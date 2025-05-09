<?php  
// Start session for tracking recently viewed and favorites
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

@$id = $_GET['id'];
if($id==''){
    redirect("index.php");
}

$lesson = new Lesson();
$res = $lesson->single_lesson($id);

// Track this view in recently viewed
if ($res) {
    // Initialize recently viewed array if not exists
    if (!isset($_SESSION['recently_viewed'])) {
        $_SESSION['recently_viewed'] = [];
    }
    
    // Create the item to store
    $viewedItem = [
        'id' => $id,
        'title' => $res->LessonTitle,
        'grade' => $res->LessonChapter,
        'strand' => $res->strand,
        'timestamp' => time()
    ];
    
    // Remove if already exists (prevent duplicates)
    $_SESSION['recently_viewed'] = array_filter($_SESSION['recently_viewed'], function($item) use ($id) {
        return $item['id'] != $id;
    });
    
    // Add to beginning of array
    array_unshift($_SESSION['recently_viewed'], $viewedItem);
    
    // Keep only last 5 items
    $_SESSION['recently_viewed'] = array_slice($_SESSION['recently_viewed'], 0, 5);
    
    // Handle favorite toggle
    if (isset($_POST['toggle_favorite'])) {
        if (!isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = [];
        }
        
        if (in_array($id, $_SESSION['favorites'])) {
            // Remove from favorites
            $_SESSION['favorites'] = array_diff($_SESSION['favorites'], [$id]);
        } else {
            // Add to favorites
            $_SESSION['favorites'][] = $id;
        }
    }
}
?> 

<h2>View PDF File</h2>
<div style="margin-bottom: 20px;">
    <p style="font-size: 18px;font-weight: bold;">
        Grade level: <?php echo htmlspecialchars($res->LessonChapter);?> | 
        Strand: <?php echo htmlspecialchars($res->strand);?> | 
        Title: <?php echo htmlspecialchars($res->LessonTitle);?>
    </p>
    <form method="post">
        <button type="submit" name="toggle_favorite" class="btn <?php echo (isset($_SESSION['favorites']) && in_array($id, $_SESSION['favorites'])) ? 'btn-warning' : 'btn-outline-warning'; ?>">
            <i class="fa fa-star"></i> 
            <?php echo (isset($_SESSION['favorites']) && in_array($id, $_SESSION['favorites'])) ? 'Favorited' : 'Mark as Favorite'; ?>
        </button>
    </form>
</div>
<div class="container">
    <embed src="<?php echo web_root.'admin/modules/lesson/'.htmlspecialchars($res->FileLocation); ?>" 
           type="application/pdf" 
           width="100%" 
           height="800px" />
</div>
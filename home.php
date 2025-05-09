<div class="col-lg-12">
    <div class="row">
        <!-- Favorites Column -->
        <div class="col-lg-6 mb-4">
            <h4>Favorite Documents</h4>
            <?php if (!empty($_SESSION['favorites'])): ?>
                <?php
                $lesson = new Lesson();
                $favoriteLessons = [];
                foreach ($_SESSION['favorites'] as $favId) {
                    $favLesson = $lesson->single_lesson($favId);
                    if ($favLesson) {
                        $favoriteLessons[] = $favLesson;
                    }
                }
                
                if (!empty($favoriteLessons)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" style="border: 1px solid #dee2e6;">
                            <thead class="thead-light" style="background-color: #f8f9fa;">
                                <tr>
                                    <th width="15%" style="border-color: #dee2e6; padding: 12px 15px;">Grade Level</th>
                                    <th width="10%" style="border-color: #dee2e6; padding: 12px 15px;">Strand</th>
                                    <th style="border-color: #dee2e6; padding: 12px 15px;">Title</th>
                                    <th width="12%" style="border-color: #dee2e6; padding: 12px 15px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($favoriteLessons as $favLesson): ?>
                                <tr style="border-color: #dee2e6;">
                                    <td style="border-color: #dee2e6; padding: 12px 15px;"><?= htmlspecialchars($favLesson->LessonChapter) ?></td>
                                    <td style="border-color: #dee2e6; padding: 12px 15px;"><?= htmlspecialchars($favLesson->strand) ?></td>
                                    <td style="border-color: #dee2e6; padding: 12px 15px;"><?= htmlspecialchars($favLesson->LessonTitle) ?></td>
                                    <td style="border-color: #dee2e6; padding: 12px 15px;">
                                        <a href="index.php?q=viewpdf&id=<?= $favLesson->LessonID ?>" 
                                           class="btn btn-xs btn-info" 
                                           style="padding: 5px 10px; background-color: #17a2b8; border-color: #17a2b8;">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                        <form method="post" action="toggle_favorite.php" style="display:inline;">
                                            <input type="hidden" name="lesson_id" value="<?= $favLesson->LessonID ?>">
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info" style="color: #0c5460; background-color: #d1ecf1; border-color: #bee5eb;">
                        No favorite documents yet.
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info" style="color: #0c5460; background-color: #d1ecf1; border-color: #bee5eb;">
                    No favorite documents yet.
                </div>
            <?php endif; ?>
        </div>

        <!-- Recently Viewed Column -->
        <div class="col-lg-6 mb-4">
            <h4>Recently Viewed Documents</h4>
            <?php if (!empty($_SESSION['recently_viewed'])): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="border: 1px solid #dee2e6;">
                        <thead class="thead-light" style="background-color: #f8f9fa;">
                            <tr>
                                <th width="15%" style="border-color: #dee2e6; padding: 12px 15px;">Grade Level</th>
                                <th width="10%" style="border-color: #dee2e6; padding: 12px 15px;">Strand</th>
                                <th style="border-color: #dee2e6; padding: 12px 15px;">Title</th>
                                <th width="12%" style="border-color: #dee2e6; padding: 12px 15px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $lesson = new Lesson();
                            foreach ($_SESSION['recently_viewed'] as $item):
                                $recentLesson = $lesson->single_lesson($item['id']);
                                if ($recentLesson):
                                    $isFavorite = isset($_SESSION['favorites']) && in_array($recentLesson->LessonID, $_SESSION['favorites']);
                            ?>
                            <tr style="border-color: #dee2e6;">
                                <td style="border-color: #dee2e6; padding: 12px 15px;"><?= htmlspecialchars($recentLesson->LessonChapter) ?></td>
                                <td style="border-color: #dee2e6; padding: 12px 15px;"><?= htmlspecialchars($recentLesson->strand) ?></td>
                                <td style="border-color: #dee2e6; padding: 12px 15px;"><?= htmlspecialchars($recentLesson->LessonTitle) ?></td>
                                <td style="border-color: #dee2e6; padding: 12px 15px;">
                                    <a href="index.php?q=viewpdf&id=<?= $recentLesson->LessonID ?>" 
                                       class="btn btn-xs btn-info" 
                                       style="padding: 5px 10px; background-color: #17a2b8; border-color: #17a2b8;">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <form method="post" action="toggle_favorite.php" style="display:inline;">
                                        <input type="hidden" name="lesson_id" value="<?= $recentLesson->LessonID ?>">
                                    </form>
                                </td>
                            </tr>
                            <?php endif; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info" style="color: #0c5460; background-color: #d1ecf1; border-color: #bee5eb;">
                    No recently viewed documents yet.
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Mission/Vision Row -->
    <div class="row">
        <div class="col-lg-12">
            <h4>Mission</h4>
            <p>To provide a holistic, relevant, quality and globally recognized IT-based education...</p>
            <h4>Vision</h4> 
            <p>To be the leader and dominant provider of relevant globally recognized information technology-based education...</p>
        </div>
    </div>
</div>

<style>
/* Exact matching styles from your original table */
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
}
.table-bordered {
    border: 1px solid #dee2e6;
}
.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6;
}
.table-hover tbody tr:hover {
    color: #212529;
    background-color: rgba(0, 0, 0, 0.075);
}
.thead-light th {
    color: #495057;
    background-color: #e9ecef;
    border-color: #dee2e6;
}
.btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}
.btn-info {
    color: #fff;
    background-color: #17a2b8;
    border-color: #17a2b8;
}
.btn-info:hover {
    color: #fff;
    background-color: #138496;
    border-color: #117a8b;
}
.btn-warning {
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
}
.btn-outline-warning {
    color: #212529;
    background-color: transparent;
    border-color: #ffc107;
}
.alert-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}
</style>
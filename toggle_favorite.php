<?php
// toggle_favorite.php
require_once("include/initialize.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['lesson_id'])) {
    // Check if user is logged in
    if (!isset($_SESSION['StudentID'])) {
        $_SESSION['message'] = "Please login to save favorites";
        $_SESSION['message_type'] = "error";
        redirect("login.php");
        exit();
    }

    $lesson_id = (int)$_POST['lesson_id'];
    $student_id = (int)$_SESSION['StudentID'];

    // Verify the lesson exists
    $lesson = new Lesson();
    $lesson_detail = $lesson->single_lesson($lesson_id);
    if (!$lesson_detail) {
        $_SESSION['message'] = "Document not found";
        $_SESSION['message_type'] = "error";
        redirect("index.php");
        exit();
    }

    // Check if already favorited
    $sql = "SELECT 1 FROM tblfavorites 
            WHERE StudentID = {$student_id} AND LessonID = {$lesson_id}";
    $mydb->setQuery($sql);
    $isFavorite = ($mydb->executeQuery() && $mydb->num_rows() > 0);

    try {
        if ($isFavorite) {
            // Remove favorite
            $sql = "DELETE FROM tblfavorites 
                    WHERE StudentID = {$student_id} AND LessonID = {$lesson_id}";
            $mydb->setQuery($sql);
            $mydb->executeQuery();
            
            $_SESSION['message'] = "Removed from favorites";
            $_SESSION['message_type'] = "success";
        } else {
            // Add favorite
            $sql = "INSERT INTO tblfavorites (StudentID, LessonID) 
                    VALUES ({$student_id}, {$lesson_id})";
            $mydb->setQuery($sql);
            $mydb->executeQuery();
            
            $_SESSION['message'] = "Added to favorites";
            $_SESSION['message_type'] = "success";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Error updating favorites: " . $e->getMessage();
        $_SESSION['message_type'] = "error";
    }

    // Redirect back to previous page
    redirect($_SERVER['HTTP_REFERER']);
} else {
    redirect("index.php");
}
?>
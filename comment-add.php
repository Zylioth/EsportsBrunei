<?php session_start(); 
include('path.php'); ?>
<?php
require_once (ROOT_PATH . '/app/database/connect.php');
$postid = $_SESSION['postid'];
$userid = $_SESSION['id'];
$commentId = isset($_POST['comment_id']) ? $_POST['comment_id'] : "";
$comment = isset($_POST['comment']) ? $_POST['comment'] : "";
$commentSenderName = isset($_POST['name']) ? $_POST['name'] : "";
$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO tbl_comment(user_id,post_id,parent_comment_id,comment,comment_sender_name,date) VALUES ('" . $userid . "','" . $postid . "','" . $commentId . "','" . $comment . "','" . $commentSenderName . "','" . $date . "')";

$result = mysqli_query($conn, $sql);

if (! $result) {
    $result = mysqli_error($conn);
}
echo $result;
?>

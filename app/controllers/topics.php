<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateTopic.php");

$table = 'topics';

$errors = array();
$id = '';
$name = '';
$description = '';

$topics = selectAll($table);

//to add a topic 
if (isset($_POST['add-topic'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-topic']);
        $topic_id = create($table, $_POST);
        $_SESSION['message'] = 'Topic created successfully';
        $_SESSION['type'] = 'success';
        if ($_SESSION['admin'] == 1) {
            header('location: ' . BASE_URL . '/admin/topics/index.php'); 
        } else if($_SESSION['admin'] == 2) {
            header('location: ' . BASE_URL . '/moderator/topics/index.php');
        } else {
            header('location: ' . BASE_URL . '/index.php');
        }
        exit();
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}

//getting id of topics
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = selectOne($table, ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

//to delete a topic
if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Topic deleted successfully';
    $_SESSION['type'] = 'success';
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/topics/index.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/topics/index.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

//to update/edit a topic created
if (isset($_POST['update-topic'])) {
    adminOnly();
    $errors = validateTopic($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-topic'], $_POST['id']);
        $topic_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Topic updated successfully';
        $_SESSION['type'] = 'success';
        if ($_SESSION['admin'] == 1) {
            header('location: ' . BASE_URL . '/admin/topics/index.php'); 
        } else if($_SESSION['admin'] == 2) {
            header('location: ' . BASE_URL . '/moderator/topics/index.php');
        } else {
            header('location: ' . BASE_URL . '/index.php');
        }
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}

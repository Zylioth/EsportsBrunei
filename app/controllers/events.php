<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");

$table = 'events';
// $table2 = 'users';
$topics = selectAll('topics');
// $events = selectAll($table);
$events = selectEvent($table ,  array('published'=> 1));

$Adminevents = selectEvent($table);

// $pCount = SELECT COUNT('payment_status') FROM 'payments' WHERE 'product_id'='61';

// $events = selectEvent($table , $table2);



$errors = array();
$id = "";
$title = "";
$body = "";
$topic_id = "";
$published = "";
$proof = "";
$s_price = "";
$category = "";
$participant_limit= "";




// to get the id of events 
if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);

    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $s_price = $post['s_price'];
    $category = $post['category'];
    $participant_limit = $post['participant_limit'];
    $topic_id = $post['topic_id'];
    $published = $post['published'];
    $image = $post['image'];

}

//to delete events created
if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = "Post deleted successfully";
    $_SESSION['type'] = "success";
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/events/index.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/events/index.php');
    } else {
        header('location: ' . BASE_URL . '/organiser/events/index.php');
    }
    exit();
}


// to publish events created for admin and moderator only
if (isset($_GET['published']) && isset($_GET['p_id'])) {
    // adminOnly();
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    $count = update($table, $p_id, ['published' => $published]);
    $_SESSION['message'] = "Event published state changed!";
    $_SESSION['type'] = "success";
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/events/index.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/events/index.php');
    } else {
        header('location: ' . BASE_URL . '/organiser/events/index.php');
    }
    exit();
}


//to create a new event  //add counter stuff sql query for participant_limit
if (isset($_POST['add-post'])) {
    // adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
           $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    } else {
       array_push($errors, "Event image required");
    }
    if (count($errors) == 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
    
        $post_id = create($table, $_POST);
        $_SESSION['message'] = "Event created successfully";
        $_SESSION['type'] = "success";
        if ($_SESSION['admin'] == 1) {
            header('location: ' . BASE_URL . '/admin/events/index.php'); 
        } else if($_SESSION['admin'] == 2) {
            header('location: ' . BASE_URL . '/moderator/events/index.php');
        } else {
            header('location: ' . BASE_URL . '/organiser/events/index.php');
        }
        exit();   
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $s_price= $_POST['s_price'];
        $category= $_POST['category'];
        $participant_limit= $_POST['participant_limit'];
        $title = $_POST['title'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}

//to edit/update a current event
if (isset($_POST['update-post'])) {
    // adminOnly();
    $errors = validatePost($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/images/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
           $_POST['image'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    } else {
       array_push($errors, "Event image required");
    }

    //function for counter of participations of upload

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
    
        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = "Event details updated successfully";
        $_SESSION['type'] = "success";
        if ($_SESSION['admin'] == 1) {
            header('location: ' . BASE_URL . '/admin/events/index.php'); 
        } else if($_SESSION['admin'] == 2) {
            header('location: ' . BASE_URL . '/moderator/events/index.php');
        } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $s_price= $_POST['s_price'];
        $category= $_POST['category'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
    }
}


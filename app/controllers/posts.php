<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validatePost.php");

$table = 'posts';

$topics = selectAll('topics');
$posts = selectAll($table);
$bookmarktable = 'bookmark';

//for bookmarked content TO BE USED
if (isset($_SESSION['id'])){
$sql = "SELECT *, b.id as bookmarkid  FROM bookmark as b 
                INNER JOIN users as u on u.id = b.userid 
                INNER JOIN posts as p on p.id = b.postid 
                WHERE b.status = 0 AND u.id = " . $_SESSION['id'];
 $stmt = $conn->prepare($sql); // preparing sql statement by first checking the connection of database
 $stmt->execute(); // executing query statement
$bookmarks = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

$errors = array();
$id = "";
$title = "";
$body = "";
$topic_id = "";
$published = "";
$bookmark = "";


// to get the id of posts

if (isset($_GET['id'])) {
    $post = selectOne($table, ['id' => $_GET['id']]);

    $_SESSION['postid'] = $post['id'];
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $topic_id = $post['topic_id'];
    $published = $post['published'];
}

//to delete posts created
if (isset($_GET['delete_id'])) {
    adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = "Post deleted successfully";
    $_SESSION['type'] = "success";
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/posts/index.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/posts/index.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

//to publish or unpublish posts created
if (isset($_GET['published']) && isset($_GET['p_id'])) {
    adminOnly();
    $published = $_GET['published'];
    $p_id = $_GET['p_id'];
    $count = update($table, $p_id, ['published' => $published]);
    $_SESSION['message'] = "Post published state changed!";
    $_SESSION['type'] = "success";
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/posts/index.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/posts/index.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}
 

//to add a new posts
if (isset($_POST['add-post'])) {
    adminOnly();
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
       array_push($errors, "Post image required");
    }
    if (count($errors) == 0) {
        unset($_POST['add-post']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
    
        $post_id = create($table, $_POST);
        $_SESSION['message'] = "Post created successfully";
        $_SESSION['type'] = "success";
        if ($_SESSION['admin'] == 1) {
            header('location: ' . BASE_URL . '/admin/posts/index.php'); 
        } else if($_SESSION['admin'] == 2)  {
            header('location: ' . BASE_URL . '/moderator/posts/index.php'); }
    } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
}

//to edit/update a created post
if (isset($_POST['update-post'])) {
    adminOnly();
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
       array_push($errors, "Post image required");
    }

    if (count($errors) == 0) {
        $id = $_POST['id'];
        unset($_POST['update-post'], $_POST['id']);
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['published'] = isset($_POST['published']) ? 1 : 0;
        $_POST['body'] = htmlentities($_POST['body']);
    
        $post_id = update($table, $id, $_POST);
        $_SESSION['message'] = "Post updated successfully";
        $_SESSION['type'] = "success";
        if ($_SESSION['admin'] == 1) {
            header('location: ' . BASE_URL . '/admin/posts/index.php'); 
        } else if($_SESSION['admin'] == 2) {
            header('location: ' . BASE_URL . '/moderator/posts/index.php');
        } else {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        $published = isset($_POST['published']) ? 1 : 0;
    }
    }

}

// to remove bookmark post (not working currently)
if (isset($_GET['bookmarkid'])) {
    // $bookmark = $_GET['p_id'];
    $bookmarkid = $_GET['bookmarkid'];
    $count = update($bookmarktable, $bookmarkid, array('status' => 1));
    $_SESSION['message'] = "This post is now listed in your bookmark post lists !";
    $_SESSION['type'] = "success";

    if ($_SESSION['admin'] == 1) {
    header('location: ' . BASE_URL . '/bookmarkpost.php'); 
} else if($_SESSION['admin'] == 2) {
    header('location: ' . BASE_URL . '/bookmarkpost.php');
} else {
    header('location: ' . BASE_URL . '/bookmarkpost.php');
 }
}

    //to bookmark a post TO BE USED
if (isset($_GET['bookmark']) && isset($_GET['p_id'])) {
    $bookmark = $_GET['p_id'];
    $p_id = $_GET['p_id'];
    $uid = $_SESSION['id'];
    $limit = "SELECT * FROM bookmark WHERE bookmark.status = 0 AND postid = $p_id AND userid = $uid ";
    $res = mysqli_query($conn, $limit);
    if(mysqli_num_rows($res) > 0){
        $fetch = mysqli_fetch_assoc($res);
        $_SESSION['message'] = "This post already exists in your bookmark list !";
        $_SESSION['type'] = "success";
    } else {
    $count = create($bookmarktable, ['postid' => $bookmark , 'userid' => $_SESSION['id'] ] );
    $_SESSION['message'] = "This post is now listed in your bookmark post lists !";
    $_SESSION['type'] = "success";
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/bookmarkpost.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/bookmarkpost.php');
    } else {
        header('location: ' . BASE_URL . '/bookmarkpost.php');
    }
}



}
 
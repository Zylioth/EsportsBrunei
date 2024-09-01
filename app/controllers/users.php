<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateUser.php");


//specify the table of User
$table = 'users'; // 'users' is from the table of users where it is called from db.php 

//for selecting all normal users ONLY
$admin_users = selectAll($table, array('admin'=> 0));

//for selecting pending organisers and normal users 
$pending_users = selectAll($table, array('admin'=> 0 , 'organiser_status' => 1));

//for selecting accepted organisers 
$organiser_users = selectAll($table, array('admin' => 3 , 'organiser_status'=> 2 ));
// $moderator_users = ;

//for selecting rejected organisers
$rejected_users = selectAll($table, array('admin' => 0 , 'organiser_status'=> 3 ));


//newly added normal users table
$normal_users = selectAllNotEqual($table ,array('admin' => 0) );


$errors = array();
$id = '';
$username = '';
$admin = '';
$email = '';
$password = '';
$passwordConf = '';
$bio = '';
$instagram = '';
$steam = '';
$discord = '';
$details = '';
$pic = '';
$proof = '';
$phone_number = '';
$status = '';



//Sessions available when user is logged into the website
function loginUser($user)
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['bio'] = $user['bio'];
    $_SESSION['instagram'] = $user['instagram'];
    $_SESSION['steam'] = $user['steam'];
    $_SESSION['discord'] = $user['discord'];
    $_SESSION['pic'] = $user['pic'];
    $_SESSION['phone_number'] = $user['phone_number'];
    $_SESSION['organiser_proof'] = $user['proof'];
    $_SESSION['details'] = $user['details'];
    $_SESSION['admin'] = $user['admin'];
    $_SESSION['status'] = $user['status'];
    $_SESSION['message'] = 'Welcome Back ' . $user['username'] . '!';
    $_SESSION['type'] = 'success';
    

    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/dashboard.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/dashboard.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();

    
}

// create normal user or moderator (for Admins ONLY)
 if (isset($_POST['create-admin'])) {
     $errors = validateUser($_POST);

     if (count($errors) === 0) {
         unset($_POST['passwordConf'], $_POST['create-admin']);
         $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_POST['status'] = 'verified';
         if (isset($_POST['admin'])) {
             $_POST['admin'] = 2;   
             $user_id = create($table, $_POST);
            $_SESSION['message'] = 'User created';
            $_SESSION['type'] = 'success';
            if ($_SESSION['admin'] == 1) {
                header('location: ' . BASE_URL . '/admin/users/index.php'); 
            } else if($_SESSION['admin'] == 2) {
                header('location: ' . BASE_URL . '/moderator/users/index.php');
            } else {
                header('location: ' . BASE_URL . '/index.php');
            }
            exit();
        } else {
             $_POST['admin'] = 0;
             $user_id = create($table, $_POST);
             $user = selectOne($table, ['id' => $user_id]);
             $_SESSION['message'] = 'User created';
             $_SESSION['type'] = 'success';
             if ($_SESSION['admin'] == 1) {
                header('location: ' . BASE_URL . '/admin/users/index.php'); 
            } else if($_SESSION['admin'] == 2) {
                header('location: ' . BASE_URL . '/moderator/users/index.php');
            } else {
                header('location: ' . BASE_URL . '/index.php');
            }
            exit();
         }
     } else {
         $username = $_POST['username'];
         $admin = isset($_POST['admin']) ? 1 : 0;
         $email = $_POST['email'];
         $password = $_POST['password'];
         $passwordConf = $_POST['passwordConf'];
     }
}

// if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
//     $errors = validateUser($_POST);

//     if (count($errors) === 0) {
//         unset($_POST['register-btn'], $_POST['passwordConf'], $_POST['create-admin']);
//         $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
       
//         if (isset($_POST['admin'])) {
//             $_POST['admin'] = 1;             
//             $user_id = create($table, $_POST);
//            $_SESSION['message'] = 'Admin user created';
//            $_SESSION['type'] = 'success';
//             header('location: ' . BASE_URL . '/admin/users/index.php'); 
//            exit();
//        } else {
//             $_POST['admin'] = 0;
//             $user_id = create($table, $_POST);
//             $user = selectOne($table, ['id' => $user_id]);
//             loginUser($user);
//         }
//     } else {
//         $username = $_POST['username'];
//         $admin = isset($_POST['admin']) ? 1 : 0;
//         $email = $_POST['email'];
//         $password = $_POST['password'];
//         $passwordConf = $_POST['passwordConf'];
//     }
// }


 
// if (isset($_POST['add-post'])) {
//     adminOnly();
//     $errors = validatePost($_POST);

    // if (!empty($_FILES['image']['name'])) {
    //     $image_name = time() . '_' . $_FILES['image']['name'];
    //     $destination = ROOT_PATH . "/assets/images/" . $image_name;

    //     $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

    //     if ($result) {
    //        $_POST['image'] = $image_name;
    //     } else {
    //         array_push($errors, "Failed to upload image");
    //     }
    // } else {
    //    array_push($errors, "Post image required");
    // }


//update user details if they can be moderator or normal users
if (isset($_POST['update-user'])) {
    $errors = validateUser($_POST);

    

    if (count($errors) === 0) {
        $id = $_POST['id'];
        unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $_POST['admin'] = isset($_POST['admin']) ? 2 : 0;
        $count = update($table, $id, $_POST);
        $_SESSION['message'] =  'user updated';
        $_SESSION['type'] = 'success';
        if ($_SESSION['admin'] == 1) {
            header('location: ' . BASE_URL . '/admin/users/index.php'); 
        } else if($_SESSION['admin'] == 2) {
            header('location: ' . BASE_URL . '/moderator/users/index.php');
        } else {
            header('location: ' . BASE_URL . '/index.php');
        }
        exit();
        
     } else {
         $username = $_POST['username'];
         $admin = isset($_POST['admin']) ? 1 : 0;
         $email = $_POST['email'];
         $password = $_POST['password'];
         $passwordConf = $_POST['passwordConf'];
     }
 }




// user update profile
if (isset($_POST['update-profile'])) {
    $errors = validateUser($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/profile/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
           $_POST['pic'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    } 

    if (count($errors) === 0) {
        $id = $_POST['id'];
       unset($_POST['passwordConf'], $_POST['update-profile'], $_POST['id']);
         $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        
        $count = update($table, $id, $_POST);
        $_SESSION['message'] = 'Profile Updated';
        $_SESSION['type'] = 'success';
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['bio'] = $_POST['bio'];
        $_SESSION['instagram'] = $_POST['instagram'];
        $_SESSION['steam'] = $_POST['steam'];
        $_SESSION['discord'] = $_POST['discord'];
        $_SESSION['pic'] = $_POST['pic'];
        $_SESSION['phone_number'] = $_POST['phone_number'];
        header('location: ' . BASE_URL . '/profile.php'); 
        exit();
        
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $bio = $_POST['bio'];
        $instagram = $_POST['instagram'];
        $steam = $_POST['steam'];
        $discord = $_POST['discord'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
}


// user register as organiser for normal registered users
if (isset($_POST['organiser-register'])) {
    $errors = validateUser($_POST);

    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/proof/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
           $_POST['proof'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image");
        }
    } else {
       array_push($errors, "image of proof required");
    }

    if (count($errors) === 0) {
        $id = $_POST['id'];
        $_POST['organiser_status'] = 1;
       unset($_POST['passwordConf'], $_POST['organiser-register'], $_POST['id']);
        //  $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $_POST['details'] = htmlentities($_POST['details']);
        
        $count = update($table, $id, $_POST);
        $_SESSION['message'] = 'Details are sent to moderator for further processing';
        $_SESSION['type'] = 'success';
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['email'] = $_POST['email'];
        // $_SESSION['details'] = $_POST['details'];
        $_SESSION['organiser_proof'] = $_POST['image'];
        header('location: ' . BASE_URL . '/organiser-reg.php'); 
        exit();
        
    } else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $details = $_POST['details'];
        // $password = $_POST['password'];
        // $passwordConf = $_POST['passwordConf'];
    }
}

// help to get user info for all update/edit/delete and view other users profile etc using the get
if (isset($_GET['id'])) {
    $user = selectOne($table, ['id' => $_GET['id']]);
    
    $id = $user['id'];
    $pic = $user['pic'];
    $username = $user['username'];
    $admin = $user['admin'];
    $proof = $user['proof'];
    $bio = $user['bio'];
    $email = $user['email'];
    $phone = $user['phone_number'];
    $instagram = $user['instagram'];
    $steam = $user['steam'];
    $discord = $user['discord'];
    $created = $user['created_at'];



}

//onclick login button
// if (isset($_POST['login-btn'])) {
//     $errors = validateLogin($_POST);

//     if (count($errors) === 0) {
//         $user = selectOne($table, ['username' => $_POST['username']]);

//         if ($user && password_verify($_POST['password'], $user['password'])) {
//             loginUser($user);
//         } else {
//            array_push($errors, 'Wrong credentials');
//         }
//     }

//     $username = $_POST['username'];
//     $password = $_POST['password'];
// }


//function for deleting user/moderator
if (isset($_GET['delete_id'])) {
 adminOnly();
    $count = delete($table, $_GET['delete_id']);
    $_SESSION['message'] = 'User deleted';
    $_SESSION['type'] = 'success';
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/users/index.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/users/index.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

//function for banning user temporary 
if (isset($_GET['blocked']) && isset($_GET['p_id'])) {
    adminOnly();
    $blocked = $_GET['blocked'];
    $user = $_GET['p_id'];
    $count = update($table, $user, ['blocked' => $blocked]);
    $_SESSION['message'] = "User status changed successfully !";
    $_SESSION['type'] = "success";
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/players/index.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/players/index.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

//function for banning organiser temporary 
if (isset($_GET['organiser_blocked']) && isset($_GET['p_id'])) {
    adminOnly();
    $blocked = $_GET['organiser_blocked'];
    $user = $_GET['p_id'];
    $count = update($table, $user, ['blocked' => $blocked]);
    $_SESSION['message'] = "User status changed successfully !";
    $_SESSION['type'] = "success";
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/organiserlist/accepted.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/organiserlist/accepted.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}

//function for pending organisers
if (isset($_GET['admin']) && isset($_GET['p_id'])) {
    adminOnly();
    $organiser = $_GET['admin'];
    $organiser_status = $_GET['organiser_status'];
    $user = $_GET['p_id'];
    $count = update($table, $user, ['admin' => $organiser , 'organiser_status' => $organiser_status]);
    $_SESSION['message'] = "User has been promoted as an organiser !";
    $_SESSION['type'] = "success";
    if ($_SESSION['admin'] == 1) {
        header('location: ' . BASE_URL . '/admin/organiserlist/index.php'); 
    } else if($_SESSION['admin'] == 2) {
        header('location: ' . BASE_URL . '/moderator/organiserlist/index.php');
    } else {
        header('location: ' . BASE_URL . '/index.php');
    }
    exit();
}
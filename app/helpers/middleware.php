<?php

// function for user redirection of page only for normal users 
function usersOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id'])) {
        $_SESSION['message'] = 'You need to login first';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }
}


// function for user redirection of page only for admin/moderator/organisers users For dashboard access 
function adminOnly($redirect = '/index.php')
{
    if (empty($_SESSION['id']) || empty($_SESSION['admin'])) {
        $_SESSION['message'] = 'You are not authorized';
        $_SESSION['type'] = 'error';
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }
}

// function organiserOnly($redirect = '/index.php')
// {
//     if (empty($_SESSION['id']) || empty($_SESSION['organiser'])) {
//         $_SESSION['message'] = 'You are not authorized';
//         $_SESSION['type'] = 'error';
//         header('location: ' . BASE_URL . $redirect);
//         exit(0);
//     }
// }


function guestsOnly($redirect = '/index.php')
{
    if (isset($_SESSION['id'])) {
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }    
}
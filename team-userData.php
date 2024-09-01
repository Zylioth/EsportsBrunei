<?php
session_start();
require "app/database/connect.php";
include "app/includes/sidebar.php";
$teamName = "";
$username = "";
$errors = array();



//if user team registration button
if(isset($_POST['teamReg'])){
    $userId = $_SESSION['id'];
    $teamName = $_POST['teamName'];
    $teamCoach =  $_POST['teamCoach'];
    // $teamLogo = $_POST['image'];
    $limit = $_POST['limit'];


    //TEAM NAME
    $teamCheck = "SELECT * FROM teams WHERE team_name = '$teamName'";
    $res = mysqli_query($conn, $teamCheck);
    if(mysqli_num_rows($res) > 0){
        $errors['teamName'] = "The name of the team that you have entered is already exist for another team! Please use another!";
    }

    //PROFANITY FILTER
    $profanities =  array('fuck','shit','bullshit','motherfucker','ass','nigga','tranny','piss'); //this array is for inserting such

    foreach ($profanities as $value) {
        if(strpos($teamName, $value) !== false){
            $errors['teamName'] = "The name of the team contains abusive language. Please change the team name.";
        }
      }

    //TEAM COACH - IN TEAMS DATABASE
    $teamCC = "SELECT * FROM teams WHERE team_coach = '$teamCoach'";
    $res = mysqli_query($conn, $teamCC);
    if(mysqli_num_rows($res) > 0){
        $errors['teamCoach'] = "The name of the coach is already being used for another team! Please check again.";
    }

    //TEAM COACH - IN USER DATABASE
    $teamUC = "SELECT * FROM users WHERE username = '$teamCoach'";
    if($teamUC === $teamCoach){
        $errors['teamCoach'] = "The name of the coach does not exist in the database! Please ensure that coach is registered first.";
    }

    //CHECK LIMIT REGISTRATION FOR TEAMS
    $teamCreator = "SELECT * FROM teams WHERE team_creator = '$userId'";
    $res = mysqli_query($conn, $teamCreator);
    if(mysqli_num_rows($res) > 2){
        $errors['id'] = "You've reached your maximum registration for teams!";
    }

    //UPLOAD IMAGE
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        $destination = ROOT_PATH . "/assets/team_logo/" . $image_name;

        $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

        if ($result) {
           $_POST['pic'] = $image_name;
        } else {
            array_push($errors, "Failed to upload image.");
        }
    } else {
       array_push($errors, "Profile image required.");
    }

    //INSERT TO TEAM DATABASE
    if(count($errors) === 0){
    $insert_data = "INSERT INTO teams (team_name, team_coach, team_creator, team_captain, team_logo, limit_members)
                         values('$teamName', '$teamCoach', '$userId', '$userId', '$image_name', '$limit')";
        $data_check = mysqli_query($conn, $insert_data);

        $team_id = "SELECT * FROM teams WHERE team_name = '$teamName'";
        $res = mysqli_query($conn, $team_id);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $teamRegId = $fetch['id'];
        }

    //INSERT TEAM MEMBERS DATABASE
    $insert_data_to_member_table = "INSERT INTO team_members (team_id, member_id)
                                values('$teamRegId', '$userId')";
                $data_check02 = mysqli_query($conn, $insert_data_to_member_table);

    //CHECKING IF INSERTED ALL
        if($data_check){
            if($data_check02){
                header('location: team-menu.php');
                exit();}
            else{
                    $errors['db-error'] = "Failed while inserting data into database!";
                    }
        } else{
             $errors['db-error'] = "Failed while inserting data into database!";
             }
            }
        }

        
        
?>
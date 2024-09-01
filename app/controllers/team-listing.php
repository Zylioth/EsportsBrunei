<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'teams';
//selecting/getting teams
$tableMembers = 'team_members';

$teams  = selectAll('teams');
$teamMembers = selectAll('team_members');
$userId = $_SESSION['id'];

$errors = array();

//(Adding Members)
//selecting where they have the same id as user in the same team

// //select all in the column that should not equal to the user's team_id
// $checkTeams = selectAllNotEqual($tableMembers ,array('team_id' => $teamUserAdd) );

// (DELETING MEMBERS)
$teamUserDelete = "SELECT * FROM users WHERE id = ( SELECT member_id FROM team_members WHERE id = member_id);";

?>
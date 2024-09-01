<?php

session_start();
require('connect.php');



function dd($value) // to be deleted
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}


//function to execute query
function executeQuery($sql, $data)
{
    global $conn;
    $stmt = $conn->prepare($sql); // preparing sql statement by first checking the connection of database
    $values = array_values($data); // getting array values from $data 
    $types = str_repeat('s', count($values)); // repeating the string 's' and count is the number of times you want to repeat by passing $values 
    $stmt->bind_param($types, ...$values); //bind all the values into the query by matching the conditions needed to execute the query
    $stmt->execute(); // executing query statement
    return $stmt; // returns the result of the statement query   
}

// function to get all values from database table column array 
function selectAll($table, $conditions = [])
{
    global $conn; 
    $sql = "SELECT * FROM $table"; // selecting data from database table
    if (empty($conditions)) {  // if conditions is empty then returns every records in the database table
        $stmt = $conn->prepare($sql); // preparing sql statement by first checking the connection of database
        $stmt->execute(); // executing the statement
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); // fetching the result of $records statement
        return $records; //returns the result of selected/all record
    } else { // else if it is not empty then it returns the provided conditions array ($conditions) 
        $i = 0;
        foreach ($conditions as $key => $value) { //to loop through the condition
            if ($i === 0) { // if the index value is  0 then it will proceed to
                $sql = $sql . " WHERE $key=?"; // this WHERE =? is a placeholder
            } else {
                $sql = $sql . " AND $key=?"; // else if the index value is not 0 then it will return this AND
            }
            $i++; // then the firstly indexed value will keep increasing 
        }

        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

// function selectEvent($table, $table2 )
// {
//     global $conn;
//      $sql = "SELECT * FROM $table";
//          $sql = $sql . " INNER JOIN ". $table2 . " ON " . $table . ".user_id = " . $table2 . ".id ";
//         $stmt = $conn->prepare($sql);
//         $stmt->execute();
//         $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
//         return $records;

//     }


// function to get all values from database events table column array 
function selectEvent($table, $conditions = [])
{
    global $conn;
    $sql =" select e.id as eventid, e.user_id, topic_id,title, image, body, published, e.created_at, u.id, username from events e inner join users u ON e.user_id = u.id ";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }

        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

// function to get all values that are not equal from database table column array  when called in another function

function selectAllNotEqual($table, $conditions = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    } else {
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key != ?";
            } else {
                $sql = $sql . " AND $key != ?";
            }
            $i++;
        }

        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

// function for turning users into organisers if accepted (unused)
// function selectAllNotEqualOrganiser($table, $conditions = [])
// {
//     global $conn;
//     $sql = "SELECT * FROM $table";
//     if (empty($conditions)) {
//         $stmt = $conn->prepare($sql);
//         $stmt->execute();
//         $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
//         return $records;
//     } else {
//         $i = 0;
//         foreach ($conditions as $key => $value) {
//             if ($i === 0) {
//                 $sql = $sql . " WHERE $key != ?";
//             } else {
//                 $sql = $sql . " AND $key != ?";
//             }
//             $i++;
//         }

//         $stmt = executeQuery($sql, $conditions);
//         $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
//         return $records;
//     }
// }

// function to get only one value (specified) from database table column array

function selectOne($table, $conditions)
{
    global $conn;
    $sql = "SELECT * FROM $table"; 

    $i = 0; 
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $sql = $sql . " LIMIT 1"; 
    $stmt = executeQuery($sql, $conditions); //setting the $stmt value to the function ExecuteQuery above
    $records = $stmt->get_result()->fetch_assoc(); // getting the records or all 
    return $records; //returns the result of $records
}

// function to execute a create function (CRUD)

function create($table, $data)
{
    global $conn;
    $sql = "INSERT INTO $table SET "; // creates or inserting new data into database table

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $stmt = executeQuery($sql, $data); //setting the $stmt value to the function ExecuteQuery above
    $id = $stmt->insert_id; //get the id of the inserted record
    return $id; // returns the id of inserted record
}


// function to execute a update function (CRUD)

function update($table, $id, $data)
{
    global $conn;
    $sql = "UPDATE $table SET "; // updates the data into the database table

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?"; 
    $data['id'] = $id; // setting a key of 'id' giving it to the value of $id
    $stmt = executeQuery($sql, $data); //setting the $stmt value to the function ExecuteQuery above
    return $stmt->affected_rows;  
}



// function to execute a delete function (CRUD)

function delete($table, $id)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE id=?"; // deletes the data from the database table


    $stmt = executeQuery($sql, ['id' => $id]); 
    return $stmt->affected_rows;
}

// function to get published post where it check from databse post table where it only gets the value is = 1

function getPublishedPosts()
{
    global $conn;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=?";

    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

// function to get published post's topic id where it check from databse post table where it only gets the value of 'published' is = 1 and the topic id

function getPostsByTopicId($topic_id)
{
    global $conn;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=?";

    $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

// function to search the post specified 

function searchPosts($term)
{
    $match = '%' . $term . '%';
    global $conn;
    $sql = "SELECT
                p.*, u.username
            FROM posts AS p  
            JOIN users AS u
            ON p.user_id=u.id
            WHERE p.published=?
            AND p.title LIKE ?"; 
            //table post and users known as 'p' and 'u'
            //from table post under title match on term

    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

//payment function
function verifyTransaction($data) {
    global $paypalUrl;

    $req = 'cmd=_notify-validate';
    foreach ($data as $key => $value) {
        $value = urlencode(stripslashes($value));
        $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
        $req .= "&$key=$value";
    }

    $ch = curl_init($paypalUrl);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
    $res = curl_exec($ch);

    if (!$res) {
        $errno = curl_errno($ch);
        $errstr = curl_error($ch);
        curl_close($ch);
        throw new Exception("cURL error: [$errno] $errstr");
    }

    $info = curl_getinfo($ch);

    // Check the http response
    $httpCode = $info['http_code'];
    if ($httpCode != 200) {
        throw new Exception("PayPal responded with http code $httpCode");
    }
    curl_close($ch);

    return $res === 'VERIFIED';
}
function checkTxnid($txnid) {
    global $conn;

    $txnid = $conn->real_escape_string($txnid);
    $results = $conn->query('SELECT * FROM `payments` WHERE txnid = \'' . $txnid . '\'');

    return ! $results->num_rows;
}


function addPayment($data) {
    global $conn;

    if (is_array($data)) {
        $stmt = $conn->prepare('INSERT INTO `payments` (txnid, payment_amount, payment_status, itemid, createdtime) VALUES(?, ?, ?, ?, ?)');
        $stmt->bind_param(
            'sdsss',
            $data['txn_id'],
            $data['payment_amount'],
            $data['payment_status'],
            $data['item_number'],
            date('Y-m-d H:i:s')
        );
        $stmt->execute();
        $stmt->close();

        return $conn->insert_id;
    }

    return false;
}
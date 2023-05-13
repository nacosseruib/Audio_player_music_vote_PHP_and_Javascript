<?php
header( 'content-type: text/html; charset:utf-8' );
session_start();
error_reporting( 0 );


//CONNECT TO DATABASE
$servername = "localhost";
$database = "tune_box";
$username = "root";
$passwordDb = "";
// Create connection
$conn = mysqli_connect($servername, $username, $passwordDb, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//Update
$id = $_GET['id'];
$status = $_GET['status'];

if($status == 'true'){
    $sql = "UPDATE vote SET vote_count = (vote_count + 1) WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        //die( "Record updated successfully");
    } else {
        //die( "Error updating record: " . $conn->error);
    }
}else if($status == 'false'){
    $sql = "UPDATE vote SET vote_count = (vote_count - 1) WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        //die( "Record updated successfully");
    } else {
        //die( "Error updating record: " . $conn->error);
    }
}else if($status == 'delete'){
    $sql = "DELETE FROM vote WHERE id=$id";
    $conn->query($sql);
    
    header("Location: index.php");
    exit();
}else if($status == 'clear'){
    $sql = "DELETE FROM vote";
    $conn->query($sql);
       
    header("Location: index.php");
    exit();
}


header("Location: vote.php");
exit();

mysqli_close($conn);
//END CONNECTION

?>
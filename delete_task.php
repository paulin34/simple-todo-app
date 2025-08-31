<?php

include 'db.php';
if($_SERVER['REQUEST_METHOD'] != 'GET' || !isset($_GET['id']))
{
    die("Error");
}
$id = $_GET['id'];

$stmt = $sql->prepare("DELETE FROM $table_name WHERE ID=?");
$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: index.php");
die();

?>
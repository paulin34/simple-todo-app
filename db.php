<?php 

$db = "todo_app";
$hostname = "localhost";
$username = "root";
$password = "1234";
$sql = new mysqli($hostname ,$username, $password,$db);
if($sql->connect_error)
{
    die("Error connecting to database : " . $sql->connect_error);
}

$table_name = "task";

function select_all(): bool|mysqli_result
{
    global $sql , $table_name;
    $result = $sql->query("SELECT * FROM {$table_name} WHERE 1 ORDER BY CreatedAt DESC");
    return $result;
}


?>
<?php

include "db.php";

add();

function add(): void
{
    $deadline = $_GET["deadline"];
    $name = isset($_GET["name"]) ? $_GET["name"] : null;
    if($name==null || $deadline==null)
    {
        echo "Task definition invalid!";
        die();
    }
    $deadline = parse($deadline);

    global $sql, $table_name;

    echo "$name <br> $deadline";
    $sql->query("INSERT INTO $table_name (Name, Deadline) VALUES ('$name' , '$deadline') ");
    print_r($sql->error_list);
    
}


function parse(string $date):string
{
    $date = strtotime($date);
    $new_date = date("Y-m-d H:i:s",$date);
    return $new_date;
}

header("Location: index.php");
die();

?>
<?php

include("connection.php");

try
{
    $con = new Connection;
    $dbhelper = $con->getCon();

    if(!$con || !$dbhelper)
    {
        throw new Exception("Error connection to database");

    }
    //else
    //echo "Successfully Connected";
}

catch(PDOException $e)
{
    echo $e->getMessage();
}

?>
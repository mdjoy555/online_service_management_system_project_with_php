<?php
    $username = "root";
    $password = "";
    $hostname = "localhost";
    $db = "ms";

    $conn = mysqli_connect($hostname, $username, $password, $db);

    if(!$conn) // or we can use ($conn->connect_error)
    {
        die("Connection failed :" . mysqli_connect_error());
    }
    #else
    #{
    #    echo "Connected Successfully";
    #}

?>
<?php

    $servername = "localhost";
    $username = "planeuzp_lobola";
    $password = "qmg@2339";
    $dbname = "planeuzp_signups";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);

    // Check connection
    if ( !$conn ) {

       die("Connection failed: " . mysqli_connect_error());
    }

    // echo "Connected successfully". "<br>";

?>
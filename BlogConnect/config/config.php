<?php

    try {
        //host
        $host = "localhost";

        //dbname
        $dbname = "blogconnect";

        //user
        $user = "root";

        //pass
        $pass = "";


        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        echo $e->getMessage();

    }


    


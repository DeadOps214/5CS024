<?php
    $dbhost = "localhost";
    $dbuser = "2216418";
    $dbpass = "TrapScum4life";
    $dbname = "db2216418";

    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
    {
        die("fail to connect!!");
    }
    


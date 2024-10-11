<?php
    $con = mysqli_connect("localhost","root","","data_perpus");
    if($con == false){
        die("Connectiin Error" . mysqli_connect_error());
    }
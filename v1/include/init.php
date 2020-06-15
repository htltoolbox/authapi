<?php

    include 'keys.php';

    $conn = mysqli_connect('philsoft.at','toolbox_api',$databasekey,'toolbox');

    date_default_timezone_set('Europe/Vienna');
    $date = date('Y-m-d G:i:s');
?>
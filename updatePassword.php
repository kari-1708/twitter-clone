<?php
    include("functions.php");
    $email="pankitrocks@gmail.com";
    $password="12345678";
    $hashPwd = password_hash($password,PASSWORD_DEFAULT);
    $queryUpdate = "update users set password='".$hashPwd."' where email='".mysqli_real_escape_string($link,$email)."'";
    echo $queryUpdate;
    //$resultUpdate = mysqli_query($link,$queryInsert);
?>
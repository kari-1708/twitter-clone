<?php
    include("functions.php");
    if($_GET['action']=="loginSignUp"){
        $error="";
        $email=$_POST["email"];
        $password=$_POST["password"];
        $loginActive=$_POST["loginActive"];
        if(!$email){
            $error.="The email id is required<br/>";
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $error.="Email id is not valid<br/>";
        }

        if(!$password){
            $error.="The password is required<br/>";
        }

        if($error!=""){
            // $error='<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>'.$error.'</div>';
            $error="<p><strong>There were error(s) in your form:</strong></p>".$error;
            echo $error;
            exit();
        }
        $queryCheck = "select * from users where email='".mysqli_real_escape_string($link,$email)."'";
        $resultCheck = mysqli_query($link,$queryCheck);
        if($loginActive=="0"){
            if(mysqli_fetch_array($resultCheck)>0){
                $error='The email id is already registered';
                exit();
            }
            else{
                $hashPwd = password_hash($password,PASSWORD_DEFAULT);
                $queryInsert = "insert into users (email,password) values ('".mysqli_real_escape_string($link,$email)."','".$hashPwd."')";
                $resultInsert = mysqli_query($link,$queryInsert);
                if($resultInsert){
                    $_SESSION['email']=$email;
                }
                else{
                    $error='We couldn\'t register you now. Try again later...';
                    exit();
                }
            }  
        }
        else{
            $row=mysqli_fetch_array($resultCheck);
            if(!$row){
                $error= "Email id is not registered. PLease Sign Up first";
                exit();
            }
            else{
                $hashPwd = $row["password"];
                if(password_verify($password,$hashPwd)){
                    $_SESSION['email']=$email;
                }
                else{
                    $error='Email id or password do not match. Please enter the correct details...';
                    exit();
                }
            }    
        }
        if($error!=""){
            echo $error;
            exit();
        }
        else{
            echo 1;
        }
    }
    else if($_GET['action']=="toggleFollow"){
        $email=$_SESSION["email"];
        $userEmail=$_POST["userEmail"];
        $queryCheck = "select * from followers where follower='".mysqli_real_escape_string($link,$email)."' and isFollowing='".mysqli_real_escape_string($link,$userEmail)."'";
        $resultCheck = mysqli_query($link,$queryCheck);
        if(mysqli_num_rows($resultCheck)>0){
            $row=mysqli_fetch_assoc($resultCheck);
            $queryDelete = "delete from followers where id=".$row["id"];
            mysqli_query($link,$queryDelete);
            echo 1;
        }
        else{
            $queryInsert= "insert into followers (follower,isFollowing) values ('".mysqli_real_escape_string($link,$email)."','".mysqli_real_escape_string($link,$userEmail)."')";
            mysqli_query($link,$queryInsert);
            echo 2;
        }
    }
    else if($_GET['action']=="postTweet"){
        $email=$_SESSION["email"];
        $tweet=$_POST["tweet"];
        if($tweet==""){
            $error="Please write some content to post";
            exit();            
        }
        else if(strlen($tweet)>140){
            $error="Your Tweet is too long...";
            exit();
        }
        $queryInsert= "insert into tweets (tweet,email) values ('".mysqli_real_escape_string($link,$tweet)."','".mysqli_real_escape_string($link,$email)."')";
        mysqli_query($link,$queryInsert);
        echo 1;
    }
?>
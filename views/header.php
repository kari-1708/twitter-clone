<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet">
        <title>Twitter</title>
    </head>
    <body> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Twitter</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="?page=timeline">Your Timeline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=tweets">Your Tweets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=publicprofile">Public Profiles</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <!-- Button trigger modal -->
                        <?php
                            if($_SESSION && $_SESSION["email"]){
                        ?>
                                <a type="button" class="btn btn-outline-success" href="?function=logout">
                                    Logout
                                </a>
                        <?php
                            }
                            else{
                        ?>
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Login/Sign Up
                                </button>
                        <?php        
                            }
                        ?>                        
                    </div>
                </div>
            </div>
        </nav>

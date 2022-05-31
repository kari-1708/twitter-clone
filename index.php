<?php
    include("functions.php");
    include("views/header.php");
    if(array_key_exists("page",$_GET)){
        $pageName=$_GET["page"];
        if($pageName=="timeline"){
            include("views/timeline.php");
        }
        else if($pageName=="tweets"){
            include("views/mytweets.php");
        }
        else if($pageName=="search"){
            include("views/search.php");
        }
        else if($pageName=="publicprofile"){
            include("views/publicprofile.php");
        }
        else{
            include("views/home.php");
        }
    }
    else{
        include("views/home.php");
    }    
    include("views/footer.php");
?>
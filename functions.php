<?php
    session_start();
    $link = mysqli_connect("localhost","admin","karishma@123","twitter");
    if(mysqli_connect_error()){
        die ("Database Connection failed");
        exit();
    }

    if($_GET){
        if(array_key_exists("function",$_GET) && $_GET["function"]=="logout"){
            unset($_SESSION["email"]);
        }
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    function displayTweets($type){
        global $link;
        $whereClause="";
        $email="";
        $followArray=array();
        if(array_key_exists("email",$_SESSION)){
            $email=$_SESSION["email"];
        }
        $queryFollowing = "select isFollowing from followers where follower='".mysqli_real_escape_string($link,$email)."'";
        $resultFollowing = mysqli_query($link,$queryFollowing);
        if(mysqli_num_rows($resultFollowing)>0){
            while($row=mysqli_fetch_assoc($resultFollowing)){
                array_push($followArray,$row["isFollowing"]);
            }
        }

        if($type=="all");
        else if($type=="isFollowing"){
            $queryCheck = "select * from followers where follower='".mysqli_real_escape_string($link,$email)."'";
            $resultCheck = mysqli_query($link,$queryCheck);
            while($row=mysqli_fetch_assoc($resultCheck)){
                if($whereClause==""){
                    $whereClause="where email='".mysqli_real_escape_string($link,$row["isFollowing"])."'";
                }
                else{
                    $whereClause.=" or email='".mysqli_real_escape_string($link,row["isFollowing"])."'";
                }
            }
            if($whereClause==""){
                $whereClause="where email='1'";
            }
        }
        else if($type=="myTweets"){
            $whereClause="where email='".mysqli_real_escape_string($link,$email)."'";
        }
        else if($type=="search"){
            echo "<h5>Showing Results for \"".$_GET['search']."\"</h5>";
            $whereClause="where tweet like '%".mysqli_real_escape_string($link,$_GET["search"])."%'";
        }
        else{ 
            echo "<h5>Showing Results for ".$type."'s Tweets</h5>";
            $whereClause="where email='".mysqli_real_escape_string($link,$type)."'";
        }
        $queryTweets="select * from tweets ".$whereClause." order by datetime desc";
        $resultTweets = mysqli_query($link,$queryTweets);
        if(mysqli_num_rows($resultTweets)>0){
            while($row = mysqli_fetch_assoc($resultTweets)){
                echo "<div class='tweet'><p><a href='?page=publicprofile&userEmail=".$row["email"]."'>".$row["email"]."</a><span class='time'>  ".time_since(time()-strtotime($row["datetime"]))." ago</span></p>";
                echo "<p>".$row["tweet"]."</p>";
                if($type!="myTweets"){
                    echo "<p><a class='toggleFollow' data-email='".$row["email"]."' href='javascript:void(0)'>";
                    if(in_array($row["email"],$followArray)){
                        echo "Unfollow";
                    }
                    else{
                        echo "Follow";
                    }
                    echo "</a></p>";
                }
                echo "</div>";
            }
        }
        else{
            echo "There are no tweets";
        }
    }

    function displaySearch(){
        echo '<form class="d-flex" role="search" id="searchForm">
                <input class="form-control me-2" type="search" placeholder="Search" id="search" name="search" required>
                <input type="hidden" name="page" id="page" value="search"/>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>';
    }

    function displayTweetBox(){
        if(array_key_exists("email",$_SESSION)){
            echo '<div id="tweetSuccess" class="alert alert-success">Your tweet was posted successfully.</div>
                    <div id="tweetFail" class="alert alert-danger"></div>
                    <div class="form" role="search">
                        <textarea class="form-control mb-2" type="search" id="tweetContent"></textarea>                    
                        <button class="btn btn-outline-success" id="postTweet">Post Tweet</button>
                    </div>';
        }        
    }

    function displayUsers(){
        global $link;
        $queryUsers = "select * from users";
        $resultQuery = mysqli_query($link,$queryUsers);
        if(mysqli_num_rows($resultQuery)>0){
            while($row=mysqli_fetch_assoc($resultQuery)){
                echo "<p><a href='?page=publicprofile&userEmail=".$row["email"]."'>".$row["email"]."</a></p>";
            }
        }
    }
?>
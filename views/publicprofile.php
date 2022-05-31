<div class="container">
    <div class="row">
        <div class="col-6 col-md-8">
            <?php
                if(array_key_exists("userEmail",$_GET)){
                    displayTweets($_GET["userEmail"]);
            ?>
            <?php
                }
                else{
            ?>
                    <h2>Active Profile</h2>
            <?php
                    displayUsers();
                }
            ?>
        </div>
        <div class="col-6 col-md-4">
            <?php displaySearch(); ?>
            <hr>
            <?php displayTweetBox(); ?>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-6 col-md-8">
            <h2>Recent Tweets</h2>
            <?php
                displayTweets("all");
            ?>
        </div>
        <div class="col-6 col-md-4">
            <?php displaySearch(); ?>
            <hr>
            <?php displayTweetBox(); ?>
        </div>
    </div>
</div>

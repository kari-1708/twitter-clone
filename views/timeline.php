<div class="container">
    <div class="row">
        <div class="col-6 col-md-8">
            <h2>My Timeline</h2>
            <?php
                displayTweets("isFollowing");
            ?>
        </div>
        <div class="col-6 col-md-4">
            <?php displaySearch(); ?>
            <hr>
            <?php displayTweetBox(); ?>
        </div>
    </div>
</div>

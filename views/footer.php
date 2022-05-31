        
        
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container">
                <p class="text-muted">&copy;My Website <?php echo date("Y");?></p>
            </div>
        </footer>       
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="alert alert-danger error" role="alert"><p></p></div>
                        <form method="post" id="loginForm">
                            <fieldset class="form-group mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email"/>
                            </fieldset>
                            <fieldset class="form-group mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
                            </fieldset>
                            <!-- <fieldset class="form-group">
                                <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" name="stayLogged" id="stayLogged">
                                    <label class="form-check-label" for="stayLogged">Stay Logged In </label>
                                </div>
                            </fieldset> -->
                            <fieldset class="form-group">
                                <input type="hidden" id="loginActive" name="loginActive" value="1"/>
                            </fieldset>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a class="toggleLogin" href="javascript:void(0)">Sign Up</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="loginButton">Login</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(".toggleLogin").click(function(){
                if($("#loginActive").val()=="1"){
                    //login page displayed
                    $("#loginModalLabel").text("Sign Up");
                    $(".toggleLogin").text("Login");
                    $("#loginButton").text("Sign Up");
                    $("#loginActive").val("0");
                }
                else{
                    // signup page displayed
                    $("#loginModalLabel").text("Login");
                    $(".toggleLogin").text("Sign Up");
                    $("#loginButton").text("Login");
                    $("#loginActive").val("1");
                }
            }); 

            $("#loginButton").click(function(){
                $email=$("#email").val();
                $password=$("#password").val();
                $error="";
                $mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                $pwdformat = /^(?=.\d)(?=.[!@#$%^&])(?=.[a-z])(?=.*[A-Z]).{8,20}$/;
                if($email==''){
                    $error+= "The email id is required<br/>";
                }
                else{
                    if(!($email.match($mailformat))){
                        $error+= "Email id is not valid<br/>";
                    }
                }
                if($password==''){
                    $error+= "The password is required<br/>";
                }
                // else if(!($password.match($pwdformat))){
                //     $error+= "The password should be of minimum 8 and maximum 20 characters and should contain atleast one captial letter, one small letter, one number and one special character";
                // }

                if($error!=""){
                    $(".error").html($error).show();
                }
                else{
                    $(".error").hide();
                    $.ajax({
                        type: "POST",
                        url: "action.php?action=loginSignUp",
                        data: "email="+$email+"&password="+$("#password").val()+"&loginActive="+$("#loginActive").val(),
                        success: function(result){
                            if(result=="1"){
                                window.location.assign("http://localhost/twitter-clone/");
                            }
                            else{
                                $(".error").html(result).show();
                            }
                        }
                    })
                }
            });

            $(".toggleFollow").click(function(){
                $userEmail = $(this).attr("data-email");
                $.ajax({
                    type: "POST",
                    url: "action.php?action=toggleFollow",
                    data: "userEmail="+$userEmail,
                    success: function(result){
                        if(result==1){
                            $("a[data-email='"+$userEmail+"']").text("Follow");
                            window.location.reload(true);
                        }
                        else if(result==2){
                            $("a[data-email='"+$userEmail+"']").text("Unfollow");
                            window.location.reload(true);
                        }
                    }
                })
            });

            $("#postTweet").click(function(){
                $tweetContent=$("#tweetContent").val();
                if($tweetContent==""){
                    $("#tweetSuccess").hide();
                    $("#tweetFail").text("Please write some content to post").show();
                }
                else if($tweetContent.length>140){                    
                    $("#tweetSuccess").hide();
                    $("#tweetFail").text("Your Tweet is too long...").show();
                }
                else{
                    $.ajax({
                        type: "POST",
                        data: "tweet="+$tweetContent,
                        url: "action.php?action=postTweet",
                        success: function(result){
                            if(result==1){
                                $("#tweetSuccess").show();
                                $("#tweetFail").hide();
                            }
                            else{
                                $("#tweetFail").html(result).show();
                                $("#tweetSuccess").hide();
                            }
                        }
                    })
                }
            });
        </script>
    </body>
</html>
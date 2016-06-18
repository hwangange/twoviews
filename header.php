
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class = "container-fluid" style = "height: 75px; background-color: black" id = "header-top">
            <h1 style = "text-align:center; color: white">TWO VIEWS</h1>
        </div>
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Two Views</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="myNav">
                <ul class="nav navbar-nav">
                    <li class = "dropdown">
                        
                            <a class = "dropdown-toggle" data-toggle = "dropdown" href = "#">News<b class = "caret"></b></a>
                                <ul class = "dropdown-menu" role = "menu" aria-labelledby="dLabel">
                                    <li><a href = "genre.php?genre=United States">United States</a></li>
                                    <li><a href = "genre.php?genre=Viral News">Viral News</a></li>
                                    <li><a href = "genre.php?genre=International">International</a></li>
                                </ul>
                      
                    </li>
                    <li>
                        <a href = "genre.php?genre=Tech">Tech & Sciences</a>
                    </li>
                    <li>
                        <a href = "genre.php?genre=Entertainment">Entertainment</a>
                    </li>
                    <li>
                        <a href = "genre.php?genre=School">School</a>
                    </li>
                    <li>
                        <a href = "genre.php?genre=Lifestyle">Lifestyle & Health</a>
                    </li>
                    <li>
                        <a href = "genre.php?genre=Editorials">Editorials</a>
                    </li>
                    <li class = "dropdown">
                        <a class = "dropdown-toggle" data-toggle = "dropdown" href = "#">About Us<b class = "caret"></b></a>
                                <ul class = "dropdown-menu" role = "menu" aria-labelledby="dLabel">
                                    <li><a href = "staff.php">Our Staff</a></li>
                                    <li><a href = "contact.php">Contact Us</a></li>
                                </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

        <!-- Navigation -->

   <!-- <script>
        $(document).ready(function(){
            $('#news-link').click(function() {
                request = $.ajax({
                    url: "genre.php",
                    type: "POST",
                    data: {genre: "News"}
                });

                // callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR){
                    // log a message to the console
                    console.log("Hooray, it worked!");
                    window.location.href = "genre.php";
                });

                // callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    // log the error to the console
                    console.error(
                        "The following error occured: "+
                        textStatus, errorThrown
                    );
                });

            });
        });
        
    </script> -->
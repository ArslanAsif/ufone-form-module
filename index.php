<?php
session_start();
require('config/config.php');

function checkDuplicateUser($email , $dbhelper)
{
    $stmt = $dbhelper->prepare("SELECT * FROM user_info WHERE userEmail=?");
    $stmt->bindParam('1', $email);

    $stmt->execute();

    if($result = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        return true;
    }
    return false;
}

function insertUser($fullname, $email, $password, $dob, $gender, $area , $dbhelper)
{
    $stmt = $dbhelper->prepare("INSERT INTO user_info(userName, userEmail, pass, gender, dob, area) VALUES(?, ?, ?, ?, ?, ?)");
    $stmt->bindParam('1', $fullname);
    $stmt->bindParam('2', $email);
    $stmt->bindParam('3', $password);
    $stmt->bindParam('4', $gender);
    $stmt->bindParam('5', $dob);
    $stmt->bindParam('6', $area);
    $stmt->execute();
    echo $fullname." ".$email." ".$password." ".$dob." ".$gender." ".$area;
    echo "Successfully submiitted!";
}

function checkUser($email, $pass, $dbhelper)
{
    $stmt = $dbhelper->prepare("SELECT * FROM user_info WHERE userEmail=? AND pass=?");
    $stmt->bindParam('1', $email);
    $stmt->bindParam('2', $pass);

    $stmt->execute();

    if($result = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        return true;
    }
    return false;
}

function insert($userEmailSes, $title, $category, $description, $rating, $nfHead, $nfInput, $location, $project, $dbhelper)
{
    $stmt = $dbhelper->prepare("INSERT INTO feedback(userEmail, title, category, details, location, rating, nfHead, nfInput, project) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam('1', $userEmailSes);
    $stmt->bindParam('2', $title);
    $stmt->bindParam('3', $category);
    $stmt->bindParam('4', $description);
    $stmt->bindParam('5', $location);
    $stmt->bindParam('6', $rating);
    $stmt->bindParam('7', $nfHead);
    $stmt->bindParam('8', $nfInput);
    $stmt->bindParam('9', $project);
    $stmt->execute();
    echo "Successfully submiitted!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>feedback</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/ratingStar.css">

    <link href="css/templatebaker.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans|Raleway:400,200' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top hidden-xs">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#home">Feedback</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="page-scroll" href="#general">General</a></li>
                <li><a class="page-scroll" href="#location">By Location</a></li>
                <li><a class="page-scroll" href="#project">By Project</a></li>
                <li><a class="page-scroll" href="#contact">Contact Us</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header id="home" class="tb-header-container">
    <div class="container">
        <div class="col-lg-12">
            <h1 style="text-align: center">Help us make our services Better for you!</h1>
            <div class="pt50"></div>
            <div class="row">
                <div class="btn-group col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
                    <a class="btn tb-btn-bb col-md-4 col-sm-4 col-xs-12  page-scroll" href="#general">General Feedback</a>
                    <a class="btn tb-btn-bb col-md-4 col-sm-4 col-xs-12  page-scroll" href="#location">Feedback By Location</a>
                    <a class="btn tb-btn-bb col-md-4 col-sm-4 col-xs-12  page-scroll" href="#project">Feedback By Project</a>
                </div>
            </div>
        </div>
    </div>
    <div id="general" style="position: absolute; margin-top:17%"></div>
</header>

<!-- General Feedback Section -->
<section class="tb-page-container">
    <div class="container">
        <div class="row" style="margin-top: -80px;">
            <div class="col-lg-12 text-center">
                <h2>General Feedback</h2>
            </div>
        </div>
    </div>
</section>

<!-- Hire Section -->
<section id="hire" class="tb-page-container tb-hire-container" style="margin-top: -80px">
    <div class="container" style="margin-top: -60px; margin-bottom: -60px">
        <div class="col-sm-12 col-md-8 col-md-offset-2" style="background-color: black; opacity: 0.8; padding: 25px">

            <form class="form-horizontal " role="form" id="general-form" method="post" action="index.php?form=1">
                <div hidden>
                    <div class="form-group" id="myfields">
                        <label class="col-sm-3 control-label">Your Field</label>
                        <div class="col-sm-9">
                            <input type="text" name="nfh" placeholder="Field Name" class="form-control" autofocus style="margin-bottom: -5px"></br>
                        </div>
                        <div class="col-sm-9 col-sm-offset-3">
                            <textarea type="text" name="nfi" placeholder="Field Description" class="form-control" autofocus></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <br>
                    <label class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" id="g_title" name="g_title" placeholder="Title" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Category</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="g_category" name="g_category">
                            <option>Health</option>
                            <option>Sports</option>
                            <option>Infrastructure</option>
                            <option>Personality</option>
                            <option>Food</option>
                            <option>Products</option>
                            <option>Environment</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea rows="8" type="text" id="g_desc" name="g_desc" placeholder="Description" class="form-control"></textarea>
                    </div>
                </div>
                <input type="text" name = "g_rated" id="g_rated" hidden="true"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Experience</label>
                    <div class="col-sm-9">
                        <div class="stars">
                            <input type="radio" name="star" class="star-1" id="star-1" onclick="postToController('g')" value="1"/><label class="star-1" for="star-1">1</label>
                            <input type="radio" name="star" class="star-2" id="star-2" onclick="postToController('g')" value="2"/><label class="star-2" for="star-2">2</label>
                            <input type="radio" name="star" class="star-3" id="star-3" onclick="postToController('g')" value="3"/><label class="star-3" for="star-3">3</label>
                            <input type="radio" name="star" class="star-4" id="star-4" onclick="postToController('g')" value="4"/><label class="star-4" for="star-4">4</label>
                            <input type="radio" name="star" class="star-5" id="star-5" onclick="postToController('g')" value="5"/><label class="star-5" for="star-5">5</label>
                            <span></span>
                        </div>
                        <label id="g_ratingLabel"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <a href="#" class="btn btn-success btn-block" id="nif"><i class="fa fa-plus-circle"></i> Add field</a>
                        <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" onclick="formActive(1)"><i class="fa fa-check-circle-o"></i> Submit</a>
                    </div>
                </div>
            </form> <!-- /form -->
            <div id="location"></div>

            <script type="text/javascript">
                $("#nif").click(function() {
                    $("#myfields").clone(true).insertBefore("#general-form > div:last-child");
                    return false;
                });
            </script>

        </div>
</section>

<!-- Feedback by location Section -->
<section class="tb-page-container">
    <div class="container">
        <div class="row" style="margin-top: -80px;">
            <div class="col-lg-12 text-center">
                <h2>Feedback By Location</h2>
            </div>
        </div>
    </div>
</section>

<!---->
<section id="portfolio" class="tb-page-container tb-portfolio-container" style="margin-top: -80px">
    <div  class="row" style="margin-top: -60px; margin-bottom: -60px">
        <div class="container">

            <form class="form-horizontal col-xs-12 col-sm-6 col-md-6" role="form" id="location-form" action="index.php?form=2" method="post" style="margin-top: -20px">
                <div class="form-group">
                    <br>
                    <label class="col-sm-3 control-label">Location</label>
                    <div class = "col-sm-9">
                        <input id="pac-input" type="text" id="l_location" name="l_location"  placeholder="Location" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" id="l_title" name="l_title" placeholder="Title" class="form-control" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea rows="8" type="text" id="l_desc" name="l_desc" placeholder="Description" class="form-control"></textarea>
                    </div>
                </div>
                <input type="text" name = "l_rated" id="l_rated" hidden="true"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Experience</label>
                    <div class="col-sm-9">
                        <div class="stars">
                            <input type="radio" name="star" class="star-1" id="l_star-1" onclick="postToController('l')" value="1"/><label class="star-1" for="l_star-1">1</label>
                            <input type="radio" name="star" class="star-2" id="l_star-2" onclick="postToController('l')" value="2"/><label class="star-2" for="l_star-2">2</label>
                            <input type="radio" name="star" class="star-3" id="l_star-3" onclick="postToController('l')" value="3"/><label class="star-3" for="l_star-3">3</label>
                            <input type="radio" name="star" class="star-4" id="l_star-4" onclick="postToController('l')" value="4"/><label class="star-4" for="l_star-4">4</label>
                            <input type="radio" name="star" class="star-5" id="l_star-5" onclick="postToController('l')" value="5"/><label class="star-5" for="l_star-5">5</label>
                            <span></span>
                        </div>
                        <label id="l_ratingLabel"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" onclick="formActive(2)"><i class="fa fa-check-circle-o"></i> Submit</a>
                        <div id="project"></div>
                    </div>
                </div>

            </form> <!-- /form -->

            <div class="col-xs-12 col-sm-6 col-md-6">
                <div id="map" class="col-md-12" style="height: 26em"></div>
            </div>
        </div>
    </div>
</section>

<!-- Project Feedback Section -->
<section class="tb-page-container">
    <div class="container">
        <div class="row" style="margin-top: -80px;">
            <div class="col-lg-12 text-center">
                <h2>Feedback By Project</h2>
            </div>
        </div>
    </div>
</section>

<!---->
<section id="hire2" class="tb-page-container tb-hire-container2" style="margin-top: -80px">
    <div class="container" style="margin-top: -60px; margin-bottom: -60px">
        <div class="col-sm-12 col-md-8 col-md-offset-2" style="background-color: black; opacity: 0.8; padding: 25px">

            <form class="form-horizontal " role="form" action="index.php?form=3" method="post" id="project-form">
                <div class="form-group">
                    <br>
                    <label class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" id="p_title" name="p_title" placeholder="Title" class="form-control" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Project</label>
                    <div class = "col-sm-9">
                        <input type="text" id="p_project" name="p_project" placeholder="Project Name" class="form-control">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-9">
                        <textarea rows="8" type="text" id="p_desc" name="p_desc" placeholder="Description" class="form-control"></textarea>
                    </div>
                </div>
                <input type="text" name = "p_rated" id="p_rated" hidden="true"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Experience</label>
                    <div class="col-sm-9">
                        <div class="stars">
                            <input type="radio" name="star" class="star-1" id="p_star-1" onclick="postToController('p')" value="1"/><label class="star-1" for="p_star-1">1</label>
                            <input type="radio" name="star" class="star-2" id="p_star-2" onclick="postToController('p')" value="2"/><label class="star-2" for="p_star-2">2</label>
                            <input type="radio" name="star" class="star-3" id="p_star-3" onclick="postToController('p')" value="3"/><label class="star-3" for="p_star-3">3</label>
                            <input type="radio" name="star" class="star-4" id="p_star-4" onclick="postToController('p')" value="4"/><label class="star-4" for="p_star-4">4</label>
                            <input type="radio" name="star" class="star-5" id="p_star-5" onclick="postToController('p')" value="5"/><label class="star-5" for="p_star-5">5</label>
                            <span></span>
                        </div>
                        <label id="p_ratingLabel"></label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" onclick="formActive(3)"><i class="fa fa-check-circle-o"></i> Submit</a>
                    </div>
                </div>
            </form> <!-- /form -->
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="tb-page-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Keep in Touch</h2>
                <span class="tb-underline-dark"> </span>
                <h3>123, Some Street. Some City, Some Country</h3>
                <div class="tb-touch-body">
                    <ul class="list-inline tb-touch-body-pt">
                        <li><a href="mailto:someone@somemail.com?Subject=Hello!" target="_top"><i class="fa fa-envelope"></i>  someone@somemail.com</a></li>
                        <li><a href=""><i class="fa fa-skype"></i> Skype Name</a></li>
                        <li><a href="tel:+92 111 111 111"><i class="fa fa-phone"></i> 111-111-111</a></li>
                    </ul>
                </div>
                <div class="tb-social-icons">
                    <ul class="list-inline">
                        <li><a href=""><i class="fa fa-facebook-square"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter-square"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <ul class="list-inline">
                    <li>&copy;Feedback</li>
                    <li class="tb-copyright">Designed by: <a target="_blank" rel="nofollow" href="http://www.templatebaker.com"><a href="http://www.techagentx.com">Tech Agentx</a></a>
                </ul>
            </div>
        </div>
    </div>
</footer>
<label id="islogin"></label>


<!--SIGN UP MODAL-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="text-align: center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">How should we save your feedback?</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="signInBtn">
                    <span style="float: right; margin-top: 0px; padding-right: 15px">Already a user? <a href="#" class="btn btn-success btn-sm" onclick="hideOnSignIn()">Sign In</a></span>
                </div>

                <div class="row">
                    <h2 style="text-align: center; padding-bottom: 10px; margin-top: 0px" class="col-md-12" id="signUpText">Sign Up</h2>
                </div>

                <div  class="row">
                    <div class="container">
                        <form class="form-horizontal col-xs-12 col-sm-6 col-md-6" role="form" action="index.php" method="post" id="modal-form">

                            <div hidden="true">
                                <input type="text" name="getForm" id="getForm">
                            </div>

                            <div class="form-group" id="fullName">
                                <label for="firstName" class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="fullName" placeholder="Full Name" class="form-control" autofocus>
                                    <span class="help-block">Example : John Snow</span>
                                </div>
                            </div>
                            <div class="form-group" id="email">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" id="password">
                                <label for="password" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" id="dob">
                                <label for="birthDate" class="col-sm-3 control-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input type="date" name="dob" class="form-control">
                                </div>
                            </div>
                            <div class="form-group" id="area">
                                <label for="area" class="col-sm-3 control-label">City / Area</label>
                                <div class="col-sm-9">
                                    <input type="text" name="area" class="form-control">
                                </div>
                            </div> <!-- /.form-group -->
                            <div class="form-group" id="gender">
                                <label class="control-label col-sm-3">Gender</label>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" id="femaleRadio" name="female" value="Female">Female
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <input type="radio" id="maleRadio" name="male" value="Male">Male
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.form-group -->

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" onclick="submitAn(document.getElementById('getForm').value)">Submit Anonymously</a>
                <input class="btn btn-primary" type="submit" id="submitBtn" onclick="submitUser()" value="Submit by Signing Up">
            </div>
            </form> <!-- /form -->
        </div>
    </div>
</div>
<!--END: SIGN MODAL-->

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    try
    {
        if(isset($_POST['fullName']) && isset($_POST['dob']) && isset($_POST['area']) && isset($_POST['gender']))
        {
            $fullname = $_POST['fullName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $dob = $_POST['dob'];
            $area = $_POST['area'];
            $form = $_POST['getForm'];

            if(isset($_POST['female']))
            {
                $gender = 0;
            }
            else if(isset($_POST['male']))
            {
                $gender = 1;
            }

            //Check Duplicates
            if(checkDuplicateUser($email, $dbhelper) == true)
            {
                echo "Email already exists! Please Sign In";
            }
            else
            {
                insertUser($fullname, $email, $password, $dob, $gender, $area, $dbhelper);
                $_SESSION['email'] = "$email";

                if($form == 1)
                {?>
                    <script>document.getElementById('general-form').submit();</script>
                <?php }
                if($form == 2)
                {?>
                    <script>document.getElementById('location-form').submit();</script>
                <?php }
                if($form == 3)
                {?>
                    <script>document.getElementById('project-form').submit();</script>
                <?php }
            }
        }
        else if(isset($_POST['email']) && isset($_POST['password']))
        {
            $form = $_POST['getForm'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if(checkUser($email, $password, $dbhelper) == true)
            {
                echo "Signed In";
                $_SESSION['email'] = "$email";

                if($form == 1)
                {?>
                    <script>document.getElementById('general-form').submit();</script>
                <?php }
                if($form == 2)
                {?>
                    <script>document.getElementById('location-form').submit();</script>
                <?php }
                if($form == 3)
                {?>
                    <script>document.getElementById('project-form').submit();</script>
                <?php }
            }
            else
            {
                echo "Error Signing In";
            }
        }

        if(isset($_SESSION['email']))
        {
            $userEmailSes = $_SESSION['email'];
        }
        else
        {
            $userEmailSes = null;
        }
        ?>
        <script>
            if (document.getElementById('islogin').innerHTML == 'anonymous')
            {
                <?php $userEmailSes = null;?>
            }
        </script>
        <?php

        if(isset($_POST['g_title']) && isset($_POST['g_category']) && isset($_POST['g_desc'])) {
            ?><script>alert('<?=$_POST['g_title']." ".$_POST['g_category']." ".$_POST['g_desc']?>');</script><?php
            if($_POST['g_title'] != null && $_POST['g_category'] != null && $_POST['g_desc'] != null ) {
                $title = $_POST['g_title'];
                $category = $_POST['g_category'];
                $description = $_POST['g_desc'];
                $rating = $_POST['g_rated'];
                $nfHead = $_POST['nfh'];
                $nfInput = $_POST['nfi'];
                $location = '';
                $project = '';
                insert($userEmailSes, $title, $category, $description, $rating, $nfHead, $nfInput, $location, $project, $dbhelper);
            }
        }

        if(isset($_POST['l_title']) && isset($_POST['l_location']) && isset($_POST['l_desc'])) {
            ?><script>alert('<?=$_POST['l_title']." ".$_POST['l_location']." ".$_POST['l_desc']?>');</script><?php
            if($_POST['l_title'] != null && $_POST['l_location'] != null && $_POST['l_desc'] != null) {
                $title = $_POST['l_title'];
                $category = '';
                $description = $_POST['l_desc'];
                $rating = $_POST['l_rated'];
                $nfHead = '';
                $nfInput = '';
                $location = $_POST['l_location'];
                $project = '';
                insert($userEmailSes, $title, $category, $description, $rating, $nfHead, $nfInput, $location, $project, $dbhelper);
            }
        }


        if(isset($_POST['p_title']) && isset($_POST['p_project']) && isset($_POST['p_desc'])) {
            ?><script>alert('<?=$_POST['p_title']." ".$_POST['p_project']." ".$_POST['p_desc']?>');</script><?php
            if($_POST['p_title'] != null && $_POST['p_project'] != null && $_POST['p_desc'] != null) {
                $title = $_POST['p_title'];
                $category = '';
                $description = $_POST['p_desc'];
                $rating = $_POST['p_rated'];
                $nfHead = '';
                $nfInput = '';
                $location = '';
                $project = $_POST['p_project'];
                insert($userEmailSes, $title, $category, $description, $rating, $nfHead, $nfInput, $location, $project, $dbhelper);
            }
        }

        //header("Location: eventAddForm.php?u=success");
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}
?>

<script>
    function submitAn(x)
    {
        document.getElementById('islogin').innerHTML = 'anonymous';
        if(x == 1)
        {
            document.getElementById('general-form').submit();
        }
        else if(x == 2)
        {
            document.getElementById('location-form').submit();
        }
        else if(x == 3)
        {
            document.getElementById('project-form').submit();
        }
    }

    function submitUser()
    {
        document.getElementById('islogin').innerHTML = '';
    }

    function formActive(x) {
        document.getElementById('getForm').value = x;
    }

    function hideOnSignIn() {
        document.getElementById('fullName').style.display = "none";
        document.getElementById('dob').style.display = "none";
        document.getElementById('area').style.display = "none";
        document.getElementById('gender').style.display = "none";
        document.getElementById('signInBtn').style.display = "none";
        document.getElementById('signUpText').innerHTML = "Sign In";
        document.getElementById('submitBtn').value = "Submit by Signing In";
    }


    function postToController(n) {
        for (i = 0; i < document.getElementsByName('star').length; i++) {
            if (document.getElementsByName('star')[i].checked == true) {
                var ratingValue = document.getElementsByName('star')[i].value;
                ratingDone = true;
                //document.getElementById(n+"_ratingLabel").innerHTML = "";
                break;
            }
        }
        ratings = ratingValue;
        document.getElementById(n+"_rated").value = ratings;
    }

    $(document).ready(function() {

        $( ".starsdb" ).each(function() {
            // Get the value
            var val = $(this).data("rating");
            // Make sure that the value is in 0 - 5 range, multiply to get width
            var size = Math.max(0, (Math.min(5, val))) * 16;
            // Create stars holder
            var $span = $('<span />').width(size);
            // Replace the numerical value with stars
            $(this).html($span);
        });

    });

</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<!-- Animated Header JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/cbp-animated-header.js"></script>

<!-- Slowly Scrolling JavaScript -->
<script src="js/smoothly-scrolling.js"></script>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!--Google Maps Api-->
<script src="js/googleMapsSearch.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete" async defer></script>

</body>
</html>
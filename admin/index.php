<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();
if ($user_login->is_logged_in() != "") {
    $user_login->redirect('home.php');
}

if (isset($_POST['btn-login'])) {
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtupass']);

    if ($user_login->login($email, $upass)) {
        $user_login->redirect('home.php');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Login | Aroma</title>
    <!-- Bootstrap -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bower_components/bootstrap/dist/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <style>
        body{
        background:url('patterns/pattern13.jpg');
        }
        .panel-info{
        margin-top: 120px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .form{
        border:1px solid#DDD; padding: 20px;
        background-color: #DDD;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

    </style>
    </head>
    <body id="login">
    <div class="container">
        <?php
        if (isset($_GET['inactive'])) { ?>
        <div class='alert alert-error'>
            <button class='close' data-dismiss='alert'>&times;</button>
            <strong>SORRY!!</strong> This Account is not Activated Go to your Inbox and Activate it.
        </div>
        <?php
        }
        ?>
    <div class="col-md-6 col-md-offset-3" class="login_form">
        <div class="panel panel-info">
        <div class="panel-heading"><strong><h4> Log in</h4></strong></div>
        <div class="panel-body">
        <div class="col-md-12">
            <div class="form">
            <form method="post" class="form form-horizontal">
                <?php
                if (isset($_GET['error'])) { ?>
                    <div class='alert alert-success'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Wrong Details!</strong>
                    </div>
                <?php
                }
                ?>
                <div class="form-group">
                <label for="inputemail3" class="col-sm-2 control-label"> Email_add</label>
                <div class="col-sm-10">
                    <input type="email" name="txtemail" 
                    class="form-control" id="inputemail3" placeholder="Email address" required="required">
                </div>
                </div>
                <div class="form-group">
                    <label for="inputpassword3" class="col-sm-2 control-label"> Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="txtupass" 
                        class="form-control" id="inputpassword3"placeholder="Password" required="required">
                    </div>
                </div>  
                <button type="submit" class="btn btn-sm btn-primary" name="btn-login">
                <span class="glyphicon glyphicon-log-in"> <strong> </strong></span> Login</button>
                
                <a href="signup.php" class="btn btn-sm btn-success pull-right">
                <span class="glyphicon glyphicon-plus"> <strong>Signup</strong></span></a>    
            </form>
            </div>
            </div>
        </div>
        <div class="panel-footer">
            <a href="fpass.php"> <strong>Lost your password ?</strong></a>
        </div>
        </div>
    </div>
    </div>
    <script src="bower_components/jquery/dist/js/jquery.min.js"></script>
    <script src="bower_components/dist/js/bootstrap.min.js"></script>
    </body>
</html>

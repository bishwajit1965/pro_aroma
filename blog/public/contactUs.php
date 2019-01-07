<!doctype html>
<html class="no-js" lang="">
    <?php include_once 'partials/_head.php';?>
    <body>
        <div class="container-fluid">
            <?php include_once('partials/_header.php');?>
            <?php include('partials/_horizontal_bar.php');?>
            <div class="row">
                <?php include_once('partials/_left_sidebar.php'); ?>
                <div class="col-sm-8">
                    <div class="border" style="min-height:40px;background-color:#DDD;"></div>
                    <?php include_once('partials/_slider_panel.php'); ?>
                <!-- Code below -->
                    <?php
                    $db = new sendMessage();
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['submit'])) {
                            $firstname  = $_POST['firstname'];
                            $lastname   = $_POST['lastname'];
                            $email      = $_POST['email'];
                            $message    = $_POST['message'];
                            if ($firstname == "") {
                                $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <strong id= "strong"#9C0A0A>
                                    WARNING!!! First name field remained blank!
                                    Fill up the field and try again!</strong>
                                    </div>
                                    </div>
                                </div>';
                                echo $msg;
                            } elseif ($lastname == "") {
                                $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <strong id= "strong">
                                    WARNING!!! Last name field remained blank! Fill up the field and try again!</strong>
                                    </div>
                                    </div>
                                </div>';
                                echo $msg;
                            } elseif (empty($email)) {
                                $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <strong id= "strong">
                                    WARNING!!! Email field remained blank! Fill up the field and try again!</strong>
                                    </div>
                                    </div>
                                </div>';
                                echo $msg;
                            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <strong id= "strong">
                                    WARNING!!! Invalid email format!</strong>
                                    </div>
                                    </div>
                                </div>';
                                echo $msg;
                            } elseif ($message =="") {
                                $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <strong id= "strong">
                                    WARNING!!! Message id field
                                    remained blank! Fill up the field and try again!</strong>
                                    </div>
                                    </div>
                                </div>';
                                echo $msg;
                            } else {
                                $db->createMessage(
                                    $firstname,
                                    $lastname,
                                    $email,
                                    $message
                                );
                            }
                        }
                    }
                    ?>
                    <div class="contact-us">
                        <h1>Contact us</h1>
                        <form method="post">
                            <div class="form-group">
                                <label for="firstname">First name</label>
                                <input type="text" class="form-control" name="firstname"
                                placeholder="Enter first name....">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last name</label>
                                <input type="text" class="form-control" name="lastname"
                                placeholder="Enter last name....">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email"
                                class="form-control" id="email" placeholder="Enter email....">
                            </div>
                             <div class="form-group">
                                <textarea name="message" id="editor1" class="text-area" cols="73" rows="5">
                                </textarea>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary" name="submit">
                                <i class="fa fa-envelope"></i>
                                Send Message</button>
                        </form>
                    </div>

                <!-- Code above -->
                </div>
                <?php include_once('partials/_right_sidebar.php');?>
            </div>
            <?php include('partials/_horizontal_bar-bottom.php');?>
            <?php include_once('partials/_footer.php'); ?>
        </div>
        <?php include_once('partials/_scripts.php'); ?>
    </body>
</html>

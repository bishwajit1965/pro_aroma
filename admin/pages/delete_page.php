<!DOCTYPE html>
<html>
    <?php include_once('../partials/_head.php');?>
    <body class="hold-transition skin-blue sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                <?php include_once('../partials/_header.php');?>
            </header>
            <!-- =============================================== -->
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <?php include_once('../partials/_sidebar.php');?>
                <!-- /.sidebar -->
            </aside>
            <!-- =============================================== -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    Edit pages <small>it all starts here</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <!-- <h3 class="box-title">Create Article</h3> -->
                            <a href="pages_home.php" class="btn btn-primary btn-sm"> <span class="glyphicon glyphicon-list"></span> Pages home</a>
                            <div class="box-tools pull-right">
                                <button type="button" style="color:#FFF;" class="btn btn-box-tool btn-primary" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fa fa-minus"></i></button>
                                <button type="button" style="color:#FFF;" class="btn btn-box-tool btn-primary" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <!-- Add code below -->
                            <?php
                            $db = new Pages();
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (isset($_POST['submit'])) {
                                    $id       = $_GET['edit_id'];
                                    $title    = $_POST['title'];
                                    $heading  = $_POST['heading'];
                                    $body     = $_POST['body'];
                                    $footer   = $_POST['footer'];
                                    if ($title == "") {
                                        $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong id= "strong"#9C0A0A>WARNING!!! Title field remained blank! Fill up the field and try again!</strong>
                                    </div>
                                </div>
                            </div>';
                                        echo $msg;
                                    } elseif ($heading == "") {
                                        $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong id= "strong">WARNING!!! Heading field remained blank! Fill up the field and try again!</strong>
                                    </div>
                                </div>
                            </div>';
                                        echo $msg;
                                    } elseif ($body == "") {
                                        $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong id= "strong">WARNING!!! Body field remained blank! Fill up the field and try again!</strong>
                                    </div>
                                </div>
                            </div>';
                                        echo $msg;
                                    } elseif ($footer =="") {
                                        $msg = '<div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong id= "strong">WARNING!!! Footer field remained blank! Fill up the field and try again!</strong>
                                    </div>
                                </div>
                            </div>';
                                        echo $msg;
                                    } // The following code will update data with picture
                                    else {
                                        $db->update($id, $title, $heading, $body, $footer);
                                    ?>
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong id="success_msg">WOW! Data inserted successfully!</strong>
                                    </div>
                                    </div>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            ?>
                            <?php
                            $page  = new Pages();
                            if (isset($_POST['btn-delete'])) {
                                $id = $_GET['delete_id'];
                                $page->delete($id);
                            }
                            $query = "SELECT * FROM tbl_pages WHERE id = :id";
                            $page->deleteView($query);
                            ?>
                            <!-- Add code above -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            Footer
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <?php include_once('../partials/_footer.php');?>
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <?php include_once('../partials/_control_sidebar.php');?>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php include_once('../partials/_js.php');?>
    </body>
</html>
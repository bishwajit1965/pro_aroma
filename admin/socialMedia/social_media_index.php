<!DOCTYPE html>
<html>
    <?php include_once('../partials/_head.php'); ?>
    <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
        <?php include_once('../partials/_header.php'); ?>
        </header>
        <!-- =============================================== -->
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php include_once('../partials/_sidebar.php'); ?>
        <!-- /.sidebar -->
        </aside>
        <!-- =============================================== -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            Social media index
            <small>it all starts here</small>
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
                <a href="add_social_media.php" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-plus"></span> Add Social Media</a>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" 
                data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php
                if (isset($_GET['inserted'])) {
                    echo '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SUCCESS!!! Social media data inserted successfully!</strong>&nbsp &nbsp
                    </div>
                </div>
                </div>';
                }
                ?>
                <?php
                if (isset($_GET['updated'])) {
                    echo '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <strong id= "strong"#9C0A0A> SUCCESSFUL !!! Social media data is updated successfully!
                    </strong> &nbsp &nbsp
                    </div>
                </div>
                </div>';
                }
                ?>
                <?php
                if (isset($_GET['deleted'])) {
                    echo '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>
                    SUCCESS!!! Tag deleted successfully!</strong>&nbsp &nbsp
                    </div>
                </div>
                </div>';
                }
                ?>
                <table id="example1" class="table table-bordered table-striped table-success 
                table-hover table-responsive table-condensed">
                <thead>
                    <tr>
                    <th>NO.</th>
                    <th>Social media address</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $db = new socialMedia();
                    $stmt = "SELECT * FROM tbl_social_media";
                    $db->viewSocialMedia($stmt);
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>NO.</th>
                    <th>Social media address</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
                </table>
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
        <?php include_once('../partials/_footer.php'); ?>
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <?php include_once('../partials/_control_sidebar.php'); ?>
        </aside>
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <?php include_once('../partials/_js.php'); ?>
    </body>
</html>

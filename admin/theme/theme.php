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
            Theme option <small>it all starts here</small>
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
                <h3 class="box-title">Update theme </h3>
                <div class="box-tools pull-right">
                <button type="button" style="color:#FFF;" 
                class="btn btn-box-tool btn-primary" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" style="color:#FFF;" 
                class="btn btn-box-tool btn-primary" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
            <!-- Add code below -->
            <div class="col-sm-6 col-sm-offset-3">
                <?php
                if (isset($_GET['updated'])) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SUCCESS!!! Theme is updated successfully!
                    </strong>&nbsp &nbsp
                    </div>
                <?php
                }
                ?>
                <?php
                $db = new Theme;
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    if (isset($_POST['submit'])) {
                        $theme = $_POST['theme'];
                        if ($theme == "") { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <strong id= "strong"#9C0A0A>ERROR!!! Theme remained unselected ! Select one and submit.
                            </strong>&nbsp &nbsp
                        </div>
                        <?php
                        } else {
                            $db->update($theme);
                        }
                    }
                }
                ?>

                <?php
                $db = new Theme();
                $query = "SELECT theme FROM tbl_theme WHERE id = 1";
                $db->getTheme($query);
                ?>
                <!--Add code above  -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer"> Footer </div>
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

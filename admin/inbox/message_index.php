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
            Messages home
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
                 <!-- count messages -->
                <button type="button" class="btn btn-success btn-sm">
                Received Messages <span class="badge badge-light">
                <?php
                $db = new Messages();
                $stmt = "SELECT * FROM tbl_contact WHERE status = 0"; ?>
                <span style="color:red;">
                <?php $db->countReceivedMessages($stmt); ?>
                </span>
    
                </span>
                <span class="sr-only">unread messages</span>
                </button>
                <!-- /count messages -->

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
                $status = $_POST['status'] =1;
                $db = new Messages();
                if (isset($_GET['seen_id'])) {
                    $id = $_GET['seen_id'];
                    $db->sendMessagesToArchive($id, $status);
                }
                ?>
                <table id="example1" class="table table-bordered table-striped table-responsive table-condensed">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Fname</th>
                    <th>Lame</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Sent on</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $db = new Messages();
                    $stmt = "SELECT * FROM tbl_contact WHERE status = 0";
                    $db->viewAllMessasages($stmt);
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Fname</th>
                    <th>Lname</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Sent on</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
                </table>  
            </div>
            <!-- /.box-body -->
            <div class="box-footer">Footer</div>
            <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            </section>
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                Seen archived messages
                <small>it all starts here</small>
                </h1>
                <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
                </ol>
            </section>
            <section class="content">
                <!-- Default box -->
                <div class="box">
                <div class="box-header with-border">
                    <!-- count messages -->
                    <button type="button" class="btn btn-success btn-sm">Seen Messages <span class="badge badge-light">
                    <?php
                    $stmt = "SELECT * FROM tbl_contact WHERE status = 1";?>
                    <span style="color:red;">
                    <?php $db->countReadMessages($stmt);?></span>
                    </span>
                    <span class="sr-only">Unread messages</span>
                    </button>
                    <!-- /count messages -->

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
                <!-- Seen messages will be deleted -->
                <?php
                $db = new Messages();
                if (isset($_GET['delete_message_id'])) {
                    $id = $_GET['delete_message_id'];
                    $db->deleteSeenMessage($id);
                }
                ?>
                <!-- /Seen messages will be deleted -->

                <!-- Arcived messages sent bak again-->
                <?php
                $db = new Messages();
                if (isset($_GET['return_message_id'])) {
                    $id = $_GET['return_message_id'];
                    $db->returnMessagesToUnseenBox($id, $status);
                }
                ?>
                <!-- Arcived messages sent bak again-->
                <table id="example2" class="table table-bordered table-striped table-responsive table-condensed">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Fname</th>
                    <th>Lname</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Sent on</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $db = new Messages();
                    $stmt = "SELECT * FROM tbl_contact WHERE status = 1";
                    $db->seenMessasages($stmt);
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Fname</th>
                    <th>Lname</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Sent on</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
                </table>  
            </div>

            <!-- /.box-body -->
            <div class="box-footer"> Footer</div>
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

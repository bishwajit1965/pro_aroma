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
            Edit logo
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
            <h3 class="box-title">Title</h3>
            <div class="box-tools pull-right">
                <button type="button" style="color:#ddd;"
                 class="btn btn-box-tool btn-primary" data-widget="collapse" 
                 data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" style="color:#ddd;" 
                class="btn btn-box-tool btn-primary" data-widget="remove" 
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
                </button>
            </div>
            </div>
            <div class="box-body">
            <a href="logoIndex.php" class="btn btn-primary btn-sm">
                <span class="glyphicon glyphicon-list"></span> Logo gallery</a>
            <hr>
            <table class="table table-responsive table-condensed">
                <tbody>
                <?php
                // Gallery photo to delete
                $db = new Logo();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['btn-edit'])) {
                        $id = $_GET['edit_photo_id'];
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        // Image insert code
                        $permitted = ['jpg', 'jpeg', 'png', 'gif'];
                        $file_name = $_FILES['photo']['name'];
                        $file_size = $_FILES['photo']['size'];
                        $file_temp = $_FILES['photo']['tmp_name'];
                        $div = explode('.', $file_name);
                        $file_ext = strtolower(end($div));
                        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                        $photo = "photo_repository/" . $unique_image;
                        if (empty($title)) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Title field left blank!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <?php
                        } elseif (empty($description)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Title field left blank!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <?php
                        } elseif (empty($file_name)) {
                            $db->updateWithoutPhoto($id, $title, $description); ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Update successful!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <?php
                        } elseif ($file_size > 1048567) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>SORRY !!! File is larger than 1MB! Select one less than 1MB</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <?php
                        } elseif (in_array($file_ext, $permitted) === false) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>SORRY! you can select only : <?php echo implode(' , ', $permitted); ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <?php
                        } elseif (!empty($file_name)) {
                            $db->updatePhoto($id, $title, $photo, $description);
                            move_uploaded_file($file_temp, $photo); ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>File is updated successfully!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                        } else { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>ERROR in updating data!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        <?php
                        }
                    }
                }
                // Gallery photo fetched to display
                $db = new Logo;
                $stmt = 'SELECT * FROM tbl_logo WHERE id=:id';
                $db->editPhotoView($stmt);
                ?>
                </tbody>
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

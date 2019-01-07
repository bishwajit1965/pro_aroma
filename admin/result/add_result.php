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
          Create Article <small>it all starts here</small>
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
              <a href="result_index.php" class="btn btn-primary btn-sm"> <span class="glyphicon glyphicon-list"></span> Result Index</a>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <!-- Add code below -->
                <?php
                $db = new Result();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['submit'])) {
                $s_roll        = $_POST['s_roll'];
                $s_name         = $_POST['s_name'];
                // Image insert code
                $permitted = ['jpg', 'jpeg', 'png', 'gif'];
                $file_name = $_FILES['s_picture']['name'];
                $file_size = $_FILES['s_picture']['size'];
                $file_temp = $_FILES['s_picture']['tmp_name'];
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div)) ;
                $unique_image = substr(md5(time()), 0 , 10) . '.' . $file_ext;
                $uploaded_image = "students/". $unique_image;
                if ($s_roll == "" ) {
                $msg = '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>WARNING!!! Roll field remained blank! Fill up the field and try again!</strong>
                    </div>
                </div>
                </div>';
                echo $msg;
                }
                elseif ( $s_name == "" ) {
                $msg = '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! Name field remained blank! Fill up the field and try again!</strong>
                    </div>
                </div>
                </div>';
                echo $msg;
                }
                elseif (empty($file_name)) {
                // The following code will update data without picture
                $db->StoreWithoutPicture($s_roll, $s_name);
                $msg = '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! Data is uploaded without photo!</strong>
                    </div>
                </div>
                </div>';
                echo $msg;
                }
                elseif($file_size > 1048567){
                echo '<span class="error">Image size should be less than 1 MB!</span>';
                $msg = '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! File size is too large!</strong>
                    </div>
                </div>
                </div>';
                echo $msg;
                }
                elseif(in_array($file_ext, $permitted) === false){
                echo '<span class="error">You can upload only:-' . implode(',' , $permitted).'</span>';
                $msg = '<div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! You can upload only:-' . implode(',' , $permitted).'! Fill up the field and try again!</strong>
                    </div>
                </div>
                </div>';
                echo $msg;
                } // The following code will update data with picture
                elseif (!empty($file_name)) {
                $db->Store($s_roll, $s_name, $uploaded_image);
                move_uploaded_file($file_temp, $uploaded_image);
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
                else{
                ?>
                <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">Warning!</strong> There was problem in inserting data in database!
                    </div>
                </div>
                </div>
                <?php
                }
                }
                }
                ?>
                <form class="form" action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Student Roll</label>
                        <input type="text" class="form-control" id="title" name="s_roll" placeholder="Student roll.....">
                    </div>
                    <div class="form-group">
                        <label for="title">Student Name</label>
                        <input type="text" class="form-control" id="title" name="s_name" placeholder="Student name.....">
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="s_picture">Photo</label>
                        <input type="file" name="s_picture" class="form-control" id="s_picture"  >
                    </div>
                    </div>

                    <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-md btn-primary"><i class="fa fa-upload" aria-hidden="true"> Upload</i></button>

                        <button type="reset" value="cancel" class="btn btn-danger btn-md"><i class="fa fa-ban" aria-hidden="true"></i> Reset Data</button>
                    </div>
                    </div>
                </form>
                </div>
                </div>
                <!-- Add code above -->
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

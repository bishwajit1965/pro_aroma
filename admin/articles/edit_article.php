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
        Blank page
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
            <button type="button" style="color:#FFF;" class="btn btn-box-tool btn-primary" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" style="color:#FFF;" class="btn btn-box-tool btn-primary" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
        <?php
        $db = new Article();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['btn-update'])) {
                $art_id        = $_GET['edit_id'];
                $title         = $_POST['title'];
                $author        = $_POST['author'];
                $tag_id        = $_POST['tag_id'];
                $cat_id        = $_POST['cat_id'];
                $status        = $_POST['status'];
                $content       = $_POST['content'];
                $published_at  = $_POST['published_at'];
              // Image insert code
                $permitted = ['jpg', 'jpeg', 'png', 'gif'];
                $file_name = $_FILES['photo']['name'];
                $file_size = $_FILES['photo']['size'];
                $file_temp = $_FILES['photo']['tmp_name'];
                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div)) ;
                $unique_image =  substr(md5(time()), 0, 10) . '.' . $file_ext;
                $uploaded_image = "uploads/".$unique_image;
                $description = $_POST['description'];

                if ($title == "") {
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>WARNING!!! Title field remained blank! 
                    Fill up the field and try again!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } elseif ($author == "") {
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! Author field remained blank! 
                    Fill up the field and try again!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } elseif ($tag_id =="") {
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! Tag field remained blank! Fill up the field and try again!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } elseif ($cat_id =="") {
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! Category id field remained blank! Fill up the field and try again!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } elseif ($status == "") {
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! Post status field remained blank! 
                    Fill up the field and try again!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } elseif ($content == "") {
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! Content field remained blank! 
                    Fill up the field and try again!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } elseif (empty($file_name)) {
                  // The following code will update data without picture
                    $db->UpdateWithoutPicture($art_id, $title, $author, $cat_id, $status, $tag_id, $content, $description, $published_at);
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! Article is updated with the previously existing photo!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } elseif ($file_size > 1048567) {
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! File size is too large!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } elseif (in_array($file_ext, $permitted) === false) {
                    $msg = '<div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong">WARNING!!! You can upload only:-' . implode(',', $permitted).'! Fill up the field and try again!</strong>
                    </div>
                    </div>
                    </div>';
                    echo $msg;
                } // The following code will update data with picture
                elseif ($file_name) {
                    $db->update($art_id, $title, $author, $cat_id, $status, $tag_id, $content, $uploaded_image, $description, $published_at);
                    move_uploaded_file($file_temp, $uploaded_image);
                } else { ?>
                    <div class="row">
                     <div class="col-md-12">
                       <div class="alert alert-danger alert-dismissible" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                         <strong id= "strong">Warning!</strong> There was problem in updating data in database!
                       </div>
                     </div>
                    </div>
                    <?php
                }
            }
        }
        ?>

        <?php
          $db = new Article();
          $query = "SELECT * FROM tbl_article WHERE art_id =:art_id";
          $db->updateView($query);
        ?>
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

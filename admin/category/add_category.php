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
          Create Category
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
              <a href="category_index.php" class="btn btn-primary btn-sm"> <span class="glyphicon glyphicon-list"></span> Category Index</a>
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
              $fm = new helpers();
              $db = new Category();
              if ($_SERVER["REQUEST_METHOD"] == "POST")  {
              if (isset($_POST['submit'])) {
              $cat_name = $fm->validation($_POST['cat_name']);
              if($cat_name==""){
              $msg = '<div class="row">
                <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>WARNING!!! Category field remained blank! Fill up the field and try again!</strong>
                  </div>
                </div>
              </div>';
              echo $msg;
              }
              elseif($db->Create($cat_name)){
              $msg = '<div class="row">
                <div class="col-md-12">
                  <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>WOW!! Category inserted successfully!</strong> &nbsp &nbsp
                  </div>
                </div>
              </div>';
              echo $msg;
              } else {
              $msg = '<div class="row">
                <div class="col-md-12">
                  <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>WARNING!!! ERROR!! Category is not inserted!</strong>
                  </div>
                </div>
              </div>';
              echo $msg;
              } } }
              ?>
              <form class="form-group" action="" method="POST">
                <div class="form-group">
                  <label for="category">Category</label>
                  <input type="text" name="cat_name" class="form-control" id="category" placeholder="Write category name....">
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" name="submit" class="btn btn-sm btn-primary"><i class="fa fa-upload" aria-hidden="true"> Upload Category</i></button>
                    <button type="reset" value="cancel" class="btn btn-danger btn-sm"><i class="fa fa-ban" aria-hidden="true"></i> Reset Data</button>
                  </div>
                </div>
              </form>

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

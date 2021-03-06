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
        Article Index
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
          <a href="add_article.php" class="btn btn-primary btn-sm"> <span class="glyphicon glyphicon-plus">
          </span> Add Article</a>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <?php
            if (isset($_GET['dataInserted'])) {
                echo '<div class="row">
          <div class="col-md-12">
          <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;
          </span></button>
          <strong id= "strong"#9C0A0A>SUCCESS!!! Article data is inserted successfully! Check data below here.
          </strong>&nbsp &nbsp
          </div>
          </div>
          </div>';
            }
        ?>
        <?php
        if (isset($_GET['edited'])) {
            echo '<div class="row">
          <div class="col-md-12">
          <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;
          </span></button>
          <strong id= "strong"#9C0A0A>SUCCESS!!! Article data updated successfully!</strong>&nbsp &nbsp
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
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;
          </span></button>
          <strong id= "strong"#9C0A0A>SUCCESS!!! Article data has been deleted!</strong>&nbsp &nbsp
          </div>
          </div>
          </div>';
        }
        ?>

        <?php
        if (isset($_GET['unpublished'])) {
            echo '<div class="row">
          <div class="col-md-12">
          <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;
          </span></button>
          <strong id= "strong"#9C0A0A>SUCCESS!!! Article data has been unpublished! Check article status here below.
          </strong>&nbsp &nbsp
          </div>
          </div>
          </div>';
        }
        ?>

        <?php
        if (isset($_GET['published'])) {
            echo '<div class="row">
          <div class="col-md-12">
          <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <strong id= "strong"#9C0A0A>SUCCESS!!! Article data has been published successfully!
          Check article status here below.
          </strong>&nbsp &nbsp
          </div>
          </div>
          </div>';
        }
        ?>

          <table id="example1" class="table table-bordered table-striped table-responsive   table-condensed">
            <thead>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Author</th>
              <th>Content</th>
              <th>Photo</th>
              <th>Description</th>
              <th>C_id</th>
              <th>T_id</th>
              <th>Status</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>Published_at</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $db = new Article();
                $query = "SELECT * FROM tbl_article";
                $db->viewData($query);
                ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Author</th>
              <th>Content</th>
              <th>Photo</th>
              <th>Description</th>
              <th>C_id</th>
              <th>T_id</th>
              <th>Status</th>
              <th>Created_at</th>
              <th>Updated_at</th>
              <th>Published_at</th>
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

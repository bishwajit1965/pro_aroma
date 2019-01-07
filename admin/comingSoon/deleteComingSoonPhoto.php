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
        Delete coming soon photo only
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

       <h4>Dynamic comning soon photo gallery contains
        <?php
        $db = new comingSoon;
        $query = 'SELECT * FROM tbl_gallery';
        ?>
        <span class="badge badge-pill badge-primary"><?php $db->count($query); ?></span> photos</h4>
        <h4 class="blink_me" style="color:#C82333;">Are you sure of deleting this photo only ?</h4>
        <table class="table table-responsive table-condensed">
          <tbody>
            <?php
            // Gallery photo to delete
            $db = new comingSoon;
            if (isset($_POST['btn-photo-delete'])) {
                $id = $_GET['photo_delete_id'];
                $db->photoDelete($id);
            }
            // Gallery photo fetched to display
            $query = "SELECT * FROM tbl_coming_soon WHERE id=:id";
            $db->photoDeleteView($query);
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

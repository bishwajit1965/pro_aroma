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
        <h1>Coming soon index <small>it all starts here</small>
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
            <span><a href="addComingSoon.php" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-plus"></span> Add coming soon</a>
            Dynamic coming soon gallery contains
            <?php
            $db = new ComingSoon();
            $query = 'SELECT * FROM tbl_coming_soon';
            ?>
            <span class="badge badge-pill badge-primary">
            <?php $db->count($query); ?></span> photos</span>

            <div class="box-tools pull-right">
            <button type="button" style="color:#FFF;" class="btn btn-box-tool btn-primary" data-widget="collapse"
                data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" style="color:#FFF;" class="btn btn-box-tool btn-primary" data-widget="remove"
                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
            </button>
            </div>
        </div>
        <div class="box-body">
        <?php // Alert message data
        if (isset($_GET['photo_inserted'])) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong id= "strong"#9C0A0A>SUCCESS!!! Data is uploaded successfully!
                </strong>&nbsp &nbsp
                </div>
            </div>
        </div>
        <?php
        }
        if (isset($_GET['no_photo-uploaded'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SUCCESS!!! Data is uploaded successfully without any photo!
                    </strong>&nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
        if (isset($_GET['no_photo'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SUCCESS!!! Photo is updated successfully with the old existing photo!
                    </strong>&nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
        if (isset($_GET['photo_edited'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SUCCESS!!! Photo is updated successfully with the chosen photo!
                    </strong>&nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
        if (isset($_GET['photo-deleted'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SUCCESS!!! Photo is deleted successfully!
                    </strong>&nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
        if (isset($_GET['delete-errror'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SORRY!!! Photo is not deleted successfully! System encountered an error!
                    </strong>&nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
        if (isset($_GET['only-photo-deleted'])) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <strong id= "strong"#9C0A0A>SUCCESS!!! Only photo is deleted successfully!
                        </strong>&nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
            <table class="table table-responsive table-condensed">
                <tbody>
                    <?php
                    // Gallery photo fetched to display
                    $db = new ComingSoon();
                    $query = 'SELECT * FROM tbl_coming_soon ORDER BY id DESC';
                    $records_per_page = 20;
                    $newquery = $db->paging($query, $records_per_page);
                    $db->viewComingSoonDataForIndex($newquery); ?>
                    <tr>
                        <td colspan="" class="text-center">
                        <div class="pagination">
                            <?php $db->paginglink($query, $records_per_page); ?>
                        </div>
                        </td>
                    </tr>
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

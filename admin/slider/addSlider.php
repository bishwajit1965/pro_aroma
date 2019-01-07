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
          Add slider image <small>it all starts here</small>
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
              <a href="sliderIndex.php" class="btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-list"></span> Slider index</a>
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
            <?php
            $db=new Slider;
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                if (isset($_POST['submit'])) {
                    $title        = $_POST['title'];
                    $description  = $_POST['description'];
                    $permitted    = ['jpg', 'jpeg', 'png', 'gif'];
                    $file_name    = $_FILES['photo']['name'];
                    $file_size    = $_FILES['photo']['size'];
                    $file_temp    = $_FILES['photo']['tmp_name'];
                    $div          = explode('.', $file_name);
                    $file_ext     = strtolower(end($div)) ;
                    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                    $photo="photo_repository/" . $unique_image;
                    if (empty($title)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Title field left blank 12!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } elseif (empty($description)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Description is blank !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } elseif (empty($file_name)) {
                    $photoData = $db->storeWithoutPhoto($title, $description);
                  } elseif (empty($title)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Title field left blank!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } elseif (empty($description)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Description is blank !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <?php } elseif (empty($file_name)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Photo is not selected !</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <?php } elseif ($file_size>1048567) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>WARNING!!! File size is larger than 1 MB!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <?php } elseif (in_array($file_ext, $permitted)===false) {
                    echo '<span class="error">You can upload only:-' . implode(',', $permitted). '</span>';?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>'WARNING!!! You can upload only:-'  . implode(',' , $permitted). '! Fill up the field and try again!'</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <?php } elseif (!empty($file_name)) {
                    $photoData = $db->store(
                        $title,
                        $photo,
                        $description
                    );
                    move_uploaded_file($file_temp, $photo);
                  } else { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>'WARNING!!! Data failed to upload !'</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php }
                }
            } ?>
                <form class="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Photo title:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Photo title...">
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo:</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>
                    <div class="form-group">
                        <label for="description">Photo description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Photo description...">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                </form>
                <br>
            
            <div class="row">
                <div class="col-sm-12">
                    <h4>Dynamic slider gallery page</h4>
                    <hr>
                    <?php // Alert message data
                    if (isset($_GET[ 'photo_inserted'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>WOW!!! Data is uploaded successfully!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } if (isset($_GET['no_photo'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>WOW!!! Data is uploaded successfully without photo!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } ?>
                    <table class="table table-responsive table-condensed">
                        <tbody>
                            <?php
                            $db = new Slider;
                            $query='SELECT * FROM tbl_slider ORDER BY id DESC';
                            $records_per_page=4;
                            $newquery=$db->paging($query, $records_per_page);
                            $db->viewPhoto($newquery);?>
                            <tr>
                              <td colspan="8" align="center">
                                <div class="pagination">
                                    <?php $db->paginglink($query, $records_per_page); ?>
                                </div>
                              </td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
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

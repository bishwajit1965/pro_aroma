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
              <a href="article_index.php" class="btn btn-primary btn-sm"> <span class="glyphicon glyphicon-list"></span> Article Index</a>
              <div class="box-tools pull-right">
                <button type="button" style="color:#FFF;" class="btn btn-box-tool btn-primary" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" style="color:#FFF;" class="btn btn-box-tool btn-primary" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <!-- Add code below -->
            <?php
            $db = new Article();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['submit'])) {
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
                    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                    $uploaded_image = "uploads/". $unique_image;
                    $description = $_POST['description'];
                    if ($title == "") {
                        $msg = '<div class="row">
                            <div class="col-md-12">
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong id= "strong"#9C0A0A>WARNING!!! Title field remained blank! Fill up the field and try again!</strong>
                              </div>
                            </div>
                          </div>';
                          echo $msg;
                    } elseif ($author == "") {
                        $msg = '<div class="row">
                            <div class="col-md-12">
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong id= "strong">WARNING!!! Author field remained blank! Fill up the field and try again!</strong>
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
                                <span aria-hidden="true">&times;</span>
                                </button>
                                <strong id= "strong">WARNING!!! Post status field remained blank! Fill up the field and try again!</strong>
                              </div>
                            </div>
                          </div>';
                        echo $msg;
                    } elseif ($content == "") {
                        $msg = '<div class="row">
                            <div class="col-md-12">
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong id= "strong">WARNING!!! Content field remained blank! Fill up the field and try again!</strong>
                              </div>
                            </div>
                          </div>';
                        echo $msg;
                    } elseif (empty($file_name)) {
                        //The following code will update data without picture
                        $db->CreateWithoutPicture(
                            $title,
                            $author,
                            $tag_id,
                            $cat_id,
                            $status,
                            $content,
                            $description,
                            $published_at
                        );
                        $msg = '<div class="row">
                            <div class="col-md-12">
                              <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong id= "strong">WARNING!!! Article is uploaded without photo!</strong>
                              </div>
                            </div>
                          </div>';
                        echo $msg;
                    } elseif ($file_size > 1048567) {
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
                    } elseif (in_array($file_ext, $permitted) === false) {
                        echo '<span class="error">You can upload only:-' . implode(',', $permitted).'</span>';
                        $msg = '<div class="row">
                            <div class="col-md-12">
                              <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong id= "strong">WARNING!!! You can upload only:-' . implode(',', $permitted).'! Fill up the field and try again!</strong>
                              </div>
                            </div>
                          </div>';
                        echo $msg;
                    } // The following code will update data with picture
                    elseif (!empty($file_name)) {
                        $db->Create(
                            $title,
                            $author,
                            $tag_id,
                            $cat_id,
                            $status,
                            $content,
                            $uploaded_image,
                            $description,
                            $published_at
                        );
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
                    } else {
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
                  <!-- <div class="form col-md-12"> -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Title.....">
                    </div>
                    <div class="form-group">
                      <label for="author">Author</label>
                      <input type="text" class="form-control" id="author"  name="author" placeholder="Author.....">
                    </div>
                    <div class="form-group">
                      <label for="tag_id">Tag </label>
                      <select id="select" name="tag_id" class="form-control">
                        <option value="">Select Tag</option>
                        <?php
                        $db = new Tag();
                        $query = "SELECT * FROM tbl_tag";
                        $db->Tag($query);
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="created_at" name="created_at">
                    </div>
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="updated_at" name="updated_at">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="cat_id">Category</label>
                      <select id="select" name="cat_id" class="form-control"  data-placeholder="Select a State">
                        <option value="">Select Category</option>
                        <?php
                        $db = new Category();
                        $query = "SELECT * FROM tbl_category";
                        $db->Category($query);
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="photo">Photo</label>
                      <input type="file" name="photo" class="form-control" id="photo"  >
                    </div>
                    <div class="row">
                      <div class="col-md-7">
                        <div class="form-group">
                          <label for="published_at">Published_at</label>
                          <input type="datetime-local" class="form-control" id="published_at" name="published_at">
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label for="status">Post Status
                            <div class="selection" style="margin-top: 4px;">
                              <select name="status" style="padding: 6px;">
                                <option value="0" selected>0</option>
                                <option value="1">1</option>
                                </select> </label><span style="padding:9px 5px;border-radius: 5px;font-weight:bold;font-size: 12px;" class="label label-primary form-control">Draft = 0 || Published = 1</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- </div> -->
                      <div class="">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="description">Post description</label>
                            <input type="text" class="form-control" id="description" name="description">
                          </div>
                          <div class="form-group">
                            <label for="content">Post Content</label>
                            <textarea name="content" id="editor1" cols="" rows=""></textarea>
                          </div>
                          <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-md btn-primary"><i class="fa fa-upload" aria-hidden="true"> Upload</i></button>
                            <button type="reset-data" value="cancel" class="btn btn-danger btn-md"><i class="fa fa-ban" aria-hidden="true"></i> Reset Data</button>
                          </div>
                        </div>
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

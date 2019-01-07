<?php
spl_autoload_register(function ($class) {
    include_once('../class.'.$class.'.php');
});
include_once '../dbconfig.php';
class Pages
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function createPage($title, $heading, $body, $footer)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_pages(title, heading, body, footer) VALUES(:title, :heading, :body, :footer)");
            $stmt->bindparam(":title", $title);
            $stmt->bindparam(":heading", $heading);
            $stmt->bindparam(":body", $body);
            $stmt->bindparam(":footer", $footer);
            $page_data = $stmt->execute();
            if ($page_data) {
                header("Location: pages_home.php?page_created=1");
            } else {
                header("Location: pages_home.php?page_created=0");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Will fetch all the pages dynamically from database to sidebar
    public function fetchPages($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($page=$stmt->fetch(PDO::FETCH_OBJ)) { ?>
                    <a href="fetch_page.php?id=<?php echo $page->id;?>">
                    <i class="fa fa-circle-o"></i>
                    <?php echo $page->title;?></a>
                <?php 
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function singlePageView($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id"=>$_GET['id']]);
        $stmt->bindparam(":id", $id);
        if ($stmt->rowCount() > 0) {
            while ($page_data = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <div class="container" style="width:100%;">
                <h2><span style="font-weight:bold;">Page No: <?php echo $page_data->id;?></span></h2>
                <h2><span style="font-weight:bold;"><?php echo $page_data->title;?></span></h2>
                <h3><span style="font-weight:bold;"><?php echo $page_data->heading;?></span></h3>
                <p><?php echo $page_data->body;?></p>
                <p><?php echo $page_data->footer;?></p>
                <p><span style="font-weight:bold;">
                Created at: <?php echo $fm->dateFormat($page_data->created_at);?>
                </span>
                </p>
            </div>
            <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="15" class="text-center" id="empty-data">
                <strong>
                    <span style="color:#B50717;">
                        <h2>No data is here to display. Upload data...</h2>
                    </span>
                </strong>
            </td>
        </tr>
        <?php
        }
    }

    // Fetch data from database to pages_home.php
    public function viewData($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $id = 1;
            while ($page_data=$stmt->fetch(PDO::FETCH_OBJ)) { ?>
        <tr>
          <td><?php echo $id++;?></td>
          <td><?php echo $fm->textShorten($page_data->title, 60);?></td>
          <td><?php echo $fm->textShorten($page_data->heading, 60);?></td>
          <td><?php echo $fm->textShorten($page_data->body, 250);?></td>
          <td><?php echo $fm->textShorten($page_data->footer, 200);?></td>
          <td><?php echo $fm->dateFormat($page_data->created_at);?></td>
          <td><?php echo $fm->dateFormat($page_data->updated_at);?></td>
          <td>
            <a href="fetch_page.php?id=<?php echo $page_data->id;?>" style="display:block; margin-bottom: 3px;" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="View page" onclick="return confirm('Sure to go to view of the page ?')">
              <i class="fa fa-eye" aria-hidden="true"></i> View page</a>

            <a href="single_page.php?id=<?php echo $page_data->id;?>" style="display:block; margin-bottom: 3px;" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="View page" onclick="return confirm('Sure to go to view of the page ?')">
              <i class="fa fa-eye" aria-hidden="true"></i> Single page</a>

            <a href="edit_page.php?edit_id=<?php echo $page_data->id;?>" style="display:block; margin-bottom: 3px;" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Update article" onclick="return confirm('Sure to go to edit view of this post ?')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i> Update page</a>

            <a href="delete_page.php?delete_id=<?php echo $page_data->id; ?>" style="display:block; margin-bottom: px;" class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="top" title="Delete article" onclick="return confirm('Sure to go to delete view ?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete page</a>
          </td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
        <td colspan="15" class="text-center" id="empty-data">
            <strong>
                <span style="color:#B50717;">
                    <h2>No data is here to display. Upload data...</h2>
                </span>
            </strong>
        </td>
        </tr>
        <?php
        }
    }

    public function viewPages($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id"=>$_GET['id']]);
            $stmt->bindparam(":id", $id);
            if ($stmt->rowCount() > 0) {
                while ($page=$stmt->fetch(PDO::FETCH_OBJ)) { ?>
                    <form class="form" action="" method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title" name="title" value="<?php echo $page->title; ?>">
                        </div> 
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Heading</label>
                          <input type="text" class="form-control" id="heading" name="heading" value="<?php echo $page->heading; ?>">
                        </div>  
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="content">Post Content</label>
                          <textarea name="body" id="editor1" cols="" rows="">
                            <?php echo $page->body; ?>"
                          </textarea>
                        </div>
                        <div class="form-group">
                          <label for="title">Footer</label>
                          <input type="text" class="form-control" id="footer" name="footer" value="<?php echo $page->footer; ?>">
                        </div>
                        <div class="form-group">
                            <a href="edit_page.php?edit_id=<?php echo $page->id; ?>" class="btn btn-md btn-primary">
                            <i class="fa fa-fast-forward"></i> Go to Edit View</a>

                          <a href="delete_page.php?delete_id=<?php echo $page->id; ?>" class="btn btn-md btn-danger"><i class="fa fa-fast-forward"></i> Go to Delete View</a>

                          <button type="reset-data" value="cancel" class="btn btn-danger btn-md"><i class="fa fa-ban" aria-hidden="true"></i> Reset Data</button>
                        </div>
                      </div>
                    </div>
                  </form>
                <?php }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editPage($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id"=>$_GET['edit_id']]);
            $stmt->bindparam(":id", $id);
            if ($stmt->rowCount() > 0) {
                while ($page=$stmt->fetch(PDO::FETCH_OBJ)) { ?>
                    <form class="form" action="" method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title" name="title" value="<?php echo $page->title; ?>">
                        </div> 
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Heading</label>
                          <input type="text" class="form-control" id="heading" name="heading" value="<?php echo $page->heading; ?>">
                        </div>  
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="content">Post Content</label>
                          <textarea name="body" id="editor1" cols="" rows="">
                            <?php echo $page->body; ?>"
                          </textarea>
                        </div>
                        <div class="form-group">
                          <label for="title">Footer</label>
                          <input type="text" class="form-control" id="footer" name="footer" value="<?php echo $page->footer; ?>">
                        </div>
                        <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-md btn-primary"><i class="fa fa-upload" aria-hidden="true"> Update</i></button>
                          <button type="reset-data" value="cancel" class="btn btn-danger btn-md"><i class="fa fa-ban" aria-hidden="true"></i> Reset Data</button>

                          <a href="pages_home.php" class="btn btn-md btn-warning"><i class="fa fa-fast-backward"></i> Go back</a>
                        </div>
                      </div>
                    </div>
                  </form>
                <?php }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //Update page data in database
    public function update($id, $title, $heading, $body, $footer)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_pages SET
            id      = :id,
            title   = :title,
            heading = :heading,
            body    = :body,
            footer  = :footer  
            WHERE id  = :id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":title", $title);
            $stmt->bindparam(":heading", $heading);
            $stmt->bindparam(":body", $body);
            $stmt->bindparam(":footer", $footer);
            $updatedData = $stmt->execute();
            if ($updatedData) {
                header("Location: pages_home.php?edited=1");
            } else {
                header("Location: edit_page.php?error");
            }
              return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
// Updatable data view
    public function deleteView($query)
    {
        $query = $this->conn->prepare($query);
        $query->execute([":id"=>$_GET['delete_id']]);
        while ($page_data=$query->fetch(PDO::FETCH_OBJ)) {
        ?>
        <div class="row">
            <form class="form" action="" method="POST">
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="id">Id</label>
                        <input type="text" name="id" class="form-control" id="id" value="<?php echo $page_data->id;?>" disabled>
                    </div>
                    <div class="form-group" >
                        <label for="title" >Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="<?php echo $page_data->title;?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="id">Heading</label>
                        <input type="text" name="heading" class="form-control" id="id" value="<?php echo $page_data->heading;?>" disabled>
                    </div>
                    <div class="form-group" >
                        <label for="title" >Footer</label>
                        <input type="text" name="footer" class="form-control" id="footer" value="<?php echo $page_data->footer;?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">Body</label>
                        <textarea name="body" id="editor1" class="form-control" type="text" cols="" rows="">
                        <?php echo $page_data->body;?>
                        </textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <button  onclick="return confirm('Are you sure to delete this data!');" type="submit" class="btn btn-danger" name="btn-delete"><span class="glyphicon glyphicon-trash"></span> Delete this Record !
                    </button>

                    <a href="pages_home.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                </div>
            </form>
        </div>
        
        <?php }
    }
//Deletable data view
    public function delete($id)
    {
     
    // Delete image and data from database
        $stmt=$this->conn->prepare("DELETE FROM tbl_pages WHERE id=:id");
        $stmt->bindparam(":id", $id);
        $deletedData = $stmt->execute();
        if ($deletedData) {
            header("Location: pages_home.php?deleted=1");
        } else {
            header("Location: delete_page.php?error");
        }
        return true;
    }
}

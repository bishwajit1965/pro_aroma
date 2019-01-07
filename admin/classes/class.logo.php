<?php

class Logo
{
// Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    
    public function store($title, $photo, $description)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO tbl_logo (title, photo, description)
            VALUES(:title, :photo, :description)');
            $stmt->bindparam(':title', $title);
            $stmt->bindparam(':photo', $photo);
            $stmt->bindparam(':description', $description);
            $inserted = $stmt->execute();
            if ($inserted) {
                header("Location:logoIndex.php?photo_inserted");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    public function storeWithoutPhoto($title, $description)
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO tbl_logo (title, description) VALUES(:title, :description)');
            $stmt->bindparam(':title', $title);
            $stmt->bindparam(':description', $description);
            $inserted = $stmt->execute();
            if ($inserted) {
                header("Location: logoIndex.php?no_photo-uploaded");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    // Counts number of records in gallery table
    public function countLogo($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->rowCount();
        echo $rows;
    }

    // Get id to edit Not used anywhere
    public function getID($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_logo WHERE id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    // Photo view after uploading data
    public function viewPhoto($query)
    {
        try {
            $fm = new helpers;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {?>
                    
                <tr>
                    <td><?php echo $result->id; ?></td>
                    <td><?php echo $result->title; ?></td>
                    <td>
                        <?php if ($result->photo == "") {?>
                        <img class="card-img-top img-responsive" 
                        src="../images/avatar.jpg" alt="Alternative image" style="height:190px;width:255px;">
                        <?php } else {?>
                        <a href="<?php echo $result->photo; ?>" data-fancybox data-caption="My caption">
                            <img class="card-img-top img-responsive" 
                            style="height:80px;width:80px" src="<?php echo $result->photo; ?>" alt="Card image">
                        </a>
                        <?php
                        }
                        ?>
                    </td>
                    
                    <td><?php echo $result->description; ?></td>
                    <td><?php echo $fm->dateFormat($result->created_at); ?></td>
                    <td><?php echo $fm->dateFormat($result->updated_at); ?></td>
                    <td>
                        <a href="editLogo.php?edit_photo_id=<?php echo $result->id; ?>" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>

                        <a href="deleteLogo.php?del_photo_id=<?php echo $result->id; ?>" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> All</a>
                        <?php
                        if (empty($result->photo)) { ?>
                        <a href="logoDelete.php?photo_delete_id=<?php echo $result->id; ?>" 
                        class="btn btn-sm btn-danger" 
                        style="display:none;">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Del logo</a>
                        <?php } else { ?>
                        <a href="logoDelete.php?photo_delete_id=<?php echo $result->id; ?>" 
                        class="btn btn-sm btn-danger">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Logo</a>
                        <?php }?>
                    </td>
                </tr>
                <?php
                }
            } else { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><h2>SORRY ! No data is found here!</h2></strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    // View to edit data and photo
    public function editPhotoView($query)
    {
        try {
            $fm = new helpers;
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $_GET["edit_photo_id"]]);
            $stmt->bindparam(":id", $id);
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {?>
            <form class="form-group" action="" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6 left">
                  <div class="form-group">
                    <label for="">Id</label>
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $result->id; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo $result->title; ?>">
                  </div>
                  <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="description" id="description" value="<?php echo $result->description; ?>">
                  </div>
                  <div class="form-group">
                    <label for="">Select photo</label>
                    <input type="file" class="form-control" name="photo" id="photo" >
                  </div>
                </div>
                <div class="col-sm-6 right" style="float:left;" >
                  <div class="form-group">
                    <label for=""> Logo</label><br>
                    <?php if (empty($result->photo)) {?>
                    <img id="photo-del" src="../images/avatar.jpg" alt="Alternative image">
                    <?php } else {?>
                    <img id="photo-del" name="photo" src="<?php echo $result->photo; ?>" 
                    alt="Photo" class="img img-rounded img-responsive" style="width:100%;height:258px; ">
                    <?php }?>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success" 
                  name="btn-edit" onclick="return confirm('Are you sure to edit this data?');">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</button>&nbsp;
                  
                  <a href="../logo/logoIndex.php" 
                  class="btn btn-sm btn-warning"><i class="fa fa-fast-backward" aria-hidden="true"></i> Go back</a>
                  <span class="badge badge-pill badge-primary" style=""><?php echo $result->id; ?></span>
                  <span class="badge badge-pill badge-primary">
                    <?php echo $fm->dateFormat($result->created_at); ?></span>
                </div>
              </div>
            </form>
            <?php }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    public function updatePhoto($id, $title, $photo, $description)
    {
        // Delete photo from folder
        $stmt = $this->conn->prepare('SELECT photo FROM tbl_logo WHERE id = :id');
        $stmt->execute([':id' => $_GET['edit_photo_id']]);
        $stmt->bindparam(':id', $id);
        while ($photo_data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $del_photo = $photo_data->photo;
            unlink($del_photo);
        }
        // Update photo and data
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_logo SET
            id    = :id,
            title = :title,
            photo = :photo,
            description = :description
            WHERE id = :id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":title", $title);
            $stmt->bindparam(":photo", $photo);
            $stmt->bindparam(":description", $description);
            $data = $stmt->execute();
            if ($data) {
                header("Location:logoIndex.php?photo_edited");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    // Data will be updated without photo if left blank
    public function updateWithoutPhoto($id, $title, $description)
    {
        // Delete photo from folder
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_logo SET
            id = :id,
            title = :title,
            description = :description
            WHERE id = :id ");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":title", $title);
            $stmt->bindparam(":description", $description);
            $data = $stmt->execute();
            if ($data) {
                header("Location:logoIndex.php?no_photo");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    public function delPhotoView($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['id' => $_GET['del_photo_id']]);
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {?>
            <form action="" method="POST" role="" enctype="multipart/form-data">
              <div class="left">
                <div class="form-group">
                  <label for="">Id</label>
                  <input type="text" class="form-control" name="id" id="id" value="<?php echo $result->id; ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="">Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="<?php echo $result->title; ?>">
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                  <input type="text" class="form-control" name="description" id="description" value="<?php echo $result->description; ?>">
                </div>
                <button type="submit" class="btn btn-md btn-danger" name="btn-delete" 
                onclick="return confirm('Are you sure to delete this data?');">
                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete all data here</button>&nbsp;
                <a href="../logo/logoIndex.php" class="btn btn-md btn-warning">
                <i class="fa fa-fast-backward" aria-hidden="true"></i> Go back</a>
              </div>
              <div class="right" style="float:left;" >
                <div class="form-group">
                  <label for="">Photo</label><br>
                    <?php if (empty($result->photo)) {?>
                      <img src="../images/avatar.jpg" alt="Alternative image">
                    <?php } else {?>
                      <img id="photo-del" src="<?php echo $result->photo; ?>" alt="Image">
                    <?php }?>
                </div>
              </div>
            </form>
            <?php }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    // Delete photo from folder and database
    public function delete($id)
    {
        // Select uploaded photo to delete from uploads
        $stmt = $this->conn->prepare('SELECT photo FROM tbl_logo WHERE id = :id');
        $stmt->execute([':id' => $_GET['del_photo_id']]);
        $stmt->bindparam(':id', $id);
        while ($photo_data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $del_photo = $photo_data->photo;
            unlink($del_photo);
        }
        // Delete photo from database
        $stmt = $this->conn->prepare('DELETE FROM tbl_logo WHERE id = :id');
        $stmt->bindparam(':id', $id);
        $photo_deleted = $stmt->execute();
        if ($photo_deleted) {
            header('Location:logoIndex.php?photo-deleted');
        } else {
            header('Location:logoIndex.php?delete-errror');
        }
    }

    // View to delete photo only
    public function photoDeleteView($query)
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['id' => $_GET['photo_delete_id']]);
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {?>
            <form action="" method="POST" role="" enctype="multipart/form-data">
              <div class="left">
                <div class="form-group">
                  <label for="">Id</label>
                  <input type="text" class="form-control" name="id" id="id" value="<?php echo $result->id; ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="">Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="<?php echo $result->title; ?>">
                </div>
                <div class="form-group">
                  <label for="">Description</label>
                  <input type="text" class="form-control" name="description" id="description" 
                  value="<?php echo $result->description; ?>">
                </div>
                <button type="submit" class="btn btn-md btn-danger" 
                name="btn-photo-delete" onclick="return confirm('Are you sure to delete this data?');">
                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete logo only</button>&nbsp;
                <a href="../logo/logoIndex.php" 
                class="btn btn-md btn-warning"><i class="fa fa-fast-backward" aria-hidden="true"></i> Go back</a>
              </div>
              <div class="right" style="float:left;" >
                <div class="form-group">
                  <label for="">Photo</label><br>
                    <?php if (empty($result->photo)) {?>
                      <img src="../images/avatar.jpg" alt="Alternative image">
                    <?php } else { ?>
                      <img id="photo-del" src="<?php echo $result->photo; ?>" alt="Image">
                    <?php } ?>
                </div>
              </div>
            </form>
            <?php }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    }

    // Delete photo only
    public function photoDelete($id)
    {
        // Select uploaded photo to delete from uploads
        $stmt = $this->conn->prepare('SELECT photo FROM tbl_logo WHERE id = :id');
        $stmt->execute([':id' => $_GET['photo_delete_id']]);
        $stmt->bindparam(':id', $id);
        while ($photo_data = $stmt->fetch(PDO::FETCH_OBJ)) {
            $del_photo = $photo_data->photo;
            unlink($del_photo);
        }
        // Delete photo from database
        $stmt = $this->conn->prepare("UPDATE tbl_logo SET photo = null WHERE id = :id");
        $stmt->bindparam(':id', $id);
        $photo_deleted = $stmt->execute();
        if ($photo_deleted) {
            header("Location: logoIndex.php?only-photo-deleted");
        } else {
            header("Location: logoIndex.php?only-delete-errror");
        }
    }

    //Pagination begins
    public function paging($query, $records_per_page)
    {
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position,$records_per_page";
        return $query2;
    }
    public function paginglink($query, $records_per_page)
    {
        $self = $_SERVER['PHP_SELF'];
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $total_no_of_records = $stmt->rowCount();
        if ($total_no_of_records > 0) {
        ?>
        <ul class="pagination">
            <?php
            $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
            $current_page = 1;
            if (isset($_GET["page_no"])) {
                $current_page = $_GET["page_no"];
            }
            if ($current_page != 1) {
                $previous = $current_page - 1;
                echo "<li class='page-item'><a class='page-link' href='" . $self . "?page_no=1'>First</a></li>";
                echo "<li class='page-item'><a class='page-link' href='" . $self . "?page_no=" . $previous . "'>Previous</a></li>";
            }
            for ($i = 1; $i <= $total_no_of_pages; $i++) {
                if ($i == $current_page) {
                    echo "<li class='page-item'><a class='page-link' href='" . $self . "?page_no=" . $i . "' style='color:red;background-color:#BDCED4;'>" . $i . "</a></li>";
                } else {
                    echo "<li class='page-item'><a class='page-link' href='" . $self . "?page_no=" . $i . "'>" . $i . "</a></li>";
                }
            }
            if ($current_page != $total_no_of_pages) {
                $next = $current_page + 1;
                echo "<li class='page-item'><a class='page-link' href='" . $self . "?page_no=" . $next . "'>Next</a></li>";
                echo "<li class='page-item'><a class='page-link' href='" . $self . "?page_no=" . $total_no_of_pages . "'>Last</a></li>";
            }
            ?>
        </ul>
        <?php
        }
    }
    /* paging */
}
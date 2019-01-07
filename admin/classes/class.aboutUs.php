<?php
spl_autoload_register(function ($class) {
    include_once('class.'. $class.'.php');
});

class aboutUs
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // Add about us description
    public function store($heading, $description)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_about_us(heading, description) VALUES(:heading, :description)");
            $stmt->bindparam(":description", $description);
            $data = $stmt->execute();
            if ($data) {
                header("Location:about_us_index.php?inserted=1");
            } else {
                header("Location:add_about_us.php?inserted=0");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // View data
    public function viewAboutUsText($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowcount() > 0) {
            while ($aboutUsData = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <tr>
                    <td><?php echo $aboutUsData->id;?></td>
                    <td><?php echo $aboutUsData->heading;?></td>
                    <td><?php echo $aboutUsData->description; ?></td>
                    <td><?php echo $aboutUsData->created_at; ?></td>
                    <td><?php echo $aboutUsData->updated_at; ?></td>
                    <td>
                        <a href="edit_about_us.php?edit_id=<?php echo $aboutUsData->id;?>" class="btn btn-xs btn-primary btn-block">
                        <i class="fa fa-edit"></i> Edit</a>
                        <a href="delete_about_us.php?delete_id=<?php echo $aboutUsData->id; ?>" class="btn btn-xs btn-danger btn-block"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            <?php
            }
        } else { ?>
            <tr>
                <td colspan="15" class="text-center" id="empty-data">
                <strong>
                    <span style="color:#B50717;">
                    <h2>No data is here to display. Upload data...</h2>
                    </span>
                </strong></td>
            </tr>
        <?php
        }
    }

    // Update view
    public function updateView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['edit_id']]);
        if ($stmt->rowCount() > 0) {
            while ($edit_about_us = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="Id">Id</label>
                        <input type="text" name="id" class="form-control" value="<?php echo $edit_about_us->id;?>">
                    </div>
                    <div class="form-group">
                        <label for="heading">Heading</label>
                        <input type="text" name="heading" class="form-control" value="<?php echo $edit_about_us->heading;?>">
                    </div>
                    <div class="form-group">
                        <label for="description"> About us</label>
                        <textarea name="description" id="editor1" cols="30" rows="10">
                        <?php echo $edit_about_us->description; ?>
                        </textarea>
                    </div>
                    <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" name="btn-update"
                    onclick="return confirm('Are you sure to update this data?');">
                    <span class="glyphicon glyphicon-edit"></span> Update this Record !
                    </button>
                    <a href="about_us_index.php" class="btn btn-large btn-success">
                    <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                </div>
            </div>
                </form>
            <?php
            }
        } else { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SORRY EMPTY!!! There is nothing in the database to update!</strong>
                    &nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
    }

    // Update about us
    public function update($id, $heading, $description)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_about_us WHERE id = :id");
        $stmt->execute([":id" => $_GET['edit_id']]);
        $stmt->bindparam(":id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_about_us
            SET
            id = :id,
            description = :description
            WHERE id = :id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":heading", $heading);
            $stmt->bindparam(":description", $description);
            $edited_about_us = $stmt->execute();
            if ($edited_about_us) {
                header("Location:about_us_index.php?updated=1");
            } else {
                header("Location:edit_about_us.php?updated=0");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Delete view
    public function deleteView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['delete_id']]);
        if ($stmt->rowCount() > 0) {
            while ($del_about_us = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="heading">Heading</label>
                        <input type="text" name="heading" class="form-control" value="<?php echo $edit_about_us->heading;?>">
                    </div>
                    <div class="form-group">
                        <label for="description"> About us</label>
                        <textarea name="description" id="editor1" cols="30" rows="10">
                        <?php echo $del_about_us->description; ?>
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-danger" name="btn-delete"
                            onclick="return confirm('Are you sure to delete this data?');">
                            <span class="glyphicon glyphicon-trash"></span> Delete this Record !
                            </button>
                            <a href="about_us_index.php" class="btn btn-large btn-success">
                            <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                        </div>
                    </div>
                </form>
            <?php
            }
        } else { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <strong id= "strong"#9C0A0A>SORRY EMPTY!!! There is nothing in the database to delete!</strong>
                    &nbsp &nbsp
                    </div>
                </div>
            </div>
        <?php
        }
    }

    // Delete about us data
    public function delete($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_about_us WHERE id = :delete_id");
        $stmt->execute([":delete_id" => $_GET['delete_id']]);
        $stmt = $this->conn->prepare("DELETE FROM tbl_about_us WHERE id = :delete_id");
        $stmt->bindparam(":delete_id", $id);
        $delete_about_us = $stmt->execute();
        if ($delete_about_us) {
            header("Location:about_us_index.php?deleted=1");
        } else {
            header("Location:delete_about_us.php?deleted=0");
        }
    }
}

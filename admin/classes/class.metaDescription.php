<?php
spl_autoload_register(function ($class) {
    include_once('../class.' . $class . '.php');
});

include_once '../dbconfig.php';

class metaDescription
{
    // Databse connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Store data with picture
    public function createMetaDescription($description)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_meta_description(description) VALUES(:description)");
            $stmt->bindparam(":description", $description);
            $insertedData = $stmt->execute();
            if ($insertedData) {
                header("Location:metaDescription_index.php?dataInserted=1");
            } else {
                header("Location:add_metaDescription.php?dataInserted=0");
            }
            return true;
        } catch (PDOException $e) {
            echo "Error!" . $e->getMessage();
        }
        return true;
    }

    // View Meta Description
    public function viewMetaDescription($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $id = 1;
            while ($meta_description = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <tr>
                <td><?php echo $id++;?></td>
                <td><?php echo $meta_description->description;?></td>
                <td><?php echo $fm->dateFormat($meta_description->created_at);?></td>
                <td><?php echo $fm->dateFormat($meta_description->updated_at);?></td>
                <td>
                    <a href="edit_metaDescription.php?edit_id=<?php echo $meta_description->id;?>" 
                    class="btn btn-xs btn-primary btn-block" 
                    onclick="return  confirm('Want to go to edit view of this data ?');">
                    <i class="fa fa-edit"></i> Edit</a>
                    <a href="delete_metaDescription.php?delete_id=<?php echo $meta_description->id;?>" 
                    class="btn btn-xs btn-danger btn-block" 
                    onclick="return confirm('Do you really want to go to delete view of this data ?');">
                    <i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="15" class="text-center" id="empty-data">
            <strong><span style="color:#B50717;"><h2>No data is here to display.Upload data...</h2></span></strong></td>
        </tr>
        <?php
        }
    }

    // Get Meta Description for SEO
    public function getMetaDescription($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($meta_description = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <?php echo $meta_description->description;?>    
            <?php
            }
        } else {
        }
    }

    // Update view
    public function updateView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['edit_id']]);
        while ($meta_description = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <form class="form" action="" method="POST">
                <div class="form-group">
                    <label for="description"> Description</label>
                    <textarea name="description" id="editor1" cols="30" rows="10">
                    <?php echo $meta_description->description;?>
                    </textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="btn-update" class="btn btn-sm btn-primary">
                        <i class="fa fa-upload" aria-hidden="true"> Upload</i></button>
                    <button type="reset-data" value="cancel" class="btn btn-danger btn-sm">
                        <i class="fa fa-ban" aria-hidden="true"></i> Reset Data</button>
                    <a href="metaDescription_index.php" class="btn btn-sm btn-primary">
                        <span class="glyphicon glyphicon-inbox"></span> Meta Description Index</a>    
                </div>
            </form>
        <?php
        }
    }
    // Update Meta Description
    public function update($id, $description)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_meta_description WHERE id = :id");
        $stmt->execute([":id" => $_GET['edit_id']]);
        $stmt->bindparam(":id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_meta_description
            SET
            id = :id,
            description = :description
            WHERE id = :id ");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":description", $description);
            $data = $stmt->execute();
            if ($data) {
                header("Location: metaDescription_index.php?updated=1");
            } else {
                header("Location: edit_metaDescription.php?notUpdated=0");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Delete view
    public function deleteView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['delete_id']]);
        while ($meta_description = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
        <form class="form" action="" method="POST">
            <div class="form-group">
                <label for="description"> Description</label>
                <textarea name="description" id="editor1" cols="30" rows="10">
                <?php echo $meta_description->description;?>
                </textarea>
            </div>
            <div class="form-group">    
                <button type="submit" name="btn-delete" 
                class="btn btn-sm btn-danger" onclick="return confirm('Are sure, you want to delete this data ?');">
                <i class="fa fa-trash" aria-hidden="true"> Delete</i></button>
                
                <a href="metaDescription_index.php" class="btn btn-sm btn-primary">
                    <span class="glyphicon glyphicon-inbox"></span> Meta Description Index</a> 
            </div>
        </form>
        <?php
        }
    }

    // Delete Meta Description
    public function delete($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_meta_description WHERE id = :id ");
        $stmt->execute([":id" => $_GET['delete_id']]);
        $stmt = $this->conn->prepare("DELETE FROM tbl_meta_description WHERE id = :id ");
        $stmt->bindparam(":id", $id);
        $data = $stmt->execute();
        if ($data) {
            header("Location:metaDescription_index.php?deleted=1");
        } else {
            header("Location:delete_metaDescription.php?deleted=0");
        }
        return true;
    }
}

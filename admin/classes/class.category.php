<?php
spl_autoload_register(function ($class) {
    include_once('class.'.$class.'.php');
});
// include_once '../dbconfig.php';

class Category
{
    // Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Add Category
    public function Create($cat_name)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_category(cat_name) VALUES(:cat_name)");
            $stmt->bindparam(":cat_name", $cat_name);
            $data = $stmt->execute();
            if ($data) {
                header("Refresh:2; category_index.php?inserted");
            } else {
                header("Location:add_category.php");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // View category
    public function viewCategory($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $id = 1;
            while ($r = $stmt->fetch(PDO::FETCH_OBJ)) { ?>

            <tr>
                <td> <?php echo $id++ ;?> </td>
                <td> <?php echo $r->cat_name ;?></td>
                <td> <?php echo $fm->dateFormat($r->created_at);?></td>
                <td> <?php echo $fm->dateFormat($r->updated_at);?></td>
                <td>
                    <a href="edit_category.php?editCat_id=<?php echo $r->cat_id;?>"
                    class="btn btn-sm btn-primary" onclick="return confirm('Are you sure to edit this data?');">
                    <span class="glyphicon glyphicon-pencil">
                    </span> Edit</a>

                    <a href="delete_category.php?delCat_id=<?php echo $r->cat_id ; ?>"class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure to delete this data?');">
                    <span class="glyphicon glyphicon-trash"></span> Delete</a>
                </td>
            </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="3" class="text-center" id="empty-data"><strong>
                <span style="color:#B50717;"><h2>No data is here to display. Upload data...</h2></span></strong></td>
            </tr>
        <?php
        }
    }

    // Select category
    public function Category($query)
    {
        $query ="SELECT * FROM tbl_category";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <option value="<?php echo $result->cat_id;?>">
            <?php echo $result->cat_name;?>
            </option>
            <?php
            }
        }
    }

    // Update view
    public function updateView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":cat_id" => $_GET['editCat_id']]);
        while ($r = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
        <form action="" class="form-group" method="post">
            <div class="form-group" >
                <label for="inputId3 control-label">Cat_id</label>
                <input type="text" name="cat_id" class="form-control" id="id" value="<?php echo $r->cat_id;?>" disabled>
            </div>
            <div class="form-group" >
                <label for="category control-label">Cat_name</label>
                    <input type="text" name="cat_name" class="form-control" id="cat_name" value="<?php echo $r->cat_name;?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="btn-update">
                <span class="glyphicon glyphicon-edit"></span>  Update this Record
                </button>
                <a href="category_index.php" class="btn btn-large btn-success">
                <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </div>
        </form>
        <?php
        }
    }

    // Update Category
    public function update($id, $cat_name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_category WHERE cat_id = :cat_id");
        $stmt->execute([":cat_id"=>$_GET['editCat_id']]);
        $stmt->bindparam(":cat_id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_category
			SET
			cat_id = :cat_id,
			cat_name = :cat_name
			WHERE cat_id = :cat_id ");
            $stmt->bindparam(":cat_id", $id);
            $stmt->bindparam(":cat_name", $cat_name);
            $data = $stmt->execute();
            if ($data) {
                header("Refresh:1; category_index.php?updated");
            } else {
                header("Location:edit_cat.php");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Category Delete View
    public function deleteView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":cat_id" => $_GET['delCat_id']]);
        while ($r = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <form action="" class="form-group" method="post">
                <div class="form-group" >
                    <label for="cat_id control-label" >Cat_id</label>
                        <input type="text" name="cat_id"
                        class="form-control" id="cat_id" value="<?php echo $r->cat_id;?>" disabled>
                </div>
                <div class="form-group" >
                    <label for="category control-label">Cat_name</label>
                        <input type="text" name="cat_name"
                        class="form-control" id="cat_name" value="<?php echo $r->cat_name;?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger" name="btn-delete"
                    onclick="return confirm('Are you sure to delete this data?');">
                    <span class="glyphicon glyphicon-trash"></span>  Delete this Record !
                    </button>
                    <a href="category_index.php"
                    class="btn btn-large btn-success">
                    <i class="glyphicon glyphicon-backward"></i> &nbsp;CANCEL</a>
                </div>
            </form>
        <?php }
    }

    // Delete Category
    public function delete($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_category WHERE cat_id = :cat_id ");
        $stmt->execute([":cat_id" => $_GET['delCat_id']]);
        $stmt = $this->conn->prepare("DELETE FROM tbl_category WHERE cat_id = :cat_id ");
        $stmt->bindparam(":cat_id", $id);
        $data = $stmt->execute();
        if ($data) {
            header("Refresh:1; category_index.php?deleted");
        }
        return true;
    }
}

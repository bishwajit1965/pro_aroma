<?php
spl_autoload_register(function ($class) {
    include_once('class.'.$class.'.php');
});

class Copyright
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // Store Footer
    public function store($copyright)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tbl_copyright
			(copyright) VALUES(:copyright)");
            $stmt->bindparam(":copyright", $copyright);
            $data = $stmt->execute();
            if ($data) {
                header("Location: copyright_home.php?inserted");
            } else {
                header("Location: add_copyright.php?not-inserted");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // Footer Index View
    public function viewCopyright($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $id = 1;
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
            ?>
            <tr>
                <td><?php echo $id++;?></td>
                <td><?php echo $result->copyright;?></td>
                <td>
                <a href="edit_copyright.php?editCopyright_id=<?php echo $result->id;?>"
                    class="btn btn-xs btn-primary"
                    onclick="return confirm('Are you sure to edit this data?');">
                    <span class="glyphicon glyphicon-pencil"></span> Edit</a>
                    <a href="delete_copyright.php?delCopyright_id=<?php echo $result->id;?>"
                        class="btn btn-xs btn-danger"
                        onclick="return confirm('Are you sure to edit this data?');">
                    <span class="glyphicon glyphicon-trash"></span> Delete</a>
                </td>
            </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="3" class="text-center" id="empty-data">
                    <strong>
                        <span style="color:#B50717;">
                            <h2> No data is here to display. Upload data...</h2>
                        </span>
                    </strong>
                </td>
            </tr>
            <?php
        }
    }

    // Select all Footer to insert with articles/posts
    public function copyright($stmt)
    {
        $stmt = $this->conn->prepare($stmt);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <option value="<?php echo $result->id;?>">
                <?php echo $result->copyright;?>
            </option>
            <?php }
        }
    }
        // Delete Footer
    public function deleteView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['delCopyright_id']]);
        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
        <form action="" class="form" method="post">
            <div class="form-group" >
                <label for="id">Id</label>
                <input type="text" name="id" class="form-control" id="id"
                value="<?php echo $result->id;?>" disabled>
            </div>
            <div class="form-group" >
                <label for="tag">Copyright</label>
                <input type="text" name="copyright" class="form-control" id="copyright"
                value="<?php echo $result->copyright;?>">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-danger" name="btn-delete"
                    onclick="return confirm('Are you sure to delete this data?');">
                    <span class="glyphicon glyphicon-trash"></span> Delete this Record !
                    </button>
                    <a href="copyright_home.php" class="btn btn-large btn-success">
                    <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                </div>
            </div>
        </form>
        <?php }
    }
    public function updateView($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['editCopyright_id']]);
        while ($r = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
        <form action="" class="form" method="post">
            <div class="form-group" >
                <label for="id">Id</label>
                <input type="text" name="id" class="form-control" id="id"
                value="<?php echo $r->id;?>" disabled>
            </div>
            <div class="form-group" >
                <label for="copyright" class="col-sm-2 control-label"> Copyright text</label>
                <input type="text" name="copyright" class="form-control" id="copyright"
                value="<?php echo $r->copyright;?>">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" name="btn-update"
                    onclick="return confirm('Are you sure to delete this data?');">
                    <span class="glyphicon glyphicon-edit"></span> Update this Record
                    </button>
                    <a href="copyright_home.php" class="btn btn-large btn-success">
                    <i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                </div>
            </div>
        </form>
        <?php }
    }
    public function update($id, $copyright)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_copyright WHERE id = :id");
        $stmt->execute([":id" => $_GET['editCopyright_id']]);
        $stmt->bindparam(":id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_copyright
				SET
				id = :id,
				copyright = :copyright
				WHERE id = :id ");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":copyright", $copyright);
            $data = $stmt->execute();
            if ($data) {
                header("Location: copyright_home.php?updated");
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
        // Delete data
    public function delete($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_copyright WHERE id = :id ");
        $stmt->execute([":id" => $_GET['delCopyright_id']]);
        $stmt = $this->conn->prepare("DELETE FROM tbl_copyright WHERE id = :id ");
        $stmt->bindparam(":id", $id);
        $data = $stmt->execute();
        if ($data) {
            header("Location: copyright_home.php?deleted");
        } else {
            header("Location: copyright_home.php?not-deleted");
        }
        return true;
    }
}

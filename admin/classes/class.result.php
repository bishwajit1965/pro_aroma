<?php
spl_autoload_register(function($class){
	include_once('../class.'.$class.'.php');
});

include_once '../dbconfig.php';

class Result {
	private $conn;
	public function __construct(){
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
}

public function Store($s_roll, $s_name, $uploaded_image){
	try {
	$stmt = $this->conn->prepare("INSERT INTO tbl_result (s_roll, s_name, s_picture ) VALUES(:s_roll, :s_name, :uploaded_image)");
	$stmt->bindparam(":s_roll", $s_roll);
	$stmt->bindparam(":s_name", $s_name);
	$stmt->bindparam(":uploaded_image", $uploaded_image);
	$data = $stmt->execute();
	if ($data) {
		header("Refresh:2; result_index.php?stored");
	}else{
		header("Location: add_result.php");
	}
	return true;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

// Insert data without picture
public function StoreWithoutPicture($s_roll, $s_name){
	try {
		$stmt = $this->conn->prepare("INSERT INTO tbl_result (s_roll, s_name) VALUES(:s_roll, :s_name)");
		$stmt->bindparam(":s_roll", $s_roll);
		$stmt->bindparam(":s_name", $s_name);
		$data = $stmt->execute();
		if ($data) {
			header("Refresh:2;result_index.php?stored");
		}else{
			header("Location:add_result.php");
		}
		return true;
	} catch (Exception $e) {
		echo "Error!" . $e->getMessage();
	}
	return true;
	}

	// Fetch data from database to article_index.php
public function viewData($query){
	$fm = new helpers();
	$stmt = $this->conn->prepare($query);
	$stmt->execute();
	if($stmt->rowCount() > 0)
	{
		$id = 1;
		while($r=$stmt->fetch(PDO::FETCH_OBJ))
			{ ?>
				<tr>
					<td><?php echo $id++;?></td>
					<td><?php echo $r->s_roll;?></td>
					<td><?php echo $r->s_name;?></td>
					<td>
						<img src="<?php echo $r->s_picture ;?>" alt="Image" style="width:80px; height:70px; border:  px solid# ; border-radius:5px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),0 6px 20px 0 rgba(0, 0, 0, 0.19);">
					</td>
					<td><?php echo $fm->dateFormat($r->created_at);?></td>
					<td><?php echo $fm->dateFormat($r->updated_at);?></td>
					<td>
						<a href="edit_result.php?edit_id=<?php echo $r->s_id;?>" style="display: ; margin-bottom:  px;" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Update article" onclick="return confirm('Sure to go to edit view of this post ?')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i> Update</a>

						<a href="delete_result.php?delete_id=<?php echo $r->s_id; ?>" style="display: ; margin-bottom: px;" class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="top" title="Delete article" onclick="return confirm('Sure to go to delete view ?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
					</td>
				</tr>
				<?php
			}
		}
		else
		{
		?>
		<tr>
			<td colspan="15" class="text-center" id="empty-data"><strong><span style="color:#B50717;"><h2>No data is here to display. Upload data...</h2></span></strong></td>
		</tr>
		<?php
	}
}

}

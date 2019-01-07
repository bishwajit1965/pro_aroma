<?php

spl_autoload_register(function ($class) {
    include_once('class.' . $class . '.php');
});

class Messages
{
    // Database connection
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // View all messages
    public function viewAllMessasages($query)
    {
        $fm = new helpers();
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $i = 1;
                while ($message = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $message->firstname; ?></td>
                    <td><?php echo $message->lastname; ?></td>
                    <td><?php echo $message->email; ?></td>
                    <td><?php echo $fm->textShorten($message->message, 150); ?></td>
                    <td> 
                        <?php
                        if ($message->status== '0') {
                            echo 'New';
                        }
                        ?>
                    </td>
                    <td><?php echo $fm->dateFormat($message->created_at); ?></td>
                    <td>
                        <a href="view_message.php?message_id=<?php echo $message->id;?>" 
                        class="btn btn-xs btn-primary btn-block">
                        <i class="fa fa-eye"></i> View</a>

                        <a href="reply_message.php?reply_id=<?php echo $message->id;?>" 
                        class="btn btn-xs btn-success btn-block">
                        <i class="fa fa-envelope"></i> Reply</a>

                        <a href="?seen_id=<?php echo $message->id;?>" 
                        class="btn btn-xs btn-info btn-block" 
                        onclick="return confirm('Do you eant to send this message to archive ?');">
                        <i class="fa fa-book"></i> Seen</a>
                    </td>
                </tr>
                    
                <?php
                }
            } else { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong id= "strong">
                SORRY !!! There is no message to display!</strong>
                </div>
            <?php
            }
        } catch (PDOException $e) {
            echo 'ERROR FOUND :'.$e->getMessage();
        }
    }

    // Seen messages will be pushed to the archived box
    public function seenMessasages($query)
    {
        $fm = new helpers();
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $i = 1;
                while ($message = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $message->firstname; ?></td>
                    <td><?php echo $message->lastname; ?></td>
                    <td><?php echo $message->email; ?></td>
                    <td><?php echo $fm->textShorten($message->message, 120); ?></td>
                    <td>
                    <?php
                    if ($message->status=='1') {
                        echo 'Read';
                    }
                    ?>
                    </td>
                    <td><?php echo $fm->dateFormat($message->created_at); ?></td>
                    <td>
                        <a href="?delete_message_id=<?php echo $message->id;?>" class="btn btn-xs btn-danger btn-block" 
                        onclick="return confirm('Are you sure to delete this seen archived message ?');">
                        <i class="fa fa-trash"></i> Delete</a>

                        <a href="?return_message_id=<?php echo $message->id; ?>" class="btn btn-xs btn-info btn-block" 
                        onclick="return confirm('Are you sure to send back this archived message to unseebn box ?');">
                        <i class="fa fa-trash"></i> Send Back</a>
                    </td>
                </tr>
                    
                <?php
                }
            } else { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong id= "strong">
                SORRY !!! There is no message to display!</strong>
                </div>
            <?php
            }
        } catch (PDOException $e) {
            echo 'ERROR FOUND :'.$e->getMessage();
        }
    }

    // Counts number of messages read
    public function countReadMessages($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->rowCount();
        echo $rows;
    }

    // Counts number of messages received and unread
    public function countReceivedMessages($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $rows = $stmt->rowCount();
        echo $rows;
    }

    // Send seen messages in archived state in the table below the inbox
    public function sendMessagesToArchive($id, $status)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_contact WHERE id = :id");
        $stmt->execute([":id" => $_GET['seen_id']]);
        $stmt->bindparam(":id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_contact SET id = :id, status = 1 WHERE id = :id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":status", $status);
            $data = $stmt->execute();
            if ($data) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong id= "strong">
                SUCCESSFULLY ARCHIVED !!! Message has been sent to archive!</strong>
                </div>
            <?php
            }
        } catch (PDOException $e) {
            echo 'ERROR FOUND !!!'.$e->getMessage();
        }
    }

    // Will send seen messages in archived state in the table below the inbox
    public function returnMessagesToUnseenBox($id, $status)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_contact WHERE id = :id");
        $stmt->execute([":id" => $_GET['return_message_id']]);
        $stmt->bindparam(":id", $id);
        try {
            $stmt = $this->conn->prepare("UPDATE tbl_contact SET id = :id, status = 0 WHERE id = :id");
            $stmt->bindparam(":id", $id);
            $stmt->bindparam(":status", $status);
            $data = $stmt->execute();
            if ($data) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong id= "strong">
                SUCCESSFULLY SENT BACK !!! Message has been sent back to unseen box!</strong>
                </div>
            <?php
            }
        } catch (PDOException $e) {
            echo 'ERROR FOUND !!!'.$e->getMessage();
        }
    }

    // Update view of message
    public function updateViewMessage($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['reply_id']]);
        $stmt->bindparam(":id", $id);
        if ($stmt->rowCount() > 0) {
            while ($message = $stmt->fetch(PDO::FETCH_OBJ)) {?>

               <form method="post">
                <div class="form-group">
                    <label for="firstname">First name</label>
                    <input type="text" class="form-control" name="firstname" 
                    value="<?php echo $message->firstname;?>">
                </div>
                <div class="form-group">
                    <label for="lastname">Last name</label>
                    <input type="text" class="form-control" name="lastname" 
                    value="<?php echo $message->lastname;?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" 
                    class="form-control" id="email" value="
                    <?php echo $message->email;?>">
                </div>
                <div class="form-group">
                    <textarea name="message" id="editor1" class="text-area" cols="79" rows="5">
                    <?php echo $message->message; ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" 
                    class="form-control" id="status" value="
                    <?php echo $message->status;?>" disabled>
                </div>

                <a href="message_index.php" class="btn btn-md btn-success"><i class="fa fa-eye"></i> 
                Message Viewed </a>    
            </form>
            <?php
            }
        }
    }

    // Reply message to a message sender fetched from database
    public function replyMessage($query)
    {
        $fm = new helpers();
        $stmt = $this->conn->prepare($query);
        $stmt->execute([":id" => $_GET['reply_id']]);
        $stmt->bindparam(":id", $id);
        if ($stmt->rowCount() > 0) {
            while ($message = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Message to</label>
                    <input type="email" name="toEmail" 
                    class="form-control" id="email" value="
                    <?php echo $message->email;?>" readonly>
                </div>
                <div class="form-group">
                    <label for="firstname">From</label>
                    <input type="text" class="form-control" name="fromEmail"
                    placeholder="Person sending message....">
                </div>
                <div class="form-group">
                    <label for="lastname">Subject</label>
                    <input type="text" class="form-control" name="subject"
                    placeholder="Enter subject of the message....">
                </div>
                
                <div class="form-group">
                    <textarea name="message" id="editor1" class="text-area" cols="79" rows="5">
                    </textarea>
                </div>

                <button type="submit" class="btn btn-md btn-primary" name="btn-submit">
                    <i class="fa fa-envelope"></i> Send message
                </button>
            </form>
            <?php
            }
        }
    }

    // Delete seen and archived message
    public function deleteSeenMessage($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_contact WHERE id = :id ");
        $stmt->execute([":id" => $_GET['delete_message_id']]);
        $stmt = $this->conn->prepare("DELETE FROM tbl_contact WHERE id = :id ");
        $stmt->bindparam(":id", $id);
        $data = $stmt->execute();
        if ($data) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <strong id= "strong">
                SUCCESSFUL !!! Archived message has been deleted!</strong>
            </div>
        <?php
        }
        return true;
    }
}

<?php

include_once 'class.Database.php';

class importantLink
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    // View data
    public function viewImportantLinksData($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowcount() > 0) {
            while ($importantLinksData = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <h5 class="header-text"><?php echo $importantLinksData->heading; ?></h5>
                <i class="fa fa-phone"></i> <?php echo $importantLinksData->phone; ?><br>
                <i class="fa fa-mobile"></i> <?php echo $importantLinksData->cell_phone; ?><br>
                <i class="fa fa-envelope"></i> <?php echo $importantLinksData->email; ?><br>
                <i class="fa fa-address-book"></i> <?php echo $importantLinksData->address; ?><br>
                <i class="fa fa-address-book"></i> <?php echo $importantLinksData->url; ?><br>
            <?php
            }
        } else { ?>
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
}

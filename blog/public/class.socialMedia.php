<?php

include_once 'class.Database.php';

class socialMedia
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Get social media data
    public function getSocialMediaData($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($data = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <a href="<?php echo $data->social_media_address;?>" target="blank">
                <?php
                if ($data->social_media_address == 'http://www.facebook.com') {
                    echo '<i class="fa fa-facebook"></i>';
                } elseif ($data->social_media_address == 'http://www.twitter.com') {
                    echo '<i class="fa fa-twitter"></i>';
                } elseif ($data->social_media_address == 'http://www.linkedin.com') {
                    echo '<i class="fa fa-linkedin"></i>';
                } elseif ($data->social_media_address == 'http://www.googleplus.com') {
                    echo '<i class="fa fa-google-plus"></i>';
                } elseif ($data->social_media_address == 'http://www.youtube.com') {
                    echo '<i class="fa fa-youtube"></i>';
                } elseif ($data->social_media_address == 'http://www.stackoverflow.com') {
                    echo '<i class="fa fa-stack-overflow"></i>';
                } elseif ($data->social_media_address == 'http://www.github.com') {
                    echo '<i class="fa fa-github"></i>';
                } else {
                }
                ?>
                </a>
            <?php
            }
        }
    }
}

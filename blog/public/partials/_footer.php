<div class="row justify-content-center footer p-3">
    <div class="col-sm-4 footer_links">
        <!-- About us data loaded -->
        <?php
        $db = new aboutUs();
        $stmt = "SELECT * FROM tbl_about_us LIMIT 1";
        $db->blogViewAboutUsText($stmt);
        ?>
        <!-- /About us data loaded -->
    </div>
    <div class="col-sm-4 footer_links">
        <!-- Important links data loaded -->
        <?php
        $db = new ImportantLink;
        $query = "SELECT * FROM tbl_impt_links";
        $db->viewImportantLinksData($query);
        ?> <br>
        <!-- /Important links data loaded -->
        <a href="" class="btn btn-sm btn-primary" style="font-size:14px;">Real all</a>
        <a href="" class="btn btn-sm btn-primary" style="font-size:14px;">Real all</a>
        <a href="" class="btn btn-sm btn-primary" style="font-size:14px;">Real all</a>
        <a href="" class="btn btn-sm btn-primary" style="font-size:14px;">Real all</a>
        <a href="" class="btn btn-sm btn-primary" style="font-size:14px;">Real all</a>
    </div>
    <div class="col-sm-4 footer_links">
        <div class="footer-social-media" style="margin-bottom:15px;">
            <h5>Social media links</h5>
            <!-- Social media data loaded -->
            <?php
            $db = new socialMedia;
            $query = "SELECT * FROM tbl_social_media";
            $db->getSocialMediaData($query);
            ?>
        </div>
        <div class="facebook">
            <a href="https://www.facebook.com/bishwajit.paul.52">
            <img src="images/facebookProfile.jpg" alt="Facebook" class="img-responsive img-fluid img-thumbnail"></a>
        </div>
        <!-- /Social media data loaded -->
    </div>
</div>
<div class="row justify-content-center footer-bottom p-3">
    <!-- Footer text loaded -->
    <?php
    $db = new FrontView;
    $stmt = "SELECT * FROM tbl_copyright LIMIT 1";
    $db->viewCopyright($stmt);
    ?>
    <!-- /Footer text loaded -->
</div>

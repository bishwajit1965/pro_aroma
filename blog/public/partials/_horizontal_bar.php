<div class="row border" style="min-height:40px;background-color:#DDD;
    margin-bottom:20px;">
    <!-- Marquee text scroll-->
    <div class="marquee">
        <?php
        $db = new FrontView;
        $db->marqueeData();
        ?>
    </div>
    <!-- /Marquee text scroll-->
</div>

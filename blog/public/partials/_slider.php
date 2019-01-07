<div class="row" id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:800px;height:456px;overflow:hidden;visibility:hidden;background-color:#24262e;">
    <!-- Loading Screen -->
    <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute;
        display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
        <div style="position:absolute;display:block;
        background:url('../images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
    </div>
    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;
    width:800px;height:356px;overflow:hidden;display:block;">
        <!-- Slider clalled -->
        <?php
        $db = new frontView;
        $query = "SELECT * FROM tbl_slider ORDER BY id DESC LIMIT 12";
        $db->viewSliderImages($query);
        ?>
        <!-- /Slider clalled -->
    </div>

    <!-- Thumbnail Navigator -->
    <div data-u="thumbnavigator" class="jssort01"
    style="position:absolute;left:0px;bottom:0px;width:800px;height:100px; padding-right:10px;" data-autocenter="1">
        <!-- Thumbnail Item Skin Begin -->
        <div data-u="slides" style="cursor: default;">
            <div data-u="prototype" class="p">
                <div class="w">
                    <div data-u="thumbnailtemplate" class="t"></div>
                </div>
                <div class="c"></div>
            </div>
        </div>
        <!-- Thumbnail Item Skin End -->
    </div>
    <!-- Arrow Navigator -->
    <span data-u="arrowleft" class="jssora05l" style="top:158px;left:8px;width:40px;height:40px;"></span>
    <span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;"></span>
    <!-- /Arrow Navigator -->
</div>
<script type="text/javascript">jssor_1_slider_init();</script>
<!-- #endregion Jssor Slider End -->

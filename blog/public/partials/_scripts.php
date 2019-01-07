<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/scrolltop.js"></script>
<script src="bootstrap-4.1.1/dist/js/bootstrap.min.js"></script>
<script src="js/jssor.slider-22.2.9.min.js"></script>
<script src=".././../admin/bower_components/ckeditor/ckeditor.js"></script>
<!-- <script src="bootstrap-4.0.0/js/dist/tooltip.js"></script> -->

<!--CK Editor-->
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<!--/CK Editor-->

<!-- Jquery slide toggle -->
<script>
    $(document).ready(function(){
        $("#flip").click(function(){
            $("#panel").slideToggle("slow");
        });
    });
</script>

<!--Coming soon post -->
<script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2019 15:37:25").getTime();
// var countDownDate = new Date(<?php $db = new FrontViewComingSoon;
//     $query = "SELECT published_at FROM tbl_coming_soon WHERE id = 3 ORDER BY id DESC LIMIT 1";
//     $db->comingSoonPublishedDateView($query);
// ?>).getTime();

// Update the count down every 1 second
var countdownfunction = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now an the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";

    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(countdownfunction);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>
<!--/Coming soon post-->

<!--Accordion -->
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
<!--/Accordion -->



<!--Sticky Nav Bar-->
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
<!--/Sticky Nav Bar-->

<!-- Fade out bootstrap alert messages -->
<script type="text/javascript">

  $(document).ready(function () {

  window.setTimeout(function() {
      $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
          $(this).remove();
      });
  }, 3000);

  });
</script>
<!-- /Fade out bootstrap alert messages -->

<!-- Tooltip-->
<script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<!-- /Tooltip-->

<!doctype html>
<html class="no-js" lang="">
    <?php include_once 'partials/_head.php'; ?>
<body>
  <div class="container-fluid">
    <?php include_once('partials/_header.php'); ?>
    <?php include('partials/_horizontal_bar.php'); ?>
    <div class="row">
      <?php include_once('partials/_left_sidebar.php'); ?>
      <div class="col-sm-8">
        <div class="border" style="min-height:40px;background-color:#DDD;"></div>
        <?php include_once('partials/_slider_panel.php'); ?>
        <!-- Code below -->
        <div class="blog-posts">
          <h2>PORTFOLIO</h2>
            <div id="myBtnContainer p-5">
            <button class="btn active" onclick="filterSelection('all')"> Show all</button>
            <button class="btn" onclick="filterSelection('nature')"> Nature</button>
            <button class="btn" onclick="filterSelection('cars')"> Cars</button>
            <button class="btn" onclick="filterSelection('people')"> People</button>
            </div>
            <!-- Portfolio Gallery Grid -->
            <div class="row p-3">
            <div class="column nature px-2 py-2">
              <div class="content">
              <img src="images/portfolio/mountains.jpg" alt="Mountains" style="width:100%">
              <h4>Mountains</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>
            <div class="column nature px-2 py-2">
              <div class="content">
              <img src="images/portfolio//lights.jpg" alt="Lights" style="width:100%">
              <h4>Lights</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>
            <div class="column nature px-2 py-2">
              <div class="content">
              <img src="images/portfolio//nature.jpg" alt="Nature" style="width:100%">
              <h4>Forest</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>

            <div class="column cars px-2 py-2">
              <div class="content">
              <img src="images/portfolio//cars1.jpg" alt="Car" style="width:100%">
              <h4>Retro</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>
            <div class="column cars px-2 py-2">
              <div class="content">
              <img src="images/portfolio//cars2.jpg" alt="Car" style="width:100%">
              <h4>Fast</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>
            <div class="column cars px-2 py-2">
              <div class="content">
              <img src="images/portfolio//cars3.jpg" alt="Car" style="width:100%">
              <h4>Classic</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>

            <div class="column people px-2 py-2">
              <div class="content">
              <img src="images/portfolio//people1.jpg" alt="People" style="width:100%">
              <h4>Girl</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>
            <div class="column people px-2 py-2">
              <div class="content">
              <img src="images/portfolio//people2.jpg" alt="People" style="width:100%">
              <h4>Man</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>
            <div class="column people px-2 py-2">
              <div class="content">
              <img src="images/portfolio//people3.jpg" alt="People" style="width:100%">
              <h4>Woman</h4>
              <p>Lorem ipsum dolor..</p>
              </div>
            </div>
            <script>
              filterSelection("all") // Execute the function and show all columns
              function filterSelection(c) {
              var x, i;
              x = document.getElementsByClassName("column");
              if (c == "all") c = "";
              // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
              for (i = 0; i < x.length; i++) {
                  w3RemoveClass(x[i], "show");
                  if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
              }
              }

              // Show filtered elements
              function w3AddClass(element, name) {
              var i, arr1, arr2;
              arr1 = element.className.split(" ");
              arr2 = name.split(" ");
              for (i = 0; i < arr2.length; i++) {
                  if (arr1.indexOf(arr2[i]) == -1) {
                  element.className += " " + arr2[i];
                  }
              }
              }

              // Hide elements that are not selected
              function w3RemoveClass(element, name) {
              var i, arr1, arr2;
              arr1 = element.className.split(" ");
              arr2 = name.split(" ");
              for (i = 0; i < arr2.length; i++) {
                  while (arr1.indexOf(arr2[i]) > -1) {
                  arr1.splice(arr1.indexOf(arr2[i]), 1);
                  }
              }
              element.className = arr1.join(" ");
              }

              // Add active class to the current button (highlight it)
              var btnContainer = document.getElementById("myBtnContainer");
              var btns = btnContainer.getElementsByClassName("btn");
              for (var i = 0; i < btns.length; i++) {
              btns[i].addEventListener("click", function(){
                  var current = document.getElementsByClassName("active");
                  current[0].className = current[0].className.replace(" active", "");
                  this.className += " active";
              });
              }
            </script>
            <!-- END GRID -->
            </div>
        </div>
        <!-- Code above -->
      </div>
      <?php include_once('partials/_right_sidebar.php'); ?>
    </div>
    <?php include('partials/_horizontal_bar-bottom.php'); ?>
  <?php include_once('partials/_footer.php'); ?>
  </div>
  <?php include_once('partials/_scripts.php'); ?>
</body>
</html>

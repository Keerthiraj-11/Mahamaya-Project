<?php

if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $ssl = 'https';
}
else {
  $ssl = 'http';
}

$app_url = ($ssl  )
          . "://".$_SERVER['HTTP_HOST']
          . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
          . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
?>

<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!----======== CSS ======== -->

  

  <!----===== Boxicons CSS ===== -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/master/sidebar.css">
  <!--<title>Dashboard Sidebar Menu</title>-->
  <title>Mahamaya Foundation</title>
</head>

  
<body>
  <nav class="sidebar close">
    <header>
      <div class="image-text">
        <span class="image">
          <img src="/master/logo.png" alt="">
        </span>

        <div class="text logo-text">
          <span class="name">MAHAMAYA</span>
          <span class="profession">FOUNDATION</span>
        </div>
      </div>

      <i class='bx bx-chevron-right toggle'></i>
    </header>

    <div class="menu-bar">
      <div class="menu">

        

        <ul class="menu-links" id="menu-links">
          <li class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/master/home/home.php') ? 'active' : ''; ?>" id="dashboard-link">
            <a href="/master/home/home">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Home</span>
            </a>
          </li>

          <li class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/master/cluster/cluster.php') ? 'active' : ''; ?>" id="cluster-link">
            <a href="/master/cluster/cluster" >
              <i class="bi bi-archive icon"></i>
              <span class="text nav-text">Cluster</span>
            </a>
          </li>

          <li class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/master/school/index.php') ? 'active' : ''; ?>" id="schools-link">
            <a href="/master/school/index">
                <i class='bx bxs-school icon'></i>
                <span class="text nav-text">Schools</span>
            </a>
          </li>
          <li class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/master/student/student.php') ? 'active' : ''; ?>" id="students-link">
            <a href="/master/student/student">
              <i class='bx bx-bus-school icon' ></i>
              <span class="text nav-text">Students</span>
            </a>
          </li>

          <li class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/master/admission/admission.php') ? 'active' : ''; ?>" id="admission-link">
            <a href="/master/admission/admission">
              <i class="bi bi-send-plus icon"></i>
              <span class="text nav-text">Admission</span>
            </a>
          </li>

          <li class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/master/puc/student.php') ? 'active' : ''; ?>" id="puc-link">
            <a href="/master/puc/student">
              <i class="bi bi-mortarboard icon"></i>
              <span class="text nav-text">PUC Details</span>
            </a>
          </li>

          <li class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/master/users/user.php') ? 'active' : ''; ?>" id="users-link">
            <a href="/master/users/user">
              <i class="bi bi-person-fill-gear icon"></i>
              <span class="text nav-text">Users</span>
            </a>
          </li>

        </ul>
      </div>

      <div class="bottom-content">
        <li class="">
          <a href="#">
            <i class='bx bx-log-out icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>

        <li class="mode">
          <div class="sun-moon">
            <i class='bx bx-moon icon moon'></i>
            <i class='bx bx-sun icon sun'></i>
          </div>
          <span class="mode-text text">Dark mode</span>

          <div class="toggle-switch">
            <span class="switch"></span>
          </div>
        </li>

      </div>
    </div>

  </nav>

  <section class="home">
    
  </section>
  
  
  <script>
    
    const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");
    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    })
    
    modeSwitch.addEventListener("click", () => {
      body.classList.toggle("dark");
      if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
      } else {
        modeText.innerText = "Dark mode";
      }
    });

</script>

<script>
 document.addEventListener("DOMContentLoaded", function () {
  // Get the container element
  var btnContainer = document.getElementById("menu-links");

  // Get all buttons with class="nav-link" inside the container
  var btns = btnContainer.getElementsByClassName("nav-link");

  // Loop through the buttons and add the click event listener
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function (event) {
      var current = document.getElementsByClassName("active");

      // If there's no active class
      if (current.length > 0) {
        if (current[0] === this) {
          // If the clicked nav-link is already active, refresh the page
          location.reload();
          event.preventDefault(); // Prevent default behavior
        } else {
          // If another nav-link is active, remove the active class
          current[0].classList.remove("active");
        }
      }

      // Add the active class to the current/clicked button
      this.classList.add("active");
    });
  }
});


</script>




  <script src="/master/sidebar.js"></script>
  
  


</body>

</html>
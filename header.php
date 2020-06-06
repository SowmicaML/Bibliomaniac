<?php 
 session_start(); 
?>
<!-- Header -->

<header class="header trans_300">


<!-- Main Navigation -->

<div class="main_nav_container">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-right">
                <div class="logo_container">
                    <a href="index.php">Biblio<span>Maniac</span></a>
                </div>
                <nav class="navbar">
                    <ul class="navbar_menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="categories.php?id=0">Categories</a></li>
                        <li><a href="books.php">Dashboard</a></li>
                        <li><a href="contact.php">contact</a></li>
                    </ul>
                    <ul class="navbar_user">
                        <?php 
                        if(isset($_SESSION['roll_no'])){
                            echo '<li><a onclick="logout()"><i class="fa fa-user" aria-hidden="true"></i></a></li>';
                        }
                        ?>
                    </ul>
                    <div class="hamburger_container">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<script>
  function logout()
  {
      var log=confirm("Are you sure to logout?");
      if(log==true)
      {
          location.href="logout.php";
      }
  }
</script>

</header>

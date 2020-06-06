<?php 
      if(!isset($_SESSION['roll_no'])) : 
      header("Location: signin.php");  
?>

<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(!isset($_SESSION['admin_username'])){
  header("location:login.php");
}

if(isset($_GET['delete']) && $_GET['delete'] != ''){
  $id = $_GET['delete'];
  $de_sql = "DELETE FROM bookings WHERE id='$id'";
  $de_result = mysqli_query($conn, $de_sql);
  
  if($de_result){
    header("location:books.php");
  }else{
    echo "Not deleted";
  }
}

if(isset($_GET['activate']) && $_GET['activate'] != ''){
  $status = $_GET['activate'];
  $id = $_GET['id'];
  $de_sql = "UPDATE bookings SET status='$status' WHERE id='$id'";
  $de_result = mysqli_query($conn, $de_sql);
  
  if($de_result){
    header("location:books.php");
  }else{
    echo "Not deleted";
  }
}

$sql = "SELECT * FROM contact;";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon2.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Contact
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <script>
  function logout()
  {
      var log=confirm("Are you sure to logout ?");
      if(log==true)
      {
          location.href="logout.php";
      }
  }
</script>
</head>

<body class="">
  <div class="wrapper ">
    <?php include('sidebar.php'); ?>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Contact details Page</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" onclick="logout()">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">View Contacted Users</h4>
              </div>
              <div class="card-body">
              <div class="table-responsive" style="overflow:auto;">
                  <table class="table">
                    <thead class=" text-primary">
                        <th style="width:5%;">
                       Id
                      </th>
                      <th style="width:15%;">
                        Name
                      </th>
                      <th style="width:15%;">
                        Email
                      </th>
                      <th style="width:10%;">
                        Message
                      </th>
                     
                     
                    </thead>
                    <tbody>
                    <?php if(!empty($row = $result -> fetch_row())){ 
                        $i=1;
                    do { ?>
               
                      <tr>
                      <td>
                          <?php echo $i; ?>
                        </td>
                        <td>
                          <?php echo $row[1]; ?>
                        </td>
                        <td>
                          <?php echo $row[2]; ?>
                        </td>
                        <td>
                          <?php echo $row[3]; ?>
                        </td>
                                               
                      </tr>
                      <?php $i++; }while ($row = $result -> fetch_row()); }else{ echo "No contacts found"; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <?php include("footer.php");?>
    </div>
  </div>
  <script>
      function confirmm(id)
      {
          var log=confirm("Are you sure to delete ?");
          if(log==true)
          {
              location.href="category.php?delete="+id;
          }
      }
      function confirm_activate(id,status)
      {
          if(status == '1'){
            var log=confirm("Are you sure to activate this book  ?");
          }else{
            var log=confirm("Are you sure to deactivate this book ?");
          }
          if(log==true)
          {
              location.href="books.php?activate="+status+"&id="+id;
          }
      }
  </script>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>

</html>

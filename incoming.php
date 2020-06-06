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

if(!isset($_SESSION['roll_no'])){
  header("location:signin.php");
}

$sql = "SELECT bookings.*,books.image as image FROM bookings INNER JOIN books ON bookings.book_id=books.id;";
$result = mysqli_query($conn, $sql);

if(isset($_GET['check'])){
  $id = $_GET['id'];
  $sql = "UPDATE bookings SET status='approved' WHERE id=".$id;
  $result = mysqli_query($conn, $sql);
  return "true";
}

// print_r($result);exit;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Dashboard 2 by Creative Tim
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
  <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>

<body class="">
  <div class="wrapper ">
    <div class="main-panel">
    <?php include('header.php'); ?>
      <div class="content">
        <div class="row">
        <div class="col-md-3">
          <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title" style="text-align: center;">Menu</h5>
              </div>
              <hr>
              <div class="card-header">
                <a href="books.php"><h5 class="card-title">Add Book</h5></a>
              </div>
              <div class="card-header" style="background-color: #fe4c50;">
              <a href="incoming.php"><h5 class="card-title">My Sales</h5></a>
              </div>
              <div class="card-header">
              <a href="outgoing.php"><h5 class="card-title">My Orders</h5></a>
              </div>
              <div class="card-body">
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Add Book</h5>
              </div>
              <div class="card-body">
              <div class="table-responsive" style="overflow:auto;">
                  <table class="table">
                    <thead class=" text-primary">
                        <th style="width:5%;">
                       Id
                      </th>
                      <th style="width:15%;">
                        Book name
                      </th>
                      <th style="width:15%;">
                        Total price
                      </th>
                      <th style="width:10%;">
                        Sale type
                      </th>
                      <th style="width:10%;">
                        Image
                      </th>
                      <th style="width:10%;">
                        Status
                      </th>
                      <th style="width:10%;">
                        Action
                      </th>
                    </thead>
                    <tbody>
                    <?php if(!empty($row = $result -> fetch_row())){ 
                        $i=1;
                    do {
                      if($row[6] == 1){
                        $type = "Sale";
                      }elseif ($row[6] == 2) {
                          $type = "Rent";
                      }else{
                          $type = "Donate"; 
                      }  ?>
                      <tr>
                      <td>
                          <?php echo $i; ?>
                        </td>
                        <td>
                          <?php echo $row[12]; ?>
                        </td>
                        <td>
                          <?php echo 'INR '.$row[5]; ?>
                        </td>
                        <td>
                          <?php echo $type; ?>
                        </td>
                        <td>
                        <img src="<?php echo "uploads/".$row[14]; ?>" style="width: 35%;">
                        </td>
                        <td>
                            <?php echo ucfirst($row[13]); ?>
                        </td>
                        <td>
                          <?php if($row[13] == "booked"){ ?>
                            <a onclick="approve('<?php echo $row[0]; ?>')">Approve ?</a>
                          <?php }else if($row[13] == "approved"){ ?>
                            <a>Yet to deliver</a>
                          <?php }else{ ?>
                            <a onclick="confirm_activate('<?php echo $row[0]; ?>','1')">Delivered</a>
                          <?php } ?>
                        </td>
                       
                      </tr>
                      <?php $i++; }while ($row = $result -> fetch_row()); }else{ echo "No sales found"; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <div class="row">
				<div class="col-lg-12">
					<div class="footer_nav_container">
						<div class="cr"> Template made with <i class="fa fa-heart-o" aria-hidden="true"></i> <a href="#">By girls</a></div>
					</div>
				</div>
			</div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script>
      function approve(id)
      {
          var log=confirm("Are you sure to approve this order ?");
          if(log==true)
          {
            $.ajax({
              type: "GET",
              url: 'http://localhost/biblio/incoming.php?check=1&id='+id,
              success: function(data){
                if(data != "true"){
                  location.href="http://localhost/biblio/incoming.php";
                }else{
                  location.href="http://localhost/biblio/incoming.php";
                }
              }
            })
          }
      }
  </script>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
</body>

</html>

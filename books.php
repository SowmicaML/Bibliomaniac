<?php
session_start();
//print_r($_SESSION['roll_no']);
//exit;

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

$sql = "SELECT * FROM category";
$result1 = mysqli_query($conn, $sql);

if(isset($_POST['addbooks'])){
    $bookname = $_POST['bookname'];
    $authorname = $_POST['authorname'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $period='';
    $price = '';
    if(isset($_POST['price']) && $_POST['price'] != ''){
      $price = $_POST['price'];
    }
    $quantity = '';
    if(isset($_POST['quantity']) && $_POST['quantity'] != ''){
    $quantity = $_POST['quantity'];
    }
    $startdate ='';
    if(isset($_POST['startdate']) && $_POST['startdate'] != ''){
    $startdate = $_POST['startdate'];
    }
    $enddate ='';
    if(isset($_POST['enddate']) && $_POST['enddate'] != ''){
    $enddate = $_POST['enddate'];
    }
    $aboutbook=$_POST['aboutbook'];
    $user_id = $_SESSION['roll_no'];


    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
$image = $_FILES["fileToUpload"]["name"];
$begin = new DateTime($startdate);
$end = new DateTime($enddate);
$end = $end->modify( '+1 day' );

$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);
$i=0;
foreach($daterange as $date){
    $i++;
}

    $insert_query = "INSERT INTO books (user_id,book_name,description,author,category,sale_type,price,availability,quantity,post_date,period,start_date,end_date,image) VALUES('$user_id','$bookname','$aboutbook','$authorname','$category','$type','$price','1','$quantity',now(),'$i','$startdate','$enddate','$image')";
    $result = mysqli_query($conn, $insert_query);

    if($result){
      echo "inserted";
    }else{
      echo("Error description: " . $insert_query);
    } 

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
     Dashboard
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
              <div class="card-header" style="background-color: #fe4c50;">
                <a href="books.php"><h5 class="card-title">Add Book</h5></a>
              </div>
              <div class="card-header">
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
              <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" >
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Book/Material name</label>
                        <input type="text" class="form-control" name="bookname" placeholder="Enter book name" value="" required>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Author Name</label>
                        <input type="text" class="form-control" placeholder="Enter author Name" name="authorname" value="" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Book</label>
                        <textarea class="form-control textarea" name="aboutbook" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category" style="height: auto;" required>
                        <?php if(!empty($row = $result1 -> fetch_row())){ 
                        do { ?>
                          <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                        <?php }while($row = $result1 -> fetch_row()); } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type" style="height: auto;" onchange="saletype(this.value)" required>
                          <option value="1">Sale</option>
                          <option value="2">Rent</option>
                          <option value="3" selected>Donate</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Upload Book Image</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
                      </div>
                    </div>
                    </div> 
                  <div class="row" id="row1" style="display:none;">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Enter price" value="" >
                      </div>
                    </div>
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" class="form-control" placeholder="Enter quantity" name="quantity" value="" >
                      </div>
                    </div>
                  </div>
                  <div class="row" id="row2" style="display:none;">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Start date</label>
                        <input type="date" class="form-control" name="startdate" placeholder="Enter start date" value="" >
                      </div>
                    </div>
                    <div class="col-md-6 pl-1 pr-1">
                      <div class="form-group">
                        <label>End date</label>
                        <input type="date" class="form-control" placeholder="Enter end date" name="enddate" value="">
                      </div>
                    </div>
                  </div>
                
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round" name="addbooks">Add Book</button>
                    </div>
                  </div>
                </form>
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
    function saletype(type)
    {
      if(type==1)
      {
        document.getElementById("row1").style.display="flex";
        document.getElementById("row2").style.display="none";
      }
      if(type==2)
      {
        document.getElementById("row2").style.display="flex";
        document.getElementById("row1").style.display="none";
      }
      if(type==3)
      {
        document.getElementById("row2").style.display="none";
        document.getElementById("row1").style.display="none";
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

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

//Fetching datas from book table
if(isset($_GET['id']) && $_GET['id'] != ''){
		$id = $_GET['id'];
		$sql = "SELECT * FROM books WHERE id=".$id." LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$book = $result->fetch_row();
}
if(isset($_POST["submit"])) {
    $qua="";
    if(isset($_POST['qua']) && $_POST['qua'] != ""){
        $qua = $_POST['qua'];
    }
    
    $uid=$_SESSION['roll_no'];
    $bid=$_POST['bid'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $total = $_POST['total'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    if($type == 1){
        $price = $_POST['price'];
    }else if($type == 3){
        $price = 0;
        $qua = 1;
    }else{
        $price = 0;
        $qua = 1;
        $start_date="";
        if(isset($_POST['start_date']) && $_POST['start_date'] != ""){
            $start_date = $_POST['start_date'];
        }
        $end_date="";
        if(isset($_POST['end_date']) && $_POST['end_date'] != ""){
            $end_date = $_POST['end_date'];
        }
	}
	
    $id = $_POST['bid'];
	$sql = "SELECT * FROM books WHERE id=".$id." LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$book = $result->fetch_row();

    $insert_query = "INSERT INTO bookings (book_id, user_id, quantity, price, total, type, date, start_date, end_date, address, phone, name) VALUES('$bid','$uid','$qua','$price','$total','$type',now(),'$start_date','$end_date','$address','$mobile','$name')";
	$result = mysqli_query($conn, $insert_query);
	
	$update_query = "UPDATE books SET quantity=$book[9]-1 WHERE id=".$id;
    $result1 = mysqli_query($conn, $update_query);

    if($result){
      echo "inserted";
      header("location:categories.php?id=0");
    }else{
      echo("Error description: " . $insert_query);
    } 
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Single Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
<link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="styles/single_responsive.css">
</head>

<body>

<div class="super_container">

    <?php include('header.php'); ?>
	<div class="fs_menu_overlay"></div>

	<div class="container single_product_container">
		<div class="row">
			<div class="col">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="index.php">Home</a></li>
                        <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo 
                        "Checkout"; ?></a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-4">
				<div class="single_product_pics">
					<div class="row">
						<div class="col-lg-12 thumbnails_col order-lg-1 order-2">
							<div class="single_product_thumbnails">
								<ul>
									<li><img src="<?php echo 'uploads/'.$book[14]; ?>" alt="" data-image="images/single_1.jpg" style="width:80%!important"></li>
								</ul>
							</div>
						</div>
						<!-- <div class="col-lg-9 image_col order-lg-2 order-1">
							<div class="single_product_image">
								<div class="single_product_image_background" style="background-image:url(<?php //echo 'uploads/'.$book[14]; ?>)"></div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="product_details">
                <div class="free_delivery d-flex flex-row align-items-center justify-content-center">
                    <?php if($book[6] == 1){ ?>
                        <span>Cash on delivery</span>
                    <?php }else if($book[6] == 2){ ?>
                        <span>Rent from <?php echo date('d/m/Y',strtotime($book[12])); ?> to <?php echo date('d/m/Y',strtotime($book[13])); ?></span>
                    <?php }else{ ?>
                        <span>Free of cost</span>
                    <?php } ?>  
					</div><br>
					<div class="product_details_title">
						<h2><?php echo $book[2]; ?></h2>
                        <?php if($book[6] == 1){ ?>
                            <p style="font-size: larger;">Quantity : <?php echo $_GET['qua']; ?></p>
                            <p style="font-size: larger;">Price : INR <?php echo $book[7]; ?></p>
                            <p style="font-size: larger;font-weight: 600;">Total price : INR <?php echo $book[7]*$_GET['qua']; ?></p>
                        <?php }else if($book[6] == 2){ ?>
                        <?php } ?>
					</div><br>

                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <label>Enter Mobile Number : </label>
                                    <input type="text" class="form-control" name="mobile" placeholder="Enter Mobile/Phone number" value="" required>
                                </div>
                                <div class="form-group">
                                    <label>Enter Address/Landmark : </label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter Address/Landmark" value="" required>
                                    <input type="hidden" name="total" value="<?php echo $book[7]*$_GET['qua']; ?>">
                                    <input type="hidden" name="bid" value="<?php echo $_GET['id']; ?>">
                                    <input type="hidden" name="qua" value="<?php echo $_GET['qua']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $book[2]; ?>">
                                    <input type="hidden" name="price" value="<?php echo $book[7]; ?>">
                                    <input type="hidden" name="type" value="<?php echo $book[6]; ?>">
                                    <input type="hidden" name="start_date" value="<?php echo $book[12]; ?>">
                                    <input type="hidden" name="end_date" value="<?php echo $book[13]; ?>">
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round" name="submit">Buy Now</button>
                            </div>
                        </div>
                    </form>
              
					
					<!-- <?php //if($book[6] == 1){ ?>
						<div class="product_price">$ <?php //echo $book[7]; ?></div>
					<?php //}else if($book[6] == 2){ ?>
						<div class="product_price"> Rent from <?php //echo date('d/m/Y',strtotime($book[12])); ?> to <?php //echo date('d/m/Y',strtotime($book[13])); ?></div>
					<?php //}else{ ?>
						<div class="product_price">Free of cost</div>
					<?php //} ?> -->
					<!-- <ul class="star_rating">
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
					</ul> -->

					</div>
			</div>
		</div>

	</div>

	<?php include("news.php"); ?>
	<?php include("Footer.php"); ?>
	

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="js/single_custom.js"></script>
</body>
<script>
function checkquantity(id){
	var type = <?php echo $book[6]; ?>;
	if(type == 1){
		var qua=document.getElementById("quantity_value").innerHTML;
		$.ajax({
			type: "GET",
			url: 'http://localhost/biblio/bookview.php?check=1&id='+id+'&qua='+qua,
			success: function(data){
				if(data != "true"){
					alert(data);
				}else{
					location.href="http://localhost/biblio/buynow.php?id="+id+'&qua='+qua;
				}
			}
		})
	}
}
</script>
</html>

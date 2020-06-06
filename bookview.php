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

$uid=$_SESSION['roll_no'];

//Fetching datas from book table
if(!isset($_GET['check'])){
	if(isset($_GET['id']) && $_GET['id'] != ''){
		$id = $_GET['id'];
		$sql = "SELECT * FROM books WHERE id=".$id." LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$book = $result->fetch_row();
	}
}else if(isset($_GET['check']) && $_GET['check']==1){
	if(isset($_GET['qua']) && $_GET['qua'] != ''){
		$id = $_GET['id'];
		$qua = $_GET['qua'];
		$sql = "SELECT * FROM books WHERE id=".$id." LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$book = $result->fetch_row();
		if($qua > $book[9]){
			echo "Only ".$book[9]." book(s) available";exit;
		}else{
			echo "true";exit;
		}
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
						<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo $book[2]; ?></a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-7">
				<div class="single_product_pics">
					<div class="row">
						<div class="col-lg-3 thumbnails_col order-lg-1 order-2">
							<div class="single_product_thumbnails">
								<ul>
									<li><img src="<?php echo 'uploads/'.$book[14]; ?>" alt="" data-image="images/single_1.jpg"></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-9 image_col order-lg-2 order-1">
							<div class="single_product_image">
								<div class="single_product_image_background" style="background-image:url(<?php echo 'uploads/'.$book[14]; ?>)"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="product_details">
					<div class="product_details_title">
						<h2><?php echo $book[2]; ?></h2>
						<p><?php echo $book[3]; ?></p>
					</div>
					<div class="free_delivery d-flex flex-row align-items-center justify-content-center">
						<span>free delivery</span>
					</div><br>
					<?php if($book[6] == 1){ ?>
						<div class="product_price">INR
							<?php echo $book[7]; ?></div><br>
						
					<?php }else if($book[6] == 2){ ?>
						<div class="product_price"> Rent from <?php echo date('d/m/Y',strtotime($book[12])); ?> to <?php echo date('d/m/Y',strtotime($book[13])); ?></div>
					<?php }else{ ?>
						<div class="product_price">Free of cost</div>
					<?php } ?>
					<!-- <ul class="star_rating">
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star" aria-hidden="true"></i></li>
						<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
					</ul> -->

					<div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
						<?php if($book[6] == 1){ ?>
						<span>Quantity:</span>
						<div class="quantity_selector">
							<span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
							<span id="quantity_value">1</span>
							<span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
						</div>
					<?php } ?>
						<?php if($uid != $book[1]){ ?>
							<div class="red_button add_to_cart_button">
								<a onclick="checkquantity(<?php echo $id; ?>)">Get Now</a></div>
						<?php } ?>
						<!-- <div class="product_favorite d-flex flex-column align-items-center justify-content-center"></div> -->
					</div><br>
					<?php if($book[6] == 1){ ?>
						<div class="d-flex flex-row">
						<?php if($book[9] != 0){ ?>
							<span>Only <?php echo $book[9]; ?> book's left</span>
						<?php }else{ ?>
							<span>Out of stock</span>
						<?php } ?>
					</div><br>
					<?php } ?>
				</div>
			</div>
		</div>

	</div>

	 
	<!-- Benefit -->

	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>free shipping</h6>
							<p>Suffered Alteration in Some Form</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>cach on delivery</h6>
							<p>The Internet Tend To Repeat</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>45 days return</h6>
							<p>Making it Look Like Readable</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>opening all week</h6>
							<p>8AM - 09PM</p>
						</div>
					</div>
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
	}else if(type == 3){
		location.href="http://localhost/biblio/buynow.php?id="+id;
	}
	else if(type == 2){
		location.href="http://localhost/biblio/buynow.php?id="+id;
	}
}
</script>
</html>

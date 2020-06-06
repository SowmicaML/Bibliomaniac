<?php 

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
    if($_GET['id'] == 0){
		$sql = "SELECT * FROM books";
	}else{
		$cat_id = $_GET['id'];
		$sql = "SELECT * FROM category WHERE id=".$cat_id." LIMIT 1";
		$result = mysqli_query($conn, $sql);
		$category = $result->fetch_row();
		$sql = "SELECT * FROM books WHERE category=".$cat_id." AND status='1'";
	}
    $result = mysqli_query($conn, $sql);
}

$catt_sql = "SELECT * FROM category";
$catt_result = mysqli_query($conn, $catt_sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Book Categories</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="styles/categories_styles.css">
<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
</head>

<body>

<div class="super_container">
    <?php include('header.php'); ?>
	<div class="fs_menu_overlay"></div>

	
	<div class="container product_section_container" style="margin-top: 120px;">
		<div class="row">
			<div class="col product_section clearfix">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="active"><a href="index.html"><i class="fa fa-angle-right" aria-hidden="true"></i><?php if(isset($_GET['id']) && $_GET['id'] == 0){ echo "All"; }else{ echo $category[1]; } ?></a></li>
					</ul>
				</div>

				<!-- Sidebar -->

				<div class="sidebar">
					<div class="sidebar_section">
						<div class="sidebar_title">
							<h5>Books Category</h5>
						</div>
						<ul class="sidebar_categories">
							<li class="<?php if(isset($_GET['id']) && $_GET['id'] == 0){ echo "active"; } ?>"><a href="categories.php?id=0"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>All</a></li>
                            <?php if(!empty($roww = $catt_result -> fetch_row())){ 
                            do {
								$style="";
								if(isset($_GET['id']) && $_GET['id'] == 0){ }else{  
                                if($roww[1] == $category[1]){ $style="active"; }else{ echo ""; } } ?>
                                <li class="<?php echo $style; ?>"><a href="categories.php?id=<?php echo $roww[0]; ?>"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span><?php echo $roww[1]; ?></a></li>
                            <?php }while ($roww = $catt_result -> fetch_row()); } ?>	
						</ul>
					</div>

					<!-- Price Range Filtering -->
					<div class="sidebar_section">
						<div class="sidebar_title">
							<h5>Filter by Price</h5>
						</div>
						<p>
							<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
						</p>
						<div id="slider-range"></div>
						<div class="filter_button"><span>filter</span></div>
					</div>

				</div>

				<!-- Main Content -->

				<div class="main_content">

					<!-- Products -->

					<div class="products_iso">
						<div class="row">
							<div class="col">

								<!-- Product Sorting -->

								<div class="product_sorting_container product_sorting_container_top">
									<ul class="product_sorting">
										<li>
											<span class="type_sorting_text">Default Sorting</span>
											<i class="fa fa-angle-down"></i>
											<ul class="sorting_type">
												<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default Sorting</span></li>
												<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
												<li class="type_sorting_btn" data-isotope-option='{ "sortBy": "name" }'><span>Product Name</span></li>
											</ul>
										</li>
										<li>
											<span>Show</span>
											<span class="num_sorting_text">6</span>
											<i class="fa fa-angle-down"></i>
											<ul class="sorting_num">
												<li class="num_sorting_btn"><span>6</span></li>
												<li class="num_sorting_btn"><span>12</span></li>
												<li class="num_sorting_btn"><span>24</span></li>
											</ul>
										</li>
									</ul>
									
								</div>

								<!-- Product Grid -->

								<div class="product-grid">

									<!-- Product 1 -->

									<?php if(!empty($row = $result -> fetch_row())){ 
                                    do { ?>
                                    <?php 
                                        if($row[6] == 1){
                                            $type = "Sale";
                                            $style = "product_bubble_right product_bubble_red";
                                        }elseif ($row[6] == 2) {
                                            $type = "Rent";
                                            $style = "product_bubble_rightt product_bubble_red";
                                        }else{
                                            $type = "Donate"; 
                                            $style = "product_bubble_left product_bubble_green";
                                        } 
                                        $cat = "SELECT * FROM category WHERE id=".$row[5]." LIMIT 1";
                                        $catresult = mysqli_query($conn, $cat);
                                        $category=$catresult->fetch_row();
                                    ?>
                                    <div class="product-item <?php echo $category[1]; ?>">
                                        <div class="product discount product_filter">
                                        <div class="product_image">
                                            <img src="<?php echo 'uploads/'.$row[14]; ?>" alt="" style="max-height: 235px;">
                                        </div>
                                        <div class="favorite favorite_left"></div>
                                        <div class="product_bubble <?php echo $style; ?> d-flex flex-column align-items-center"><span>
                                        <?php echo $type; ?>
                                        </span></div>
                                        <div class="product_info">
                                            <h6 class="product_name"><a href="bookview.php?id=<?php echo $row[0]; ?>"><?php echo $row[2]; ?></a></h6>
                                            <div class="product_price"><?php if($row[6] == 1){ echo 'INR '.$row[7]; }elseif ($row[6] == 2) {
                                            echo "No of days : ",$row[11];
                                        }else{ echo "Free"; } ?></div>
                                        </div>
										</div>
										<?php if($row[9] != 0){ ?>
											<div class="red_button add_to_cart_button"><a href="bookview.php?id=<?php echo $row[0]; ?>">Buy Now</a></div>
										<?php }else{ ?>
											<div class="red_button add_to_cart_button"><a href="#">Out of stock</a></div>
										<?php } ?>
                                    </div>

                                <?php }while ($row = $result -> fetch_row()); }else{ echo "No books found"; } ?>
					

									
								</div>

								
							</div>
						</div>
					</div>
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

	<!-- Newsletter -->

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
<script src="js/categories_custom.js"></script>
</body>

</html>

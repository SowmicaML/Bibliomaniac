<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio";

// 
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_SESSION['admin_username'])){
header("location:dashboard.php");
}
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $enc_password = md5($password);

    $user_check_query = "SELECT * FROM user WHERE username='$username' AND password='$enc_password' AND type='admin' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if (count($user) != 0) {
        $_SESSION['admin_username'] = $user['username'];
        echo "Logged in";
        header('location: dashboard.php');
  	}else {
  		echo "Wrong username/password combination";
  	}

}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>BiblioManiac login</title>
        <link rel="stylesheet" href="../styles/style.css">
        </head>
        <body>
            <div class="main-container loginpage">
                <div class="login-bg">
                </div>
                        <div class="login-form">
                            <div class="app-logo">
                                  <img class="img" src="../images/bibliologo.png">
                            </div>
                                 <h2>SIGN IN</h2>
                                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" >
                                        <div class="form-field">
                                            <input type="text" name="username" placeholder=" Enter username" required/>
                                        </div>
                                        <div class="form-field">
                                            <input type="password" name="password" placeholder="Enter password" required/> 
                                        </div>
                                        <div class="form-field">
                                            <button class="app-button" name="login" type="submit">LOGIN</button>
                                        </div>
                                        <div>
                                        </div>
                    
                                     </form>
                    </div>
             </div>
                    
        </body>
</html>
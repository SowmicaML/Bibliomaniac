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

if (isset($_POST['reg_user'])) {
    $rollno = $_POST['roll_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_check_query = "SELECT * FROM user WHERE roll_no='$rollno' AND type='user' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user){
        echo "roll number already exist";
    }else{
        //echo "inserted";
        $enc_password = md5($password);
        $insert_query = "INSERT INTO user (roll_no, username, password, created_date) VALUES('$rollno','$username','$enc_password',now())";
        $result = mysqli_query($conn, $insert_query);
        echo "inserted";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Foodie login</title>
        <link rel="stylesheet" href="styles/style.css">
        </head>
        <body>
            <div class="main-container loginpage">
                <div class="login-bg">
                </div>
                        <div class="login-form">
                            <div class="app-logo">
                                  <img class="img" src="images/bibliologo.png">
                            </div>
                                 <h2>SIGN UP</h2>
                                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" onsubmit="return validate()">
                                        <div class="form-field">
                                            <input type="text" name="roll_no" placeholder="Enter roll number" required/>
                                        </div>
                                        <div class="form-field">
                                            <input type="text" name="username" placeholder="Enter username" required/>
                                        </div>
                                        <div class="form-field">
                                                  <input type="password" name="password" id="password" placeholder="Enter password" required/> 
                                        </div>
                                        <div class="form-field">
                                            <input type="password" name="con_password" id="con_password" placeholder="confirm password" required/> 
                                        </div>
                                        <div class="form-field">
                                            <button class="app-button" type="submit" name="reg_user">Register</button>
                                        </div>
                                        <div><br>
                                        <span class="forget-password">Already a member?</span>
                                        <a class="link" href="signin.php">click here</a>
                                        </div>
                    
                                     </form>
                    </div>
             </div>
             <script type="text/javascript">
                function validate() {
                    var password = document.getElementById("password").value;
                    var confirmPassword = document.getElementById("con_password").value;
                    if (password != confirmPassword) {
                        alert("Passwords do not match.");
                        return false;
                    }
                    return true;
                }
            </script>           
        </body>
        
</html>
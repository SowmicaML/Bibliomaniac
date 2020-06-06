<?php 
require_once("class.phpmailer.php");
require_once("class.smtp.php");

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
if(isset($_POST["submit"])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    $insert_query = "INSERT INTO contact (name, email, message) VALUES('$name','$email','$message')";
    $result = mysqli_query($conn, $insert_query);

    if($result){
      echo "inserted";
      

    if($email != ""){
        $mail = new PHPMailer();
        $mail->IsSMTP();    
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure="ssl";
        $mail->Host     = "smtp.gmail.com"; 
        $mail->Port   = 465;
        $mail->Username = "bibliomaniac.vcet@gmail.com"; // Need to config with SM tecnologies Mail id
        $mail->Password = "Biblio123";// Need to config with SM tecnologies Mail password
        $mail->addAddress($email); //To address
        $mail->From     = "bibliomaniac.vcet@gmail.com";
        $mail->FromName = "Biblio Maniac";
        $mail->Subject  = "Thanks for contacting us.";  
        $mail->IsHTML(true); 
        $mail->Body  = "<html>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Welcome to Biblio Maniac</title>
        </head>

        <body>

        Your request has been received. We will reply you within 7 days. Thanks.

        </body>
        </html>"; 
        $mail->Send();
    }

        $maill = new PHPMailer();
        $maill->IsSMTP();    
        $maill->SMTPDebug = 1;
        $maill->SMTPAuth = true;
        $maill->SMTPSecure="ssl";
        $maill->Host     = "smtp.gmail.com"; 
        $maill->Port   = 465;
        $maill->Username = "bibliomaniac.vcet@gmail.com"; // Need to config with SM tecnologies Mail id
        $maill->Password = "biblio123";// Need to config with SM tecnologies Mail password
        $maill->addAddress("bibliomaniac.vcet@gmail.com"); //To address
        if($email == ''){
            $maill->From     = "bibliomaniac.vcet@gmail.com";
        }else{
            $maill->From     = $email;
        }
        $maill->FromName = "New request from ".$_POST["name"];
        $maill->Subject  = "Customer request";  
        $maill->IsHTML(true); 
        $maill->Body  = "<html>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Newsletter</title>
        </head>

        <body>

        Name : ".$name."<br>
        Email : ".$email."<br>
        Message : ".$message."<br>

        </body>
        </html>"; 
        if($maill->Send()){
            return 1;
        }else
        {
            return 0;
        }

      header("location:contact.php");
    }else{
      echo("Error description: " . $insert_query);
    } 
}


if(isset($_POST["newsletter_submit"])) {

    $email = $_POST['newsletter_email'];

    $insert_queryy = "INSERT INTO newsletter ( email) VALUES('$email')";
    $resultt = mysqli_query($conn, $insert_queryy);

    if($resultt){
      echo "inserted";
      

    if($email != ""){
        $mail = new PHPMailer();
        $mail->IsSMTP();    
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure="ssl";
        $mail->Host     = "smtp.gmail.com"; 
        $mail->Port   = 465;
        $mail->Username = "bibliomaniac.vcet@gmail.com"; // Need to config with SM tecnologies Mail id
        $mail->Password = "Biblio123";// Need to config with SM tecnologies Mail password
        $mail->addAddress($email); //To address
        $mail->From     = "bibliomaniac.vcet@gmail.com";
        $mail->FromName = "Biblio Maniac";
        $mail->Subject  = "Thanks for contacting us.";  
        $mail->IsHTML(true); 
        $mail->Body  = "<html>
        <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>Welcome to Biblio Maniac</title>
        </head>

        <body>

        Thanks for subscribing for newsletter. We will notify you.

        </body>
        </html>"; 
        $mail->Send();
    }

       
      header("location:contact.php");
    }else{
      echo("Error description: " . $insert_queryy);
    } 
}
  ?>
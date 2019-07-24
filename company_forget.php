<?php
      session_start();
      $servername='localhost';
      $username='root';
      $password='swapnil159';
      $dbname='campus_recruitment';

      $conn=mysqli_connect($servername,$username,$password,$dbname);

      ini_set('display_errors',1);
      error_reporting(E_ALL);
      if(!$conn)
      {
        die("Connection Failed: ".mysqli_connect_error());
      }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>FORGOT PASSWORD</title>
  </head>
  <body>
    <main>
      <form method="post">
        <table>
          <thead>
            <tr>
              <td colspan="3">Enter the registered E-mail</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>E-mail:</td>
              <td colspan="2"><input type="email" name="email" placeholder="Enter the registered E-mail"></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3"><input type="submit" name="submit_button" value="SUBMIT"></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </main>
  </body>
</html>


<?php
  require_once('PHPMailer/PHPMailerAutoload.php');
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
  $mail->Username = 'campusrecruitmenthbtu@gmail.com';
  $mail->Password = 'localhost1590';
  $mail->setFrom('HBTUPlacementCell@gmail.com');
  if(isset($_POST['submit_button']))
  {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $query = "SELECT Username FROM company_registration WHERE Email='$email'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0)
    {
        $user = mysqli_fetch_assoc($result);
        $name = $user['Username'];
        $math = mt_rand(100000,999999);
        $query = "UPDATE company_registration SET pass_change=$math WHERE Username='$name'";
        $result = mysqli_query($conn,$query);

        $mail->Subject = 'Password Change';
        $mail->Body = 'Your OTP for changing password is '.$math;
        $mail->addAddress($email);

        $mail->send();
        $_SESSION['Username']=$name;
        header('location:company_otp.php');
    }
    else
    {
        echo "<script>";
        echo "alert('Please enter a valid email address')";
        echo "</script>";
    }
  }
?>

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
      if(!$_SESSION['Username'])
      {
        header('location: company_login.php');
      }
      $name = $_SESSION['Username'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title>OTP</title>
    <script>
      function check_form(form)
      {
        var pass = form.pass.value;
        var cpass = form.cpass.value;
        if(pass!=cpass)
        {
          alert('Passwords do not match');
          form.cpass.focus();
          return false;
        }
        return true;
      }
    </script>
  </head>
  <body>
    <main>
      <form method="post"  onsubmit="return check_form(this);">
        <table>
          <thead>
            <tr>
              <th colspan="3">Enter the OTP</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>OTP:</td>
              <td><input type="number" name="otp" size="30" placeholder="Enter the OTP" required></td>
            </tr>
            <tr>
              <td>New Password:</td>
              <td colspan="2"><input type="password" name="pass" size="30" placeholder="Enter New Password" required></td>
            </tr>
            <tr>
              <td>Confirm Password:</td>
              <td colspan="2"><input type="password" name="cpass" size="30" placeholder="Confirm New Password" required></td>
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
  if(isset($_POST['submit_button']))
  {
    $otp = $_POST['otp'];
    $pass = $_POST['pass'];
    $query = "SELECT pass_change FROM company_registration WHERE Username='$name'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    if($row['pass_change']===$otp)
    {
        $query = "UPDATE company_registration SET Password='$pass' WHERE Username='$name'";
        $result = mysqli_query($conn,$query);
        if($result)
        {
          echo "<script>";
          echo "alert('Your password has been changed')";
          echo "</script>";
          header('location:log_out.php');
        }
    }
    else
    {
      echo "<script>";
      echo "alert('Please enter a valid email address')";
      echo "</script>";
    }
  }
?>

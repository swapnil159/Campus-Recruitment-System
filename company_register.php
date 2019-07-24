<?php
    $servername='localhost';
    $username='root';
    $password='swapnil159';
    $dbname='campus_recruitment';

    $conn=mysqli_connect($servername,$username,$password,$dbname);

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    if(!$conn)
    {
      die("Connection failed: " . mysqli_connect_error());
    }
?>
<!Doctype html>
<html>
  <head>
    <title>Company Registration</title>
    <style type="text/css">
      html{
        background: url('back1.jpeg') no-repeat center center fixed;
        background-size: cover;
        width: 100%;
      }
      body{
        text-align: center;
        width: 100%;
        height: 100%;
      }
      table{
        margin-left: auto;
        margin-right: auto;
        text-align: left;
        border-style: double;
      }
    </style>
    <script type="text/javascript">
      function check_form(form)
      {
        var pass=form.pass.value;
        var cpass=form.cpass.value;
        if(pass!=cpass)
        {
          alert("Passwords did not match");
          form.cpass.focus();
          return false;
        }
        return true;
      }
    </script>
  </head>
  <body>
    <div>
      <h1 align="center" style="margin-top: 50pt;">REGISTER</h1>
      <div>
        <form method="post" onsubmit="return check_form(this);">
        <table cellspacing="40">
          <div>
            <tr>
              <td><b>NAME:</b></td>
              <td><input id="name" name="name" value="" type="text" size="30" placeholder="Enter Comapny name" required></td>
            </tr>
          </div>
          <div>
            <tr>
              <td><b>LOCATION:</b></td>
              <td><input id="location" name="loc" value="" type="text" size="30" placeholder="Enter Company location" required></td>
            </tr>
          </div>
          <div>
            <tr>
              <td><b>E-MAIL:</b></td>
              <td><input id="e-mail" name="email" value="" type="email" size="30" placeholder="Enter E-mail" required></td>
            </tr>
          </div>
          <div>
            <tr>
              <td><b>USERNAME:</b></td>
              <td><input id="user" name="username" value="" type="text" size="30" placeholder="Enter your username" required></td>
            </tr>
          </div>
          <div>
            <tr>
              <td><b>PASSWORD:</b></td>
              <td><input id="pass" name="pass" value="" type="password" size="30" placeholder="Enter your password" required></td>
            </tr>
          </div>
          <div>
            <tr>
              <td><b>CONFIRM PASSWORD:</b></td>
              <td><input id="passc" name="cpass" value="" type="password" size="30" placeholder="Confirm Password" required></td>
            </tr>
          </div>
          <div>
            <tr>
              <td colspan="2" align="center"><input type="submit" name="submit_button" id="submit" value="SUBMIT"></td>
            </tr>
          </div>
        </table>
      </form>
      </div>
    </div>
  </body>
</html>
<?php
    if(isset($_POST['submit_button']))
    {
      $name=$_POST['name'];
      $location=$_POST['loc'];
      $email=$_POST['email'];
      $username=$_POST['username'];
      $password=$_POST['pass'];

      $sql="INSERT INTO company_registration(Name,Location,Email,Username,Password) VALUES('$name','$location','$email','$username','$password')";

      if($conn->query($sql) === TRUE)
      {
        echo "<script>
              alert('You have successfully registered');
              location='company_login.php';
              </script>";
      }
      else
      {
        echo "<script>
              alert('Some error occured. Try Again');
              </script>";
      }
  }
  ?>

<?php
  session_start();
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
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
  </head>
  <body>
    <div>
      <a href="https://www.hbtu.ac.in"><img src="hbtu_heading.jpeg" height=200 width=1000 class="College_image"></a>
    </div>
    <br /><br /><br />
    <div>
      <form method="post">
      <table cellspacing="50" bgcolor="tomato">
        <tr>
          <td colspan="2" align="center" style="font-size:20pt"><u><b>ADMIN LOGIN</b></u></td>
        </tr>
        <tr>
          <td>
            <b>USERNAME:</b>
          </td>
          <td>
            <input id="username" type="text" value="" name="user-name" size="30" placeholder="Enter your username.">
          </td>
        </tr>
        <tr>
          <td>
            <b>PASSWORD:</b>
          </td>
          <td>
            <input id="password" type="password" value="" name="pass" size="30" placeholder="Enter your password.">
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input id="submit_button" name="submit_button" type="submit" value="SUBMIT" style="font-size:17pt">
          </td>
        </tr>
      </table>
    </form>
  </div>
  </body>
</html>
<?php
  if(isset($_POST['submit_button'])){
  $adminname=$_POST['user-name'];
  $adminpass=$_POST['pass'];
  $sql="SELECT * FROM admin where username='$adminname' and password='$adminpass'";
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0)
  {
    $_SESSION['user']=$adminname;
    header('location:admin_home.php');
  }
  else
  {
    echo 'you are not the admin';
  }
}
?>

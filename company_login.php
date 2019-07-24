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

<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Company Login</title>
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
        <thead>
        <tr>
          <th colspan="3" align="center" style="font-size:20pt"><u>COMPANY LOGIN</u></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <b>USERNAME:</b>
          </td>
          <td>
            <input id="username" type="text" value="" name="user-name" size="30" placeholder="Enter your username." required>
          </td>
        </tr>
        <tr>
          <td>
            <b>PASSWORD:</b>
          </td>
          <td>
            <input id="password" type="password" value="" name="pass" size="30" placeholder="Enter your password." required>
          </td>
        </tr>
        <tr>
          <td align="center" colspan="3">
            <input id="submit_button" name="submit_button" type="submit" value="SUBMIT" style="font-size:17pt;">
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td align="center">
            <a href="company_register.php">New User?</a>
          </td>
          <td></td>
          <td>
            <a href="company_forget.php">Forgot password?</a>
          </td>
        </tr>
      </tfoot>
      </table>
    </form>
    </div>
  </body>
</html>

<?php
  if(isset($_POST['submit_button']))
  {
    $name=$_POST['user-name'];
    $pass=$_POST['pass'];
    $sql="SELECT * FROM company_registration WHERE Username='$name' and Password='$pass'";
    $result=mysqli_query($conn,$sql);
    $total = mysqli_num_rows($result);
    if($total==1)
    {
      $_SESSION['username']=$name;
      header('location:created_vacancies.php');
    }
    else {
      echo '<script language="javascript">';
      echo 'alert("Wrong username or password")';
      echo '</script>';
    }
  }
?>

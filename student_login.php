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
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <script type="text/javascript">
      function check_form(form)
      {
        var roll = form.roll.value;
        if(roll.length!=10)
        {
          alert("Roll No should be of 10 digits");
          return false;
        }
        for(i in roll)
        {
          if(roll[i]<'0' || roll[i]>'9')
          {
            alert("Roll No should contain digits from 0-9 only.");
            return false;
          }
        }
        return true;
      }
    </script>
  </head>
  <body>
    <div>
      <a href="https://www.hbtu.ac.in"><img src="hbtu_heading.jpeg" height=200 width=1000 class="College_image"></a>
    </div>
    <br /><br /><br />
    <div>
      <form method="post" onsubmit="return check_form(this);">
      <table cellspacing="50" bgcolor="tomato">
        <thead>
        <tr>
          <th colspan="3" align="center" style="font-size:20pt"><u>STUDENT LOGIN</u></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <b>Roll No:</b>
          </td>
          <td>
            <input id="roll" type="text" value="" name="roll" size="30" placeholder="Enter your roll number." required>
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
          <td colspan="3" align="center">
            <input id="submit_button" type="submit" name="submit_button" value="SUBMIT" style="font-size:17pt;">
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td align="center">
            <a href="student_registration.php">New User?</a>
          </td>
          <td></td>
          <td>
            <a href="student_forget.php">Forgot Password?</a>
          </td>
        </tr>
      </tfoot>
      </table>
    </form>
    </div>
  </body>
</html>

<?php
      if(isset($_POST['submit_button'])){
      $roll=$_POST['roll'];
      $stupass=$_POST['pass'];

      $sql="SELECT * FROM student_registration WHERE Roll_no = $roll and Password='$stupass'";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>0)
      {
        $_SESSION['roll']=$_POST['roll'];
        header('location: student_profile.php');
      }
      else {
        echo "<script>";
        echo "alert('Please enter a valid roll no. or password')";
        echo "</script>";
      }
    }
    ?>

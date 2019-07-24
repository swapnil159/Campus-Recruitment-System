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
  if(!$_SESSION['user'])
  {
    header('location: admin_login.php');
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>STUDENT DETAILS</title>
  </head>
  <body>
    <header class="container">
      <div id="menu">
      <div id="logo">
        <img src="hbtu_heading.jpeg">
      </div>
      <nav id="bar">
        <ul>
          <li><a href="admin_home.php">HOME</a>
          <li><a href="company_details.php">COMPANY DETAILS</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <main>
      <form method="post">
        <table>
          <thead>
            <tr>
              <td>SELECT YEAR:</td>
              <td>1<input type="radio" name="year" value="1"></td>
              <td>2<input type="radio" name="year" value="2"></td>
              <td>3<input type="radio" name="year" value="3"></td>
              <td>4<input type="radio" name="year" value="4"></td>
            </tr>
            <tr>
              <td>SELECT BRANCH</td>
              <td>1<input type="radio" name="branch" value="1"></td>
              <td>2<input type="radio" name="branch" value="2"></td>
              <td>3<input type="radio" name="branch" value="3"></td>
              <td>4<input type="radio" name="branch" value="4"></td>
              <td>5<input type="radio" name="branch" value="5"></td>
              <td>6<input type="radio" name="branch" value="6"></td>
              <td>7<input type="radio" name="branch" value="7"></td>
            </tr>
            <tr>
              <td></td>
              <td>8<input type="radio" name="branch" value="8"></td>
              <td>9<input type="radio" name="branch" value="9"></td>
              <td>10<input type="radio" name="branch" value="10"></td>
              <td>11<input type="radio" name="branch" value="11"></td>
              <td>12<input type="radio" name="branch" value="12"></td>
              <td>13<input type="radio" name="branch" value="13"></td>
            </tr>
          </thead>
          <tfoot>
            <td><input type="submit" name="submit_button" value="submit"></td>
          </tfoot>
        </table>
      </form>
    </main>

<?php
  if(isset($_POST['submit_button']))
  {
    if(!isset($_POST['year']))
    {
      echo '<script language="javascript">';
      echo 'alert("Please select an year")';
      echo '</script>';
    }
    else if(!isset($_POST['branch'])){
      echo '<script language="javascript">';
      echo 'alert("Please select a branch")';
      echo '</script>';
    }
    else {
      $year=$_POST['year'];
      $branch = $_POST['branch'];
      $query = "SELECT Roll_no,Gender,CGPA FROM apply WHERE Year=$year AND Branch_code=$branch";
      $result = mysqli_query($conn,$query);
      if(mysqli_num_rows($result)>0){
      ?>
      <footer>
        <form method="post">
        <table>
          <thead>
            <th>Roll_no</th>
            <th>Name</th>
            <th>Gender</th>
            <th>CGPA</th>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_array($result))
              {
                $roll=$row['Roll_no'];
                $sql = "SELECT Name FROM student_registration WHERE Roll_no='$roll'";
                $res = mysqli_query($conn,$sql);
                $name = mysqli_fetch_assoc($res);
                echo "<tr>";
                echo "<td>".$roll."</td>";
                echo "<td>".$name['Name']."</td>";
                echo "<td>".$row['Gender']."</td>";
                echo "<td>".$row['CGPA']."</td>";
                echo "<td>".'<input type="checkbox" name="update[]" value='.$roll.'>'."</td>";
                echo "</tr>";
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td><input type="submit" name="drop" value="drop"></td>
            </tr>
          </tfoot>
        </table>
      </form>
      </footer>
      <?php
      }
      else {
        echo "No companies found";
      }
    }
  }
?>
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
  if(isset($_POST['drop']))
  {
    $drop = $_POST['update'];
    for($a=0;$a<count($drop);$a++)
    {
      $roll=$drop[$a];
      $query = "SELECT Email FROM student_registration WHERE Roll_no=$roll";
      $result = mysqli_query($conn,$query);
      $res = mysqli_fetch_assoc($result);

      $mail->Subject = 'Incorrect information';
      $mail->Body = 'The information provided by you is found to be incorrect. Kindly apply again.';
      $mail->addAddress($res['Email'],$roll);

      $mail->send();
      $query = "DELETE FROM apply WHERE Roll_no=$roll";
      $result = mysqli_query($conn,$query);
      header('location:student_details.php');
    }
  }
?>

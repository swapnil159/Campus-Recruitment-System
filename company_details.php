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
  $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title>COMPANY DETAILS</title>
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
          <li><a href="student_details.php">STUDENT DETAILS</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>VACANCY NUMBER</th>
            <th>COMPANY NAME</th>
            <th>POST</th>
            <th>SALARY</th>
            <th>REQUIRED CGPA</th>
            <th>BRANCH</th>
            <th>YEAR</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = "SELECT * FROM vacancy";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_array($result))
            {
              $username = $row['company_username'];
              $sql = "SELECT Name FROM company_registration WHERE Username='$username'";
              $res = mysqli_query($conn,$sql);
              $po = mysqli_fetch_assoc($res);
              echo"<tr>";
              echo "<td>".$row['vacancy_number']."</td>";
              echo "<td>".$po['Name']."</td>";
              echo "<td>".$row['Post']."</td>";
              echo "<td>".$row['Salary']."</td>";
              echo "<td>".$row['Req_CGPA']."</td>";
              echo "<td>".$row['Branch']."</td>";
              echo "<td>".$row['Year']."</td>";
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </main>
  </body>
</html>

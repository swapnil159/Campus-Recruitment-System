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
  $name = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>HOME</title>
  </head>
  <body>
    <header class="container">
      <div id="menu">
      <div id="logo">
        <img src="hbtu_heading.jpeg">
      </div>
      <nav id="bar">
        <ul>
          <li><a href="student_details.php">STUDENT DETAILS</a>
          <li><a href="company_details.php">COMPANY DETAILS</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>Branch/Year</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for($a=1;$a<14;$a++)
            {
              echo "<tr>";
              echo "<td>".$a."</td>";
              for($b=1;$b<5;$b++)
              {
                $query = "SELECT * FROM apply WHERE Year=$b AND Branch_code=$a";
                $result = mysqli_query($conn,$query);
                echo "<td>".mysqli_num_rows($result)."</td>";
              }
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
      <table>
        <thead>
          <tr>
            <th>Branch/Year</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for($a=1;$a<14;$a++)
            {
              echo "<tr>";
              echo "<td>".$a."</td>";
              for($b=1;$b<5;$b++)
              {
                $query = "SELECT * FROM vacancy WHERE Year=$b AND Branch=$a";
                $result = mysqli_query($conn,$query);
                echo "<td>".mysqli_num_rows($result)."</td>";
              }
              echo "</tr>";
            }
          ?>
        </tbody>
      </table>
    </main>
  </body>
</html>

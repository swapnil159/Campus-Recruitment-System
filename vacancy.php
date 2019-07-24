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
      if(!$_SESSION['roll'])
      {
        header('location: student_login.php');
      }
      $user_roll=$_SESSION['roll'];
?>

<!Doctype html>
<html>
  <head>
    <title>VACANCY</title>
  </head>
  <body>
    <header class="container">
      <div id="menu">
      <div id="logo">
        <img src="hbtu_heading.jpeg">
      </div>
      <nav id="bar">
        <ul>
          <li><a href="student_profile.php">HOME</a>
          <li><a href="apply.php">APPLY</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <?php
      $query = "SELECT Branch_code,Year,CGPA FROM apply WHERE Roll_no=$user_roll";
      $result = mysqli_query($conn,$query);
      if(mysqli_num_rows($result)>0)
      {
        $row = mysqli_fetch_assoc($result);
        $branch=$row['Branch_code'];
        $cgpa=$row['CGPA'];
        $year=$row['Year'];
        $sql = "SELECT * FROM vacancy WHERE Req_CGPA<=$cgpa";
        $res=mysqli_query($conn,$sql);
        echo "<table>
          <thead>
            <tr>
              <th>Vacancy Number</th>
              <th>Company Name</th>
              <th>Company Location</th>
              <th>POST</th>
              <th>SALARY</th>
            </tr>
          </thead>
          <tbody>";
              if(mysqli_num_rows($res)>0)
              {
                while($rr = mysqli_fetch_array($res))
                {
                    $name=$rr['company_username'];
                    $qur="SELECT Name,Location FROM company_registration WHERE Username='$name'";
                    $res2=mysqli_query($conn,$qur);
                    $po=mysqli_fetch_assoc($res2);
                    echo "<tr>";
                    echo "<td>".$rr['vacancy_number']."</td>";
                    echo "<td>".$po['Name']."</td>";
                    echo "<td>".$po['Location']."</td>";
                    echo "<td>".$rr['Post']."</td>";
                    echo "<td>".$rr['Salary']."</td>";
                    echo "</tr>";
                }
              }
              else {
                echo "po";
              }
          echo "</tbody>
        </table>";
      }
      else {
        echo "No vacancies match your profile";
      }
    ?>
  </body>
</html>

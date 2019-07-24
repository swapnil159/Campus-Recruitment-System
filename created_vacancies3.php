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
  if(!$_SESSION['username'])
  {
    header('location: company_login.php');
  }
  $num = $_SESSION['vacancy_num'];
 ?>

 <!DOCTYPE html>
 <html>
  <head>
    <title>SHORTLISTED STUDENTS</title>
  </head>
  <body>
    <header class="container">
      <div id="menu">
      <div id="logo">
        <img src="hbtu_heading.jpeg">
      </div>
      <nav id="bar">
        <ul>
          <li><a href="created_vacancies.php">HOME</a>
          <li><a href="create_event.php">CREATE EVENT</a>
          <li><a href="create_vacancy.php">CREATE VACANCY</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <br/> <br/>
    <main>
      <table>
        <thead>
          <tr>
            <th>NAME</th>
            <th>ROLL NO</th>
            <th>YEAR</th>
            <th>BRANCH CODE</th>
            <th>GENDER</th>
            <th>CGPA</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = "SELECT * FROM SHORTLIST WHERE Job_no=$num";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_array($result))
            {
              $roll=$row['Roll_no'];
              $sql = "SELECT Name FROM student_registration WHERE Roll_no='$roll'";
              $res = mysqli_query($conn,$sql);
              $name = mysqli_fetch_assoc($res);
              $sql = "SELECT * FROM apply WHERE Roll_no='$roll'";
              $res = mysqli_query($conn,$sql);
              $det = mysqli_fetch_assoc($res);
              echo "<tr>";
              echo "<td>".$name['Name']."</td>";
              echo "<td>".$roll."</td>";
              echo "<td>".$det['Year']."</td>";
              echo "<td>".$det['Branch_code']."</td>";
              echo "<td>".$det['Gender']."</td>";
              echo "<td>".$det['CGPA']."</td>";
              echo "</tr>";
            }
           ?>
        </tbody>
      </table>
    </main>
  </body>
 </html>

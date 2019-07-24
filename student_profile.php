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
    <title>Student Profile</title>
  </head>
  <body>
    <header class="container">
      <div id="menu">
      <div id="logo">
        <img src="hbtu_heading.jpeg">
      </div>
      <nav id="bar">
        <ul>
          <li><a href="apply.php">APPLY</a>
          <li><a href="vacancy.php">VACANCY</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <main>
      <?php
        $query = "SELECT Job_no FROM SHORTLIST WHERE Roll_no='$user_roll' ORDER BY Job_no";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0)
        { ?>
          <table>
            <thead>
              <tr>
                <th>Job_no</th>
                <th>COMPANY NAME</th>
                <th>LOCATION</th>
                <th>E-MAIL</th>
                <th>POST</th>
                <th>SALARY</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while($row = mysqli_fetch_array($result))
                {
                  $num= $row['Job_no'];
                  $query2 = "SELECT company_username,Post,Salary FROM vacancy WHERE vacancy_number=$num";
                  $result2 = mysqli_query($conn,$query2);
                  while($rr = mysqli_fetch_array($result2))
                  {
                    $name = $rr['company_username'];
                    $query3 = "SELECT Name,Location,Email FROM company_registration WHERE Username='$name'";
                    $result3 = mysqli_query($conn,$query3);
                    while($ro = mysqli_fetch_array($result3))
                    {
                      echo "<tr>";
                      echo "<td>".$num."</td>";
                      echo "<td>".$ro['Name']."</td>";
                      echo "<td>".$ro['Location']."</td>";
                      echo "<td>".$ro['Email']."</td>";
                      echo "<td>".$rr['Post']."</td>";
                      echo "<td>".$rr['Salary']."</td>";
                      echo "</tr>";
                    }
                  }
                }
              ?>
            </tbody>
          </table>
        <?php
        }
        else {
          echo "YOU HAVE NOT BEEN SHORTLISTED YET";
        }
      ?>
    </main>
  </body>
</html>

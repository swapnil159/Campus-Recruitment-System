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
  $user = $_SESSION['username'];
  $num = $_SESSION['vacancy_num'];
  $query = "SELECT Req_CGPA,Branch,Year FROM vacancy WHERE vacancy_number=$num";
  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_assoc($result);
  $cgpa = $row['Req_CGPA'];
  $branch = $row['Branch'];
  $year = $row['Year'];
  $query = "SELECT * FROM apply WHERE (Branch_code=$branch AND Year=$year AND CGPA>=$cgpa)";
  $result = mysqli_query($conn,$query);
  $sql = "SELECT Name FROM company_registration WHERE Username='$user'";
  $res = mysqli_query($conn,$sql);
  $name = mysqli_fetch_assoc($res);
 ?>
 <!Doctype html>
 <html>
  <head>
    <title>SHORTLIST</title>
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
    <main>
      <form method="post">
        <table>
          <thead>
            <tr>
              <th>Roll No</th>
              <th>Gender</th>
              <th>Branch</th>
              <th>Year</th>
              <th>CGPA</th>
              <th>Resume</th>
              <th>Shortlist</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_array($result))
              {?>
                <tr>
                  <td><?php echo $row['Roll_no'] ?></td>
                  <td><?php echo $row['Gender'] ?></td>
                  <td><?php echo $row['Branch_code'] ?></td>
                  <td><?php echo $row['Year'] ?></td>
                  <td><?php echo $row['CGPA'] ?></td>
                  <td><a download="<?php echo $row['Roll_no'] ?>" href="resumes/<?php echo $row['Roll_no'] ?>"><?php echo $row['Roll_no'] ?></a></td>
                  <td><input type="checkbox" name="shortlist[]" value="<?php echo $row['Roll_no'] ?>"></td>
                </tr>
              <?php
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="7" align="center"><input type="submit" name="submit_button" value="submit"></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </main>
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
    if(isset($_POST['submit_button']))
    {
      if(isset($_POST['shortlist'])){
      $select = $_POST['shortlist'];
      for($a=0;$a<count($select);$a++)
      {
        $roll = $select[$a];
        $query = "SELECT Email FROM student_registration WHERE Roll_no=$roll";
        $result = mysqli_query($conn,$query);
        $res = mysqli_fetch_assoc($result);

        $mail->Subject = 'Shortlisted for '.$name['Name'];
        $mail->Body = 'Congratulations !! You have been shortlisted for placement in '.$name['Name'].' for job number '.$num.'. Further details will be mailed to you.';
        $mail->addAddress($res['Email'],$roll);

        $mail->send();

        $query = "INSERT INTO SHORTLIST (Roll_no,Job_no) VALUES ('$roll',$num)";
        $result = mysqli_query($conn,$query);

        $query = "UPDATE vacancy SET shortlisted = 1 WHERE vacancy_number = $num";
        $result = mysqli_query($conn,$query);
      }
    }
    else {
      echo '<script type="text/javascript">
      alert("You have not selected any student");
      location="created_vacancies2.php";
      </script>';
    }
  }
 ?>

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
  $user=$_SESSION['username'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>CREATE VACANCY</title>
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
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <br /><br />
    <marquee><h2>Fill this form to create a vacancy</h2></marquee>
    <form method="post">
    <table>
      <tr>
        <td>POST:</td>
        <td colspan="2"><input type="text" name="pos" value="" size="30" placeholder="Enter post" required></td>
      </tr>
      <tr>
        <td>SALARY:</td>
        <td colspan="2"><input type="number" name="salary" value="" size="30" placeholder="Enter the salary offered" required></td>
      </tr>
      <tr>
        <td>REQUIRED CGPA:</td>
        <td colspan="2"><input type="number" step="0.01" name="cgpa" value="" size="30" placeholder="Enter the required CGPA" required></td>
      </tr>
      <tr>
        <td>BRANCH:</td>
        <td colspan="2"><input type="number" min="1" max="13" name="branch" value="" size="30" placeholder="Enter the Branch" required></td>
      </tr>
      <tr>
        <td>YEAR:</td>
        <td colspan="2"><input type="number" min="1" max="4" name="year" value="" size="30" placeholder="Enter the Year" required></td>
      </tr>
			<tr>
				<td colspan="3" align="center"><input type="submit" name="submit_button" size="10" value="submit"></td>
			</tr>
      <br /> <br />
    </table>
  </form>
  </body>
</html>

<?php
  if(isset($_POST['submit_button']))
  {
    $pos=$_POST['pos'];
    $sal=$_POST['salary'];
    $cgpa=$_POST['cgpa'];
    $branch=$_POST['branch'];
    $year=$_POST['year'];
    $short=0;
    $sql="INSERT INTO vacancy (company_username,Post,Salary,Req_CGPA,Branch,Year,shortlisted) VALUES ('$user','$pos',$sal,$cgpa,$branch,$year,$short)";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
      echo '<script type="text/javascript">
      alert("The vacancy has been successfully created");
      location="create_vacancy.php";
      </script>';
    }
    else {
      echo '<script type="text/javascript">
      alert("Something went wrong. Please try again");
      location="create_vacancy.php";
      </script>';
    }
  }
?>

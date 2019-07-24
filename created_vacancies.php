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
 ?>
<!DOCTYPE html>
<html>
  <head>
    <title>COMPANY PAGE</title>
    <link rel="stylesheet" type="text/css" href="company_login.css">
  </head>
  <body>
    <header class="container">
      <div id="menu">
      <div id="logo">
        <img src="hbtu_heading.jpeg">
      </div>
      <nav id="bar">
        <ul>
          <li><a href="create_event.php">CREATE EVENT</a>
          <li><a href="create_vacancy.php">CREATE VACANCY</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <br /><br />
    <div id="content">
      <?php
        $query = "SELECT * FROM vacancy WHERE company_username='$user'";
        $result = mysqli_query($conn,$query);
        if($result && mysqli_num_rows($result)>0)
        {?>
          <form method="post">
            <table>
              <thead>
                <tr>
                  <th>Vacancy Number</th>
                  <th>Post</th>
                  <th>Salary</th>
                  <th>Req_CGPA</th>
                  <th>Branch code</th>
                  <th>Year</th>
                </tr>
              </thead>
              <tbody>
          <?php
          $query = "SELECT * FROM vacancy WHERE company_username='$user'";
          $result = mysqli_query($conn,$query);
          if(mysqli_num_rows($result)>0)
          {
            while($row = mysqli_fetch_array($result))
            {
              echo "<tr>";
              echo "<td>".$row['vacancy_number']."</td>";
              echo "<td>".$row['Post']."</td>";
              echo "<td>".$row['Salary']."</td>";
              echo "<td>".$row['Req_CGPA']."</td>";
              echo "<td>".$row['Branch']."</td>";
              echo "<td>".$row['Year']."</td>";
              echo "</tr>";
            }
          }
        echo "</tbody>
      </table>";
        ?>
        <div>
          <p>ENTER VACANCY NUMBER:</p>
          <input type="number" name="vacancy_num" size="30" placeholder="Enter Vacancy number" required>
          <input type="submit" name="submit_button" value="GO">
        </div>
      </form>
        <?php
        }
        else
        {
          echo "No vacancies have been created by you till now.";
        } ?>
    </div>
  </body>
</html>

<?php
  if(isset($_POST['submit_button']))
  {
    $num = $_POST['vacancy_num'];
    $query1 = "SELECT shortlisted FROM vacancy WHERE vacancy_number=$num";
    $result1 = mysqli_query($conn,$query1);
    $res1 = mysqli_fetch_assoc($result1);

    if($res1['shortlisted']==0)
    {
      $query = "SELECT company_username FROM vacancy WHERE vacancy_number=$num";
      $result=mysqli_query($conn,$query);
      $res=mysqli_fetch_assoc($result);
      if($res['company_username']==$user)
      {
        $_SESSION['vacancy_num']=$num;
        header('Location: created_vacancies2.php');
      }
      else {
        echo "This vacancy has not been created by you";
      }
    }
    else
    {
        $_SESSION['vacancy_num']=$num;
        header('location: created_vacancies3.php');
    }
  }
?>

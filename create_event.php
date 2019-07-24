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
    <title>CREATE EVENT</title>
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
          <li><a href="create_vacancy.php">CREATE VACANCY</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <marquee><h2>Fill this form to create an event</h2></marquee>
    <form method="post">
    <table>
      <tr>
        <td>EVENT NAME:</td>
        <td colspan="2"><input type="text" name="event_name" value="" size="30" placeholder="Enter event name" required></td>
      </tr>
      <tr>
        <td>DATE:</td>
        <td colspan="2"><input type="date" name="event_date" value="" size="30" required></td>
      </tr>
      <tr>
        <td>TIME</td>
        <td colspan="2"><input type="time" name="event_time" value="" size="30" required></td>
      </tr>
      <tr>
        <td>VENUE:</td>
        <td colspan="2"><input type="text" name="event_venue" value="" size="30" placeholder="Enter the venue of event" required></td>
      </tr>
      <tr>
        <td>EVENT DESCRIPTION:</td>
        <td colspan="2"><textarea rows="4" cols="40" name="event_description" value="" size="30" placeholder="Enter the description of event"></textarea></td>
      </tr>
			<tr>
				<td colspan="3" align="center"><input type="submit" name="submit_button" size="10"></td>
			</tr>
    </table>
  </form>
  </body>
</html>

<?php
  if(isset($_POST['submit_button']))
  {
    echo "Success";
    $ename = $_POST['event_name'];
    $edate = $_POST['event_date'];
    $etime = $_POST['event_time'];
    $evenue = $_POST['event_venue'];
    if(isset($_POST['event_description']))
    {
      $edescription = $_POST['event_description'];
      $query = "INSERT INTO events (company_username,event_name,event_date,event_time,event_venue,event_description) VALUES ('$user','$ename','$edate','$etime','$evenue','$edescription')";
    }
    else
    {
      $query = "INSERT INTO events (company_username,event_name,event_date,event_time,event_venue) VALUES ('$user','$ename','$edate','$etime','$evenue')";
    }
    $result=mysqli_query($conn,$query);

    if($result)
    {
      echo "Success";
    }
    else {
      echo "Failure";
    }
  }
?>

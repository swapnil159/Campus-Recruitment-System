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
      $query = "SELECT Roll_no FROM apply WHERE Roll_no=$user_roll";
      $result = mysqli_query($conn,$query);
      if(mysqli_num_rows($result)>0)
      {
        $message = "You have already registered";
        echo "<script type='text/javascript'>
        alert('$message');
        location='student_profile.php';
        </script>";
      }
?>


<!Doctype html>
<html>
  <head>
    <title>APPLY</title>
    <script type="text/javascript">
      function check_form(form)
      {
        var br=form.branch.value;
        if(br<1 || br>13)
        {
          alert("Enter a valid branch code");
          form.branch,focus();
          return false;
        }
        var yr=form.year.value;
        if(yr<1 || yr>4)
        {
          alert("Enter a valid year");
          form.year.focus();
          return false;
        }
        return true;
      }
    </script>
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
            <li><a href="vacancy.php">VACANCY</a>
          <li><a href="log_out.php">LOG OUT</a>
        </ul>
      </nav>
    </div>
    </header>
    <main>
      <form method="post" enctype="multipart/form-data" onsubmit="return check_form(this);">
        <table>
          <tr>
            <td><b>BRANCH CODE*:</b></td>
            <td><input id="branch_code" type="number" value="" name="branch" size="30" placeholder="Enter your Branch Code." required></td>
          </tr>
          <tr>
            <td><b>YEAR*:</b></td>
            <td><input id="year" type="number" value="" name="year" size="30" placeholder="Enter your year." required></td>
          </tr>
          <tr>
            <td><b>Gender*:</b></td>
            <td><input id="gm" type="radio" value="male" name="gender" checked>Male 
              <input id="gf" type="radio" name="gender" value="female">Female</td>
          </tr>
          <tr>
            <td><b>CGPA*:</b></td>
            <td><input id="cgpa" type="number" step="0.01" value="" name="cgpa" size="30" placeholder="Enter your CGPA."></td>
          </tr>
          <tr>
            <td><input id="userfile" name="userfile" type="file"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="submit" value="SUBMIT" name="submit_button"></td>
          </tr>
        </table>
      </form>
    </main>
  </body>
</html>

<?php
  if(isset($_POST['submit_button']) && $_FILES['userfile']['size']>0)
  {
    $branch=$_POST['branch'];
    $year=$_POST['year'];
    $gender=$_POST['gender'];
    $cgpa=$_POST['cgpa'];
    $file=$_FILES['userfile'];

    move_uploaded_file($file['tmp_name'],"resumes/".$user_roll);

    $query = "INSERT INTO apply(Roll_no,Branch_code,Year,Gender,CGPA) VALUES ('$user_roll',$branch,$year,'$gender',$cgpa)";
    $result = mysqli_query($conn,$query);
    if($result)
    {
      echo "Success";
    }
    else {
      echo "Failure";
    }
  }
?>

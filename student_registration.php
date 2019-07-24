<?php
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
?>

<!Doctype html>
<html>
  <head>
    <title>REGISTER</title>
    <style type="text/css">
      html{
        background: url('back.jpeg') no-repeat center center fixed;
        background-size: cover;
        width: 100%;
      }
      body{
        text-align: center;
        height: 100%;
        width: 100%;
      }
      table
      {
        margin-left: auto;
        margin-right: auto;
        text-align: left;
        border-style: solid;
      }
      .he{
        margin-top: 50pt;
      }
    </style>
    <script type="text/javascript">
      function check_form(form)
      {
        var stuname=form.name.value;
        for(i in stuname)
        {
          if(stuname[i]!=' ' && !(stuname[i]>='A' && stuname[i]<='Z') && !(stuname[i]>='a' && stuname[i]<='z'))
          {
            alert("Name should contain first name and last name separated by space");
            form.name.focus();
            return false;
          }
        }
        var roll=form.roll.value;
        if(roll.length!=10)
        {
          alert("Roll No. should be of 10 digits");
          form.roll.focus();
          return false;
        }
        for(i in roll)
        {
          if(roll[i]<'0' || roll[i]>'9')
          {
            alert("Roll No. should contain only 0-9 digits");
            form.roll.focus();
            return false;
          }
        }
        var pass=form.pass.value;
        var cpass=form.cpass.value;
        if(pass!=cpass)
        {
          alert("Password did not match");
          form.cpass.focus();
          return false;
        }
        return true;
      }
    </script>
  </head>
  <body>
    <marquee><font size="25">Fill this form to be eligible for placement.</font></marquee>
    <div>
      <h1 align="center" class="he">REGISTER</h1>
      <form method="post" onsubmit="return check_form(this);">
        <div>
          <table cellspacing="40">
            <div>
              <tr>
                <td>
                  <b>NAME*:<b>
                </td>
                <td>
                  <input id="name" type="text" value="" name="name" size="30" placeholder="Enter your name." required>
                </td>
              </tr>
            </div>
            <div>
              <tr>
                <td>
                  <b>ROLL NO*:</b>
                </td>
                <td>
                  <input id="roll_no" type="text" value="" name="roll" size="30" placeholder="Enter your Roll no." required>
                </td>
              </tr>
            </div>
            <div>
              <tr>
                <td><b>E-mail*:</b></td>
                <td><input id="e-mail" type="email" value="" name="e_mail" size="30" placeholder="Enter your E-mail" required></td>
              </tr>
            </div>
            <div>
              <tr>
                <td><b>PASSWORD*:</b></td>
                <td><input id="pass" type="password" value="" name="pass" size="30" placeholder="Enter the password you want to set" required></td>
              </tr>
            </div>
            <div>
              <tr>
                <td><b>CONFIRM PASSWORD*:</b></td>
                <td><input id="confirm_pass" type="password" value="" name="cpass" size="30" placeholder="Confirm your password" required></td>
              </tr>
            </div>
            <div>
              <tr>
                <td colspan="2" align="center"><input id="submit" type="submit" value="SUBMIT" name="submit_button" style="font-size: 17pt;"></td>
              </tr>
            </div>
          </table>
        </div>
      </form>
    </div>
  </body>
</html>

<?php
    if(isset($_POST['submit_button'])){
    $name=$_POST['name'];
    $roll_no=$_POST['roll'];
    $email=$_POST['e_mail'];
    $password=$_POST['pass'];

    $sql="INSERT INTO student_registration(Name,Roll_no,Email,Password) VALUES('$name','$roll_no','$email','$password')";

    $result=mysqli_query($conn,$sql);

    if($result)
    {
      echo "<h1><center><a href=student_login.php>Click</a> to Login</center></h1>";
    }
    else {
      echo "<h1><center>Registration Failed <a href=student_login.html>Click</a> to Login</center></h1>";
    }
  }
  ?>
</body>
</html>

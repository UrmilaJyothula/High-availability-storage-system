 (62 sloc)  2.13 KB
<?php
 session_start();
 if(!isset($_SESSION["admin_signup"]))
 {
  $_SESSION["admin_signup"] = True;
  header("Location:admin_signup.php");	 
 }
 
?> 

<html>
  <head>
    <title>
      Admin - Sign Up
    </title>
    <link rel="stylesheet" type="text/css" href="signup.css">
  </head>
  <body>
    <header>
	  <div id="logo">
		<a href="profile.php"><h1>SDrive</h1></a>
	  </div>
	</header>
    <main>
      <div>
        <center>
        <form method="POST">
          <fieldset class="formstyle">
            <legend>Create Admin Account</legend>
              <div class="adjust">
                <br><label class="labels">First name</label><br>
                <input class="floattype" type="text" name="firstname" placeholder="First Name" required><br>
                <br><label class="labels">Last name</label><br>
                <input class="floattype" type="text" name="lastname" placeholder="Last Name" required><br>
                <br><label class="labels">E-mail ID</label><br>
                <input class="floattype" type="text" name="emailid" placeholder="E-mail Id" required><br>
                <br><label class="labels">Password</label><br>
                <input class="floattype" type="password" name="password" placeholder="Password" required><br>
                <br><label class="labels">Confirm Password</label><br>
                <input class="floattype" type="password" name="confirm_password" placeholder="Confirm Password" required><br>
                <br><button type="submit" name="signup" value="Sign Up">Sign Up</button>
              </div>
          </fieldset>
        </form>
        </center>
      </div>
    </main>
    <footer>
      <p>&copy;2016 SDrive,Gryffindors Inc.</p>
    </footer>
  </body>
</html>

<?php
 if(isset($_POST["signup"]))
 {
  $_SESSION["adminsignup_confirm"] = True; 
  $_SESSION["fname"] = $_POST["firstname"];
  $_SESSION["lname"] = $_POST["lastname"];
  $_SESSION["eid"] = $_POST["emailid"];
  $_SESSION["pwd"] = $_POST["password"];
  $_SESSION["cfmpwd"] = $_POST["confirm_password"];
  header("Location:admin_signup_sql.php");	 
 }
?> 

<html>
  <head>
    <title>
      Main-Random-Page
    </title>
    <link rel="stylesheet" type="text/css" href="css/mainpage.css">
  </head>
  <body>
    <header>
	  <div id="logo">
		<a href="mainpage.php"><h1>SDrive</h1></a>
	  </div>
	</header>
    <main>
      <div>
        <form method="POST">
          <div class="adjust">
			<br><label class="labels">Click Login to redirect to Login page</label><br>
            <br><button type="submit" name="login_submit" value="Login">Login</button>
			<br><br>
			<br><label class="labels">Click SignUp to redirect to SignUp page</label><br>
			<br><button type="submit" name="signup_submit" value="SignUp">SignUp</button>
          </div>
        </form>
      </div>
    </main>
    <footer>
      <p>&copy;2016 SDrive,Gryffindors Inc.</p>
    </footer>
  </body>
</html>

<?php
 if(isset($_POST["login_submit"]))
 {
  header("Location:login.php");	 
 }
 elseif(isset($_POST["signup_submit"]))
 {
  header("Location:signup.php");	 
 }
 else
 {
	 
 }
?> 

<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Page</title>
</head>

<body>
<div>This is the Login Page</div>
<form name="LogIn" method="post" action="LoginPage.php">
User Name: <input type="text"  name="UserName"/><br />
Password: <input type="password"  name="Password"/><br />
<input type="submit" />
</form>
<?php
//Server Information
$servername = "localhost";
$username = "web_student";
$password = "apple123";
$datab = "studentschema";

//Create Connection
//$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$conn = mysqli_connect($servername, $username, $password, $datab);

//Check Connection
if ($conn == FALSE)
	{
	die("Connection Failed: ".$conn -> connect_error);
	};

//Sets up the LoggedIn Variable
if(isset($_SESSION["LoggedIn"]) == FALSE)
	{
	$_SESSION["LoggedIn"] = 0;
	}
		
//Checking Log In
if($_SESSION["LoggedIn"] == 0)
	{	
	if(isset($_POST['UserName']) && isset($_POST['Password']))
		{	
		$UN = $_POST['UserName'];
		$PW = $_POST['Password'];
		$sql = "SELECT * FROM ModerLogins";
		$result = $conn -> query($sql);
			//Checks all the infromation in the table and matches it with the UN and PW
			//Probably can be done much better using SELECT 'Password' FROM 'table' WHERE 'Username' = $UN
		if($result -> num_rows > 0)
			{	
			while($row = $result -> fetch_assoc())
				{
				if($row['UserName'] == $UN)
					{
					//echo "User Name Match <br>";
					if($row['Password'] == $PW)
						{
						$_SESSION["UserID"] = $row['id'];
						$_SESSION["LoggedIn"] = 1;
						echo "Logged in as ";
						echo "$UN";
						}
					else
						{
						echo "Incorrect username or password<br>";
						}
					}
				else
					{
					//echo "User Name Does Not Exist. Create A New Account?<br>";
					}			
				}
			}
		}
	}
	else
	{
	echo "Already Logged In";
	}	
?>

</body>
</html>

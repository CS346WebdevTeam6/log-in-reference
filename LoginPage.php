<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Page</title>
<style>
body {color: #FFFFFF; font-family:Georgia, "Times New Roman", Times, serif}
body {background-color:black; font-size:18px}
#SideBar {position: fixed; color:white; font-size:20px; padding-top:50px;}
#Header {position: fixed; color:white; font-size: 36px; padding-left: 150px; z-index:3;}
#Header2 {position: fixed; color:white; font-size:20px; padding-left: 50px; padding-top: 40px}
#StorePage {padding-left: 150px; padding-top:110px;}
a:link {color: #FFFFFF;}
a:visited {color: #FFFFFF;}
a:hover{color: #FFFF00;}
table, td, th {border:#FFFFFF thin solid; background-color:#000000;}
@media print 
	{
	body {background-color:#FFFFFF; font-family:Georgia, "Times New Roman", Times, serif; color:#000000}
	#SideBar {position: fixed; top:150px; color:#000000; font-size:18px; padding-top:20px; padding-bottom:250px; background-color:#FFFFFF; border-right-style:solid; border-right-width:medium; border-right-color:#000000;}
	#Header {position: fixed; color:#000000; font-size: 34px; padding-left: 150px; background-color:#FFFFFF; z-index:5;}
	#Header2 {position: fixed; color:#000000; font-size:18px; padding-left: 50px; padding-top: 40px; background-color:#FFFFFF; z-index:3}
	#StorePage { position: relative; left:150px; top:100px; /*padding-left: 150px; padding-top:110px;*/ background-color:#FFFFFF}
	#spoopy {color:#FFFFFF; position:relative}
	a:link {color: #000000;}
	a:visited {color: #000000;}
	a:hover{color: #FFFF00;}
	iframe {z-index:2; padding-left: 30px;}
	table, td, th {border:#000000 thin solid; background-color:#FFFFFF;}
	}
</style>
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

//Creating the table	
//$sql = "CREATE TABLE ModerLogins
//		(
//		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//		UserName CHAR(255),
//		Password CHAR(255)
//		)";
//Table Creation Test		
//	if(mysqli_query($conn, $sql))
//		{
//		echo "Table Created<br>";
//		}
//	else
//		{
//		echo "Table Creation Failed" . $conn -> error;
//		echo "<br>";
//		}

//Inserting a Password For Me
//$sql = "INSERT INTO ModerLogins (UserName, Password) 
//		VALUES('Flowey', 'Flower')";
//		if (mysqli_query($conn, $sql))
//		{
//		echo "Congrats, You did it!<br>";
//		}
//		else
//		{
//		echo "Insert Failed" . $sql . "<br>" . mysqli_error($conn);
//		}

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

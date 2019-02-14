<?php
        class Database {
    private static $dsn = 'mysql:host=localhost;dbname=mpworks';
    private static $username = 'root';
    private static $password = 'Pa$$w0rd';
    private static $db;
    
    private function __construct() {}
    
    public static function getDB() {
        if (!isset(self::$db)){
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);

            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include('database_error.php');
              echo "DB Error: " . $error_message; 
                exit();
            }
        }
        return self::$db;
    }
        }
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/contact.css">
<link rel="stylesheet"  href="css/about.css">
<meta name="viewport" content="width=device-width">
<title>Matthew Pugel Portfolio</title>

<!-- Mobile -->
<link href="CSS/mobile.css" rel="stylesheet" type="text/css" media="only screen and (max-width:800px)">

</head>

<body>
<header>
		<div class="formRow">
	<nav>
		<ul>
			<li><a href="index.html">Home</a></li>
			<li><a href="about.html">About Me</a></li>
			<li><a href="hobbies.html">Hobbies</a></li>
			<li><a href="contact.html">Contact Me</a></li>
                         <li><a href="login.html">Admin</a></li>
			
		</ul>	
	</nav>
	</div>
   

<section>
   <h2>We are experiencing technical difficulties. Please try again later</h2>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <form name="customer" method="post" action="http://www.personalportfolio.com/formsubmit.php">
  </form>
  <p>&nbsp;</p>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1>&nbsp;</h1>
<h2>&nbsp;</h2>

</body>
</html>

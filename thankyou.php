<?php
        $visitor_name = filter_input(INPUT_POST, 'name');
    $visitor_email = filter_input(INPUT_POST, 'email');
    $visitor_msg = filter_input(INPUT_POST, 'message');
    /* echo "Fields: " . $visitor_name . $visitor_email . $visitor_msg;  */
    
    // Validate inputs
    if ($visitor_name == null || $visitor_email == null ||
        $visitor_msg == null) {
        $error = "Invalid input data. Check all fields and try again.";
        /* include('error.php'); */
        echo "Form Data Error: " . $error; 
        exit();
        } else {
            
            // Connect to db
            try {
               include './model/database.php';
                include './model/visitor.php';
                
            } catch (PDOException $e) {
                echo 'Connection error: ' . $e->getMessage();
               // require('error.php');
                header('error.php');
                exit();
            }
            try {
          $return = add_visitor($visitor_name, $visitor_email, $visitor_msg);
            } catch (PDOException $e) {
                 echo 'Connection error: ' . $e->getMessage();
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
   <h2><h2>Thank you, <?php echo $visitor_name; ?>, for contacting me! I will get back to you shortly.</h2>
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

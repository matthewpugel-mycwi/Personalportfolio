<!------------------------------------------------------------------------------
  Modification Log
  Date          Name            Description
  ----------    -------------   -----------------------------------------------
  2-1-2018      JWokersien      Initial Deployment.
  ----------------------------------------------------------------------------->
<?php   
// Connect to db
$dsn = 'mysql:host=localhost;dbname=ejdesign';
$username = 'root';
$password = 'Pa$$w0rd';

try {
    $db = new PDO($dsn, $username, $password);

} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "DB Error: " . $error_message; 
    exit();
    }
        
// Check action; on initial load it is null
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_visitors';
    }
}  

// List the visitors & employees
if ($action == 'list_visitors') {

    // Read employee data 

    $employeeID = filter_input(INPUT_GET, 'empID', 
            FILTER_VALIDATE_INT);
    if ($employeeID == NULL || $employeeID == FALSE) {
        $employeeID = 1;
    }
    try {
        $query = 'SELECT * FROM employee
                  ORDER BY employeeID';
        $statement = $db->prepare($query);
        $statement->execute();
        $employees = $statement;

        $query2 = 'SELECT * FROM visitor
		join history on visitor.visitor_id = history.visitor_id
                WHERE employeeID = :employeeID
                ORDER BY visitor_email';
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(":employeeID", $employeeID);
        $statement2->execute();
        $visitors = $statement2;
    }
    catch(PDOException $e){
        echo 'Error: ' . $e->getMessage();
    }
}

// Executed when user clicks delete button
else if ($action == 'delete_visitor') {
    $visitor_id = filter_input(INPUT_POST, 'visitor_id', 
            FILTER_VALIDATE_INT);
    $query = 'DELETE FROM visitor
              WHERE visitor_id = :visitor_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':visitor_id', $visitor_id);
    $statement->execute();
    $statement->closeCursor();
    echo ($visitor_id);
    header("Location: admin.php");
}
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>Eva Jones Design</title>
<style type="text/css">
@import url("CSS/stylesheet.css");
body {
	background-image: url(images/bkgdContact.jpg);
}
</style>
<!-- Mobile -->
<link href="CSS/mobile.css" rel="stylesheet" type="text/css" media="only screen and (max-width:800px)">
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
</head>

<body>
<div id="logo"><img src="images/logo.png" width="220" height="103" alt="Eva Jones Design"></div>
<nav>
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="index.html">home</a>    </li>
    <li><a href="about.html">about</a></li>
    <li><a href="portfolio.html">portfolio</a>    </li>
    <li><a href="contact.html">contact</a></li>
  </ul>
</nav>
<header>
  <h1>admin <span class="fancy">Eva Jones</span></h1>
</header>
<section>
  <h2>Admin Page</h2>
  <h3>Select an employee email to view messages</h3>
            <!-- display links for all employees -->
            <ul style="list-style-type:none;">
                <?php foreach($employees as $employee) : ?>
                <li>
                    <a href="?empID=<?php echo $employee['employeeID']; ?>">
                        <?php echo $employee['first_name'] . $employee['last_name']; ?>
                    </a>
                    
                </li>
                <?php endforeach; ?>
            </ul>
            </br>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th class="right">Message</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($visitors as $visitor) : ?>
            <tr>
                <td><?php echo $visitor['visitor_name']; ?></td>
                <td><?php echo $visitor['visitor_email']; ?></td>
                <td><?php echo $visitor['visitor_msg']; ?></td> </td>
                <td><form action="admin.php" method="post">
                    <input type="hidden" name="action"
                           value="delete_visitor">
                    <input type="hidden" name="visitor_id"
                           value="<?php echo $visitor['visitor_id']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

  <p>&nbsp;</p>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1>&nbsp;</h1>
<h2>&nbsp;</h2>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>

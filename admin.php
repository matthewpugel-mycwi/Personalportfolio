<!------------------------------------------------------------------------------
  Modification Log
  Date          Name            Description
  ----------    -------------   -----------------------------------------------
  2-8-2018      MPugel     Changing database to look more clean and add functions
  ----------------------------------------------------------------------------->
<?php
// Connect to db
include "./model/database.php";
include "./model/employee.php";
include "./model/visitor.php";


        
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

        $employeeID = filter_input(INPUT_GET, 'employeeID', 
                FILTER_VALIDATE_INT);
        if ($employeeID == NULL || $employeeID == FALSE) {
            $employeeID = 1;
        }
try {
        $employees = getEmployees ();

        $visitors = getVisitors($employeeID);
    } catch (PDOException $e) {
        echo 'Connection error: ' . $e->getMessage();
    }
    }
    // Executed when user clicks delete button
    else if ($action == 'delete_visitor') {
        $visitor_id = filter_input(INPUT_POST, 'visitor_id', 
                FILTER_VALIDATE_INT);

        $count = deleteVisitor($visitor_id);
        if ($count == 1){
            $message = "Can not delete.";
            header("Location: error.php");
        }else {
            header("Location: admin.php");
        }
    
    }

/* // Connect to db
  include('./model/database.php');
// Connect to db
$dsn = 'mysql:host=localhost;dbname=mpworks';
$username = 'root';
$password = 'Pa$$w0rd';

try {
    $db = new PDO($dsn, $username, $password);

} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "DB Error: " . $error_message; 
    exit();
    }
// Get category ID
if (!isset($employeeID)) {
    $employeeID = filter_input(INPUT_GET, 'employeeID', 
            FILTER_VALIDATE_INT);
    if ($employeeID == NULL || $employeeID == FALSE) {
        $employeeID = 1;
    }
}
try{
    // Get all employees
    $queryCategory = 'SELECT employeeID, first_name, last_name FROM employee
                      order by employeeID' ;
    $statement1 = $db->prepare($queryCategory);
    $statement1->execute();
    $employees = $statement1->fetchAll();
    $statement1->closeCursor();
    
    // Get products for selected category
    $queryProducts = 'select * from visitor
                        join history on visitor.visitor_id = history.visitor_id
                        where employeeID = :employeeID';
    $statement3 = $db->prepare($queryProducts);
    $statement3->bindValue(':employeeID', $employeeID);
    $statement3->execute();
    $visitors = $statement3->fetchAll();
    $statement3->closeCursor();
            /* echo "Fields: " . $visitor_name . $visitor_email . $visitor_msg; */
//} catch(PDOException $e){
  //  echo "DB Error: " . $e; 
   // exit();
//} 


?>


<!doctype html>
<!-- Matthew Pugel -->
<html lang="en">
<head>
	<title>Matthew Pugel's Personal Portfolio</title>
	<meta charset="utf-8">
        <link rel="stylesheet"  href="css/about.css">
        <link rel="stylesheet" href="css/contact.css"
	<link rel="stylesheet" href="css/animate.css">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
        </header>

<section>
  <h2>Admin Page</h2>
  <h3>Select an employee email to view messages</h3>
  <!-- display links for all employees -->
            <ul style="list-style-type:none;">
                <?php foreach($employees as $employee) : ?>
                   
                    <li>
                    <a href="?employeeID=<?php echo $employee['employeeID']; ?>">
                        <?php echo $employee['first_name'] . $employee['last_name']; ?>
                    </a>
                    
                </li>
               
                <?php endforeach; ?>
               
               
            </ul>
  </form>
 
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
                <td> <form action="admin.php" method="post"> 
                    <input type="hidden" name="action"
                           value="addVisitor">
                    <input type="hidden" name="visitor_id"
                           value="<?php echo $visitor['visitor_id']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $visitor['employeeID']; ?>">
                    <input type="submit" value="Add">
                        <input type="hidden" name="action"
                           value="delete_visitor">
                    <input type="hidden" name="visitor_id"
                           value="<?php echo $visitor['visitor_id']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $visitor['employeeID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
                
            </tr>
            <?php endforeach; ?>
        </table> 
  <p>&nbsp;</p>
  <p>&nbsp;</p>

  <p>&nbsp;</p>
</section>

</body>
</html>

 <!--  -->
 
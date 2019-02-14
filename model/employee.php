<?php
 function getEmployees() {
        global $db;
        $query = 'SELECT * FROM employee
                  ORDER BY employeeID';
        $statement = $db->prepare($query);
        $statement->execute();
        $employees = $statement;
        
        return $employees;
    }
?>
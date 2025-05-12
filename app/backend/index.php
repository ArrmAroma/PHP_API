<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

try {
    $user = 'root';
    $pass = '';
    $dbh = new PDO('mysql:host=localhost;dbname=mydb', $user, $pass);
    $employee_data = array();

    foreach($dbh->query("SELECT e.employee_id, CONCAT(e.firstname, ' ', e.lastname) AS employee_title, d.department_name 
                     FROM employee e 
                     INNER JOIN department d ON e.department_id = d.department_id") as $row) {
        array_push($employee_data, array(
            'employee_id' => $row['employee_id'],
            'employee_title' => $row['employee_title'],
            'department_name' => $row['department_name']
        ));
    }
echo json_encode($employee_data);
} catch (PDOException $e) {
   echo "Server error: $e.getMessage()";
}
?>
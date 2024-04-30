<?php
include_once "db_connection.php";


$query = "SELECT 
            a.id AS account_id, 
            a.username, 
            r.role_name, 
            s.name AS status_name, 
            ap.id AS profile_id, 
            CONCAT(ap.firstname, ' ', ap.lastname) AS full_name, 
            g.gender_name, 
            ap.gmail
            FROM 
            account AS a
            JOIN 
            account_profile AS ap ON a.id = ap.id
            JOIN 
            role AS r ON a.role = r.id
            JOIN 
            status AS s ON a.status = s.id
            JOIN 
            gender AS g ON ap.gender = g.id
            Order by account_id ";
$result = mysqli_query($conn, $query);

$users = array();
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}


echo json_encode($users);
?>

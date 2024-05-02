<?php
include_once "db_connection.php";

// Query roles
$query_roles = "SELECT role_name FROM role";
$result_roles = mysqli_query($conn, $query_roles);
$roles = array();
while ($row = mysqli_fetch_assoc($result_roles)) {
    $roles[] = $row['role_name'];
}

// Query statuses
$query_statuses = "SELECT name FROM status";
$result_statuses = mysqli_query($conn, $query_statuses);
$statuses = array();
while ($row = mysqli_fetch_assoc($result_statuses)) {
    $statuses[] = $row['name'];
}

// Query users
$query_users = "SELECT 
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
                ORDER BY account_id";

$result_users = mysqli_query($conn, $query_users);

$users = array();
while ($row = mysqli_fetch_assoc($result_users)) {
    // Add available roles and statuses to each user
    $row['available_roles'] = $roles;
    $row['available_statuses'] = $statuses;
    $users[] = $row;
}

echo json_encode($users);
?>
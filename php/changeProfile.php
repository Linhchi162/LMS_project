<?php
session_start();
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $age = $_GET['age'];
    $gender = $_GET['gender'];
    $email = $_GET['email'];
    $phoneNumber = $_GET['phoneNumber'];

    if ($gender === 'Female') {
        $genderValue = 1;
    } elseif ($gender === 'Male') {
        $genderValue = 2;
    } else {
        $genderValue = 0;
    }

    $id = $_SESSION['user_id'];
    $sql = "UPDATE account_profile SET firstName=?, lastName=?, age=?, gender=?, gmail=?, description=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssi", $firstName, $lastName, $age, $genderValue, $email, $phoneNumber, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'age' => $age,
            'gender' => $gender,
            'email' => $email,
            'phoneNumber' => $phoneNumber
        ));
    } else {
        echo json_encode(array('error' => 'Failed to update profile.'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method.'));
}

$conn->close();
?>

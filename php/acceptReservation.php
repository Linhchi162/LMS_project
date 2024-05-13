<?php
include_once "db_connection.php";
include_once "get_user.php";

if ($_SESSION['user_role'] != '0') {
    echo json_encode(array("error" => "You don't have permission to access this page."));
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $reservation_id = $_GET['id'];

    // Prepare SQL statements with placeholders for book_id
    $sql_reservation = "UPDATE reservation SET reservation_status_id = 2 WHERE id = ?";

    // Prepare and execute SQL statements
    $stmt_reservation = $conn->prepare($sql_reservation);

    // Bind parameters
    $stmt_reservation->bind_param("i", $reservation_id);

    // Execute SQL statements
    $stmt_reservation->execute();

    // Check if both statements were successful
    if ($stmt_reservation->affected_rows > 0) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }

    // Close statements and connection
    $stmt_reservation->close();
    $conn->close();
} else {
    echo json_encode(['success' => false]);
}

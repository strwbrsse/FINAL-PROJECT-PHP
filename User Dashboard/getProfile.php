<?php
require_once 'DB_Connect.php';

session_start();
header('Content-Type: application/json');

$userId = $_SESSION['user_id'];

$query = "SELECT fname, mname, lname, birthday, mail, contact, address, barangay, sex, civilstat, employmentstat, employer, profession FROM Personal_Info WHERE personal_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["error" => "User not found."]);
}

$stmt->close();
$conn->close();
?>
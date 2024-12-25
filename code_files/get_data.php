<?php
// Connect to the database and prepare the SQL query
include ('connection.php');

// Fetch the user_date and am_pm data for the given student ID
$stmt = $conn->prepare('SELECT user_date, am_pm FROM collegestud WHERE ID = ?');
$stmt->bind_param('s', $_POST['ID']);
$stmt->execute();
$result = $stmt->get_result();

// Check if there is a row with the given student ID
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $data = array(
    'success' => true,
    'user_date' => $row['user_date'],
    'am_pm' => $row['am_pm']
  );
} else {
  $data = array(
    'success' => false,
    'error' => 'No data found for the given student ID'
  );
}

// Return the data as a JSON object
header('Content-Type: application/json');
echo json_encode($data);
?>

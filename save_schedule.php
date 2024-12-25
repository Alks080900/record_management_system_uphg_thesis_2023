<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
   echo 'error';
   exit;
}

extract($_POST);

if (empty($id)) {
   $sql = "INSERT INTO `schedule_list` (`title`,`description`,`start_datetime`,`end_datetime`) VALUES ('$title','$description','$start_datetime','$end_datetime')";
} else {$sql = "UPDATE schedule_list SET title='$title', description='$description', start_datetime='$start_datetime', end_datetime='$end_datetime' WHERE id='$id'";
}

$save = $conn->query($sql);

if ($save) {
echo "success";
} else {
echo "error";
}

$conn->close();

?>
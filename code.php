<?php 
require 'dbcon.php';

// Helper function to send JSON responses
function sendResponse($status, $message, $data = null) {
    $response = [
        'status' => $status,
        'message' => $message
    ];

    if (!is_null($data)) {
        $response['data'] = $data;
    }

    echo json_encode($response);
    exit();
}

// Save student logic
if (isset($_POST['save_student'])) {

    $name = trim(mysqli_real_escape_string($con, $_POST['name']));
    $email = trim(mysqli_real_escape_string($con, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($con, $_POST['phone']));
    $course = trim(mysqli_real_escape_string($con, $_POST['course']));

    // Validate fields
    if (empty($name) || empty($email) || empty($phone) || empty($course)) {
        sendResponse(422, 'All fields are mandatory');
    }

    // Use prepared statements for security
    $stmt = $con->prepare("INSERT INTO students (name, email, phone, course) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $course);

    if ($stmt->execute()) {
        sendResponse(200, 'Student Created Successfully.');
    } else {
        sendResponse(500, 'Student Not Created. Error: ' . $stmt->error);
    }
}

// Fetch student logic
if (isset($_GET['studentID'])) {

    $studentID = mysqli_real_escape_string($con, $_GET['studentID']);

    $stmt = $con->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
        sendResponse(200, 'Student Fetch Successfully', $student);
    } else {
        sendResponse(404, 'Student ID not found.');
    }
}

// Update student logic
if (isset($_POST['update_student'])) {

    $studentID = trim($_POST['stuid']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $course = trim($_POST['course']);

    // Validate fields
    if (empty($name) || empty($email) || empty($phone) || empty($course)) {
        sendResponse(422, 'All fields are mandatory');
    }

    // Use prepared statements for security
    $stmt = $con->prepare("UPDATE students SET name=?, email=?, phone=?, course=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $course, $studentID);

    if ($stmt->execute()) {
        sendResponse(200, 'Student Updated Successfully.');
    } else {
        sendResponse(500, 'Student Not Updated. Error: ' . $stmt->error);
    }
}


// Delete Student
if (isset($_POST['delete_student'])) {

    $studentID = mysqli_real_escape_string($con, $_POST['studentID']);

    $stmt = $con->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $studentID);

    if ($stmt->execute()) {
        sendResponse(200, 'Student Deleted Successfully.');
    } else {
        sendResponse(500, 'Student Not Deleted. Error: ' . $stmt->error);
    }
}

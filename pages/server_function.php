<?php
include_once '../db/db_conn.php';

if (isset($_POST['add_room'])) {
    $room_name = $_POST['room_name'];
    $occupy_num = $_POST['occupy_num'];
    $floor_belong = $_POST['floor_belong'];
    $status = $_POST['status'];

    if (isset($_FILES['staffformFile']) && $_FILES['staffformFile']['error'] == 0) {
        $uploadDir = 'assets/'; // Choose your upload directory
        $originalFileName = basename($_FILES['staffformFile']['name']);

        // Generate a random string (you can use any suitable method)
        $randomString = bin2hex(random_bytes(8));

        // Combine the random string and original file name
        $newFileName = $randomString . '_' . $originalFileName;
        $uploadFile = $uploadDir . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['staffformFile']['tmp_name'], $uploadFile)) {
            // File has been successfully uploaded
            $fileName = basename($_FILES['staffformFile']['name']); // Extract just the file name
        } else {
            // Handle file upload error
            $response['status'] = 500;
            $response['message'] = 'Error uploading file';
            echo json_encode($response);
            exit; // Stop further execution
        }
    } else {
        // No file was uploaded
        $uploadFile = null; // Set to a default value or handle as needed
    }

    $sql = "CALL addRoom(?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sisss", $room_name, $occupy_num, $floor_belong, $newFileName, $status);

    // Execute the statement
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Room added successfully'
        ];
        echo json_encode($res);
    } else {
        $error = $stmt->error;
        $res = [
            'status' => 500,
            'message' => 'Room not added successfully',
            'error' => $error
        ];
        echo json_encode($res);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}

if (isset($_POST['edit_room'])) {
    $room_name = $_POST['new_room_name'];
    $occupy_num = $_POST['new_occupy_num'];
    $floor_belong = $_POST['new_floor_belong'];
    $status = $_POST['new_status'];
    $room_id = $_POST['new_room_id'];
    $imageSrc = $_POST['imageSrc'];

    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] == 0) {
        $uploadDir = 'assets/'; // Choose your upload directory
        $originalFileName = basename($_FILES['fileInput']['name']);

        // Generate a random string (you can use any suitable method)
        $randomString = bin2hex(random_bytes(8));

        // Combine the random string and original file name
        $newFileName = $randomString . '_' . $originalFileName;
        $uploadFile = $uploadDir . $newFileName;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['fileInput']['tmp_name'], $uploadFile)) {
            // File has been successfully uploaded
            $fileName = basename($_FILES['fileInput']['name']); // Extract just the file name
        } else {
            // Handle file upload error
            $response['status'] = 500;
            $response['message'] = 'Error uploading file';
            echo json_encode($response);
            exit; // Stop further execution
        }
    } else {
        $newFileName = $imageSrc;
    }

    $sql = "CALL editRoom(?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("siissi", $room_name, $occupy_num, $floor_belong, $status, $newFileName, $room_id);

    // Execute the statement
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Room updated successfully'
        ];
        echo json_encode($res);
    } else {
        $error = $stmt->error;
        $res = [
            'status' => 500,
            'message' => 'Room not updated successfully',
            'error' => $error
        ];
        echo json_encode($res);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}

if (isset($_GET['view_room_id'])) {
    $room_id = $_GET['view_room_id'];

    $query = "SELECT * FROM room_details WHERE room_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $room_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Check for errors in the query execution
    if (!$result) {
        die('Error in query: ' . mysqli_error($conn));
    }

    // Check the number of rows
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_array($result);

        $res = [
            'status' => 200,
            'message' => 'Data fetched',
            'data' => $data
        ];
    } else {
        $res = [
            'status' => 404,
            'message' => 'Data not found'
        ];
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    echo json_encode($res);
}

if (isset($_POST['add_announcement'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "CALL addAnnouncement(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("ssss", $title, $description, $date, $time);

    // Execute the statement
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Announcement added successfully'
        ];
        echo json_encode($res);
    } else {
        $error = $stmt->error;
        $res = [
            'status' => 500,
            'message' => 'Announcement not added successfully',
            'error' => $error
        ];
        echo json_encode($res);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
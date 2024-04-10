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

    $query = "SELECT room_details.*, tenants.*, (room_details.occupy_num - COUNT(tenants.tenants_id)) AS available_occupation FROM room_details LEFT JOIN tenants ON room_details.room_id = tenants.room_id WHERE room_details.room_id = ? GROUP BY room_details.room_id";
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
            'message' => 'Data not found',
            'data' => $data
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

if (isset($_GET['view_announcement_id'])) {
    $id = $_GET['view_announcement_id'];

    $query = "SELECT * FROM announcements WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $id);
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

if (isset($_POST['edit_announcement'])) {
    $title = $_POST['title_edit'];
    $description = $_POST['description_edit'];
    $date = $_POST['date_edit'];
    $time = $_POST['time_edit'];
    $ann_id = $_POST['ann_id'];

    $sql = "CALL editAnnouncement(?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("ssssi", $title, $description, $date, $time, $ann_id);

    // Execute the statement
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Announcement edited successfully'
        ];
        echo json_encode($res);
    } else {
        $error = $stmt->error;
        $res = [
            'status' => 500,
            'message' => 'Announcement not edited successfully',
            'error' => $error
        ];
        echo json_encode($res);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}

if (isset($_GET['delete_announcement_id'])) {
    $id = $_GET['delete_announcement_id'];

    $query = "DELETE FROM announcements WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    // Check for errors in the query execution
    if (mysqli_stmt_errno($stmt) != 0) {
        $res = [
            'status' => 500,
            'message' => 'Error in query: ' . mysqli_stmt_error($stmt)
        ];
    } else {
        // Check the number of affected rows
        $affectedRows = mysqli_stmt_affected_rows($stmt);

        if ($affectedRows > 0) {
            $res = [
                'status' => 200,
                'message' => 'Announcement deleted',
                'affected_rows' => $affectedRows
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'Announcement not found or not deleted'
            ];
        }
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    echo json_encode($res);
}

if (isset($_GET['get_latest_room'])) {
    $id = $_GET['get_latest_room'];

    // Prepare the SQL statement with a parameter placeholder
    $query = "SELECT * FROM room_details WHERE floor_belong = ? ORDER BY room_id DESC LIMIT 1";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Check for errors in the query execution
    if (!$result) {
        die('Error in query: ' . mysqli_error($conn));
    }

    // Check the number of rows
    if (mysqli_num_rows($result) == 1) {
        // Fetch the data
        $data = mysqli_fetch_array($result);

        // Prepare response
        $res = [
            'status' => 200,
            'message' => 'Data fetched',
            'data' => $data
        ];
    } else {
        // Prepare response for no data found
        $res = [
            'status' => 404,
            'message' => 'Data not found'
        ];
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    // Output response as JSON
    echo json_encode($res);
}

if (isset($_POST['add_tenants'])) {
    $profileSelect = $_POST['profileSelect'];
    $userType = $_POST['userType'];
    $date = $_POST['date'];
    $roomSelect = $_POST['roomSelect'];
    $addFee = $_POST['addFee'];

    $sql = "CALL addTenants(?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("iisdi", $profileSelect, $userType, $date, $roomSelect, $addFee);

    // Execute the statement
    if ($stmt->execute()) {
        $res = [
            'status' => 200,
            'message' => 'Tenants added successfully'
        ];
        echo json_encode($res);
    } else {
        $error = $stmt->error;
        $res = [
            'status' => 500,
            'message' => 'Tenants not added successfully',
            'error' => $error
        ];
        echo json_encode($res);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}

if (isset($_POST['accept_payment'])) {
    $id = $_POST['id'];
    $status = "Accepted";

    $query = "UPDATE payments SET status = ? WHERE payment_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    mysqli_stmt_execute($stmt);

    // Check for errors in the query execution
    if (mysqli_stmt_errno($stmt) != 0) {
        $res = [
            'status' => 500,
            'message' => 'Error in query: ' . mysqli_stmt_error($stmt)
        ];
    } else {
        // Check the number of affected rows
        $affectedRows = mysqli_stmt_affected_rows($stmt);

        if ($affectedRows > 0) {
            $res = [
                'status' => 200,
                'message' => 'Payment accepted',
                'affected_rows' => $affectedRows
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'Payment not found or not accepted'
            ];
        }
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    echo json_encode($res);
}

if (isset($_POST['reject_payment'])) {
    $id = $_POST['id'];
    $status = "Rejected";

    $query = "UPDATE payments SET status = ? WHERE payment_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    mysqli_stmt_execute($stmt);

    // Check for errors in the query execution
    if (mysqli_stmt_errno($stmt) != 0) {
        $res = [
            'status' => 500,
            'message' => 'Error in query: ' . mysqli_stmt_error($stmt)
        ];
    } else {
        // Check the number of affected rows
        $affectedRows = mysqli_stmt_affected_rows($stmt);

        if ($affectedRows > 0) {
            $res = [
                'status' => 200,
                'message' => 'Payment Rejected',
                'affected_rows' => $affectedRows
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'Payment not found or not Rejected'
            ];
        }
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);

    echo json_encode($res);
}

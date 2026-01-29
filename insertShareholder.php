<?php
$conn = new mysqli('localhost', 'root', '', 'vendor_information');

if ($conn->connect_error) {
    http_response_code(500);
    exit("DB connection failed");
}

$table = $_POST['Table'];


if ($table === 'Shareholders'){
    $sql = "
    INSERT INTO shareholders
    (ShareHolderID, NewCompanyRegistration, time, nationality, name, address, share)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($sql);
    // assign to variables because bind_param requires variables (passed by reference)
    $shareHolderID = isset($_POST['ShareHolderID']) ? (int)$_POST['ShareHolderID'] : 0;
    $newCompanyRegistration = isset($_POST['NewCompanyRegistration']) ? (int)$_POST['NewCompanyRegistration'] : 0;
    $time = $_POST['time'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $share = isset($_POST['share']) ? (float)$_POST['share'] : 0.0;

    $stmt->bind_param(
        "iissssd",
        $shareHolderID,
        $newCompanyRegistration,
        $time,
        $nationality,
        $name,
        $address,
        $share
    );

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "id" => $_POST['ShareHolderID']
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "error" => $stmt->error
        ]);
    }
} else if($table === 'DirectorAndSecretary'){
    $sql = "
    INSERT INTO directorandsecretary
    (NewCompanyRegistration, time, nationality, name, position, appoitmentDate, DOB)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($sql);
    $newCompanyRegistration = isset($_POST['NewCompanyRegistration']) ? (int)$_POST['NewCompanyRegistration'] : 0;
    $time = $_POST['time'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $name = $_POST['name'] ?? '';
    $position = $_POST['position'] ?? '';
    $appoitmentDate = $_POST['appoitmentDate'] ?? '';
    $DOB = $_POST['DOB'] ?? '';

    $stmt->bind_param(
        "issssss",
        $newCompanyRegistration,
        $time,
        $nationality,
        $name,
        $position,
        $appoitmentDate,
        $DOB
    );

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "error" => $stmt->error
        ]);
    }
} else if($table === 'Management'){
    $sql = "
    INSERT INTO management
    (NewCompanyRegistration, time, nationality, name, position, yearsInPosition, yearsInRelatedField)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($sql);
    $newCompanyRegistration = isset($_POST['NewCompanyRegistration']) ? (int)$_POST['NewCompanyRegistration'] : 0;
    $time = $_POST['time'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $name = $_POST['name'] ?? '';
    $position = $_POST['position'] ?? '';
    $yearsInPosition = isset($_POST['yearsInPosition']) ? (int)$_POST['yearsInPosition'] : 0;
    $yearsInRelatedField = isset($_POST['yearsInRelatedField']) ? (int)$_POST['yearsInRelatedField'] : 0;

    $stmt->bind_param(
        "issssii",
        $newCompanyRegistration,
        $time,
        $nationality,
        $name,
        $position,
        $yearsInPosition,
        $yearsInRelatedField
    );

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "error" => $stmt->error
        ]);
    }
}

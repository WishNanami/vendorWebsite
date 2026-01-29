<?php
$conn = new mysqli('localhost', 'root', '', 'vendor_information');

if ($conn->connect_error) {
    http_response_code(500);
    exit("DB connection failed");
}

$table = $_POST['Table'];


if ($table === 'Shareholders'){
    $sql = "
    INSERT INTO Shareholders
    (ShareHolderID, NewCompanyRegistration, time, nationality, name, address, share)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "iissssd",
        $_POST['ShareHolderID'],
        $_POST['NewCompanyRegistration'],
        $_POST['time'],
        $_POST['nationality'],
        $_POST['name'],
        $_POST['address'],
        $_POST['share']
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
    INSERT INTO DirectorAndSecretary
    (NewCompanyRegistration, time, nationality, name, position, appoitmentDate, DOB)
    VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "issssss",
        $_POST['NewCompanyRegistration'],
        $_POST['time'],
        $_POST['nationality'],
        $_POST['name'],
        $_POST['position'],
        $_POST['appoitmentDate'],
        $_POST['DOB']
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
    $stmt->bind_param(
        "issssii",
        $_POST['NewCompanyRegistration'],
        $_POST['time'],
        $_POST['nationality'],
        $_POST['name'],
        $_POST['position'],
        $_POST['yearsInPosition'],
        $_POST['yearsInRelatedField']
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

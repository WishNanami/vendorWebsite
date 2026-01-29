<?php
$conn = new mysqli('localhost', 'root', '', 'vendor_information');

if ($conn->connect_error) {
    http_response_code(500);
    exit("DB connection failed");
}

$required = ['field', 'value', 'NewCompanyRegistration', 'time', 'Table', 'dataType'];
foreach ($required as $key) {
    if (!isset($_POST[$key])) {
        http_response_code(400);
        exit("Missing $key");
    }
}

$field   = $_POST['field'];
$value   = trim($_POST['value']);
$newCRN  = $_POST['NewCompanyRegistration'];
$time    = $_POST['time'];
$table   = $_POST['Table'];
$dataType = $_POST['dataType'];
$rowId = $_POST['rowId'];
$idName = $_POST['idName'];

$AllowedTables = [
    'Shareholders' => [
        'table' => 'shareholders',
        'fields' => ['ShareHolderID','name', 'nationality', 'address', 'share']
    ],
    'DirectorAndSecretary' => [
        'table' => 'directorandsecretary',
        'fields' => ['DirectorID','time', 'nationality', 'position', 'name','appoitmentDate','DOB']
    ],
    'Management' => [
        'table' => 'management',
        'fields' => ['ManagementID','time', 'nationality', 'yearsInPosition', 'name','yearsInRelatedField']
    ]
];

if (!isset($AllowedTables[$table])) {
    http_response_code(403);
    exit("Invalid table");
}

if (!in_array($field, $AllowedTables[$table]['fields'], true)) {
    http_response_code(403);
    exit("Invalid field");
}

$tableName = $AllowedTables[$table]['table'];

$sql = "UPDATE `$tableName`
        SET `$field` = ?
        WHERE `NewCompanyRegistration` = ? AND `time` = ? AND `$idName` = ?";

$stmt = $conn->prepare($sql);

if ($dataType === "number") {
    $value = (int)$value;
    $stmt->bind_param("issi", $value, $newCRN, $time, $rowId);
} else {
    $stmt->bind_param("sssi", $value, $newCRN, $time, $rowId);
}

$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Updated successfully";
} else {
    echo "No changes made";
}

$stmt->close();
$conn->close();

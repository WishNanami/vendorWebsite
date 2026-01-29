<?php
$conn = new mysqli('localhost', 'root', '', 'vendor_information');

if ($conn->connect_error) {
    http_response_code(500);
    exit("DB connection failed");
}

$ID = $_POST['ID'];
$NewCRN = $_POST['NewCompanyRegistration'];
$time = $_POST['time'];
$tableName = $_POST['Table'];
$idName = $_POST['idName'];

$deleteStmt = $conn->prepare("Delete From `$tableName` WHERE `NewCompanyRegistration` = ? AND `time` = ? AND `$idName` = ?;");
$deleteStmt->bind_param("isi", $NewCRN, $time, $ID);

if ($deleteStmt->execute()) {
    echo "success";
    echo $ID;
    echo $NewCRN;
    echo $tableName;
    echo $time;
} else {
    http_response_code(500);
    echo "error";
}
?>
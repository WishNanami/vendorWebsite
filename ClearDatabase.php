<?php
session_start();
$conn = new mysqli("localhost", "root", "", "vendor_information");

// Protect admin page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if (isset($_POST['clear_database'])){

    // Safety: Disable foreign key checks if you have relationships
    $conn ->query("SET FOREIGN_KEY_CHECKS = 0;");

    // Use TRUNCATE to wipe data and reset Auto-Increment counters
    $tablesToWipe = ['bank', 'contacts', 'creditfacilities', 'currentproject', 'directorandsecretary','equipmentused','management','nettworth','projecttrackrecord','registrationform','shareholders','staff'];
    
    foreach ($tablesToWipe as $table) {
        $sql = "TRUNCATE TABLE $table";
        if (!$conn->query($sql)) {
            echo "Error clearing $table: " . $conn->error . "<br>";
        }
    }

    $conn ->query("SET FOREIGN_KEY_CHECKS = 1;");
    echo "<script>alert(Database cleared successfully!)</script>";
    header("Location: admin.php");
    exit();
}
?>
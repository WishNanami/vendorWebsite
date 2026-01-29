<?php
$conn = new mysqli('localhost', 'root', '', 'vendor_information');

if ($conn->connect_error) {
    die("DB connection failed");
}

if (
    !isset($_POST['field'], $_POST['value'], $_POST['NewCompanyRegistration'], $_POST['time'], $_POST['Table'])
) {
    http_response_code(400);
    exit("Missing data");
}

$field  = $_POST['field'];
$value  = trim($_POST['value']);
$newCRN = $_POST['NewCompanyRegistration'];
$time   = $_POST['time'];
$table  = $_POST['Table'];
$dataType  = $_POST['dataType'];

//table data
$rowId = $_POST['rowId'];

/* ✅ ALLOWED TABLES */
$AllowedTables = [
    'RegistrationForm' => 'registrationform',
    'Bank' => 'bank',
    'Contacts' => 'contacts',
    'CreditFacilities' => 'creditfacilities',
    'CurrentProject' => 'currentproject',
    'DirectorAndSecretary' => 'directorandsecretary',
    'Equipment' => 'equipment',
    'Management' => 'management',
    'NettWorth' => 'nettworth',
    'ProjectTrackRecord' => 'projecttrackrecord',
    'Shareholders' => 'shareholders',
    'Staff' => 'staff'
];

/* ✅ ALLOWED FIELDS */
$RegistrationFields = [
    'companyName',
    'taxRegistrationNumber',
    'faxNo',
    'companyOrganisation',
    'OldCompanyRegistration',
    'otherNames',
    'telephoneNumber',
    'email',
    'EmailAddress',
    'website',
    'branch',
    'authorisedCapital',
    'paidUpCapital',
    'CountryOfIncorporation',
    'DateOfIncorporation',
    'NatureAndLineOfBusiness',
    'registeredAddress',
    'correspondenceAddress',
    'TypeOfOrganisation',
    'parentCompany',
    'parentCompanyCountry',
    'ultimateParentCompany',
    'ultimateParentCompanyCountry',
    'bankruptHistory',
    'discription',
    'CIDB',
    'CIDBValidationTill',
    'trade',
    'ValueOfSimilarProject',
    'ValueOfCurrentProject',
    'name',
    'designation',
    'DateOfVerification',
    'AuditorCompayName',
    'AuditorCompanyAddress',
    'AuditorName',
    'AuditorEmail',
    'AuditorPhone',
    'AdvocatesCompanyName',
    'AdvocatesCompanyAddress',
    'AdvocatesName',
    'AdvocatesEmail',
    'AdvocatesPhone',
    'AuditorYearOfService',
    'AdvocatesYearOfService',
    'Status'
];



if (!isset($AllowedTables[$table])) {
    exit("Invalid table");
}


if (!in_array($field, $RegistrationFields, true)) {
    exit("Invalid field");
}

$tableName = $AllowedTables[$table];

if ($tableName === 'registrationform'){
    $sql = "UPDATE `$tableName`
        SET `$field` = ?
        WHERE `NewCompanyRegistration` = ? AND `time` = ?";
    
    if($dataType == "text"){
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $value, $newCRN, $time);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Updated successfully";
        } else {
            echo "No changes made";
        }
    } else if($dataType == "number"){
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $value, $newCRN, $time);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Updated successfully";
        } else {
            echo "No changes made";
        }
    }

    if (!isset($_POST['dataType'])) {
        exit("Missing dataType");
    }
} else if ($tableName === 'shareholders'){
    $sql = "UPDATE `$tableName`
        SET `$field` = ?
        WHERE `NewCompanyRegistration` = ? AND `time` = ? AND `ShareHolderID` = ?";
    
    if($dataType == "text"){
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sisi", $value, $newCRN, $time, $rowId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Updated successfully";
        } else {
            echo "No changes made";
        }
    } else if($dataType == "number"){
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisi", $value, $newCRN, $time,$rowId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Updated successfully";
        } else {
            echo "No changes made";
        }
    }

    if (!isset($_POST['dataType'])) {
        exit("Missing dataType");
    }
}


var_dump($_POST);
exit;


?>
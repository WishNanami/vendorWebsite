<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <!--    css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendorStyle.css">
<?php

//connect to the database
$conn = new mysqli('localhost', 'root', '','vendor_information');


//primarykey
$newCRN = $_POST['newCRN'] ?? '';
$currentDate = date('Y-m-d');  // this is the current date not year
//normal data
$CompanyName = $_POST['CompanyName'] ?? '';
$tax = $_POST['tax'] ?? '';
$FaxNo = $_POST['FaxNo'] ?? '';

//conpanyOrganisation radio button
$companyOrganisation = $_POST['CompanyOrganisation'] ?? '';
    
$oldCRN = $_POST['oldCRN'] ?? '';
$OtherName = $_POST['OtherName'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$Email = $_POST['Email'] ?? '';
$EmailAddress = $_POST['EmailAddress'] ?? '';
$website = $_POST['Website'] ?? '';
$BranchAddress = $_POST['BranchAddress'] ?? '';
$AuthorisedCapital =$_POST['AuthorisedCapital'] ?? '';
$PaidUpCapital =$_POST['PaidUpCapital'] ?? '';
$CountryOfIncorporation =$_POST['CountryOfIncorporation'] ?? '';
$DateOfIncorporation =$_POST['DateOfIncorporation'] ?? '';
$NatureOfBusiness =$_POST['NatureOfBusiness'] ?? '';
$RegisteredAddress =$_POST['RegisteredAddress'] ?? '';
$CorrespondenceAddress =$_POST['CorrespondenceAddress'] ?? '';
$TypeOfOrganisation =$_POST['TypeOfOrganisation'] ?? '';
$ParentCompany =$_POST['ParentCompany'] ?? '';
$ParentCompanyCountry =$_POST['ParentCompanyCountry'] ?? '';
$UltimateParentCompany =$_POST['UltimateParentCompany'] ?? '';
$UParentCompanyCountry =$_POST['UParentCompanyCountry'] ?? '';

//bankrupt / bankrupt discription
$bankruptcy =$_POST['bankruptcy'] ?? '';
$bankruptcyDiscription = $_POST['bankruptcy-details'] ?? '';

$CIDB =$_POST['CIDB'] ?? '';
$CIDBValidityDate =$_POST['CIDBValidityDate'] ?? '';
$CIDBTrade =$_POST['CIDBTrade'] ?? '';
$ValueOfSimilarProject =$_POST['ValueOfSimilarProject'] ?? '';
$ValueOfCurrentProject =$_POST['ValueOfCurrentProject'] ?? '';

$name = $_POST['NameOfWritter'] ?? '';
$DesignationOfWritter = $_POST['DesignationOfWritter'] ?? '';
$DateOfWritting = $_POST['DateOfWritting'] ?? '';

$AuditorCompanyName = $_POST['AuditorCompanyName'] ?? '';
$AuditorCompanyAddress = $_POST['AuditorCompanyAddress'] ?? '';
$AuditorPersonName = $_POST['AuditorPersonName'] ?? '';
$AuditorPersonEmail = $_POST['AuditorPersonEmail'] ?? '';
$AuditorPersonPhone = $_POST['AuditorPersonPhone'] ?? '';

$AdvocatesCompanyName = $_POST['AdvocatesCompanyName'] ?? '';
$AdvocatesCompanyAddress = $_POST['AdvocatesCompanyAddress'] ?? '';
$AdvocatesPersonName = $_POST['AdvocatesPersonName'] ?? '';
$AdvocatesPersonEmail = $_POST['AdvocatesPersonEmail'] ?? '';
$AdvocatesPersonPhone = $_POST['AdvocatesPersonPhone'] ?? '';
$AuditorYearOfService = $_POST['AuditorYearOfService'] ?? '';
$AdvocatesYearOfService = $_POST['AdvocatesYearOfService'] ?? '';

//status
$Status = "pending";
        
if ($conn->connect_error) {
    die('Connection Failed : ' . $conn->connect_error);
}

$stmt = $conn->prepare("
    INSERT INTO registrationform (
        NewCompanyRegistration,
        time,
        companyName,
        taxRegistrationNumber,
        faxNo,
        companyOrganisation,
        OldCompanyRegistration,
        otherNames,
        telephoneNumber,
        email,
        EmailAddress,
        website,
        branch,
        authorisedCapital,
        paidUpCapital,
        CountryOfIncorporation,
        DateOfIncorporation,
        NatureAndLineOfBusiness,
        registeredAddress,
        correspondenceAddress,
        TypeOfOrganisation,
        parentCompany,
        parentCompanyCountry,
        ultimateParentCompany,
        ultimateParentCompanyCountry,
        bankruptHistory,
        discription,
        CIDB,
        CIDBValidationTill,
        trade,
        ValueOfSimilarProject,
        ValueOfCurrentProject,
        name,
        designation,
        DateOfVerification,
        AuditorCompayName,
        AuditorCompanyAddress,
        AuditorName,
        AuditorEmail,
        AuditorPhone,
        AdvocatesCompanyName,
        AdvocatesCompanyAddress,
        AdvocatesName,
        AdvocatesEmail,
        AdvocatesPhone,
        AuditorYearOfService,
        AdvocatesYearOfService,
        Status
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
");

$stmt->bind_param(
    "issiisisissssddsssssssssssssssddsssssssissssiiis",
    $newCRN,
    $currentDate,              // date as string
    $CompanyName,
    $tax,
    $FaxNo,
    $companyOrganisation,
    $oldCRN,
    $OtherName,
    $telephone,
    $Email,
    $EmailAddress,
    $website,
    $BranchAddress,
    $AuthorisedCapital,
    $PaidUpCapital,
    $CountryOfIncorporation,
    $DateOfIncorporation,
    $NatureOfBusiness,
    $RegisteredAddress,
    $CorrespondenceAddress,
    $TypeOfOrganisation,
    $ParentCompany,
    $ParentCompanyCountry,
    $UltimateParentCompany,
    $UParentCompanyCountry,
    $bankruptcy,
    $bankruptcyDiscription,
    $CIDB,
    $CIDBValidityDate,
    $CIDBTrade,
    $ValueOfSimilarProject,
    $ValueOfCurrentProject,
    $name,
    $DesignationOfWritter,
    $DateOfWritting,
    $AuditorCompanyName,
    $AuditorCompanyAddress,
    $AuditorPersonName,
    $AuditorPersonEmail,
    $AuditorPersonPhone,
    $AdvocatesCompanyName,
    $AdvocatesCompanyAddress,
    $AdvocatesPersonName,
    $AdvocatesPersonEmail,
    $AdvocatesPersonPhone,
    $AuditorYearOfService,
    $AdvocatesYearOfService,
    $Status
);


try {
    $stmt->execute()  
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Registration inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
} catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($stmt->error) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}

$stmt->close();


//inserting into bank table
$bankNames = $_POST['NameOfBank'] ?? [];
$AddressOfBank = $_POST['AddressOfBank'] ?? [];
$SwiftCodeOfBank = $_POST['SwiftCodeOfBank'] ?? [];

$BankStmt = $conn->prepare("INSERT INTO bank (NewCompanyRegistration,
time,
BankName,
BankAddress,
SWIFTCode
) VALUES (?,?,?,?,?)");

for ($i = 0; $i < count($bankNames); $i++){
    //skip empty
    if(
        empty($bankNames[$i]) &&
        empty($AddressOfBank[$i]) &&
        empty($SwiftCodeOfBank[$i])
    ){
        continue;
    }
    
    $BankStmt->bind_param(
        "issss",
        $newCRN,
        $currentDate,
        $bankNames[$i],
        $AddressOfBank[$i],
        $SwiftCodeOfBank[$i]
    );
    
    
    
    
}

try{
    $BankStmt->execute()
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Bank Data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
} catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($BankStmt->error) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}

$BankStmt->close();


//contacts
//primary
$PrimaryContactPerson = $_POST['PrimaryContactPerson'] ?? '';
$PrimaryDepartment = $_POST['PrimaryDepartment'] ?? '';
$PrimaryTelephone = $_POST['PrimaryTelephone'] ?? '';
$PrimaryEmail = $_POST['PrimaryEmail'] ?? '';
$PrimaryStatus = 'Primary';

//secondary
$SecondaryContactPerson = $_POST['SecondaryContactPerson'] ?? '';
$SecondaryDepartment = $_POST['SecondaryDepartment'] ?? '';
$SecondaryTelephone = $_POST['SecondaryTelephone'] ?? '';
$SecondaryEmail = $_POST['SecondaryEmail'] ?? '';
$SecondaryStatus = 'Secondary';

$ContactStmt = $conn->prepare("INSERT INTO contacts (NewCompanyRegistration,
time,
ContactPersonName,
department,
telephone,
email,
contactStatus
) VALUES (?,?,?,?,?,?,?)");

// Primary contact
$ContactStmt->bind_param(
    "isssiss",
    $newCRN,
    $currentDate, // or whatever date you use
    $PrimaryContactPerson,
    $PrimaryDepartment,
    $PrimaryTelephone,
    $PrimaryEmail,
    $PrimaryStatus
);

try { 
    $ContactStmt->execute() 
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        PrimaryContact Data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
} catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($ContactStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}

// Secondary contact
$ContactStmt->bind_param(
    "isssiss",
    $newCRN,
    $currentDate,
    $SecondaryContactPerson,
    $SecondaryDepartment,
    $SecondaryTelephone,
    $SecondaryEmail,
    $SecondaryStatus
);
        

try{ $ContactStmt->execute()  ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        SecondaryContact Data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
} catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($ContactStmt->error) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}

$ContactStmt->close();

//Credit Facilities
$TypeOfCredit = $_POST['TypeOfCredit'] ?? [];
$FinancialInstitution = $_POST['FinancialInstitution'] ?? [];
$CreditTotalAmount = $_POST['CreditTotalAmount'] ?? [];
$CreditUnutilisedAmount = $_POST['CreditUnutilisedAmount'] ?? [];
$CreditExpiryDate = $_POST['CreditExpiryDate'] ?? [];
$CreditAsAtDate = $_POST['CreditAsAtDate'] ?? [];

$CreditStmt = $conn->prepare("INSERT INTO Creditfacilities (
NewCompanyRegistration,
time,
typeOfCreditFaciliites,
financialInstitution,
totalAmount,
expirydate,
unutilesedAmountCurrentlyAvailable,
asAtDate
) VALUES (?,?,?,?,?,?,?,?)");

for ($i = 0; $i < count($TypeOfCredit); $i++){
    //skip empty
    if(
        empty($TypeOfCredit[$i]) &&
        empty($FinancialInstitution[$i]) &&
        empty($CreditTotalAmount[$i]) &&
        empty($CreditUnutilisedAmount[$i]) &&
        empty($CreditExpiryDate[$i]) &&
        empty($CreditAsAtDate[$i])
    ){
        continue;
    }
    
    $CreditStmt->bind_param(
        "isssdsds",
        $newCRN,                    //i
        $currentDate,               //s
        $TypeOfCredit[$i],          //s
        $FinancialInstitution[$i],  //s
        $CreditTotalAmount[$i],     //d
        $CreditExpiryDate[$i],      //s
        $CreditUnutilisedAmount[$i],//d
        $CreditAsAtDate[$i]         //s
    );
    
    
    try{ $CreditStmt->execute()  ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Credit data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
} catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($CreditStmt->error) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}

$CreditStmt->close();
    
//CurrentProject
$CurrentProjectNo       = $_POST['CurrentProjectNo'] ?? [];
$CurrentProjTitle       = $_POST['CurrentProjTitle'] ?? [];
$CurrentPorjNature      = $_POST['CurrentPorjNature'] ?? [];
$CurrentProjLocation    = $_POST['CurrentProjLocation'] ?? [];
$CurrentProjName        = $_POST['CurrentProjName'] ?? [];
$CurrentProjValue       = $_POST['CurrentProjValue'] ?? [];
$CurrentProjStartDate   = $_POST['CurrentProjStartDate'] ?? [];
$CurrentProjEndDate     = $_POST['CurrentProjEndDate'] ?? [];
$CurrentProjProgress    = $_POST['CurrentProjProgress'] ?? [];

$ProjectStmt = $conn->prepare("
    INSERT INTO currentProject (
        CurrentprojectNo,
        NewCompanyRegistration,
        time,
        projectTitle,
        projectNature,
        location,
        clientName,
        projectValue,
        commencement,
        completionDate,
        progressOfTheWork
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?)
");

for ($i = 0; $i < count($CurrentProjectNo); $i++) {

    // Skip empty rows
    if (
        empty($CurrentProjectNo[$i]) &&
        empty($CurrentProjTitle[$i]) &&
        empty($CurrentPorjNature[$i])
    ) {
        continue;
    }

    $ProjectStmt->bind_param(
        "iisssssdssd",
        $CurrentProjectNo[$i],
        $newCRN,
        $currentDate,
        $CurrentProjTitle[$i],     
        $CurrentPorjNature[$i],    
        $CurrentProjLocation[$i],  
        $CurrentProjName[$i],      
        $CurrentProjValue[$i],     
        $CurrentProjStartDate[$i], 
        $CurrentProjEndDate[$i],   
        $CurrentProjProgress[$i]   
    );

    try{
        $ProjectStmt->execute()
        ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Current Project statement inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
} catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($ProjectStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}
$ProjectStmt->close();

//director and secretary
$DirectorName             = $_POST['DirectorName'] ?? [];
$DirectorNationality      = $_POST['DirectorNationality'] ?? [];
$DirectorPosition         = $_POST['DirectorPosition'] ?? [];
$DirectorAppointmentDate  = $_POST['DirectorAppointmentDate'] ?? [];
$DirectorDOB              = $_POST['DirectorDOB'] ?? [];

$DirectorStmt = $conn->prepare("
    INSERT INTO directorandsecretary (
        NewCompanyRegistration,
        time,
        nationality,
        name,
        position,
        appoitmentDate,
        DOB
    ) VALUES (?,?,?,?,?,?,?)
");

for ($i = 0; $i < count($DirectorName); $i++) {

    // Skip empty rows
    if (
        empty($DirectorName[$i]) &&
        empty($DirectorNationality[$i]) &&
        empty($DirectorPosition[$i])
    ) {
        continue;
    }

    $DirectorStmt->bind_param(
        "issssss",
        $newCRN,                          // i
        $currentDate,                     // s
        $DirectorNationality[$i],         // s
        $DirectorName[$i],                // s
        $DirectorPosition[$i],            // s
        $DirectorAppointmentDate[$i],     // s
        $DirectorDOB[$i]                  // s
    );

    
    try{
        $DirectorStmt->execute()
        ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Director data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
} catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($DirectorStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}

$DirectorStmt->close();




//equipment
$EquipmentStmt = $conn->prepare("
    INSERT INTO equipment (
        equipmentID,
        NewCompanyRegistration,
        time,
        quantity,
        brand,
        rating,
        ownership,
        yearsOfManufacture,
        registrationNo
    ) VALUES (?,?,?,?,?,?,?,?,?)
");

$equipmentData = [
    [
        'equipmentID' => 1,
        'quantity' => $_POST['BobcatQuality'] ?? '',
        'brand'    => $_POST['BobcatBrandModel'] ?? '',
        'rating'   => $_POST['BobcatRating'] ?? '',
        'owner'    => $_POST['BobcatOwnership'] ?? '',
        'year'     => $_POST['BobcatYearOfManufacture'] ?? '',
        'reg'      => $_POST['BobcatRegistrationNo'] ?? ''
    ],
    [
        'equipmentID' => 2,
        'quantity' => $_POST['HDDQuality'] ?? '',
        'brand'    => $_POST['HDDBrandModel'] ?? '',
        'rating'   => $_POST['HDDRating'] ?? '',
        'owner'    => $_POST['HDDOwnership'] ?? '',
        'year'     => $_POST['HDDYearOfManufacture'] ?? '',
        'reg'      => $_POST['HDDRegistrationNo'] ?? ''
    ],
    [
        'equipmentID' => 3,
        'quantity' => $_POST['SplicingQuality'] ?? '',
        'brand'    => $_POST['SplicingBrandModel'] ?? '',
        'rating'   => $_POST['SplicingRating'] ?? '',
        'owner'    => $_POST['SplicingOwnership'] ?? '',
        'year'     => $_POST['SplicingYearOfManufacture'] ?? '',
        'reg'      => $_POST['SplicingRegistrationNo'] ?? ''
    ],
    [
        'equipmentID' => 4,
        'quantity' => $_POST['OPMQuality'] ?? '',
        'brand'    => $_POST['OPMBrandModel'] ?? '',
        'rating'   => $_POST['OPMRating'] ?? '',
        'owner'    => $_POST['OPMOwnership'] ?? '',
        'year'     => $_POST['OPMYearOfManufacture'] ?? '',
        'reg'      => $_POST['OPMRegistrationNo'] ?? ''
    ],
    [
        'equipmentID' => 5,
        'quantity' => $_POST['OTDRQuality'] ?? '',
        'brand'    => $_POST['OTDRBrandModel'] ?? '',
        'rating'   => $_POST['OTDRRating'] ?? '',
        'owner'    => $_POST['OTDROwnership'] ?? '',
        'year'     => $_POST['OTDRYearOfManufacture'] ?? '',
        'reg'      => $_POST['OTDRRegistrationNo'] ?? ''
    ],
    [
        'equipmentID' => 6,
        'quantity' => $_POST['TestGearQuality'] ?? '',
        'brand'    => $_POST['TestGearBrandModel'] ?? '',
        'rating'   => $_POST['TestGearRating'] ?? '',
        'owner'    => $_POST['TestGearOwnership'] ?? '',
        'year'     => $_POST['TestGearYearOfManufacture'] ?? '',
        'reg'      => $_POST['TestGearRegistrationNo'] ?? ''
    ]
];

foreach ($equipmentData as $eq) {

    // Skip completely empty rows
    if (
        empty($eq['quantity']) &&
        empty($eq['brand']) &&
        empty($eq['rating'])
    ) {
        continue;
    }

    $EquipmentStmt->bind_param(
        "iisisdssi",
        $eq['equipmentID'],         // i (equipmentID)
        $newCRN,                 // i
        $currentDate,            // s (DATE)
        $eq['quantity'],         // i
        $eq['brand'],            // s
        $eq['rating'],           // d (double ok as string)
        $eq['owner'],            // s
        $eq['year'],             // s (DATE)
        $eq['reg']               // i
    );

    
    try{ 
        $EquipmentStmt->execute()  
        ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Equipment data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
    } catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($EquipmentStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}

$EquipmentStmt->close();

//Management
$ManagementName              = $_POST['MangementName'] ?? [];
$ManagementNationality       = $_POST['ManagementNationality'] ?? [];
$ManagementPosition          = $_POST['ManagementPosition'] ?? [];
$ManagementYearsInPosition   = $_POST['ManagementYearInPosition'] ?? [];
$ManagementYearsInIndustry   = $_POST['ManagementYearsInIndustry'] ?? [];

$ManagementStmt = $conn->prepare("
    INSERT INTO management (
        NewCompanyRegistration,
        time,
        nationality,
        name,
        position,
        yearsInPosition,
        yearsInRelatedField
    ) VALUES (?,?,?,?,?,?,?)
");

for ($i = 0; $i < count($ManagementName); $i++) {

    // Skip empty rows
    if (
        empty($ManagementName[$i]) &&
        empty($ManagementNationality[$i]) &&
        empty($ManagementPosition[$i])
    ) {
        continue;
    }

    $ManagementStmt->bind_param(
        "issssii",
        $newCRN,                          // i
        $currentDate,                     // s (DATE)
        $ManagementNationality[$i],        // s
        $ManagementName[$i],               // s
        $ManagementPosition[$i],           // s
        $ManagementYearsInPosition[$i],    // i
        $ManagementYearsInIndustry[$i]     // i
    );

    
    try{ 
        $ManagementStmt->execute()
        ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Management data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
    } catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($ManagementStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}

$ManagementStmt->close();


//nett worth and working capital
$totalLiabilities = $_POST['totalLiabilities'] ?? [];
$totalAssets      = $_POST['totalAssets'] ?? [];
$NetWorth         = $_POST['NetWorth'] ?? [];
$WorkingCapital   = $_POST['WorkingCapital'] ?? [];

$FinanceStmt = $conn->prepare("
    INSERT INTO nettworth (
        NewCompanyRegistration,
        time,
        YearOf,
        TotalLiabilities,
        TotalAssets,
        NetWorth,
        WorkingCapital
    ) VALUES (?,?,?,?,?,?,?)
");

foreach ($totalLiabilities as $year => $liability) {

    // Skip empty rows
    if (
        empty($liability) &&
        empty($totalAssets[$year]) &&
        empty($NetWorth[$year]) &&
        empty($WorkingCapital[$year])
    ) {
        continue;
    }
    
    $totalAssets = $totalAssets[$year] ?? 0;
    $NetWorth = $NetWorth[$year] ?? 0;
    $WorkingCapital = $WorkingCapital[$year] ?? 0;
    
    $FinanceStmt->bind_param(
        "isidddd",
        $newCRN,                         // i
        $currentDate,                    // s (DATE)
        $year,                           // i (YEAR)
        $liability,                      // d
        $totalAssets,        // d
        $NetWorth,           // d
        $WorkingCapital      // d
    );

    
    try{ $FinanceStmt->execute() ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Nett worth & working capital data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
    } catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($FinanceStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}

$FinanceStmt->close();


//current project tracking
$ProjectRecordNo        = $_POST['ProjectRecordNo'] ?? [];
$ProjectTitle           = $_POST['ProjectTitle'] ?? [];
$ProjectNature          = $_POST['ProjectNature'] ?? [];
$ProjectLocation        = $_POST['ProjectLocation'] ?? [];
$ProjectClientName      = $_POST['ProjectClientName'] ?? [];
$ProjectValue           = $_POST['ProjectValue'] ?? [];
$ProjectCommencement    = $_POST['ProjectCommencementDate'] ?? [];
$ProjectCompletion      = $_POST['ProjectCompletionDate'] ?? [];

$ProjectStmt = $conn->prepare("
    INSERT INTO projecttrackrecord (
        projectRecordNo,
        NewCompanyRegistration,
        time,
        projectTitle,
        projectNature,
        location,
        clientName,
        projectValue,
        commencement,
        completionDate
    ) VALUES (?,?,?,?,?,?,?,?,?,?)
");

for ($i = 0; $i < count($ProjectRecordNo); $i++) {

    // Skip empty rows
    if (
        empty($ProjectTitle[$i]) &&
        empty($ProjectNature[$i]) &&
        empty($ProjectLocation[$i])
    ) {
        continue;
    }

    $ProjectStmt->bind_param(
        "iisssssdss",
        $ProjectRecordNo[$i],       // i
        $newCRN,                    // i
        $currentDate,               // s (DATE)
        $ProjectTitle[$i],          // s
        $ProjectNature[$i],         // s
        $ProjectLocation[$i],       // s
        $ProjectClientName[$i],     // s
        $ProjectValue[$i],          // d
        $ProjectCommencement[$i],   // s (DATE)
        $ProjectCompletion[$i]      // s (DATE)
    );

    
    try{ $ProjectStmt->execute() ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Project record data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
    } catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($ProjectStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}

$ProjectStmt->close();


//share holders
$ShareholderName        = $_POST['ShareholderName'] ?? [];
$ShareholderNationality = $_POST['ShareholderNationality'] ?? [];
$ShareholderIDNo        = $_POST['ShareholderID'] ?? [];
$ShareholderAddress     = $_POST['ShareholderAddress'] ?? [];
$ShareholderPercent     = $_POST['ShareholderPercent'] ?? [];

$ShareholderStmt = $conn->prepare("
    INSERT INTO shareholders (
        ShareHolderID,
        NewCompanyRegistration,
        time,
        nationality,
        name,
        address,
        share
    ) VALUES (?,?,?,?,?,?,?)
");

for ($i = 0; $i < count($ShareholderName); $i++) {

    // Skip empty rows
    if (
        empty($ShareholderName[$i]) &&
        empty($ShareholderNationality[$i]) &&
        empty($ShareholderPercent[$i])
    ) {
        continue;
    }

    $ShareholderStmt->bind_param(
        "iissssd",
        $ShareholderIDNo,
        $newCRN,                         // i
        $currentDate,                    // s (DATE)
        $ShareholderNationality[$i],     // s
        $ShareholderName[$i],            // s
        $ShareholderAddress[$i],         // s
        $ShareholderPercent[$i]          // d
    );

    try{ $ShareholderStmt->execute()  ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Shareholder data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
    } catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($ShareholderStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}

$ShareholderStmt->close();



//on site staff
$StaffNo              = $_POST['StaffNo'] ?? [];
$StaffName            = $_POST['StaffName'] ?? [];
$StaffDesignation     = $_POST['StaffDesignation'] ?? [];
$StaffQualification   = $_POST['StaffQualification'] ?? [];
$StaffEmployment      = $_POST['StaffEmploymentStatus'] ?? [];
$StaffSkills          = $_POST['StaffSkills'] ?? [];
$StaffCertification   = $_POST['StaffCertification'] ?? [];
$StaffExperience      = $_POST['StaffExperience'] ?? [];

$StaffStmt = $conn->prepare("
    INSERT INTO staff (
        staffNO,
        NewCompanyRegistration,
        time,
        name,
        designation,
        qualification,
        yearsOfExperience,
        employmentStatus,
        skills,
        ReleventCertification
    ) VALUES (?,?,?,?,?,?,?,?,?,?)
");

for ($i = 0; $i < count($StaffNo); $i++) {

    // Skip empty rows
    if (
        empty($StaffName[$i]) &&
        empty($StaffDesignation[$i]) &&
        empty($StaffQualification[$i])
    ) {
        continue;
    }

    $StaffStmt->bind_param(
        "iissssisss",
        $StaffNo[$i],               // i
        $newCRN,                    // i
        $currentDate,               // s (DATE)
        $StaffName[$i],             // s
        $StaffDesignation[$i],      // s
        $StaffQualification[$i],    // s
        $StaffExperience[$i],       // i
        $StaffEmployment[$i],       // s
        $StaffSkills[$i],           // s
        $StaffCertification[$i]     // s
    );

    try{ $StaffStmt->execute()  ?> 
    <div class="input-group mb-3">
        <span class="form-control text-success">
        Staff team data inserted successfully
        </span>
        <span class="input-group-text text-success">✓</span>
    </div>
        
        <?php
    } catch(mysqli_sql_exception $e) {
    ?> 
    <div class="input-group mb-3">
        <span class="form-control text-danger">
        Insert failed: <?= htmlspecialchars($StaffStmt->execute()) ?>
        </span>
        <span class="input-group-text text-danger">✗</span>
    </div>
        
        <?php
}
}

$StaffStmt->close();

$conn->close();
?>
<div class="pending-box">Pending Approval...</div>
</body>
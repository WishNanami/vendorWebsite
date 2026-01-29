<!DOCTYPE html>
<html>
<head>
    <title>Vendor Information Form</title>
    
</head>
<body>
<!--    css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendorStyle.css" rel="stylesheet">
    
    <img src="Image/company%20logo.png" class="rounded mx-auto d-block" alt="Company Logo" style="width: 150px;">
    <div><center><b>CIVIL CONTRACTOR REGISTRATION FORM</b><br>
    (For all information given below, documentary evidence shall be submitted)  
    </center></div>
    
    <div class="accordion" id="accordionExample">
    <form action="insertData.php" method="post">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Part A: Particulars of Company</button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
        <div class="grid-row">
            <div class="grid-column">
                <label for="CompanyName">Company Name</label>
                <input type="text" name="CompanyName" id="CompanyName" required>
            </div>
            <div class="grid-column">
            <label for="telephone">Telephone No</label>
            <input type="number" name="telephone" id="telephone" required>
            </div>
        </div>
        <div class="grid-row">
            <div class="grid-column">
                <label for="OtherName">Other Name (Any previous Legal Name/Trading Names)</label>
                <input type="text" name="OtherName" id="OtherName">
            </div>

            <div class="grid-column">
                <label for="tax">Tax Registration Number</label>
                <input type="number" name="tax" id="tax" required>
            </div>
        </div>
        <div class="grid-row">
            <div class="grid-column">
                <label for="newCRN">Company Registration No (new)</label>
                <input type="number" name="newCRN" id="newCRN" required>
            </div>
            <div class="grid-column">
                <label for="FaxNo">Fax No</label>
                <input type="number" name="FaxNo" id="FaxNo" required>
            </div>
        </div>
        <div class="grid-row">
            <div class="grid-column">
                <label for="oldCRN">Company Registration No (old)</label>
                <input type="number" name="oldCRN" id="oldCRN">
            </div>
            <div class="grid-column">
                <label for="Email">Email</label>
                <input type="Email" name="Email" id="Email" required>
            </div>
        </div>
        <div class="grid-row">
            <div class="grid-column">
                <label for="CountryOfIncorporation">Country of Incorporation</label>
                <input type="text" name="CountryOfIncorporation" id="CountryOfIncorporation" required>
            </div>
            <div class="grid-column">
                <label for="DateOfIncorporation">Date of incorporation</label>
                <input type="date" name="DateOfIncorporation" id="DateOfIncorporation" required>
            </div>
        </div >
        <div class="grid-row">
            <div class="grid-column">
                <label for="CompanyOrganisation">Comapany Organisation</label>
                <div class="grid-row-radio">
                    <label class="radio-item">
                        <input type="radio" name="CompanyOrganisation" value="More than 15" required>
                        <span>More than 15</span>
                    </label>

                    <label class="radio-item">
                        <input type="radio" name="CompanyOrganisation" value="10 - 15">
                        <span>10 - 15</span>
                    </label>

                    <label class="radio-item">
                        <input type="radio" name="CompanyOrganisation" value="5 - 10">
                        <span>5 - 10</span>
                    </label>

                    <label class="radio-item">
                        <input type="radio" name="CompanyOrganisation" value="Less than 5">
                        <span>Less than 5 supervisory, skilled and unskilled workers</span>
                    </label>
                </div>

            </div>
            <div class="grid-column">
                <label for="NatureOfBusiness">nature and line of Business</label>
                <input type="text" name="NatureOfBusiness" id="NatureOfBusiness" required>
            </div>
        </div>
        <div class="grid-row-full-width">
        <div class="grid-column-full-width">
            <label for="RegisteredAddress">Registered Address</label>
            <input type="text" name="RegisteredAddress" id="RegisteredAddress" required>
        </div>
        </div>
        <div class="grid-row-full-width">
        <div class="grid-column-full-width">
            <label for="CorrespondenceAddress">Correspondence/Business Address</label>
            <input type="text" name="CorrespondenceAddress" id="CorrespondenceAddress" required>
        </div>
        </div>
        <div class="grid-row-full-width">
            <div class="grid-column-full-width">
                <label for="TypeOfOrganisation">Type of Organisation</label>
                <div>
                <input type="radio" name="TypeOfOrganisation" id="Berhad" value="Berhad" required>
                <label for="Berhad">Berhad</label>
                <input type="radio" name="TypeOfOrganisation" id="Sdn Bhd" value="Sdn Bhd">
                <label for="Sdn Bhd">Sdn Bhd</label>
                <input type="radio" name="TypeOfOrganisation" id="sole Proprietor/Enterprise" value="sole Proprietor/Enterprise">
                <label for="sole Proprietor/Enterprise">sole Proprietor/Enterprise</label>
                </div>
            </div>
        </div>
        <div class="grid-row">
        <div class="grid-column">
            <label for="EmailAddress">Email Address</label>
            <input type="email" name="EmailAddress" id="EmailAddress" required>
        </div>
        <div class="grid-column">
            <label for="Website">Website</label>
            <input type="text" name="Website" id="Website" required>
        </div>
        </div>
        <div class="grid-row-full-width">
        <div class="grid-column-full-width">
            <label for="BranchAddress">Branch Address (if any)</label>
            <input type="text" name="BranchAddress" id="BranchAddress">
        </div>
        </div>
        <div class="grid-row">
        <div class="grid-column">
            <label for="AuthorisedCapital">Authorised Capital</label>
            <input type="number" name="AuthorisedCapital" id="AuthorisedCapital" required>
        </div>
        <div class="grid-column">
            <label for="PaidUpCapital">Paid-up Capital</label>
            <input type="number" name="PaidUpCapital" id="PaidUpCapital" required>
        </div>
        </div>
                </div>
                </div>
        </div>
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><label>Part B: Particulars of Shareolders</label></button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
        <div class="grid-row">
            <div class="grid-column">
                <label for="ParentCompany">Parent Company(Full Legal Name)</label>
                <input type="text" name="ParentCompany" id="ParentCompany" required>
            </div>
            <div class="grid-column">
                <label for="ParentCompanyCountry">Country</label>
                <input type="text" name="ParentCompanyCountry" id="ParentCompanyCountry" required>
            </div>
        </div>
        <div class="grid-row">
            <div class="grid-column">
                <label for="UltimateParentCompany">Ultimate Parent Company(Full Legal Name)</label>
                <input type="text" name="UltimateParentCompany" id="UltimateParentCompany" required>
            </div>
            <div class="grid-column">
                <label for="UParentCompanyCountry">Country</label>
                <input type="text" name="UParentCompanyCountry" id="UParentCompanyCountry" required>
            </div>
        </div>
        <table id="shareholderTable">
            <tr>
                <th>ID / Registration Number</th>
                <th>Name (Individual/Company)</th>
                <th>Nationality / Jurisdiction</th>
                <th>Address</th>
                <th>% of shares</th>
            </tr>
            <tr>
                <td><input type="number" name="ShareholderID[]" step="1"></td>
                <td><input type="text" name="ShareholderName[]"></td>
                <td><input type="text" name="ShareholderNationality[]"></td>
                <td><input type="text" name="ShareholderAddress[]"></td>
                <td><input type="number" name="ShareholderPercent[]" step="0.01"></td>
                <td>
                <button type="button" onclick="deleteRow(this)">Delete</button>
                </td>
            </tr>
        </table>
        <div><button type="button" onclick="addShareholders()">Add</button></div>
                </div></div></div>
            
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><label>Part C : Particulars of Directors & Company Secretery</label></button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <table id ="DirectorTable">
            <tr>
                <th>Name</th>
                <th>Nationality/ Jurisdiction</th>
                <th>Position (Company Secretary/ Independent Director/ Non-Independent Director)</th>
                <th>Appointment Date</th>
                <th>Date of Birth</th>
            </tr>
            <tr>
                <td><input type="text" name="DirectorName[]"></td>
                <td><input type="text" name="DirectorNationality[]"></td>
                <td><input type="text" name="DirectorPosition[]"></td>
                <td><input type="date" name="DirectorAppointmentDate[]"></td>
                <td><input type="date" name="DirectorDOB[]"></td>
                <td><button type="button" onclick="deleteRow(this)">Delete</button></td>
            </tr>
        </table>
        <div><button type="button" onclick="addDirector()">Add</button></div>
        </div>
        </div>
        </div>
        
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <label>Part D : Management of Company</label></button></h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
            <div class="accordion-body">
        <table id ="ManagementTable">
            <tr>
                <th>Name</th>
                <th>Nationality/ Jurisdiction</th>
                <th>Position</th>
                <th>Years in Position</th>
                <th>Years in Industry/ Related Field</th>
            </tr>
            <tr>
                <td><input type="text" name="MangementName[]"></td>
                <td><input type="text" name="ManagementNationality[]"></td>
                <td><input type="text" name="ManagementPosition[]"></td>
                <td><input type="number" min="0" max="99" name="ManagementYearInPosition[]"></td>
                <td><input type="number" min="0" max="99" name="ManagementYearsInIndustry[]"></td>
                <td><button type="button" onclick="deleteRow(this)">Delete</button></td>
            </tr>
        </table>
        <div><button type="button" onclick="addManagement()">Add</button></div>
            </div></div></div>
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"><Label>Part E: Particulars of Finance</Label></button></h2>
        
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
            <div class="accordion-body">
        <div><label for="bankruptcy">Does the Company have history of backruptcy?</label></div>
        
        <div><input type="radio" name="bankruptcy" id="bankrupt-yes" value="yes" onclick="bankruptYes()" required>
        <label for="bankrupt-yes">yes</label></div>
        
        <div><input type="radio" name="bankruptcy" id="bankrupt-no" value="no" onclick="bankruptNO()">
        <label for="bankrupt-no">no</label></div>
        
        <div id="bankruptcy-details" style="display: none;">
            <div><label for="details">Please provide a brief description on the bankruptcy</label></div>
            <div>
            <input type="text" id="details" name="bankruptcy-details" style="width: 100%;">
            </div></div>

        <div>
        <p>Please provide <u>3 most recent </u>annual Audited Financial Statements (Statements of Financial Position, Income Statement and Cash Flow Statement) including Director’s report/ Auditor’s report/ Note to the Financial Statements with Disclosure of Commitment & Contingent Liability</p>
        </div>
        <div>
        <table>
            <tr>
                <th></th>
                <th colspan="2">Company</th>
                <th colspan="2">Contact Person</th>
                <th>Year of Service</th>
            </tr>
            <tr>
                <td rowspan="3">Auditors</td>
                <td><label for="AuditorCompanyName">Name</label>
                </td>
                <td><input type="text" name="AuditorCompanyName" id="AuditorCompanyName" required></td>
                <td><label for="AuditorPersonName">Name</label>
                </td>
                <td><input type="text" name="AuditorPersonName" id="AuditorPersonName" required></td>
                <td><input type="number" min="1" max="100" step="1" required></td>
            </tr>
            <tr>
                <td rowspan="2"><label for="AuditorCompanyAddress">Address</label>
                </td>
                <td rowspan="2"><input type="text" name="AuditorCompanyAddress" id="AuditorCompanyAddress" required></td>
                <td><label for="AuditorPersonEmail">Email</label>
                </td>
                <td><input type="email" name="AuditorPersonEmail" id="AuditorPersonEmail" required></td>
                <td><input type="number" min="1" max="100" step="1"></td>
            </tr>
            <tr>
                <td><label for="AuditorPersonPhone">Phone</label>
                </td>
                <td><input type="text" name="AuditorPersonPhone" id="AuditorPersonPhone" required></td>
                <td><input type="number" min="1" max="100" step="1"></td>
            </tr>
            <tr>
                <td rowspan="3">Advocates & Solicitors</td>
                <td><label for="AdvocatesCompanyName">Name</label>
                </td>
                <td><input type="text" name="AdvocatesCompanyName" id="AdvocatesCompanyName" required></td>
                <td><label for="AdvocatesPersonName">Name</label>
                </td>
                <td><input type="text" name="AdvocatesPersonName" id="AdvocatesPersonName" required></td>
                <td><input type="number" min="1" max="100" step="1" name="AuditorYearOfService" required></td>
            </tr>
            <tr>
                <td rowspan="2"><label for="AdvocatesCompanyAddress">Address</label>
                </td>
                <td rowspan="2"><input type="text" name="AdvocatesCompanyAddress" id="AdvocatesCompanyAddress" required></td>
                <td><label for="AdvocatesPersonEmail">Email</label>
                </td>
                <td><input type="email" name="AdvocatesPersonEmail" id="AdvocatesPersonEmail" required></td>
                <td><input type="number" min="1" max="100" step="1"></td>
            </tr>
            <tr>
                <td><label for="AdvocatesPersonPhone">Phone</label>
                </td>
                <td><input type="text" name="AdvocatesPersonPhone" id="AdvocatesPersonPhone" required></td>
                <td><input type="number" min="1" max="100" step="1" name="AdvocatesYearOfService"></td>
            </tr>
        </table>
        </div>
                <br>
        <div>
        <table id="bankTable">
            <tr>
                <th>Name of the Bank</th>
                <th>Address of the Bank</th>
                <th>SWIFT Code</th>
            </tr>
            <tr>
                <td><input type="text" name="NameOfBank[]"></td>
                <td><input type="text" name="AddressOfBank[]"></td>
                <td><input type="text" name="SwiftCodeOfBank[]"></td>
                <td><button type="button" onclick="deleteRow(this)">Delete</button></td>
            </tr>
        </table>
        </div>
        <div><button type ="button" onclick="addBanks()">add</button></div>
        <div><p>Please include the last 6 months Bank Statement.</p></div>
        
        <div>
        <?php
            $currentYear = date("Y");
        ?>
        <table>
            <tr>
                <th colspan="5">Nett Worth and Working Capital</th>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><?php echo ($currentYear - 1) . "(RM)"; ?></td>
                <td><?php echo ($currentYear-2) . "(RM)"; ?></td>
                <td><?php echo ($currentYear-3) ."(RM)"; ?></td>
            </tr>
            <tr>
                <td>(a)</td>
                <td>Total Liabilities</td>
                <td><input type="text" name="totalLiabilities[<?= $currentYear - 1 ?>]" required></td>
                <td><input type="text" name="totalLiabilities[<?= $currentYear - 2 ?>]" required></td>
                <td><input type="text" name="totalLiabilities[<?= $currentYear - 3 ?>]" required></td>
            </tr>
            <tr>
                <td>(b)</td>
                <td>Total Assets</td>
                <td><input type="text" name="totalAssets[<?= $currentYear - 1 ?>]" required></td>
                <td><input type="text" name="totalAssets[<?= $currentYear - 2 ?>]" required></td>
                <td><input type="text" name="totalAssets[<?= $currentYear - 3 ?>]" required></td>
            </tr>
            <tr>
                <td>(c)</td>
                <td>Net Worth(b-a)</td>
                <td><input type="text" name="NetWorth[<?= $currentYear - 1 ?>]" required></td>
                <td><input type="text" name="NetWorth[<?= $currentYear - 2 ?>]" required></td>
                <td><input type="text" name="NetWorth[<?= $currentYear - 3 ?>]" required></td>
            </tr>
            <tr>
                <td>(d)</td>
                <td>Working Capital (current assets minus current liabilities)</td>
                <td><input type="text" name="WorkingCapital[<?= $currentYear - 1 ?>]" required></td>
                <td><input type="text" name="WorkingCapital[<?= $currentYear - 2 ?>]" required></td>
                <td><input type="text" name="WorkingCapital[<?= $currentYear - 3 ?>]" required></td>
            </tr>
        </table>
        </div>
        
        <p>Current Credit Resources form Banks and Financial Institution / Supplier </p>
        <div><label for="CreditFacilities">Does the Company have any credit facilities </label>
        <input type="radio" name="CreditFacilities" id="CreditFacilities-Yes" value="Yes" onclick="turnOnCreditDetails()" required>
        <label for="CreditFacilities-Yes">Yes</label>
        
        <input type="radio" name="CreditFacilities" id="CreditFacilities-No" value="No" onclick="turnOffCreditDetails()">
        <label for="CreditFacilities-No">No</label>
        </div>
        
        <div id="CreditFacilities-Details" style="display: none;">
        <p>if yes, please provide details. (please include Offer Letter from bank if applicable)</p>
        <table id="CreditTable">
            <tr>
                <th>Type of Credit Facilities</th>
                <th>Bank / Financial Institution / Supplier</th>
                <th>Total Amount(RM)</th>
                <th>Unutilised Amount Currently Available (RM)</th>
                <th>Expiry Date</th>
                <th>As at Date</th>
            </tr>
            <tr>
                <td><input type="text" name="TypeOfCredit[]"></td>
                <td><input type="text" name="FinancialInstitution[]"></td>
                <td><input type="text" name="CreditTotalAmount[]"></td>
                <td><input type="text" name="CreditUnutilisedAmount[]"></td>
                <td><input type="date" name="CreditExpiryDate[]"></td>
                <td><input type="date" name="CreditAsAtDate[]"></td>
                <td><button type="button" onclick="deleteRow(this)">Delete</button></td>
            </tr>
        </table>
        <div>
            <button type="button" onclick="addCreditFacilities()">add</button>
        </div>
        </div>
                </div></div></div>
        
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingSix">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix"><label>Part F: Contractor's Technical Capability</label></button></h2>
        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <div class="grid-row">
        <div class="grid-column"><label for="CIDB">CIDB (Grade / Category / Specialisation)</label>
        <input type="text" name="CIDB" id="CIDB" required>
        </div>
        
        <div class="grid-column">
            <label for="CIDBValidityDate">CIDB validity till</label>
            <input type="date" name="CIDBValidityDate" id="CIDBValidityDate" required>
        </div>
        </div>
        <div class="grid-row-full-width">
            <div class="grid-column-full-width"><label for="CIDBTrade">Trade</label>
            
            <div>
            <input type="radio" name="CIDBTrade" id="ISP" value="ISP" onclick="OffOthersDetails()">
            <label for="ISP">ISP</label>
            
            <input type="radio" name="CIDBTrade" id="OSP" value="OSP" onclick="OffOthersDetails()">
            <label for="OSP">OSP</label>
            
            <input type="radio" name="CIDBTrade" id="O&M" value="O&M" onclick="OffOthersDetails()">
            <label for="O&M">O&M</label>
            
            <input type="radio" name="CIDBTrade" id="M&E" value="M&E" onclick="OffOthersDetails()">
            <label for="M&E">M&E</label>
            
            <input type="radio" name="CIDBTrade" onclick="OnOthersDetails()">
            <label for="CIDBOthers" id="CIDBOthersRadio">Others</label>
            </div>
            </div>
        </div>
        <div id="CIDBOthersDetails" style="display: none;">
            <div><label>(Please specify)</label></div>
            <div><input type="text" id="CIDBOthersInput" ></div>
        </div>
        <br>
        <div class="grid-row">
            <div class="grid-row-radio">
                <div>
                <p for="ValueOfSimilarProject">Value of Similar Project Completed in last 5 years</p></div>
                <div>
                    <input type="radio" name="ValueOfSimilarProject" value=">15M" id=">15M" required>
                    <label for=">15M">More than RM15M</label>
                </div>
                <div>
                    <input type="radio" name="ValueOfSimilarProject" value="10M-14.9M" id="10M-14.9M">
                    <label for="10M-14.9M">RM10M and More but less than RM14.9M</label>
                </div>
                <div>
                    <input type="radio" name="ValueOfSimilarProject" value="5M-9.9M" id="5M-9.9M">
                    <label for="5M-9.9M">Rm5M and mroe but less than 9.9M</label>
                </div>
                <div>
                    <input type="radio" name="ValueOfSimilarProject" value="1M-4.9M" id="1M-4.9M">
                    <label for="1M-4.9M">RM1M and more but less than Rm4.9M</label>
                </div>
                <div>
                    <input type="radio" name="ValueOfSimilarProject" value="<1M" id="<1M">
                    <label for="<1M">Less than RM1M</label>
                </div>
            </div>
            <div class="grid-row-radio">
                <div for="ValueOfCurrentProject"><p>Value of Current On Going Project</p></div>
                <div>
                    <input type="radio" name="ValueOfCurrentProject" id=">5M" value=">5M" required>
                    <label for=">5M">More than Rm5M</label>
                </div>
                <div>
                    <input type="radio" name="ValueOfCurrentProject" id="2M-4.9M" value="2M-4.9M">
                    <label for="2M-4.9M">Rm2M and more but less than Rm4.9M</label>
                </div>
                <div>
                    <input type="radio" name="ValueOfCurrentProject" id="0.5M-1.9M" value="0.5M-1.9M">
                    <label for="0.5M-1.9M">Rm0.5M and more but less than Rm1.9M</label>
                </div>
                <div>
                    <input type="radio" name="ValueOfCurrentProject" id="<0.5M" value="<0.5M">
                    <label for="<0.5M">Less than Rm0.5M</label>
                </div>
            </div>
        </div>
        
        <div><label>Experience in the Industry (Years)</label>
        <input type="number" min="0">
        </div>
        
        <div>
        <br>
            <label>List of Plant, Machinery and Equipment </label><p>
The Contractor is required to complete the form by listing all plant and machinery owned by the company, including details such as quantity, brand/model, capacity rating, ownership status, and year of manufacture. <b>The Contractor shall also provide valid calibration certificates for the relevant equipment.</b> The list must be adjusted and expanded, where necessary, to accurately reflect the actual plant and machinery currently owned, hired or available to the Contractor.
</p>
        </div>
        <div>
            <table>
                <tr>
                    <th>Equipment Type</th>
                    <th>Quantity</th>
                    <th>Brand/Model</th>
                    <th>Capacity / Rating</th>
                    <th>Ownership (Owned/Hired)</th>
                    <th>Years of Manufacture</th>
                    <th>Registration No. / Serial No.</th>
                </tr>
                <tr>
                    <td>Bobcat/JCB</td>
                    <td><input type="text" name="BobcatQuality"></td>
                    <td><input type="text" name="BobcatBrandModel"></td>
                    <td><input type="number" name="BobcatRating" min="0" max="9.9" step="0.1"></td>
                    <td><input type="text" name="BobcatOwnership"></td>
                    <td><input type="date" name="BobcatYearOfManufacture"></td>
                    <td><input type="date" name="BobcatRegistrationNo"></td>
                </tr>
                <tr>
                    <td>HDD Equipment</td>
                    <td><input type="text" name="HDDQuality"></td>
                    <td><input type="text" name="HDDBrandModel"></td>
                    <td><input type="text" name="HDDRating"></td>
                    <td><input type="text" name="HDDOwnership"></td>
                    <td><input type="date" name="HDDYearOfManufacture"></td>
                    <td><input type="date" name="HDDRegistrationNo"></td>
                </tr>
                <tr>
                    <td>Splicing Equipment</td>
                    <td><input type="text" name="SplicingQuality"></td>
                    <td><input type="text" name="SplicingBrandModel"></td>
                    <td><input type="text" name="SplicingRating"></td>
                    <td><input type="text" name="SplicingOwnership"></td>
                    <td><input type="date" name="SplicingYearOfManufacture"></td>
                    <td><input type="date" name="SplicingRegistrationNo"></td>
                </tr>
                <tr>
                    <td>Optical Power Meter (OPM)</td>
                    <td><input type="text" name="OPMQuality"></td>
                    <td><input type="text" name="OPMBrandModel"></td>
                    <td><input type="text" name="OPMRating"></td>
                    <td><input type="text" name="OPMOwnership"></td>
                    <td><input type="date" name="OPMYearOfManufacture"></td>
                    <td><input type="date" name="OPMRegistrationNo"></td>
                </tr>
                <tr>
                    <td>Optical Time Domain Reflectometer (OTDR)</td>
                    <td><input type="text" name="OTDRQuality"></td>
                    <td><input type="text" name="OTDRBrandModel"></td>
                    <td><input type="text" name="OTDRRating"></td>
                    <td><input type="text" name="OTDROwnership"></td>
                    <td><input type="date" name="OTDRYearOfManufacture"></td>
                    <td><input type="date" name="OTDRRegistrationNo"></td>
                </tr>
                <tr>
                    <td>Equipment/Test Gear</td>
                    <td><input type="text" name="TestGearQuality"></td>
                    <td><input type="text" name="TestGearBrandModel"></td>
                    <td><input type="text" name="TestGearRating"></td>
                    <td><input type="text" name="TestGearOwnership"></td>
                    <td><input type="date" name="TestGearYearOfManufacture"></td>
                    <td><input type="date" name="TestGearRegistrationNo"></td>
                </tr>
            </table>
        </div>
        <br>
        <div><label>List of Site Team and Site Staff</label></div>
        <div><p>The Contractor is required to complete this form by listing all site supervisors and workers under its employment, categorised according to their respective skills (Civil / HDD / Cable / TMP).<b> The Contractor shall also provide the curriculum vitae (CV) of the Site Supervisor and any other key personnel,</b> where applicable. The list shall be expanded, where necessary, to accurately reflect all personnel currently employed by the Contractor. </p></div>
        
        <table id="StaffTeamTable">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Qualification</th>
                <th>Employment Status (Permanent / Contract / Seconded)</th>
                <th>Skills / Expertise (Civil / HDD / Cable / TMP/ others contractor to indicate)</th>
                <th>Relevant Certification (CIDB / EOSP/ others contractor to indicate)</th>
                <th>Year of Experience</th>
            </tr>
            <tr>
                <td><input type="number" name="StaffNo[]" min="1"></td>
                <td><input type="text" name="StaffName[]"></td>
                <td><input type="text" name="StaffDesignation[]"></td>
                <td><input type="text" name="StaffQualification[]"></td>
                <td><input type="text" name="StaffEmploymentStatus[]"></td>
                <td><input type="text" name="StaffSkills[]"></td>
                <td><input type="text" name="StaffCertification[]"></td>
                <td><input type="number" name="StaffExperience[]" min="1"></td>
                <td><button type="button" onclick="deleteRow(this)">Delete</button></td>
            </tr>
        </table>
        <div><button type="button" onclick="addStaffList()">add</button></div>
        <br>
        <div><label>Project Track Record</label></div>
        <div><p>The Contractor is required to provide details of relevant project experience <u><b>within the last five (5) years </b></u>related to fibre optic infrastructure systems, including but not limited to Outside Plant (OSP), Inside Plant (ISP), and Operation & Maintenance (O&M). The list shall be expanded, where necessary.</p></div>
        
        <table id="ProjectRecordTable">
            <tr>
                <th>NO.</th>
                <th>Project Title /Description</th>
                <th>Project Nature</th>
                <th>Location of the Project (Negeri / Daerah)</th>
                <th>Client Name</th>
                <th>Project Value</th>
                <th>Commencement Date</th>
                <th>Completion Date</th>
            </tr>
            <tr>
                <td><input min="1" type="number" name="ProjectRecordNo[]"></td>
                <td><input type="text" name="ProjectTitle[]"></td>
                <td><input type="text" name="ProjectNature[]"></td>
                <td><input type="text" name="ProjectLocation[]"></td>
                <td><input type="text" name="ProjectClientName[]"></td>
                <td><input type="text" name="ProjectValue[]"></td>
                <td><input type="date" name="ProjectCommencementDate[]"></td>
                <td><input type="date" name="ProjectCompletionDate[]"></td>
                <td><button type="button" onclick="deleteRow(this)">Delete</button></td>
            </tr>
        </table>
        <div><button type="button" onclick="addProjectRecord()">add</button></div>
        <br>
        <div><label>Current Projects</label></div>
        <div><p>The Contractor is required to provide details of all current projects undertaken by the company. The list shall be expanded, where necessary.</p></div>
        <div>
            <table id="CurrentProjTable">
                <tr>
                    <th>No.</th>
                    <th>Project Title / Description</th>
                    <th>Project Nature</th>
                    <th>Location of the Project (Negeri / Daerah)</th>
                    <th>Client Name</th>
                    <th>Project Value</th>
                    <th>Commencement Date</th>
                    <th>Completion Date</th>
                    <th>Progress of the Works (%)</th>
                </tr>
                <tr>
                    <td><input min="1" type="number" name="CurrentProjectNo[]"></td>
                    <td><input type="text" name="CurrentProjTitle[]"></td>
                    <td><input type="text" name="CurrentPorjNature[]"></td>
                    <td><input type="text" name="CurrentProjLocation[]"></td>
                    <td><input type="text" name="CurrentProjName[]"></td>
                    <td><input type="text" name="CurrentProjValue[]"></td>
                    <td><input type="date" name="CurrentProjStartDate[]"></td>
                    <td><input type="date" name="CurrentProjEndDate[]"></td>
                    <td><input min="1" max="100" type="number" name="CurrentProjProgress[]"></td>
                    <td><button type="button" onclick="deleteRow(this)">Delete</button></td>
                </tr>
            </table>
        </div>
        <div><button type="button" onclick="addCurrentProjectRecord()">add</button></div>
        </div></div></div>
        
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingSEVEN">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven"><label>Part G: Contact Details</label></button></h2>
        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        
        <div class="grid-row-full-width">
        <div class="grid-column-full-width"><label for="PrimaryContactPerson">Primary Contact Person</label><input type="text" id="PrimaryContactPerson" name="PrimaryContactPerson" required></div>
        </div>
        <div class="grid-row-full-width">
        <div class="grid-column-full-width">
        <label for="PrimaryDepartment">Department</label><input type="text" id="PrimaryDepartment" name="PrimaryDepartment" required></div>
        </div>
        <div class="grid-row">
            <div class="grid-column">
            <label for="PrimaryTelephone">Telephone Nuumber</label><input type="text" id="PrimaryTelephone" name="PrimaryTelephone" required>
            </div>
            <div class="grid-column">
            <label for="PrimaryEmail">Email</label><input type="Email" id="PrimaryEmail" name="PrimaryEmail" required>
            </div>
        </div>
        <div class="grid-row-full-width">
            <div class="grid-column-full-width">
            <label for="SecondaryContactPerson">Secondary Contact Person</label><input type="text" id="SecondaryContactPerson" name="SecondaryContactPerson" required>
            </div>
        </div>
        <div class="grid-row-full-width">
            <div class="grid-column-full-width">
            <label for="SecondaryDepartment">Department</label><input type="text" id="SecondaryDepartment" name="SecondaryDepartment" required>
            </div>
        </div>
        <div class="grid-row">
            <div class="grid-column">
            <label for="SecondaryTelephone">Telephone Nuumber</label><input type="text" id="SecondaryTelephone" name="SecondaryTelephone" required>
            </div>
            <div class="grid-column">
            <label for="SecondaryEmail">Email</label><input type="Email" id="SecondaryEmail" name="SecondaryEmail" required>
            </div>
        </div>
            </div></div></div>
        
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingEight">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight"><label>Part H: Self Declaration</label></button></h2>
        <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
        <div><p>We understand and acknowledge that MSA RESOURCES SDN. BHD. <b>(Company No. 199801006982 (463109-M)) (“MSAR”)</b> observes good business conduct and is committed to adhere to all laws and regulations wherever it operates including but not limited to economic sanctions, export control, competition or anti-trust, personal data protection laws, guided by MSAR’s policies.</p></div>
        <br>
        <div><p>Accordingly, we confirm and declare that, to the best of our knowledge, the Company and/or any of its affiliates, including its and their directors, officers, employees–</p></div>
        
        <div>
        <ol type="a">
            <li>	are not the target or subjects of any sanctions; </li>
            <li>	are not owned or controlled by any person who is the target or subject of any sanctions</li>
            <li>	are not acting for the benefit of or on behalf of any person (including but not limited to any natural person, corporation, limited liability company, trust, joint venture, association, company, partnership, Governmental Authority or other entity) that is the target or subject of any sanctions;</li>
            <li>	have not been engaging in any conduct/activity that would result in us being in breach of any sanctions or becoming a target or subject of sanctions; </li>
            <li>	have not been the subject of any convictions or prosecutions or is it the subject of any pending investigations by a public authority, in relation to export control regulations within the last 5 years. </li>
        </ol>
        </div>
            </div></div>
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine"><label>Part I: Notice of Disclosure</label></button></h2>
            
        <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <div><p><b>Applicable Laws relating to regulation of the Processing of Personal Data and matters connected thereto (“Data Protection Law”)</b></p></div>
        <br>
        <div><p>Pursuant to the requirement of Data Protection Law, we hereby wish to give this notice and seek your consent on the processing of your personal data as well as to give an assurance of our commitment to ensure that your data is securely processed, kept and not used or disclosed for any other purpose than the commercial dealings we have with you.</p></div>
        <div><p>The contact to whom written requests for access to personal data or correction and/or deletion of personal data or for information regarding policies and procedures and types of personal data handled by us can be made to the following:</p></div>
        <br>
        <div><label>Name: En. Razlan Radzi</label></div>
        <div><label>Telephone Number: 019 - 258 8888</label></div>
        <div><label>Email Address: razlan@msar.tech</label></div>
        
            </div></div></div>
            
        <div class="accordion-item">
        <h2 class="accordion-header" id="headingTen">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen"><label>Part J: Information Verification</label></button></h2>
            
        <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        <div><p>By signing this document, the undersigned, being duly authorized to complete this form, hereby certify the following:</p></div>
        <br>
        <div>
        <ul class="o-list">
          <li>declares that he/she has, or has obtained from the relevant authority, the proper mandate and authority to disclose such information;</li>
          <li>consents to the processing of such information for the purpose described in the Notice of Disclosure;</li>
          <li>acknowledges that the processing of such information may be conducted by a third party on behalf of MSAR which may occur in another country than the country of disclosure; and</li>
          <li>represents that the information provided in this document is, to the best of his/her knowledge, accurate, current and complete as of the date of disclosure.</li>
          <li>pursuant to the Credit Reporting Agencies Act 2010 (“the CRA”) and Central Bank of Malaysia Act 2009, the Company do hereby give our consent to MSAR and CTOS Data Systems Sdn. Bhd. (“CTOS”), a registered credit reporting agency under the CRA to process our Company’s personal data as per the Personal Data Protection Act 2010 including for the purpose of conducting credit/trade check.</li>
        </ul>
        </div>
        <div class="grid-row">
        <div>
        <div><label>The above information had been verified by: - </label></div>
        <div><label>For and on behalf of the Company.</label></div>
        <div><input type="text"></div>
        <label>(Authorised Signature and Company Stamp) </label>
        <label>Chairman/Director/Company Secretary</label>
        </div>
        
        <div>
        <div><label for="NameOfWritter">Name:</label><input type="text" name="NameOfWritter" id="NameOfWritter"></div>
        <div><label for="DesignationOfWritter">Designation:</label><input type="text" name="DesignationOfWritter" id="DesignationOfWritter" required></div>
        <div><label for="DateOfWritting">Date:</label><input type="date" name="DateOfWritting" id="DateOfWritting" required></div>
        </div>
        </div>
            </div></div></div>
        <!--    auto fill button remove later-->
    <button type="button" onclick="autoFillTestData()">
    Auto-Fill Test Data
</button>

<script>
function autoFillTestData() {
    console.log("Auto-fill function called");

    document.querySelectorAll("input").forEach(input => {
        if (input.type === "text") input.value = "Test";
        if (input.type === "number") input.value = 1;
        if (input.type === "date") input.value = "2024-01-01";
        if (input.type === "email") input.value = "test@gmail.com"
    });
}
</script>

<!--    submit button--> 
    <button type="submit">Submit</button>
<!-- editing button-->
    <a href="VendorUpdateDate.php" class="button">Go to Update Page</a>

        
    </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src=script.js></script>

    

</body>
</html>
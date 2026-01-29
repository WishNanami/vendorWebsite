function addShareholders(){
    const table = document.getElementById("shareholderTable");
    
    const newShareholderRow = table.insertRow(-1);
    
    const fields = [
        "shareholderName[]",
        "ShareholderNationality[]",
        "shareholderAddress[]",
    ];
    
    const Numbercell = newShareholderRow.insertCell();
    const Numberinput = document.createElement("input");
    Numberinput.type = "number";
    Numberinput.name = "shareholderID[]";
    Numberinput.step = "1";
    Numbercell.appendChild(Numberinput);
    
    fields.forEach(name => {
        const cell = newShareholderRow.insertCell();
        const input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });
    
    const Percentcell = newShareholderRow.insertCell();
    const Percentinput = document.createElement("input");
    Percentinput.type = "number";
    Percentinput.name = "shareholderID[]";
    Percentinput.step = "0.1";
    Percentcell.appendChild(Percentinput);
    
    const deleteCell = newShareholderRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent= "Delete";
    deleteButton.onclick = function() {
        deleteRow(this);
    };
    deleteCell.appendChild(deleteButton);
        
}

function deleteRow(button){
    const row = button.closest("tr");
    row.remove();
}

function addDirector(){
    const table = document.getElementById("DirectorTable");
    
    const newDirectorRow = table.insertRow(-1);
    
    const fields = [
        "DirectorName[]",
        "DirectorNationality[]",
        "DirectorPosition[]",
    ];
    
    const Datefields = [
        "DirectorAppointmentDate[]",
        "DirectorDOB[]",
    ];
    
    fields.forEach(name => {
        const cell = newDirectorRow.insertCell();
        const input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });
    
    Datefields.forEach(name => {
        const cell = newDirectorRow.insertCell();
        const input = document.createElement("input");
        input.type = "date";
        input.name = name;
        cell.appendChild(input);
    });
    
    const deleteCell = newDirectorRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent= "Delete";
    deleteButton.onclick = function() {
        deleteRow(this);
    };
    deleteCell.appendChild(deleteButton);
}

function addManagement(){
    const table = document.getElementById("ManagementTable");
    
    const newManagementRow = table.insertRow(-1);
    
    const fields = [
        "ManagementName[]",
        "ManagementNationality[]",
        "ManagementPosition[]",
    ];
    
    const Datefields = [
        "ManagementYearInPosition[]",
        "ManagementYearsInIndustry[]",
    ];
    
    fields.forEach(name => {
        const cell = newManagementRow.insertCell();
        const input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });
    
    Datefields.forEach(name => {
        const cell = newManagementRow.insertCell();
        const input = document.createElement("input");
        input.type = "date";
        input.name = name;
        cell.appendChild(input);
    });
    
    const deleteCell = newManagementRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent= "Delete";
    deleteButton.onclick = function() {
        deleteRow(this);
    };
    deleteCell.appendChild(deleteButton);
}

function bankruptYes(){
    const detailsDiv = document.getElementById("bankruptcy-details");
    detailsDiv.style.display = "block";  
}

function bankruptNO(){
    const detailsDiv = document.getElementById("bankruptcy-details");
    detailsDiv.style.display = "none";  
}

function addBanks(){
    const table = document.getElementById("bankTable");
    
    const newBankRow = table.insertRow(-1);
    
    const fields = [
        "NameOfBank[]",
        "AddressOfBank[]",
        "SwiftCodeOfBank[]",
    ];
    
    fields.forEach(name => {
        const cell = newBankRow.insertCell();
        const input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });
    
    const deleteCell = newBankRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent= "Delete";
    deleteButton.onclick = function() {
        deleteRow(this);
    };
    deleteCell.appendChild(deleteButton);
        
}
function addCreditFacilities() {
    const table = document.getElementById("CreditTable");
    const newCreditRow = table.insertRow(-1);

    const fields = [
        "TypeOfCredit[]",
        "FinancialInstitution[]",
        "CreditTotalAmount[]",
        "CreditUnutilisedAmount[]",
    ];

    const dateFields = [
        "CreditExpiryDate[]",
        "CreditAsAtDate[]",
    ];

    // Text fields
    fields.forEach(name => {
        const cell = newCreditRow.insertCell();
        const input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });

    // Date fields
    dateFields.forEach(name => {
        const cell = newCreditRow.insertCell();
        const input = document.createElement("input");
        input.type = "date";
        input.name = name;
        cell.appendChild(input);
    });

    // Delete button
    const deleteCell = newCreditRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent = "Delete";
    deleteButton.onclick = function () {
        deleteRow(this);
    };
    deleteCell.appendChild(deleteButton);
}


function turnOnCreditDetails(){
    const detailsDiv = document.getElementById("CreditFacilities-Details");
    detailsDiv.style.display = "block"; 
}
function turnOffCreditDetails(){
    const detailsDiv = document.getElementById("CreditFacilities-Details");
    detailsDiv.style.display = "none"; 
}

function OnOthersDetails(){
    const detailsDiv = document.getElementById("CIDBOthersDetails");
    detailsDiv.style.display = "block"; 
}
function OffOthersDetails(){
    const detailsDiv = document.getElementById("CIDBOthersDetails");
    detailsDiv.style.display = "none"; 
}

function addStaffList() {
    const table = document.getElementById("StaffTeamTable");
    const newStaffRow = table.insertRow(-1);

    // Staff No
    let cell = newStaffRow.insertCell();
    let input = document.createElement("input");
    input.type = "number";
    input.name = "StaffNo[]";
    input.min = "1";
    cell.appendChild(input);

    const fields = [
        "StaffName[]",
        "StaffDesignation[]",
        "StaffQualification[]",
        "StaffEmploymentStatus[]",
        "StaffSkills[]",
        "StaffCertification[]",
    ];

    // Text fields
    fields.forEach(name => {
        cell = newStaffRow.insertCell();
        input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });

    // Experience
    cell = newStaffRow.insertCell();
    input = document.createElement("input");
    input.type = "number";
    input.name = "StaffExperience[]";
    input.min = "1";
    cell.appendChild(input);

    // Delete button
    cell = newStaffRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent = "Delete";
    deleteButton.onclick = function () {
        deleteRow(this);
    };
    cell.appendChild(deleteButton);
}

function addStaffList() {
    const table = document.getElementById("StaffTeamTable");
    const newStaffRow = table.insertRow(-1);

    // Staff No
    let cell = newStaffRow.insertCell();
    let input = document.createElement("input");
    input.type = "number";
    input.name = "StaffNo[]";
    input.min = "1";
    cell.appendChild(input);

    const fields = [
        "StaffName[]",
        "StaffDesignation[]",
        "StaffQualification[]",
        "StaffEmploymentStatus[]",
        "StaffSkills[]",
        "StaffCertification[]",
    ];

    // Text fields
    fields.forEach(name => {
        cell = newStaffRow.insertCell();
        input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });

    // Experience
    cell = newStaffRow.insertCell();
    input = document.createElement("input");
    input.type = "number";
    input.name = "StaffExperience[]";
    input.min = "1";
    cell.appendChild(input);

    // Delete button
    cell = newStaffRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent = "Delete";
    deleteButton.onclick = function () {
        deleteRow(this);
    };
    cell.appendChild(deleteButton);
}

function addProjectRecord() {
    const table = document.getElementById("ProjectRecordTable");
    const newStaffRow = table.insertRow(-1);

    // Staff No
    let cell = newStaffRow.insertCell();
    let input = document.createElement("input");
    input.type = "number";
    input.name = "StaffNo[]";
    input.min = "1";
    cell.appendChild(input);

    const fields = [
        "ProjectTitle[]",
        "ProjectNature[]",
        "ProjectLocation[]",
        "ProjectClientName[]",
        "ProjectValue[]",
    ];
    
    const dateFields = [
        "ProjectCommencementDate[]",
        "ProjectCompletionDate[]",
    ]

    // Text fields
    fields.forEach(name => {
        cell = newStaffRow.insertCell();
        input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });

    // date
    dateFields.forEach(name => {
        cell = newStaffRow.insertCell();
        input = document.createElement("input");
        input.type = "date";
        input.name = name;
        cell.appendChild(input);
    });

    // Delete button
    cell = newStaffRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent = "Delete";
    deleteButton.onclick = function () {
        deleteRow(this);
    };
    cell.appendChild(deleteButton);
}

function addCurrentProjectRecord() {
    const table = document.getElementById("CurrentProjTable");
    const newStaffRow = table.insertRow(-1);

    // Staff No
    let cell = newStaffRow.insertCell();
    let input = document.createElement("input");
    input.type = "number";
    input.name = "CurrentProjectNo[]";
    input.min = "1";
    cell.appendChild(input);

    const fields = [
        "CurrentProjTitle[]",
        "CurrentPorjNature[]",
        "CurrentProjLocation[]",
        "CurrentProjName[]",
        "CurrentProjValue[]",
    ];
    
    const dateFields = [
        "CurrentProjStartDate[]",
        "CurrentProjEndDate[]",
    ]

    // Text fields
    fields.forEach(name => {
        cell = newStaffRow.insertCell();
        input = document.createElement("input");
        input.type = "text";
        input.name = name;
        cell.appendChild(input);
    });

    // date
    dateFields.forEach(name => {
        cell = newStaffRow.insertCell();
        input = document.createElement("input");
        input.type = "date";
        input.name = name;
        cell.appendChild(input);
    });
    
    let progressCell = newStaffRow.insertCell();
    let Processinput = document.createElement("input");
    Processinput.type = "number";
    Processinput.name = "CurrentProjProgress[]";
    Processinput.min = "1";
    Processinput.max = "100";
    progressCell.appendChild(Processinput);

    // Delete button
    cell = newStaffRow.insertCell();
    const deleteButton = document.createElement("button");
    deleteButton.type = "button";
    deleteButton.textContent = "Delete";
    deleteButton.onclick = function () {
        deleteRow(this);
    };
    cell.appendChild(deleteButton);
}

function deleteRow(button) {
    const row = button.closest("tr");
    row.remove();
}

function submitTable() {
    const rows = document.querySelectorAll("#shareholderTable tr");
    let outputHTML = "<h3>Submitted Data:</h3><ul>";

    // Skip header row (start at 1)
    for (let i = 1; i < rows.length; i++) {
        const inputs = rows[i].querySelectorAll("input");
        let rowData = [];
        inputs.forEach(input => rowData.push(input.value.trim()));

        outputHTML += `<li><strong>Row ${i}:</strong> ${rowData.join(" | ")}</li>`;
    }

    outputHTML += "</ul>";
    document.getElementById("output").innerHTML = outputHTML;
}


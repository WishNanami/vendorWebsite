function SearchRegistration() {
    const registration = document.getElementById("NewRegistration").value;

    if (registration === "") {
        alert("Please enter a value");
        return;
    }

    fetch("VendorSearch.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "registration=" + encodeURIComponent(registration)
    })
    .then(response => response.json()) // ✅ JSON
    .then(data => {
        const select = document.getElementById("AvailableTimes");

        select.innerHTML = '<option value="">-- when was the form submitted --</option>';

        data.forEach(item => {
            const option = document.createElement("option");
            option.value = item.time;      // adjust to your column name
            option.textContent = item.time;
            select.appendChild(option);
        });
    })
    .catch(err => console.error(err));
}

function editField(button, inputId, table_name, dataType) {
    const input = document.getElementById(inputId);

    // 🔒 Read DB field directly from HTML
    const dbField = input.dataset.field;

    if (!dbField) {
        console.error("Missing data-field attribute on input:", inputId);
        alert("Configuration error: data-field not set");
        return;
    }

    if (input.hasAttribute("readonly")) {
        // EDIT mode
        input.removeAttribute("readonly");
        input.focus();
        button.textContent = "Save";
        button.classList.replace("btn-outline-primary", "btn-success");
    } else {
        // SAVE mode
        input.setAttribute("readonly", true);
        button.textContent = "Edit";
        button.classList.replace("btn-success", "btn-outline-primary");

        // send updated value to PHP
        updateField(dbField, input.value, table_name, dataType);
    }
}


function updateField(dbField, value, table_name ,dataType) {
    const newCRN = document.getElementById("NewCompanyRegistration").value;
    const time   = document.getElementById("time").value;

    fetch("UpdateRegistration.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body:
            "field=" + encodeURIComponent(dbField) +
            "&value=" + encodeURIComponent(value) +
            "&NewCompanyRegistration=" + encodeURIComponent(newCRN) +
            "&time=" + encodeURIComponent(time) +
            "&Table=" + encodeURIComponent(table_name) +
            "&dataType=" + encodeURIComponent(dataType)
    })
    .then(res => res.text())
    .then(data => alert(data))
    .catch(err => console.error(err));
}


function editRadioGroup(button, groupId, tableName) {
    const group = document.getElementById(groupId);
    const radios = group.querySelectorAll("input[type='radio']");
    const field = group.dataset.field;

    const isDisabled = radios[0].disabled;

    if (isDisabled) {
        // EDIT mode
        radios.forEach(r => r.disabled = false);
        button.textContent = "Save";
        button.classList.replace("btn-outline-primary", "btn-success");
    } else {
        // SAVE mode
        radios.forEach(r => r.disabled = true);
        button.textContent = "Edit";
        button.classList.replace("btn-success", "btn-outline-primary");

        const selected = [...radios].find(r => r.checked);
        if (!selected) {
            alert("Please select an option");
            return;
        }

        updateField(field, selected.value, tableName, "text");
    }
}


function editTableRow(button, tableName,idName) {
    const row = button.closest("tr");
    const inputs = row.querySelectorAll("input");
    const rowId = row.dataset.id;

    if (button.textContent === "Edit") {
        inputs.forEach(i => i.removeAttribute("readonly"));
        button.textContent = "Save";
        button.classList.replace("btn-outline-primary", "btn-success");
    } else {
        inputs.forEach(i => i.setAttribute("readonly", true));
        button.textContent = "Edit";
        button.classList.replace("btn-success", "btn-outline-primary");

        inputs.forEach((input, index) => {
            updateTableField(
                tableName,
                rowId,
                input.dataset.field,
                input.value,
                input.type,
                idName
            );
        });
    }
}

function updateTableField(table, rowId, field, value, dataType,idName) {
    // Grab NewCompanyRegistration and time from your page
    const newCRN = document.getElementById("NewCompanyRegistration").value;
    const time   = document.getElementById("time").value;
    
    fetch("UpdateTableRow.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body:
            "field=" + encodeURIComponent(field) +
            "&value=" + encodeURIComponent(value) +
            "&NewCompanyRegistration=" + encodeURIComponent(newCRN) +
            "&time=" + encodeURIComponent(time) +
            "&Table=" + encodeURIComponent(table) +
            "&dataType=" + encodeURIComponent(dataType) +
            "&rowId=" + encodeURIComponent(rowId) +
            "&idName=" + encodeURIComponent(idName)
    })
    .then(res => res.text())
    .then(data => console.log(data))
    .catch(err => console.error("Fetch error:", err));
}

function deleteEditRow(button,TableName,idName) {
    const row = button.closest("tr");
    
    const newCRN = document.getElementById("NewCompanyRegistration").value;
    const time   = document.getElementById("time").value;
    const ID = row.dataset.id;
    
    fetch("DeleteTableRow.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body:
            "ID=" + encodeURIComponent(ID) +
            "&NewCompanyRegistration=" + encodeURIComponent(newCRN) +
            "&time=" + encodeURIComponent(time) +
            "&Table=" + encodeURIComponent(TableName) +
            "&idName=" + encodeURIComponent(idName)
    })
    .then(res => res.text())
    .then(data => console.log(data))
    .catch(err => console.error("Fetch error:", err));
    row.remove();
}

function addEditShareholders(tableName, formName) {
    const table = document.getElementById(formName).querySelector("tbody");

    const row = table.insertRow(-1);
    row.dataset.new = "1"; // mark as new row

    let fields;
    
    if (tableName === "DirectorAndSecretary"){
        fields = [
        { name: "name", type: "text"},
        { name: "position", type: "text"},
        { name: "nationality", type: "text"},
        { name: "appoitmentDate", type: "date"},
        { name: "DOB", type: "date"}
        ]
    } else if (tableName === "Shareholders"){
        fields = [
        { name: "ShareHolderID", type: "number", step: "1" },
        { name: "name", type: "text" },
        { name: "nationality", type: "text" },
        { name: "address", type: "text" },
        { name: "share", type: "number", step: "0.01" }
    ]
    } else if (tableName === "Management") {
    fields = [
        { name: "name", type: "text" },
        { name: "nationality", type: "text" },
        { name: "position", type: "text" },
        { name: "yearsInPosition", type: "number", min: 0, max: 99 },
        { name: "yearsInRelatedField", type: "number", min: 0, max: 99 }
    ];
}

    
    
    fields.forEach(f => {
        const cell = row.insertCell();
        const input = document.createElement("input");
        input.type = f.type;
        input.step = f.step || "";
        input.dataset.field = f.name;
        input.className = "form-control";
        cell.appendChild(input);
    });

    const actionCell = row.insertCell();

    const saveBtn = document.createElement("button");
    saveBtn.type = "button";
    saveBtn.className = "btn btn-success btn-sm";
    saveBtn.textContent = "Save";
    saveBtn.onclick = function () {
        InsertShareholders(this, tableName);
    };

    actionCell.appendChild(saveBtn);
}


function InsertShareholders(button, tableName) {
    const row = button.closest("tr");
    const inputs = row.querySelectorAll("input");

    const newCRN = document.getElementById("NewCompanyRegistration").value;
    const time   = document.getElementById("time").value;

    const data = new URLSearchParams();
    data.append("Table", tableName);
    data.append("NewCompanyRegistration", newCRN);
    data.append("time", time);

    inputs.forEach(input => {
        data.append(input.dataset.field, input.value);
    });

    fetch("insertShareholder.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: data.toString()
    })
    .then(res => res.text())
    .then(text => {
        console.log(text);
    })
    .then(response => {
        if (response.success) {
            // ✅ set DB id
            row.dataset.id = response.id;
            delete row.dataset.new;

            // make readonly
            inputs.forEach(i => i.setAttribute("readonly", true));

            // 🔄 convert Save → Edit
            button.textContent = "Edit";
            button.className = "btn btn-outline-primary btn-sm";
            button.onclick = function () {
                editTableRow(this, "Shareholders");
            };
        } else {
            alert("Insert failed");
        }
    })
    .catch(err => console.error(err));
}

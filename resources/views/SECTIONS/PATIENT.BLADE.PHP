<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #d63384;
            text-align: center;
        }
        .toolbar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 8px;
        }
        .toolbar button, .toolbar input[type="text"] {
            padding: 8px 12px;
            border-radius: 5px;
            border: 1px solid #d63384;
        }
        .toolbar button {
            background-color: #d63384;
            color: white;
            border: none;
            cursor: pointer;
        }
        .toolbar input[type="text"] {
            width: 200px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #d63384;
            color: white;
        }
        .folder-icon {
            width: 30px;
            height: 20px;
            background-color: #ffcc00;
            border-radius: 3px 3px 0 0;
            position: relative;
            cursor: pointer;
            display: inline-block;
        }
        .folder-icon::before {
            content: '';
            width: 70%;
            height: 6px;
            background-color: #ffdd44;
            position: absolute;
            top: -6px;
            left: 15%;
            border-radius: 3px 3px 0 0;
        }
        .folder-icon .paper {
            width: 60%;
            height: 15px;
            background-color: white;
            position: absolute;
            bottom: 2px;
            left: 20%;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.2);
            border-radius: 1px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: #fff;
            padding: 20px;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
            text-align: center;
            position: relative;
        }
        .modal-header {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 1.5em;
        }
        .report-content {
            text-align: left;
            font-size: 0.9em;
            line-height: 1.5;
        }
        .report-section {
            margin-bottom: 10px;
        }
        .report-section h3 {
            font-size: 1em;
            color: #d63384;
            margin: 0;
        }
    </style>
</head>
<body>

<h1>Patient Management System</h1>

<div class="toolbar">
    <button onclick="addRow()">Add</button>
    <button onclick="deleteRow()">Delete</button>
    <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">
    <button onclick="searchTable()">Search</button>
</div>

<table id="patientTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Date</th>
            <th>History</th>
            <th>Action</th> <!-- New column for Edit button -->
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div id="reportModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div class="modal-header">Patient Report</div>
        <div id="reportDetails" class="report-content"></div>
    </div>
</div>

<script>
    function loadPatients() {
        const patients = JSON.parse(localStorage.getItem('patients')) || [];
        const tableBody = document.getElementById("patientTable").getElementsByTagName("tbody")[0];
        tableBody.innerHTML = "";
        patients.forEach(patient => {
            const newRow = tableBody.insertRow();
            newRow.insertCell(0).innerText = patient.name;
            newRow.insertCell(1).innerText = patient.phone;
            newRow.insertCell(2).innerText = patient.age;
            newRow.insertCell(3).innerText = patient.date;
            newRow.insertCell(4).innerHTML = `<div class="folder-icon" onclick="openReport('${patient.report}')"><div class="paper"></div></div>`;
            newRow.insertCell(5).innerHTML = `<button onclick="editRow(this)">Edit</button>`;
        });
    }

    function savePatients() {
        const rows = document.getElementById("patientTable").getElementsByTagName("tbody")[0].rows;
        const patients = Array.from(rows).map(row => {
            return {
                name: row.cells[0].innerText,
                phone: row.cells[1].innerText,
                age: row.cells[2].innerText,
                date: row.cells[3].innerText,
                report: row.cells[4].textContent
            };
        });
        localStorage.setItem('patients', JSON.stringify(patients));
    }

    function addRow() {
        const table = document.getElementById("patientTable").getElementsByTagName("tbody")[0];
        const newRow = table.insertRow();
        for (let i = 0; i < 6; i++) {
            const newCell = newRow.insertCell(i);
            if (i === 4) {
                newCell.innerHTML = `<div class="folder-icon" onclick="openReport('New report')"><div class="paper"></div></div>`;
            } else if (i === 5) {
                newCell.innerHTML = `<button onclick="editRow(this)">Edit</button>`;
            } else {
                newCell.contentEditable = "true";
                newCell.innerText = i === 3 ? new Date().toISOString().split('T')[0] : "";
            }
        }
        savePatients();
    }

    function deleteRow() {
        const table = document.getElementById("patientTable");
        if (table.rows.length > 2) {
            table.deleteRow(-1);
            savePatients();
        } else {
            alert("No more rows to delete.");
        }
    }

    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.getElementById("patientTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
        for (const row of rows) {
            let visible = false;
            for (const cell of row.cells) {
                if (cell.textContent.toLowerCase().includes(input)) {
                    visible = true;
                    break;
                }
            }
            row.style.display = visible ? "" : "none";
        }
    }

    function openReport(report) {
        const reportDetails = `
            <div class="report-section"><h3>Patient Name:</h3><p>${report}</p></div>
            <div class="report-section"><h3>1. History of Present Illness</h3><p>Details about the patient's recent symptoms and treatment history.</p></div>
            <div class="report-section"><h3>2. Past Medical History</h3><p>Summary of past conditions such as diabetes, hypertension, etc.</p></div>
            <div class="report-section"><h3>3. Medication and Allergies</h3><p>Current medications and any allergies noted.</p></div>
            <div class="report-section"><h3>4. Recommendations</h3><p>Doctors’ recommendations and follow-up instructions.</p></div>
        `;
        document.getElementById("reportDetails").innerHTML = reportDetails;
        document.getElementById("reportModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("reportModal").style.display = "none";
    }

    function editRow(button) {
        const row = button.parentElement.parentElement;
        const cells = row.getElementsByTagName("td");
        let isEditable = button.textContent === "Edit";

        for (let i = 0; i < cells.length - 2; i++) {
            cells[i].contentEditable = isEditable ? "true" : "false";
        }

        button.textContent = isEditable ? "Save" : "Edit";

        if (!isEditable) savePatients();
    }

    window.onload = loadPatients;
    window.onbeforeunload = savePatients;
</script>

</body>
</html>


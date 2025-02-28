<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Reports Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .toolbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            align-items: center;
        }
        .toolbar button, .toolbar input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            margin-right: 10px;
        }
        .toolbar button {
            background-color: #000;
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
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #333;
            color: white;
        }
        .folder-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            background-color: #ffcc00;
            cursor: pointer;
            font-size: 1.2em;
            color: #333;
        }
        .folder-icon:hover {
            background-color: #ffdd44;
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
            max-width: 600px;
            border-radius: 5px;
            text-align: center;
            position: relative;
            max-height: 80vh;
            overflow-y: auto;
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
            color: #333;
        }
    </style>
</head>
<body>

<h1>Patient Reports Section - HAKIM HICHER</h1>

<div class="toolbar">
    <button onclick="addRow()">Add</button>
    <button onclick="deleteRow()">Delete</button>
    <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">
    <button onclick="searchTable()">Search</button>
    <i class="fas fa-file-alt" style="font-size: 24px; color: #333;" title="Reports Section"></i>
</div>

<table id="reportTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Age</th>
            <th>Date</th>
            <th>Report</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<div id="reportModal" class="modal">
    <div class="modal-content">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div class="modal-header">Report for Patient - HAKIM HICHER</div>
        <div id="reportDetails" class="report-paper" contenteditable="true">
            <p><strong>Clinical Notes:</strong> Details here...</p>
        </div>
    </div>
</div>

<script>
    // Load table data from localStorage
    window.onload = function() {
        if (localStorage.getItem('reports')) {
            document.getElementById('reportTable').getElementsByTagName('tbody')[0].innerHTML = localStorage.getItem('reports');
        }
    }

    // Save table data to localStorage
    function saveToLocalStorage() {
        const tableContent = document.getElementById('reportTable').getElementsByTagName('tbody')[0].innerHTML;
        localStorage.setItem('reports', tableContent);
    }

    // Add a new row
    function addRow() {
        const table = document.getElementById("reportTable").getElementsByTagName("tbody")[0];
        const newRow = table.insertRow();
        for (let i = 0; i < 5; i++) {
            const newCell = newRow.insertCell(i);
            if (i === 4) {
                newCell.innerHTML = `<div class="folder-icon" onclick="openReportModal('New Patient Report')">
                                        <i class="fas fa-folder"></i>
                                     </div>`;
            } else {
                newCell.contentEditable = "true";
                newCell.innerText = i === 3 ? new Date().toISOString().split('T')[0] : "";
            }
        }
        saveToLocalStorage();  // Save the updated table to localStorage
    }

    // Delete the last row
    function deleteRow() {
        const table = document.getElementById("reportTable");
        if (table.rows.length > 2) {
            table.deleteRow(-1);
        } else {
            alert("No more rows to delete.");
        }
        saveToLocalStorage();  // Save the updated table to localStorage
    }

    // Search function
    function searchTable() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.getElementById("reportTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
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

    // Open modal
    function openReportModal(reportTitle) {
        document.getElementById("reportModal").style.display = "flex";
    }

    // Close modal
    function closeModal() {
        document.getElementById("reportModal").style.display = "none";
    }

    // Save changes on content edit
    document.getElementById('reportTable').addEventListener('input', saveToLocalStorage);
</script>

</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Syrup List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .pharmacy-section {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .pharmacy-section h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .add-btn, .search-bar input {
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
        }

        .add-btn {
            background-color: #A0522D;
            color: white;
            border: none;
            cursor: pointer;
        }

        .add-btn:hover {
            background-color: #8B4513;
        }

        .search-bar input {
            width: 100%;
            max-width: 300px;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .pharmacy-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .pharmacy-table th,
        .pharmacy-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .pharmacy-table th {
            background-color: #A0522D;
            color: white;
        }

        .pharmacy-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pharmacy-table tr:hover {
            background-color: #e6f7ff;
        }

        .pharmacy-table td {
            color: #555;
        }

        .action-btn {
            padding: 8px 12px;
            margin: 2px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-size: 14px;
        }

        .edit-btn {
            background-color: #ffa500;
        }

        .edit-btn:hover {
            background-color: #e69500;
        }

        .delete-btn {
            background-color: #f44336;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="pharmacy-section">
        <h1>HAKIM HICHER CLINIC</h1>
        <div class="controls">
            <button class="add-btn" onclick="addNewRow()">Add New Syrup</button>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search by Syrup Name..." onkeyup="filterTable()">
            </div>
        </div>
        <table class="pharmacy-table" id="pharmacyTable">
            <thead>
                <tr>
                    <th>Syrup Name</th>
                    <th>Price ($)</th>
                    <th>Expiration Date</th>
                    <th>Manufacturing Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <script>
        const SYRUP_STORAGE_KEY = "pharmacySyrups";

        // Load syrups from local storage
        function loadSyrups() {
            const syrups = JSON.parse(localStorage.getItem(SYRUP_STORAGE_KEY)) || [];
            const tableBody = document.querySelector("#pharmacyTable tbody");
            tableBody.innerHTML = ""; // Clear existing rows
            syrups.forEach((syrup, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td contenteditable="true">${syrup.name}</td>
                    <td contenteditable="true">${syrup.price}</td>
                    <td contenteditable="true">${syrup.expiration}</td>
                    <td contenteditable="true">${syrup.manufacturing}</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="editRow(this)">Edit</button>
                        <button class="action-btn delete-btn" onclick="deleteRow(${index})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        // Save syrups to local storage
        function saveSyrups() {
            const rows = document.querySelectorAll("#pharmacyTable tbody tr");
            const syrups = Array.from(rows).map(row => ({
                name: row.cells[0].textContent.trim(),
                price: row.cells[1].textContent.trim(),
                expiration: row.cells[2].textContent.trim(),
                manufacturing: row.cells[3].textContent.trim(),
            }));
            localStorage.setItem(SYRUP_STORAGE_KEY, JSON.stringify(syrups));
        }

        // Add a new row to the table
        function addNewRow() {
            const tableBody = document.querySelector("#pharmacyTable tbody");
            const row = document.createElement("tr");
            row.innerHTML = `
                <td contenteditable="true">New Syrup</td>
                <td contenteditable="true">0.00</td>
                <td contenteditable="true">YYYY-MM-DD</td>
                <td contenteditable="true">YYYY</td>
                <td>
                    <button class="action-btn edit-btn" onclick="editRow(this)">Edit</button>
                    <button class="action-btn delete-btn" onclick="deleteRow(${tableBody.rows.length})">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
            saveSyrups();
        }

        // Edit a specific row
        function editRow(button) {
            const row = button.parentElement.parentElement;
            alert("You can now edit the row directly. Make changes and press Enter!");
        }

        // Delete a specific row
        function deleteRow(index) {
            if (confirm("Are you sure you want to delete this row?")) {
                const syrups = JSON.parse(localStorage.getItem(SYRUP_STORAGE_KEY)) || [];
                syrups.splice(index, 1);
                localStorage.setItem(SYRUP_STORAGE_KEY, JSON.stringify(syrups));
                loadSyrups();
            }
        }

        // Filter the table based on search input
        function filterTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll("#pharmacyTable tbody tr");
            rows.forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                row.style.display = name.includes(input) ? "" : "none";
            });
        }

        // Save syrups when leaving the page
        window.addEventListener("beforeunload", saveSyrups);

        // Load syrups on page load
        document.addEventListener("DOMContentLoaded", loadSyrups);
    </script>
</body>
</html>


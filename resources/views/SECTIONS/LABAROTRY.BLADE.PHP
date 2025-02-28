<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Report - HAKIM HICHER SPECIALITY CLINIC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .clinic-header {
            text-align: center;
            font-weight: bold;
            font-size: 1.4em;
            margin-bottom: 15px;
            color: #006400;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 1em;
        }
        .report-table th, .report-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .section-title {
            font-weight: bold;
            background-color: #006400;
            color: #fff;
            text-align: center;
        }
        .report-details td {
            height: 25px;
            background-color: #e9fbe9;
        }
        .toolbar {
            margin-top: 15px;
            display: flex;
            justify-content: flex-start;
            gap: 10px;
        }
        .toolbar button {
            padding: 10px 15px;
            background-color: #006400;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .toolbar button:hover {
            background-color: #004d00;
        }
        .folder-list {
            margin-top: 20px;
        }
        .folder {
            padding: 10px;
            background-color: #e9fbe9;
            border: 1px solid #006400;
            margin-bottom: 10px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .folder:hover {
            background-color: #d8f5d8;
        }
        .folder-content {
            display: none;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
        }
        .folder button {
            background-color: #f44336;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .folder button:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<div class="clinic-header">
    HAKIM HICHER SPECIALITY CLINIC<br>
    LABORATORY REPORT SECTION
</div>

<div class="search-bar">
    <input type="text" id="searchInput" onkeyup="searchReport()" placeholder="Search in report...">
</div>

<table class="report-table" id="reportTable">
    <tr>
        <th>Patient Name:</th>
        <td colspan="2" contenteditable="true">[Patient Name Here]</td>
        <th>Age:</th>
        <td contenteditable="true">[Age Here]</td>
    </tr>
    <tr>
        <th>Sex:</th>
        <td contenteditable="true">[Sex Here]</td>
        <th>Date:</th>
        <td contenteditable="true">[Date Here]</td>
    </tr>
</table>

<table class="report-table" id="reportTableContent">
    <tr class="section-title">
        <td colspan="5">Clinical Chemistry</td>
    </tr>
   











 <tr class="report-details">
        <td>Glucose</td><td contenteditable="true">[Result]</td>
        <td>Cholesterol</td><td contenteditable="true">[Result]</td>
    </tr>
    <tr class="report-details">
        <td>Urea</td><td contenteditable="true">[Result]</td>
        <td>Creatinine</td><td contenteditable="true">[Result]</td>
    </tr>

    <tr class="section-title">
        <td colspan="5">Hematology</td>
    </tr>
    <tr class="report-details">
        <td>Hb%</td><td contenteditable="true">[Result]</td>
        <td>WBC Count</td><td contenteditable="true">[Result]</td>
    </tr>
    <tr class="report-details">
        <td>Platelets</td><td contenteditable="true">[Result]</td>
        <td>RBC Count</td><td contenteditable="true">[Result]</td>
    </tr>

    <tr class="section-title">
        <td colspan="5">Urinalysis</td>
    </tr>
    <tr class="report-details">
        <td>Ketone</td><td contenteditable="true">[Result]</td>
        <td>Protein</td><td contenteditable="true">[Result]</td>
    </tr>
    <tr class="report-details">
        <td>Glucose</td><td contenteditable="true">[Result]</td>
        <td>Blood</td><td contenteditable="true">[Result]</td>
    </tr>

    <tr class="section-title">
        <td colspan="5">Serological Tests</td>
    </tr>
    <tr class="report-details">
        <td>HIV</td><td contenteditable="true">[Result]</td>
        <td>HBsAg</td><td contenteditable="true">[Result]</td>
    </tr>
    <tr class="report-details">
        <td>VDRL</td><td contenteditable="true">[Result]</td>
        <td>TPHA</td><td contenteditable="true">[Result]</td>
    </tr>

    <tr>
        <th>Date:</th>
        <td colspan="2" contenteditable="true">[Test Date]</td>
        <th>Signature:</th>
        <td contenteditable="true">[Lab Tech Signature]</td>
    </tr>
</table>
</table>

<div class="toolbar">
    <button onclick="addRow()">Add Row</button>
    <button onclick="saveReport()">Save Report</button>
</div>

<div class="folder-list" id="folderList">
    <!-- Folders will appear here -->
</div>

<script>
    let savedReports = [];

    // Add a new row to the report table
    function addRow() {
        const table = document.getElementById("reportTableContent");
        const newRow = table.insertRow(-1);
        newRow.className = "report-details";
        newRow.innerHTML = `
            <td contenteditable="true">[Test Name]</td>
            <td contenteditable="true">[Result]</td>
            <td contenteditable="true">[Other Detail]</td>
            <td><button onclick="deleteRow(this)">Delete</button></td>
        `;
    }

    // Delete a row from the report table
    function deleteRow(button) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    // Save the report as a "folder" with the patient's name
    function saveReport() {
        const patientName = document.querySelector("#reportTable td[contenteditable='true']").innerText.trim();
        if (!patientName) {
            alert("Please enter the patient's name before saving.");
            return;
        }

        // Get the report content
        const rows = document.querySelectorAll("#reportTableContent .report-details");
        const reportData = Array.from(rows).map(row => {
            const cells = row.querySelectorAll("td[contenteditable='true']");
            return Array.from(cells).map(cell => cell.innerText.trim());
        });

        // Save the report
        savedReports.push({ patientName, reportData });

        // Create the folder for the patient
        const folderList = document.getElementById("folderList");
        const folder = document.createElement("div");
        folder.className = "folder";
        folder.innerHTML = `
            ${patientName}
            <div>
                <button onclick="editFolderName('${patientName}')">Edit</button>
                <button onclick="deleteFolder(this, '${patientName}')">Delete</button>
            </div>
        `;

        // Display report data when folder is clicked
        folder.onclick = () => viewReport(patientName);

        // Add the folder to the folder list
        folderList.appendChild(folder);

        alert(`Report for ${patientName} has been saved!`);
    }

    // Edit folder name
    function editFolderName(patientName) {
        const newName = prompt("Enter new folder name:", patientName);
        if (newName) {
            const folder = document.querySelector(`#folderList .folder:contains('${patientName}')`);
            if (folder) {
                folder.innerHTML = `
                    ${newName}
                    <div>
                        <button onclick="editFolderName('${newName}')">Edit</button>
                        <button onclick="deleteFolder(this, '${newName}')">Delete</button>
                    </div>
                `;
                // Update the saved report with the new name
                const report = savedReports.find(r => r.patientName === patientName);
                if (report) {
                    report.patientName = newName;
                }
            }
        }
    }

    // Delete the folder and corresponding report
    function deleteFolder(button, patientName) {
        // Remove the folder from UI
        button.parentElement.parentElement.remove();

        // Remove the report data from savedReports
        savedReports = savedReports.filter(report => report.patientName !== patientName);

        alert(`${patientName}'s folder has been deleted.`);
    }

    // View a saved report
    function viewReport(patientName) {
        const report = savedReports.find(r => r.patientName === patientName);
        if (!report) return;

        // Show the report content inside the folder
        let content = `<h3>${patientName}'s Report</h3><table class="report-table">`;
        report.reportData.forEach(row => {
            content += `<tr>${row.map(cell => `<td>${cell}</td>`).join("")}</tr>`;
        });
        content += `</table>`;

        // Check if folder content already exists and toggle visibility
        let folderContent = document.querySelector(`#folderList .folder-content[data-name='${patientName}']`);
        if (!folderContent) {
            folderContent = document.createElement("div");
            folderContent.className = "folder-content";
            folderContent.setAttribute('data-name', patientName);
            folderContent.innerHTML = content;
            document.querySelectorAll('.folder-content').forEach(c => c.style.display = 'none');  // Hide other content
            folderContent.style.display = 'block';
            document.getElementById("folderList").appendChild(folderContent);
        } else {
            folderContent.style.display = folderContent.style.display === 'none' ? 'block' : 'none';
        }
    }
</script>

</body>
</html>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab and Doctors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #45a049;
        }
        .doctor-section {
            background-color: #eaf3ff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Laboratory Section -->
    <div class="section">
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Section</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Laboratory Section</h2>
    <form id="labForm">
        <label for="doctorSelect">Select Doctor:</label>
        <select id="doctorSelect" required>
            <option value="khalid">Dr. Khalid</option>
            <option value="saed">Dr. Saed</option>
        </select>
        <br><br>
        <label for="fileInput">Upload File:</label>
        <input type="file" id="fileInput" required>
        <br><br>
        <button type="submit" class="button">Send to Doctor</button>
    </form>
    <p id="labMessage"></p>

    <script>
        const labForm = document.getElementById('labForm');
        const fileInput = document.getElementById('fileInput');
        const doctorSelect = document.getElementById('doctorSelect');

        labForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const file = fileInput.files[0];
            const doctor = doctorSelect.value;

            if (file) {
                const fileLink = URL.createObjectURL(file);

                // Store the file link in localStorage for the respective doctor
                localStorage.setItem(`report-${doctor}`, JSON.stringify({
                    name: file.name,
                    link: fileLink,
                }));

                document.getElementById('labMessage').textContent = `File "${file.name}" sent to Dr. ${doctor.charAt(0).toUpperCase() + doctor.slice(1)} successfully!`;
            }
        });
    </script>
</body>
</html>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Section</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #d35400;
        } /* Orange color for title */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #d35400;
            color: white;
        } /* Orange header */
        #searchInput {
            margin-bottom: 20px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        /* Login Styles */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .login-form {
            background: white;
            border: 2px solid #d35400;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .login-form h2 {
            color: #d35400;
        }
        .login-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-form button {
            background-color: #d35400;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #e67e22;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .content {
            display: none;
        }
    </style>
</head>
<body>

<!-- Login Section -->
<div class="login-container" id="loginContainer">
    <form class="login-form" onsubmit="return handleLogin()">
        <h2>Login</h2>
        <input type="text" id="username" placeholder="Username" required>
        <input type="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <div class="error" id="errorMessage"></div>
    </form>
</div>

<!-- Employee Section -->
<div class="content" id="employeeContent">
    <h1>Employee Section</h1>
    <input type="text" id="searchInput" placeholder="Search employees..." onkeyup="searchEmployeeTable()">
    <button onclick="addEmployee()">Add Employee</button>
    <table id="employeeTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>ID</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    const EMPLOYEE_STORAGE_KEY = "employees";
    const USERNAME = "xamse"; // Default username
    const PASSWORD = "2028"; // Default password

    // Handle login
    function handleLogin() {
        const enteredUsername = document.getElementById("username").value.trim();
        const enteredPassword = document.getElementById("password").value.trim();
        const errorMessage = document.getElementById("errorMessage");

        if (enteredUsername === USERNAME && enteredPassword === PASSWORD) {
            document.getElementById("loginContainer").style.display = "none";
            document.getElementById("employeeContent").style.display = "block";
            loadEmployees();
        } else {
            errorMessage.textContent = "Invalid username or password.";
        }
        return false; // Prevent form submission
    }

    // Load employees from local storage
    function loadEmployees() {
        const employees = JSON.parse(localStorage.getItem(EMPLOYEE_STORAGE_KEY)) || [];
        const tableBody = document.querySelector("#employeeTable tbody");
        tableBody.innerHTML = ""; // Clear table
        employees.forEach((employee, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td contenteditable="true">${employee.name}</td>
                <td contenteditable="true">${employee.phone}</td>
                <td contenteditable="true">${employee.id}</td>
                <td contenteditable="true">${employee.salary}</td>
                <td><button onclick="deleteEmployee(${index})">Delete</button></td>
            `;
            tableBody.appendChild(row);
        });
    }

    // Save employees to local storage
    function saveEmployees() {
        const rows = document.querySelectorAll("#employeeTable tbody tr");
        const employees = Array.from(rows).map(row => ({
            name: row.cells[0].textContent.trim(),
            phone: row.cells[1].textContent.trim(),
            id: row.cells[2].textContent.trim(),
            salary: row.cells[3].textContent.trim()
        }));
        localStorage.setItem(EMPLOYEE_STORAGE_KEY, JSON.stringify(employees));
    }

    // Add a new employee row
    function addEmployee() {
        const tableBody = document.querySelector("#employeeTable tbody");
        const row = document.createElement("tr");
        row.innerHTML = `
            <td contenteditable="true">New Employee</td>
            <td contenteditable="true">+000 000 000</td>
            <td contenteditable="true">ID</td>
            <td contenteditable="true">$0</td>
            <td><button onclick="deleteEmployee(${tableBody.rows.length})">Delete</button></td>
        `;
        tableBody.appendChild(row);
        saveEmployees(); // Save data immediately after adding
    }

    // Delete an employee row
    function deleteEmployee(index) {
        const employees = JSON.parse(localStorage.getItem(EMPLOYEE_STORAGE_KEY)) || [];
        employees.splice(index, 1);
        localStorage.setItem(EMPLOYEE_STORAGE_KEY, JSON.stringify(employees));
        loadEmployees();
    }

    // Search function for employees
    function searchEmployeeTable() {
        const searchValue = document.getElementById("searchInput").value.toLowerCase();
        const rows = document.querySelectorAll("#employeeTable tbody tr");
        rows.forEach(row => {
            const cells = Array.from(row.cells);
            const isVisible = cells.some(cell => cell.textContent.toLowerCase().includes(searchValue));
            row.style.display = isVisible ? "" : "none";
        });
    }

    // Save employees when user modifies data
    window.addEventListener("beforeunload", saveEmployees);
</script>

</body>
</html>

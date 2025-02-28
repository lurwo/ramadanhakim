<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        /* Reset and general styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4B0082, #9370DB); /* Soft violet to lavender gradient */
            color: #333;
        }

        /* Header styling */
        header {
            background-color: #5C2D91; /* Royal purple header */
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5em;
            font-weight: bold;
        }

        /* Section container styling */
        .section-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            margin-top: 20px;
        }

        /* Section box styling with gradients */
        .section {
            width: 45%;
            max-width: 400px;
            margin: 10px;
            padding: 20px;
            border-radius: 8px;
            color: white;
            text-align: center;
            transition: transform 0.2s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(0, 0, 0, 0.1)); /* Subtle gradient */
        }

        .section:hover {
            transform: scale(1.05);
        }

        /* Section colors with gradients */
        .doctors {
            background: linear-gradient(135deg, #007BFF, #4FC3F7); /* Blue gradient */
        }

        .laboratory {
            background: linear-gradient(135deg, #28A745, #A5D6A7); /* Green gradient */
        }

        .employees {
            background: linear-gradient(135deg, #FF9800, #FFC107); /* Orange gradient */
        }

        .patients {
            background: linear-gradient(135deg, #FF69B4, #FFB6C1); /* Pink gradient */
        }

        .reports {
            background: linear-gradient(135deg, #333333, #757575); /* Black gradient */
        }

        .pharmacy {
            background: linear-gradient(135deg, #8B4513, #D2B48C); /* Brown gradient */
        }

        .section h2 {
            font-size: 1.8em;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 1em;
            line-height: 1.5;
        }

        /* Animation styling for all icons */
        .section i {
            font-size: 2em;
            margin-bottom: 10px;
            display: block;
            animation: float 2s ease-in-out infinite;
        }

        /* Floating animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Links */
        a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            display: block;
            margin-top: 10px;
            padding: 10px;
            border: 2px solid white;
            border-radius: 5px;
            transition: background 0.3s;
        }

        a:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <h1>HAKIM HICHER SPECIALITY CLINIC</h1>
    </header>

    <!-- Section Container -->
    <div class="section-container">
        <!-- Doctors Section -->
        <div class="section doctors">
            <i class="fas fa-user-md"></i>
            <h2>Doctors</h2>
            <p>Manage doctors’ information, schedules, and specialties.</p>
            <a href="/doctors">Doctors</a>
        </div>

        <!-- Laboratory Section -->
        <div class="section laboratory">
            <i class="fas fa-vials"></i>
            <h2>Laboratory</h2>
            <p>Access and manage lab tests, reports, and patient samples.</p>
            <a href="/laboratory">Laboratory</a>
        </div>

        <!-- Employees Section -->
        <div class="section employees">
            <i class="fas fa-users"></i>
            <h2>Employees</h2>
            <p>Track employee details, roles, shifts, and payroll information.</p>
            <a href="/employees">Employees</a>
        </div>

        <!-- Patients Section -->
        <div class="section patients">
            <i class="fas fa-procedures"></i>
            <h2>Patients</h2>
            <p>Manage patient information, medical history, and appointments.</p>
            <a href="/patients">Patients</a>
        </div>

        <!-- Reports Section -->
        <div class="section reports">
            <i class="fas fa-file-alt"></i>
            <h2>Reports</h2>
            <p>Access and manage patient history, diagnosis, and medical reports.</p>
            <a href="/reports">Reports</a>
        </div>

        <!-- Pharmacy Section -->
        <div class="section pharmacy">
            <i class="fas fa-pills"></i>
            <h2>Pharmacy</h2>
            <p>Manage medications, inventory, and prescription orders for patients.</p>
            <a href="/pharmacy">Pharmacy</a>
        </div>
    </div>

</body>
</html>









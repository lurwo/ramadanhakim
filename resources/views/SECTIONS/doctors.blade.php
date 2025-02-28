<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors' Section</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5f7fa;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #0056b3;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
        }

        .container {
            background: linear-gradient(to right, #e3f2fd, #bbdefb);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        .doctor-section {
            border: 2px solid #64b5f6;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            background-color: #ffffff;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .doctor-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .doctor-section h3 {
            color: #1e88e5;
            font-size: 1.2em;
            display: flex;
            align-items: center;
        }

        .doctor-section h3 img {
            width: 25px;
            height: 25px;
            margin-right: 10px;
        }

        .doctor-section p {
            color: #424242;
            margin: 10px 0;
        }

        .doctor-section a {
            text-decoration: none;
            color: #1e88e5;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
        }

        .doctor-section a:hover {
            color: #0056b3;
        }

        .doctor-section a img {
            margin-left: 5px;
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
<h2>Doctors' Section</h2>

<div class="container">
    <!-- Dr. Khalid -->
    <div id="khalid" class="doctor-section">
        <h3>
            <img src="https://img.icons8.com/ios-filled/50/1e88e5/doctor-male.png" alt="Doctor Icon"> 
            Reports for Dr. Khalid
        </h3>
        <p id="khalidReport">No files received.</p>
    </div>

    <!-- Dr. Saed -->
    <div id="saed" class="doctor-section">
        <h3>
            <img src="https://img.icons8.com/ios-filled/50/1e88e5/doctor-male.png" alt="Doctor Icon"> 
            Reports for Dr. Saed
        </h3>
        <p id="saedReport">No files received.</p>
    </div>
</div>

<script>
    const khalidReport = document.getElementById('khalidReport');
    const saedReport = document.getElementById('saedReport');

    // Load the file links from localStorage
    const khalidFile = JSON.parse(localStorage.getItem('report-khalid'));
    const saedFile = JSON.parse(localStorage.getItem('report-saed'));

    if (khalidFile) {
        khalidReport.innerHTML = `<a href="${khalidFile.link}" download="${khalidFile.name}">
            Download ${khalidFile.name} <img src="https://img.icons8.com/ios-glyphs/30/1e88e5/download.png" alt="Download Icon">
        </a>`;
    }

    if (saedFile) {
        saedReport.innerHTML = `<a href="${saedFile.link}" download="${saedFile.name}">
            Download ${saedFile.name} <img src="https://img.icons8.com/ios-glyphs/30/1e88e5/download.png" alt="Download Icon">
        </a>`;
    }

    // Automatically scroll to the relevant section if a query parameter exists
    const params = new URLSearchParams(window.location.search);
    const doctor = params.get('doctor');

    if (doctor) {
        const section = document.getElementById(doctor);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
</body>
</html>

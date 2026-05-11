<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration - Fábula Dental</title>
    <link rel="stylesheet" href="../css/forms.css">
</head>

<body>

<header>
    <h1>Patient Registration - Fábula Dental</h1>
</header>

<div class="form-container">
    <div class="form-card">

        <h2>Patient Details</h2>

        <form action="../../controllers/patient-controller.php" method="POST">
            <input type="hidden" name="action" value="create">
            <div class="form-grid">

                <div class="input-group">
                    <label for="nombre">Full Name</label>
                    <input type="text" id="nombre" name="fullName" required minlength="3" placeholder="Ex: John Doe">
                </div>

                <div class="input-group">
                    <label for="cedula">ID Card (Cédula)</label>
                    <input type="text" id="cedula" name="patientID" required pattern="[0-9]{10}" placeholder="1727095414">
                </div>

                <div class="input-group">
                    <label for="fecha">Date of Birth</label>
                    <input type="date" id="fecha" name="birthday" min="1900-01-01" max="2026-03-20" required>
                </div>

                <div class="input-group">
                    <label for="telefono">Phone Number</label>
                    <input type="tel" id="telefono" name="phone" required pattern="[0-9]{10}" placeholder="0991234567">
                </div>

                <div class="input-group">
                    <label for="genero">Gender</label>
                    <select id="genero" name="gender" required>
                        <option value="">Select</option>
                        <option value="femenino">Female</option>
                        <option value="masculino">Male</option>
                        <option value="otro">Other</option>
                    </select>
                </div>

                <div class="input-group full-width">
                    <label for="motivo">Reason for Visit</label>
                    <input type="text" id="motivo" name="reasonForConsultation" required minlength="5" placeholder="Ex: Tooth sensitivity">
                </div>

                <div class="full-width">
                    <button type="submit" class="btn btn-primary">
                        Register Patient
                    </button>
                </div>

                <div class="full-width actions-row" style="display: flex; gap: 10px;">
                    <a href="./patient-list.php" class="btn btn-secondary">View Registered Patients</a>
                    <a href="../html/index.html" class="btn btn-secondary">Back to Home</a>
                </div>

            </div>
        </form>

    </div>
</div>

<footer style="text-align:center; padding:15px;">
    <p>&copy; 2026 Fábula Dental - Pediatric Dentistry.</p>
</footer>



</body>
</html>
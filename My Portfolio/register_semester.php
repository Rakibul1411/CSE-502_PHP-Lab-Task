<?php
session_start();
include './includes/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$success = "";
$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $semester = $_POST['semester'];
    $user_id = $_SESSION['user_id']; // Get logged-in user ID

    $course_1 = $_POST['course_1'];
    $course_2 = $_POST['course_2'];
    $course_3 = $_POST['course_3'];
    $course_4 = $_POST['course_4'];
    $course_5 = $_POST['course_5'];
    $course_6 = $_POST['course_6'];

    $semester_table = "semester_$semester";

    // Check if the user already registered this semester
    $stmt = $pdo->prepare("SELECT * FROM registered_semesters WHERE user_id = ? AND semester = ?");
    $stmt->execute([$user_id, $semester]);
    $existing = $stmt->fetch();

    if ($existing) {
        // Delete existing semester courses before inserting new ones
        $stmt = $pdo->prepare("DELETE FROM $semester_table WHERE id = ?");
        $stmt->execute([$existing['id']]);

        // Update `registered_semesters` to reflect the new registration
        $stmt = $pdo->prepare("UPDATE registered_semesters SET created_at = NOW() WHERE user_id = ? AND semester = ?");
        $stmt->execute([$user_id, $semester]);
    } else {
        // Insert new semester registration record
        $stmt = $pdo->prepare("INSERT INTO registered_semesters (user_id, semester) VALUES (?, ?)");
        $stmt->execute([$user_id, $semester]);
    }

    // Insert new semester courses
    $stmt = $pdo->prepare("INSERT INTO $semester_table (course_1, course_2, course_3, course_4, course_5, course_6) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$course_1, $course_2, $course_3, $course_4, $course_5, $course_6])) {
        $success = "Courses for Semester $semester have been successfully registered!";
    } else {
        $error = "Failed to register courses.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register Semester Course</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Register Semester Course</h2>
        
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
            <div class="d-flex justify-content-center gap-3">
                <a href="semester.php" class="btn btn-secondary">Back to Semester Page</a>
                <a href="register_semester.php" class="btn btn-primary">Register Another Semester</a>
            </div>
        <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php else: ?>
            <form method="POST" class="mx-auto" style="max-width: 500px;">
                <div class="mb-3">
                    <label class="form-label">Select Semester</label>
                    <select name="semester" class="form-select" required>
                        <option value="">-- Select Semester --</option>
                        <?php for ($i = 1; $i <= 8; $i++): ?>
                            <option value="<?php echo $i; ?>">Semester <?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course 1</label>
                    <input type="text" class="form-control" name="course_1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course 2</label>
                    <input type="text" class="form-control" name="course_2" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course 3</label>
                    <input type="text" class="form-control" name="course_3" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course 4</label>
                    <input type="text" class="form-control" name="course_4" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course 5</label>
                    <input type="text" class="form-control" name="course_5" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course 6</label>
                    <input type="text" class="form-control" name="course_6" required>
                </div>

                <button type="submit" class="btn btn-success w-100">Register Courses</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

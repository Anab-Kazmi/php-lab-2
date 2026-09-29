```php
<?php

require "db.php";

// Variables for form values
$name = "";
$roll_number = "";
$course = "";
$semester = "";
$gpa = "";

// Store validation errors
$errors = [];

// Run only when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get form values
    $name = trim($_POST["name"] ?? "");
    $roll_number = trim($_POST["roll_number"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $semester = trim($_POST["semester"] ?? "");
    $gpa = trim($_POST["gpa"] ?? "");


    // -----------------------------
    // Server-side validation
    // -----------------------------

    // Name validation
    if ($name === "") {
        $errors[] = "Name is required.";
    }

    // Roll number validation
    if ($roll_number === "") {
        $errors[] = "Roll number is required.";
    }

    // Course validation
    if ($course === "") {
        $errors[] = "Course is required.";
    }

    // Semester validation
    if ($semester === "") {
        $errors[] = "Semester is required.";
    } elseif (!filter_var($semester, FILTER_VALIDATE_INT)) {
        $errors[] = "Semester must be a whole number.";
    } else {

        $semesterNumber = (int) $semester;

        if ($semesterNumber < 1 || $semesterNumber > 8) {
            $errors[] = "Semester must be between 1 and 8.";
        }
    }

    // GPA validation
    if ($gpa === "") {
        $errors[] = "GPA is required.";
    } elseif (!is_numeric($gpa)) {
        $errors[] = "GPA must be a number.";
    } else {

        $gpaNumber = (float) $gpa;

        if ($gpaNumber < 0 || $gpaNumber > 4.00) {
            $errors[] = "GPA must be between 0.00 and 4.00.";
        }
    }


    // -----------------------------
    // Insert only if no errors
    // -----------------------------

    if (empty($errors)) {

        // Escape text fields
        $safeName = mysqli_real_escape_string($conn, $name);
        $safeRollNumber = mysqli_real_escape_string($conn, $roll_number);
        $safeCourse = mysqli_real_escape_string($conn, $course);

        // Cast numeric fields
        $semester = (int) $semester;
        $gpa = (float) $gpa;

        // Insert query
        $sql = "INSERT INTO students (name, roll_number, course, semester, gpa)
                VALUES ('$safeName', '$safeRollNumber', '$safeCourse', $semester, $gpa)";

        // Run query
        if (mysqli_query($conn, $sql)) {

            // Redirect after successful insert
            header("Location: students.php");
            exit;

        } else {

            // Database error
            $errors[] = "Database error: " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Student</title>
</head>

<body>

    <h2>Add New Student</h2>


    <?php if (!empty($errors)) { ?>

        <div style="color: red;">

            <strong>Please fix the following:</strong>

            <ul>

                <?php foreach ($errors as $error) { ?>

                    <li>
                        <?php echo htmlspecialchars($error); ?>
                    </li>

                <?php } ?>

            </ul>

        </div>

    <?php } ?>


    <form method="POST" action="new-student.php">

        <p>
            Name:
            <input
                type="text"
                name="name"
                value="<?php echo htmlspecialchars($name); ?>"
            >
        </p>

        <p>
            Roll Number:
            <input
                type="text"
                name="roll_number"
                value="<?php echo htmlspecialchars($roll_number); ?>"
            >
        </p>

        <p>
            Course:
            <input
                type="text"
                name="course"
                value="<?php echo htmlspecialchars($course); ?>"
            >
        </p>

        <p>
            Semester:
            <input
                type="number"
                name="semester"
                value="<?php echo htmlspecialchars($semester); ?>"
            >
        </p>

        <p>
            GPA:
            <input
                type="number"
                name="gpa"
                step="0.01"
                value="<?php echo htmlspecialchars($gpa); ?>"
            >
        </p>

        <button type="submit">Add Student</button>

    </form>


    <p>
        <a href="students.php">← Back to Students</a>
    </p>

</body>

</html>
```

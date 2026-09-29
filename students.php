```php
<?php

require "db.php";

// Get search value from URL
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

// Get sorting option from URL
$sort = isset($_GET["sort"]) ? $_GET["sort"] : "";

// Start the main SELECT query
$sql = "SELECT id, name, roll_number, course, semester, gpa
        FROM students";

// Add name search filter
if ($search !== "") {

    $safeSearch = mysqli_real_escape_string($conn, $search);

    $sql .= " WHERE name LIKE '%$safeSearch%'";
}

// Add GPA sorting
if ($sort === "asc") {

    $sql .= " ORDER BY gpa ASC";

} elseif ($sort === "desc") {

    $sql .= " ORDER BY gpa DESC";
}

// Run the main query
$result = mysqli_query($conn, $sql);

// Check main query
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Count displayed results
$total = mysqli_num_rows($result);


// ------------------------------------------
// Course grouping query
// ------------------------------------------

$groupSql = "SELECT course, COUNT(*) AS total_students
             FROM students
             GROUP BY course
             ORDER BY course ASC";

$groupResult = mysqli_query($conn, $groupSql);

// Check grouping query
if (!$groupResult) {
    die("Course grouping query failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Records</title>
</head>

<body>

    <h2>Student Records</h2>

    <p>
        <?php
        if ($search !== "") {
            echo $total . " student(s) found for \""
                . htmlspecialchars($search)
                . "\".";
        } else {
            echo $total . " students in total.";
        }
        ?>
    </p>


    <!-- Search Form -->
    <form method="GET" action="students.php">

        <input
            type="text"
            name="search"
            placeholder="Search by student name"
            value="<?php echo htmlspecialchars($search); ?>"
        >

        <button type="submit">Search</button>

        <?php if ($search !== "") { ?>

            <a href="students.php">Clear Search</a>

        <?php } ?>

    </form>


    <br>


    <!-- GPA Sorting -->
    <p>

        Sort by GPA:

        <a href="students.php?sort=asc<?php
            if ($search !== "") {
                echo '&search=' . urlencode($search);
            }
        ?>">
            Low → High
        </a>

        |

        <a href="students.php?sort=desc<?php
            if ($search !== "") {
                echo '&search=' . urlencode($search);
            }
        ?>">
            High → Low
        </a>

        <?php if ($sort !== "") { ?>

            |
            <a href="students.php<?php
                if ($search !== "") {
                    echo '?search=' . urlencode($search);
                }
            ?>">
                Clear Sort
            </a>

        <?php } ?>

    </p>


    <!-- Add Student -->
    <p>
        <a href="new-student.php">+ Add New Student</a>
    </p>


    <!-- Student Table -->
    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll Number</th>
            <th>Course</th>
            <th>Semester</th>
            <th>GPA</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td>
                    <?php echo $row["id"]; ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["name"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["roll_number"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($row["course"]); ?>
                </td>

                <td>
                    <?php echo $row["semester"]; ?>
                </td>

                <td>
                    <?php echo $row["gpa"]; ?>
                </td>

            </tr>

        <?php } ?>

    </table>


    <br>


    <!-- Course Group Summary -->
    <h3>Students by Course</h3>

    <table border="1" cellpadding="8" cellspacing="0">

        <tr>
            <th>Course</th>
            <th>Total Students</th>
        </tr>

        <?php while ($group = mysqli_fetch_assoc($groupResult)) { ?>

            <tr>

                <td>
                    <?php echo htmlspecialchars($group["course"]); ?>
                </td>

                <td>
                    <?php echo $group["total_students"]; ?>
                </td>

            </tr>

        <?php } ?>

    </table>

</body>
</html>
```

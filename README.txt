# PHP Lab 2 – Student Records Management App

## Project Overview

This project is a simple Student Records Management App developed using PHP and MariaDB.

The application demonstrates how PHP connects to a database using `mysqli`, reads student records, inserts new records through a form, validates user input, and provides basic search and sorting features.

---

## Technologies Used

* PHP
* MariaDB / MySQL
* MySQLi
* HTML
* XAMPP

---

## Database Information

**Database Name:** `inventorydb`

**Table Name:** `students`

### Table Structure

| Column        | Data Type    | Description                     |
| ------------- | ------------ | ------------------------------- |
| `id`          | INT          | Primary key with AUTO_INCREMENT |
| `name`        | VARCHAR(100) | Student name                    |
| `roll_number` | VARCHAR(30)  | Student roll number             |
| `course`      | VARCHAR(100) | Student course                  |
| `semester`    | INT          | Student semester                |
| `gpa`         | DECIMAL(3,2) | Student GPA                     |

---

## Project Files

### `db.php`

Creates the database connection using `mysqli_connect()` and checks for connection errors.

### `test.php`

Used to verify that PHP can successfully connect to the `inventorydb` database.

### `students.php`

Displays all student records in an HTML table. It also shows the total number of students and provides search, GPA sorting, and course grouping features.

### `new-student.php`

Contains the form for adding new student records. It performs server-side validation, escapes text input, casts numeric values, inserts valid records into the database, and redirects to the student list after a successful insert.

### `README.txt`

Contains information about the project, database, files, features, and implementation.

### `inventorydb.sql`

SQL export of the database, including the `students` table and its records.

---

## Required Features Completed

* Database created successfully
* Students table created with primary key and AUTO_INCREMENT
* PHP database connection using `mysqli`
* Student records retrieved using `SELECT`
* Student records displayed in an HTML table
* Total student count using `mysqli_num_rows()`
* New student form using `$_POST`
* Student insertion using `INSERT`
* Redirect after successful insertion
* Clear database and query error handling
* SQL injection protection using `mysqli_real_escape_string()`
* Numeric input casting using `(int)` and `(float)`
* Output escaping using `htmlspecialchars()`

---

## Bonus Features Completed

### 1. Search

Students can be searched by name using a SQL `LIKE` query.

### 2. GPA Sorting

Students can be sorted by GPA:

* Low to High
* High to Low

### 3. Group by Course

A separate summary shows the number of students in each course using `GROUP BY` and `COUNT()`.

### 4. Server-Side Validation

Form data is validated on the server before insertion.

Validation includes:

* Required fields
* Valid semester range
* Valid numeric GPA
* GPA range from 0.00 to 4.00
* Form values are preserved when validation errors occur

---

## Sample Data

The database contains sample student records for testing the application.

Additional students can be added through the **Add New Student** form.

---

## How to Run

1. Start Apache and MySQL from XAMPP.

2. Open the project in a browser using:

   `http://localhost/PHP-Lab-2/students.php`

3. Use the **Add New Student** link to insert new records.

4. Use the search and sorting features from the student records page.

---

## Security Practices Used

* `mysqli_real_escape_string()` is used for text input before SQL insertion.
* `(int)` and `(float)` are used for numeric input.
* `htmlspecialchars()` is used when displaying database values.
* Database connection and query errors are checked.

---

## Submission Files

The project folder contains:

* `db.php`
* `test.php`
* `students.php`
* `new-student.php`
* `README.txt`
* `inventorydb.sql`

---

## Project Status

All required PHP Lab 2 features and all four optional bonus features have been implemented and tested.

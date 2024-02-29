<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location:login.php");
    exit();
}
include "start.php";
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname']; 
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];

    
    $sql_students = "UPDATE students SET firstname='$firstname', lastname='$lastname', email='$email', gender='$gender' WHERE id='$id'";
    if ($conn->query($sql_students) === TRUE) {
       
        $sql_qualification = "UPDATE qualification SET qualification='$qualification' WHERE uid='$id'";
        if ($conn->query($sql_qualification) === TRUE) {
            header("location: view.php");
            exit();
        } else {
            echo "Error updating qualification: " . $conn->error;
        }
    } else {
        echo "Error updating student details: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT students.id, students.firstname, students.lastname, students.email, students.gender, qualification.qualification
            FROM students
            INNER JOIN qualification ON students.id = qualification.uid
            WHERE students.id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
        
<h2>Student details Update Form</h2>
<div class="container">
    <h2>Update User</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="qualification">Qualification:</label>
            <input type="text" class="form-control" id="qualification" name="qualification" value="<?php echo $row['qualification']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
<head>
    <script>
        var inactiveTime = 0;
        function resetInactiveTime() {
            inactiveTime = 0;
        }
        function checkInactivity() {
            inactiveTime++;
            if (inactiveTime >= 10) {
                window.location.href = 'logout.php';
            }
        }
        document.addEventListener('mousemove', resetInactiveTime);
        document.addEventListener('keypress', resetInactiveTime);
        setInterval(checkInactivity, 1000);
    </script>
</head>
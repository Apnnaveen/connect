<?php
session_start();

include "start.php";
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];

    // Insert into students table
    $sql = "INSERT INTO students (firstname, lastname, email, password, gender) VALUES ('$firstname', '$lastname', '$email', '$password', '$gender')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        
        // Insert into qualification table
        $sql_qualification = "INSERT INTO qualification (uid, qualification) VALUES ('$last_id', '$qualification')";
        if ($conn->query($sql_qualification) === TRUE) {
            
            header("location: view.php");
            exit();
        } else {
            echo "Error: " . $sql_qualification . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2>Add User</h2>
        <form method="post">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="qualification">Qualification:</label>
                <input type="text" class="form-control" id="qualification" name="qualification" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
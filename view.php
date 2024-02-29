<?php
session_start();
include "start.php";


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location:login.php");
    exit();
    // if (time() - $_SESSION['login_time'] >= 3) {
    //     session_destroy();
    //     header("Location: login.php");
    //     die(); //

    // } else {
    //     $_SESSION['login_time'] = time();

    // }
}
?>

<!DOCTYPE html>
<html>

<head>



    <title>Student Database</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2 class="text-center"><b>Student Details</b></h2>
        <a class="btn btn-success" href="logout.php">Log out</a>
        <a class="btn btn-success" href="create.php">Add user</a>

        <br><br>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <!-- <th>Password</th> -->
                    <th>Gender</th>
                    <th>qualification</th>
                    <th>Action</th>


                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT students.id,students.firstname,students.lastname,students.gender, students.email,qualification.qualification
                FROM students
                INNER JOIN qualification on students.id = qualification.uid;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['id']; ?>
                            </td>
                            <td>
                                <?php echo $row['firstname']; ?>
                            </td>
                            <td>
                                <?php echo $row['lastname']; ?>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                           
                            <td>
                                <?php echo $row['gender']; ?>
                            </td>
                            <td>
                                <?php echo $row['qualification']; ?>
                            </td>


                            <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>

                            </td>
                        </tr>
                    <?php }
                }
                ?>
            </tbody>
        </table>
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
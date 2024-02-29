<?php

include "start.php";
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location:login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete records from both students and qualification tables
    $sql_delete_records = "DELETE students, qualification FROM students 
        JOIN qualification ON students.id = qualification.uid 
        WHERE students.id = '$id'";
        
    if ($conn->query($sql_delete_records) === TRUE) {
        header("location: view.php");
        exit();
    } else {
        echo "Error deleting records: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit();
}
?>


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
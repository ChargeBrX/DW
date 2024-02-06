<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php


require("connection_connect.php");





// Open uploaded CSV file with read-only mode
$csvFile = fopen($_FILES['file']['tmp_name'], 'r');

// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line        
while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
    // Get row data
    $studentId = $getData[0];
    $title = $getData[1];
    $name = $getData[2];
    $gender = $getData[3];
    $generetion = $getData[4];
    $departmentCode = $getData[5];



    // get genterId
    $genderSQL = "SELECT genderId FROM gender WHERE genderTh ='$gender'";
    $result = $conn->query($genderSQL);
    $genderId = $result->fetch_assoc()["genderId"];


    // get generetionId
    $generetionSQL = "SELECT generetionId FROM generetion WHERE generetion = $generetion";
    $result = $conn->query($generetionSQL);
    $generetionId = $result->fetch_assoc()["generetionId"];


    //get departmentId
    $departmentSQL = "SELECT departmentId FROM department WHERE departmentCode ='$departmentCode'";
    $result = $conn->query($departmentSQL);
    $departmentId = $result->fetch_assoc()["departmentId"];




    // If user already exists in the database with the same email
    $query = "SELECT studentId FROM student WHERE studentId = '$studentId'";

    $check = mysqli_query($conn, $query);

    if ($check->num_rows > 0) {
        mysqli_query($conn, "UPDATE student SET title = '$title' , name = '$name' , genderId = $genderId , generetionId = $generetionId , departmentId = $departmentId WHERE studentId = '" . $studentId . "'");
    } else {

        mysqli_query($conn, "INSERT INTO student (studentId, departmentId, genderId, generetionId, title,name) VALUES ('$studentId',$departmentId,$genderId,$generetionId,'$title','$name')");
    }
}

// Close opened CSV file
fclose($csvFile);

//  header("Location: index.php");

echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'เพิ่มข้อมูลสำเร็จ!',
                        icon: 'success',
                        timer: 5000,
                        showConfirmButton: false
                    });
                })
            </script>";

header("refresh:2; url=../views/home.php");




require("connection_close.php");






?>
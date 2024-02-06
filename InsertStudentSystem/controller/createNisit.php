<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
$studentId = $_POST["studentId"];
$name = $_POST["name"];
$title = $_POST["title"];
$genderId = $_POST["genderId"];
$departmentId = $_POST["departmentId"];
$generetionId = $_POST["generetionId"];

require("connection_connect.php");

mysqli_query($conn, "INSERT INTO student (studentId, departmentId, genderId, generetionId, title,name) VALUES ('$studentId',$departmentId,$genderId,$generetionId,'$title','$name')");


require("connection_close.php");



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

header("refresh:2; url=../views/addNisit.php");


?>
<?php 
 $con = mysqli_connect("localhost","root","","DB_student");
 if($con){
        echo "connect ..";
 }else{
    echo "no connect";
 }
?>
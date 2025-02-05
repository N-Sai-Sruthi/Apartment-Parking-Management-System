<?php
$servername='localhost';
$username='root';
$password='N.saisruthi20';
$databasename='carparkingwebsite';
$conn=new mysqli($servername,$username,$password,$databasename);
if($conn->connect_error){
    die('connect error'.$conn->connect_error);
}
$emailid=$_POST['emailid'];
$slotnumber=$_POST['slotnumber'];
$value1=0;
$stmt1=$conn->prepare("DELETE FROM slot_booking where emailid=? and slot_number=?");
$stmt1->bind_param("si",$emailid,$slotnumber);
$stmt1->execute();
$stmt1->close();
$stmt2=$conn->prepare("UPDATE parking_slots set is_booked=? where slot_number=?");
$stmt2->bind_param("ii",$value1,$slotnumber);
$stmt2->execute();
$stmt2->close();
echo"slot releived";
$conn->close();
?>
<?php
include('db.php');
$sql = "UPDATE contact SET name='".$_POST['name']."',email='".$_POST['email']."', message ='".$_POST['message']."' WHERE id='".$_POST['id']."'";
$res = mysqli_query($db, $sql );
if($res == TRUE)
{
	return TRUE;
}
else
{
	return FALSE;
}
?>
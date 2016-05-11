<?php
session_start();
include_once "conn.php"; 

//$_SESSION['name']="";
$_SESSION['username']="";
$_SESSION['password']="";
$_SESSION['empno']="";

$_SESSION['storeid'] = "";
$_SESSION['usertype']="";
$tbl_name="employee"; // Table name


// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT employee.emp_no, employee.emp_fname,employee.emp_status,employee.emp_storeid,useraccount.uname, useraccount.pword, useraccount.usertype
FROM employee INNER JOIN useraccount ON employee.emp_no = useraccount.user_id
WHERE uname='$myusername' and pword='$mypassword'" ;
$result=mysql_query($sql);
$item = mysql_fetch_assoc($result);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
$row = mysql_fetch_row($result);

$_SESSION['username']=$myusername;
$_SESSION['password']=$mypassword;
$_SESSION['empno'] = $item['emp_no'];
$_SESSION['storeid'] = $item['emp_storeid'];

$employeenumber = $item['emp_no'];

$select_usertype = mysql_query("SELECT * FROM useraccount WHERE user_id = '$employeenumber'");
$item_select_utype = mysql_fetch_assoc($select_usertype) or die (mysql_error());

$_SESSION['usertype'] = $item_select_utype['usertype'];
if($item_select_utype['usertype'] == "Employee")
{
	header("location:html/employeeindex.php");	

}
else
{
	header("location:html/");
}

}
else {

//echo"<script>alert('$uname')</script>";
header("location:index.php?msg=Wrong%20Username%20or%20Password");
}
?>
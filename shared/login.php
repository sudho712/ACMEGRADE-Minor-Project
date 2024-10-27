<?php
$host="localhost";
$user="root";
$pass="";
$db="ecom";
$port=3306;

/* $conn=new mysqli($host,$user,$pass,$db,$port); */
$conn = new mysqli("localhost", "root", "", "ecom", 3306);
$query = "SELECT * FROM user WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
echo $query;
$sql_result=mysqli_query($conn,$query);
print_r($sql_result);

if($sql_result->num_rows>0)
{
    echo "login Success";
    $dbrow=mysqli_fetch_assoc($sql_result);
    print_r($dbrow);
    if($dbrow["usertype"]=="seller")
    {
        header("location: ../Seller/home.html");
    }
    else  if($dbrow["usertype"]=="buyer"){
        header("location: ../Buyer/home.html");
    }
}else{
    echo "Invalid user name / password";
}
?>
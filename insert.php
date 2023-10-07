<?php
$text =$_POST['FirstName'];
$text =$_POST['LastName'];
$emai =$_POST['EmailId'];
$password =$_POST['EnterPassword'];
if(!empty($FirstName)|| !empty($LastName)|| !empty($EmailId)|| !empty(EnterPassword)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "demo";

    //connection
    $conn = new mysql($host,$dbUsername,$dbPassword,$demo);

    if(mysql_connect_error()){
        die('Connect error('.mysql_connect_error().')'.mysql_connect_error());
    }else{
        $SELECT = "SELECT email From logininf Where email = ? Limit 1";
        $INSERT = "INSERT Into logininf (Firstname, lastname, EmailId, Enterpassword) values(?, ?, ?, ?)";


        //prepare statement
        $stmt = $conn->prepare($SELECT),
        $stmt->bind_param("s",$EmailId);
        $stmt->execute();
        $stmt->bind_result($EmailId);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssi",$FirstName,$LastName,$EmailId,$Enterpassword);
            $stmt->execute();
            echo "new record inserted successfully";
        }else{
            echo "someone already registerd";
        }
        $stmt->close();
        $conn->close();
    }
}else{
    echo"All fields are required";
    die();
}

?>
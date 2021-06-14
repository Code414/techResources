<?php

    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "signup";

    $con = mysqli_connect($server,$user,$password,$db);

    if($con){
        ?>
        <script>
            alert("Connection Successful");
        </script>
        <?php    
    }else{
        ?>
        <script>
            alert("No Connection");
        </script>
        <?php    
    }

    /* $email = $_POST["email"] ?? " ";
    $username = $_POST["username"] ?? " ";
    $password = $_POST["password"] ?? " ";

    //Databse Connection
    $conn = new mysqli('localhost','root','','signup');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into signup_table(email,username,password) values('$email','$username','$password')");
        $stmt->bind_param("sss",$email,$username,$password);
        $stmt->execute();
        echo "Sign up successful";
        $stmt->close();
        $conn->close();
    } */
    /* if(isset($_POST['submitbtn'])){
        //your code
       header('Location:login.html?status=success');//redirect to your html with status
    } */
?>

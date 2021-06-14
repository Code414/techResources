<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/logstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">    
    <title>techResources</title>
</head>
<body>

<?php

include 'connect.php';

    if(isset($_POST['submitbtn'])){
    $email =  mysqli_real_escape_string($con,$_POST['email']);
    $username =  mysqli_real_escape_string($con,$_POST['username']);
    $password =  mysqli_real_escape_string($con,$_POST['password']);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    //To check email is already exists or not
    $emailquery = " select * from signup_table where email='$email' ";
    $query = mysqli_query($con,$emailquery);

    $emailcount = mysqli_num_rows($query);
    if($emailcount>0){
        echo "Email already exists";
    }else{
        $insertquery = "insert into signup_table(email, username, password) values('$email','$username','$pass')";

        $iquery = mysqli_query($con, $insertquery);

        if($iquery){
            ?>
        <script>
            alert("Inserted Successful");
            location.replace("login.php");
        </script>
        <?php    
    }else{
        ?>
        <script>
            alert("No COnnection");
        </script>
        <?php 
        }
    }

    }
?>

    <nav class="navbar background h-nav-resp"> 
        <ul class="nav-list v-class-resp">
            <div class="logo"><img src="../images/lap_img.jpg" alt="logo" width="100" height="100"></div>
            <li><a href="index.html">Home</a></li>
            <li><a href="data_structures.html">Data Structures</a></li>
            <li><a href="algorithms.html">Algorithms</a></li>
            <li><a href="competitive_programming.html">Competitive Programming</a></li>
            <li><a href="operating_system.html">Operating System</a></li>
            <li><a href="dbms.html">DBMS</a></li>
            <li><a href="computer_networks.html">Computer Networks</a></li>
            <li><a href="oops.html">OOPS</a></li>
        </ul>
        <div class="burger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </nav>
     <div class="loginbox">
         
         <h1>Sign Up</h1>
         <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <p>Email ID</p>
            <input type="text" name="email" placeholder="Enter your email id" required>
             <p>Username</p>
             <input type="text" name="username" placeholder="Enter Username" required>
             <p>Password</p>
             <input type="password" name="password" placeholder="Enter Password" required>
            
             <input class="submitbtn" name ="submitbtn" type="submit"   value="Sign Up" />     
             <!-- <input type="submit" onclick="location.href='todo.html';" value="Log In" /> -->
             <!-- <a href="#">Forgot your password?</a><br>      -->
             
         </form>

     </div>

</body>

</html>
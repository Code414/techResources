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
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email_search = " select * from signup_table where email='$email' " ;
        $query = mysqli_query($con,$email_search);

        $email_count = mysqli_num_rows($query);

        if($email_count){
            $email_pass = mysqli_fetch_assoc($query);
            $db_pass = $email_pass['password'];

            $_SESSION['username']  = $email_pass['username'];
            

            $pass_decode = password_verify($password, $db_pass);

            if($pass_decode){
                echo "Login Successful";
                ?>
                <script>
                    location.replace("todo.php");
                </script>
                <?php
            }else{
                echo "Password Incorrect";
            }
            }else{
                echo "Invalid Email";
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
         
         <h1>Login Here</h1>
         <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method ="POSt">
             <p>Email</p>
             <input type="text" name="email" placeholder="Enter email id" required>
             <p>Password</p>
             <input type="password" name="password" placeholder="Enter Password" required>
            
             <input class="submitbtn" name= "submitbtn" type="submit" value="Log In" />
             <!-- <input type="submit" onclick="location.href='todo.html';" value="Log In" /> -->
             <!-- <a href="#">Forgot your password?</a><br> -->
             <a href="signup.php">Don't have an account? Register Here!</a>
         </form>

     </div>

</body>

</html>
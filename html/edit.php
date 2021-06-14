<?php

session_start();


if(!isset($_SESSION['username'])){
    echo "You are logged out!";
    header('location: login.php');
} 

?>

<?php

include 'connect.php';
    if(isset($_GET['edit_todo'])){
        $e_id = $_GET['edit_todo'];
    }

    if(isset($_POST['addtaskbtn'])){
        $addtaskbtn = $_POST['addtaskinput'];

        $query = "update todo_table set t_name = '$addtaskbtn' where t_id = $e_id";
        $run = mysqli_query($con,$query);

        if(!$run) {
            die("Failed");
        }else{
            header("Location: todo.php?updated");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Question List</title>
  <link rel="stylesheet" href="../css/font-awesome.min.css" />
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <link rel="stylesheet" href="../css/todostyle.css" />
  <link rel="stylesheet" type="text/css" href="../css/style.css">   
</head>

<body>
   

<?php
include 'connect.php';


    

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

  <header class="bg-dark mb-3">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <nav class="navbar justify-content-between">
            <a class="navbar-brand"><?php echo $_SESSION['username']; ?>'s Question List</a>
            <form class="form-inline" action="search.php" method="POST">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search"
                id="searchtextbox" />
                <div class="btn btn-danger" type="submit" name="logout" >
                    <a href="logout.php">Log Out</a>
                </div>
            </form>
          </nav>
        </div>
      </div>
    </div>
  </header>
  <section class="todo-outer">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-sm-12 col-md-8">
          <h1>To do Questions</h1>
          <form action="" method ="POSt">
              <?php
                $sql = "select * from todo_table where t_id = $e_id";
                $result = mysqli_query($con, $sql);
                $data = mysqli_fetch_array($result);
              ?>
          <div class="todo-inner">
            <div class="form-row">
              <div class="col-8 mr-sm-2">
                <input type="text" class="form-control" placeholder="Enter que or url" name="addtaskinput" value="<?php echo $data['t_name']; ?>" >
                <input type="hidden" id="saveindex">
              </div>
              <button type="submit" class="btn btn-success mr-sm-2" name="addtaskbtn">
                Add Que.
              </button>
              <button type="submit" class="btn btn-success mr-sm-2" name="savetaskbtn" style="display: none;">
                Save Que.
              </button>
              <button type="submit" name="deleteallbtn" class="btn btn-danger">
                Delete All
              </button>
            </div>
          </form>
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="../javascript/resp.js"></script>
  
</body>

</html>
<?php

session_start();


if(!isset($_SESSION['username'])){
    echo "You are logged out!";
    header('location: login.php');
}

?>

<?php

    $errors ="";

include 'connect.php';
    $query = "SELECT * FROM todo_table" ;
    $result = mysqli_query($con,$query);
    $t_username = $_SESSION['username'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $todo = $_POST['addtaskinput'];
  /* if (empty($addtaskinput)){
    $errors = "You must fill in the task";
  }else{ */
  $sql = "insert into todo_table(t_name,t_username) values('$todo','$t_username');";
  $results = mysqli_query($con,$sql);
  
  if(!$results){
    die("Failed");
  }else{
    header("Location:todo.php?todo-added");
  }
//}
}
if(isset($_GET['delete_todo'])){
  $dtl_todo = $_GET['delete_todo'];
  $sqli = "delete from todo_table where t_id = $dtl_todo" ;
  $res = mysqli_query($con,$sqli);
  if(!$res){
    die("Failed");
  }else{
    header("Location:todo.php?todo-deleted");
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
            <form class="form-inline">
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
          <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method ="POSt">
          <div class="todo-inner">
            <div class="form-row">
              <div class="col-8 mr-sm-2">
              <?php if(isset($errors)) {
                ?>
                    <p><?php echo $errors; ?></p>
                <?php 
              }
              ?>
                <input type="text" class="form-control" placeholder="Enter que or url" name="addtaskinput" />
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
            <div class="to-do-output">
              <table class="table table-striped mt-3 mb-0" id="addedtasklist">
                <thead>
                  <th>ID</th>
                  <th>Question</th>
                  <th>Edit Question</th>
                  <th>Delete Question</th>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                        while($row = mysqli_fetch_assoc($result)){
                          $t_id = $row['t_id'];
                          $t_name = $row['t_name'];
                          $t_username = $_SESSION['username'];

                        ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $t_name; ?></td>
                      <td><a href="edit.php?edit_todo=<?php echo $t_id; ?>" class="btn btn-primary">Edit </a></td>
                      <td><a href="todo.php?delete_todo=<?php echo $t_id; ?>" class="btn btn-danger">Delete </a><td>
                    </tr>
                        <?php
                          $i++;
                        }
                    ?>
                    
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="../javascript/resp.js"></script>
  
</body>

</html>
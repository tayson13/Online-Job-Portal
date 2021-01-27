<?php
session_start();
$id= $_SESSION['user_name'];

include '../db_con.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>lOOk-for.com</title>
  <link rel="stylesheet" href="../design/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="../css/home.css"> -->
    
<style>
    .left{
        border-right: 2px solid;
        display: block;
    }
    .right{
        padding-left: 40px;
    }
    .hof{
        color: black;
    }
    .hof:hover{
        color: red;
        text-decoration:none;
    }

</style>

</head>
<body>
    <?php
    
        if(isset($_POST['up'])){
            $c_p = mysqli_real_escape_string($con,$_POST['c_name']);
            $n_p = mysqli_real_escape_string($con,$_POST['n_name']);
            $n_cp = mysqli_real_escape_string($con,$_POST['n_pass']);

            $check_pass = "select * from admin where ad_email = '$id' and ad_pass= '$n_cp' ";
            $query = $con->query($check_pass);

            if ($query->num_rows>0){
                $sql = "UPDATE admin SET ad_username = '$c_p', ad_name= '$n_p' where ad_email = '$id' ";
                $isql = $con->query($sql);

                if($isql===true){
                    ?>
                    <script>
                        alert("Updated");
                    </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert("Error!!");
                    </script>
                    <?php
                }
            }
            else{
                ?>
                <script>
                    alert("Wrong Password!!");
                </script>
                <?php
            }
        }

        $sql = "select * from admin where ad_email='$id' ";
        $isql = $con->query($sql);

        if ($isql->num_rows > 0) {
            while($show = $isql->fetch_assoc()) {
                $username = $show["ad_username"];
                $name = $show["ad_name"];
            }
        }   
    ?>

    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="../pic/look-1.png" alt="logo" width="60" height="60"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="admin-home.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-job.php">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-emp.php">Employers <span class="sr-only">(current)</span></a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link" href="admin-seeker.php">Employees</a>
                </li>    
            </ul>
            <ul class="navbar-nav justify-content-end" >
                <li class="nav-item dropdown">
                    <?php
                    if(count($_SESSION) > 0) {
                        echo '<a class="nav-link dropdown-toggle log" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">'.$_SESSION['user_name'].'</a>';
                        }
                    else {
                        $cookie_name = 'username';
                        if(isset($_COOKIE[$cookie_name])) {
                            echo '<a class="nav-link dropdown-toggle log" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">'.$_COOKIE[$cookie_name].'</a>';
                        }else{
                            echo 'no cookies';
                        }
                    }
                    ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../home.php">Log out</a>
                    </div>
                </li>
    </nav>
    <br><br><br><br>

    <div class="container ">
        <div class="row">
            <div class="col-md-2 left">
            <?php
                $sql = "select * from admin where ad_email='$id' ";
                $isql = $con->query($sql);

                if ($isql->num_rows > 0) {
                    while($row = $isql->fetch_assoc()) {
                        echo "<h4>Name: {$row["ad_name"]} <h4>";
                    }
                }
                
            ?>
            <br>
            <a class="hof" href="admin-profile.php">View Profile</a>
            
            </div>


            <div class="col-md-10 right">
                <div class="card border-success card-header mb-3" ">
                <form center action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <h3>&nbsp; Username &nbsp;&nbsp; &nbsp;
                    <input type="text" value="<?php echo $username; ?>" name="c_name" placeholder="Input username" required> </h3>
                    <br>
                    <h3>&nbsp; Name &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="text" value="<?php echo $name; ?>" name="n_name" placeholder="Input name" required> </h3>
                    <br>
                    <h3>  &nbsp; Password &nbsp; &nbsp; &nbsp;
                    <input type="password" name="n_pass" placeholder="Current Password" required> </h3>
                    <br>

                    <div class="btn-group " role="group" aria-label="Basic mixed styles example">
                        <button type="submit" name="up" class="btn btn-success">Change Username</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

  <script src="../design/jquery-3.5.1.slim.min.js"></script>
  <script src="../design/popper.min.js"></script>
  <script src="../design/bootstrap.min.js"></script>

</body>
</html>
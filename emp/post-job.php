<?php
session_start();
$id = $_SESSION['user_name'];
$_SESSION['alert'] = "not";
?>
<!DOCTYPE html>
<html>
<head>
	<title>lOOk-for.com</title>
  <link rel="stylesheet" href="../design/bootstrap.min.css">
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/home-sign.css">

    <style>
        .job-box {
            color:rgb(233, 240, 236);
            background:  rgb(20, 70, 70);
            top:10px;
            width: 60%;
            height: auto; 
            position: relative;
            font-size: 18px;
            padding-left: 5%;
            padding-right: 5%;
            padding-top: 5%;
            }
        
        .log{
            font-family:Arial, Helvetica, sans-serif ;
            font-size: 16px;
            font-weight:bold;
        }
    </style>

</head>
<body>

    <?php
        include '../db_con.php';

        if(isset($_POST['submit'])){
            $j_title = mysqli_real_escape_string($con,$_POST['j-title']);
            $j_desc = mysqli_real_escape_string($con,$_POST['j-desc']);
            $j_req = mysqli_real_escape_string($con,$_POST['j-req']);
            $j_dline = mysqli_real_escape_string($con,$_POST['j-dline']);
            $j_ctg = mysqli_real_escape_string($con,$_POST['j-ctg']);
            $j_loc = mysqli_real_escape_string($con,$_POST['j-loc']);
            $j_cmp = mysqli_real_escape_string($con,$_POST['j-cmp']);
            $j_org = mysqli_real_escape_string($con,$_POST['j-org']);
            $j_add = mysqli_real_escape_string($con,$_POST['j-add']);
            $j_sal = mysqli_real_escape_string($con,$_POST['j-sal']);
            $j_vac = mysqli_real_escape_string($con,$_POST['j-vac']);
            // $j_id = mysqli_real_escape_string($con,$_POST['j-id']);

            $sql = "INSERT INTO job (job_title, job_description, job_requirement, job_deadline, catagory, 
                    state, cmp_name, cmp_type, job_location, salary, vacancy, employee_emp_email) 
                    VALUES ('$j_title', '$j_desc', '$j_req', '$j_dline', '$j_ctg', '$j_loc',
                            '$j_cmp', '$j_org', '$j_add','$j_sal', '$j_vac', '$id')";

            $isql = $con->query($sql);

            if($isql===TRUE){
                $_SESSION['alert']="Posted successfully.";
                header("location:home-log-emp.php");
            }else{
                ?>
                <script>
                    alert("Error while posting");
                </script>
                <?php
            }
        }else{
            $_SESSION['alert']="not";
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
                <li class="nav-item active">
                    <a class="nav-link" href="home-log-emp.php">Home <span class="sr-only">(current)</span></a>
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
                        <a class="dropdown-item" href="profile-emp.php">View Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../home.php">Log out</a>
                    </div>
                </li>
                <li >&nbsp; &nbsp;&nbsp; &nbsp;</li>
            </ul>
    </nav>
    <br>
    
    <div class="job-box container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <h4>Job Title</h4> <br>
            <input class="form-control mr-sm-2" name="j-title" type="text" placeholder="Job Title"  required> <br>
            
            <h4> Description</h4> <br>
            <textarea class="form-control mr-sm-2" name="j-desc" rows="8" cols="100" 
            placeholder="Job Description" required> </textarea><br>
            
            <h4>Job Requirement</h4> <br>
            <textarea class="form-control mr-sm-2" name="j-req" rows="8" cols="100" 
            placeholder="Job Requirment" required> </textarea><br>
            
            <h4>Job Deadline</h4> <br>
            <input class="form-control mr-sm-2" name="j-dline" type="date" required> <br>
            
            <h4>Job Category</h4> <br>
            <select name="j-ctg" required>
                <option disabled selected>-- Select Category --</option>
                <option value="Accounting">Accounting</option>
                <option value="Commercial">Commercial</option>
                <option value="Electrician">Electrician</option>
          	  	<option value="Medical">Medical</option>
          	  	<option value="IT">IT</option>
              </select> <br><br>

            <h4>State</h4> <br>
            <select name="j-loc" required>
                <option disabled selected>-- Select City --</option>
                <option value="Barisal">Barisal</option>
                <option value="Chittagong">Chittagong</option>
          	  	<option value="Dhaka">Dhaka</option>
          	  	<option value="Khulna">Khulna</option>
          	  	<option value="Rajshahi">Rajshahi</option>
                <option value="Rangpur">Rangpur</option>
                <option value="Shylet">Shylet</option>  	
              </select> <br><br>

            <h4>Company Name</h4> <br>
            <input class="form-control mr-sm-2" name="j-cmp" type="text" placeholder="Company Name"  required> <br>

            <h4>Company Type</h4> <br>
            <select name="j-org" required>
                <option disabled selected>-- Select Type --</option>
                <option value="Govt">Govt</option>
                <option value="NGO">NGO</option>
          	  	<option value="Private">Private</option>	
              </select> <br><br>

                        
            <h4>Company Address</h4> <br>
            <input class="form-control mr-sm-2" name="j-add" type="text" placeholder="Company Address"  required> <br>

            <h4>Salary</h4> <br>
            <input class="form-control mr-sm-2" name="j-sal" type="text" placeholder="Salary"  required> <br>

            <h4>Vacancy</h4> <br>
            <input class="form-control mr-sm-2" name="j-vac" type="text" placeholder="Total Vacancy"  required> <br>

            <button class="btn btn-outline-white" type="submit" name="submit" ">Submit</button> <br><br>
        </form>
    </div>

  <script src="../design/jquery-3.5.1.slim.min.js"></script>
  <script src="../design/popper.min.js"></script>
  <script src="../design/bootstrap.min.js"></script>

</body>
</html>


<?php

include 'conn.php';

// Initialize $result
$result = array('id' => '', 'name' => '', 'gender' => '', 'email' => '', 'department' => '', 'address' => '');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Save data
    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $address = $_POST['address'];

        $insert = "INSERT INTO `ems_data` (`name`, `gender`, `email`, `department`, `address`) 
        VALUES ('$name', '$gender', '$email', '$department', '$address');";

        $data = mysqli_query($conn, $insert);

        if ($data) {
            echo "<script>alert('Data saved successfully')</script>";
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }

    
    }

// Search data

if (isset($_POST['searchdata'])) {
    $search = $_POST['search'];

    $query = "SELECT * FROM `ems_data` WHERE id = '$search'";
    $total = mysqli_query($conn, $query);
     $result = mysqli_fetch_assoc($total);

   if ($result == "") {
      echo "<script>alert('This record is not present')</script>";
   }  

}

//update data
if (isset($_POST['update'])) {

        $id = $_POST['search'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $address = $_POST['address'];

        $update = "UPDATE `ems_data` SET `name` = '$name' ,`gender` = '$gender', `email` = '$email',`department` = '$department', `address` = '$address' WHERE `id` = '$id' ";

        $data = mysqli_query($conn, $update);

        if ($data) {
            echo "<script>alert('Update successfully')</script>";
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
        
    }




 //delete data
 
 if (isset($_POST['deletedata'])) {
    $id = $_POST['search'];
    $delete = "DELETE FROM  `ems_data` WHERE id = '$id'";
    $data = mysqli_query($conn,$delete);

    if (!$data) {
       echo "Failed". mysqli_error($conn); 
    }
 
 }
 
 

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Mangement System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="#" method="post">
        <div class="container">
            <h2>Employee Mangement System </h2>
         <div class="input_field">
            <input type="text" name="search" class="search" placeholder="Search ID"
             value="<?php if (isset($_POST['searchdata'])){ echo $result ['id'];}?>" ><br>

            <input type="text" name = "name" class="name" placeholder="Employee Name"
            value="<?php if (isset($_POST['searchdata'])){ echo $result ['name'];}?>" ><br>

            <select name="gender" class="gender">
             <option value=""> Select Gender</option>
             <option value="male"
             <?php 
             if ($result ['gender'] == 'male'){
                   echo "selected";  
             }
             ?> 
             >Male</option>
             <option value="female"
             <?php 
             if ($result ['gender'] == 'female'){
                   echo "selected";  
             }
             ?>
             >Female</option>
             <option value="other"
             <?php 
             if ($result ['gender'] == 'other'){
                   echo "selected";  
             }
             ?>
             >Other</option>
            </select><br>

            <input type="email" name="email" class="email" placeholder="Employee email"
            value="<?php if (isset($_POST['searchdata'])){ echo $result ['email'];}?>" ><br>

            <select name="department" class="department">
             <option value=""> Select Department</option>
             <option value="mca"
             <?php 
             if ($result ['department'] == 'mca'){
                   echo "selected";  
             }
             ?>
             
             >MCA</option>
             <option value="bca"
             <?php 
             if ($result ['department'] == 'bca'){
                   echo "selected";  
             }
             ?>
             >BCA</option>
             <option value="btech"
             <?php 
             if ($result ['department'] == 'btech'){
                   echo "selected";  
             }
             ?>
             >Btech</option>
            </select><br>

            <textarea name="address" id="" cols="30" rows="10" placeholder="Address"><?php if (isset($_POST['searchdata'])){ echo $result ['address'];}?></textarea><br>
            </div>

            <div class="btn">
            <input type="submit" value="search" name="searchdata" class="search">
            <input type="submit" value="save" name="save" class="save">
            <input type="submit" value="update" name="update" class="update">
            <input type="submit" value="delete" name="deletedata" onclick="return checkdelete()" class="delete">
            <input type="submit" value="clear" name ="clear" class="clear">
            </div>

        </div>



    </form>
</body>
</html>

<script>
    function checkdelete(){
        return confirm("Are your Sure you want to delete this record?");
    }
</script>


<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $email=$_POST['email'];
     $checkEmail="SELECT * From tusers where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        $insertQuery="DELETE FROM tusers WHERE email='$email'";
        if($conn->query($insertQuery)==TRUE){
            header("location: admin_UM.php");
        }
        else{
            echo "Username Doesn't exist";
        }
     }
}
?>
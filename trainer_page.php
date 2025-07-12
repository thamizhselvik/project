<?php
session_start();
include("connect.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer DashBoard</title>
    <link rel="stylesheet" href="static/admin.css">
    <style>
      body{
        background-image: url(images/front2.jpg);
      }

      .box
      {
        background-color: #f53d68;
      }

      button:hover
      {
      background-color: #ffa3b9;
        opacity: 80%;
      }

      #questhive
      {
        color: black;
      }

      .head
      {
        color: black;
      }
      p{
        color: black;
      }
      #logoutButton{
        color:black;
      }
      a:hover{
        text-decoration: underline;
      }
      h1{
        padding-top: 30px;
      }
    </style>
</head>
<body>
    <img class="img" src="images/image2.png" alt="text">
    <div class="logo">
        <h3 id="questhive"><span>Q</span>uesthive</h3>
        <h4 class="head">Learn to lead</h4>
        <center><h1> <p>
            Hello  <?php
            if(isset($_SESSION['email'])){
            $email=$_SESSION['email'];
            $query=mysqli_query($conn, "SELECT tusers.* FROM `tusers` WHERE tusers.email='$email'");
            while($row=mysqli_fetch_array($query)){
                echo $row['firstName'].' '.$row['lastName'];
            }
            }
            ?>
            !
          </p>
          </h1></center> 
        <div class="game">
        <a href="logout.php" id="logoutButton">Logout</a>
       </div>
         </div>
         <center>
            <div class="container">
                
                <div class="top-box ">
                <button onclick="window.location.href='trainer_curri.php'" class="button box">
                    <img src="images/book.png" alt="system">
                    Upload Curriculum</button>
                <button onclick="window.location.href = 'generate.php'" class="button box">
                    <img src="images/questions.png" alt="statistics">
                    Generate Questions</button>
                <button onclick="window.location.href='trainer_receive.php'" class="button box">
                    <img src="images/request.png" alt="Issues">
                    Receive request</button>
                </div>
                <div class="bottom ">
                <button onclick="window.location.href='trainer_upload.php'" class="button box">
                    <img src="images/download.png" alt="user">
                    Upload & Review Questions
                </button>
                <button onclick="window.location.href = 'trainer_feedback.php'" class="button box">
                <img src="images/feedback.png" alt="report">
                    FeedBack
                </button>
                <button onclick="window.location.href='trainer_report.php'" class="button box">
                    <img src="images/report.png" alt="settings">
                    Report
                </button>
            </center>
                </div>
            </div>
     
      
      
      <script>
        document.getElementById("logoutButton").addEventListener("click", function(event) {
          event.preventDefault();

        var confirmation = confirm("Are you sure you want to log out?");

        if (confirmation) {
          window.location.href = "logout.php";
        }
        });
      </script>
</body>
</html>
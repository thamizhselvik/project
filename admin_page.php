<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="static/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <center><h1>Hello Admin!</h1></center>
        <div class="game">
       
        <a  href="logout.php" id="logoutButton">Logout</a>
       </div>
         </div> 
           
    
    <center>
    <div class="container">
        <div class="top-box ">
        <button onclick="window.location.href='admin_system.php'" class="button box">
            <img src="images/system.png" alt="system">
            System Monitoring</button>
        <button onclick="window.location.href='admin_report.php'" class="button box">
            <img src="images/report.png" alt="statistics">
            Report</button>
        <button onclick="window.location.href = 'admin_issue.php'" class="button box">
            <img src="images/notify.png" alt="Issues">
            Issues</button>
        </div>
        <div class="bottom ">
        <button onclick="window.location.href = 'admin_UM.php'" class="button box">
            <img src="images/user-removebg-preview.png" alt="user">
            User management
        </button>
        <button onclick="window.location.href = 'admin_set.php'" class="button box">
        <img src="images/settings.png" alt="report">
            Settings
        </button>
        <button onclick="window.location.href='logout.php'" class="button box">
            <img src="images/statistics.png" alt="settings">
            LogOut
        </button>
    </center>
        </div>
    </div>
    
    <script>
        document.getElementById("logoutButton").addEventListener("click", function(event) {
          event.preventDefault();
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
          window.location.href = this.href;
        }
        });
    </script>
</body>
</html>
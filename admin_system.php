<?php

include 'connect.php';
include 'econnect.php'; 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$econn = new mysqli($ehost, $euser, $epass, $edb);
if ($econn->connect_error) {
    die("Connection failed: " . $econn->connect_error);
}

$sql = "SELECT id, firstName, lastName, email FROM tusers";
$result = $conn->query($sql);

$esql = "SELECT id, firstName, lastName, email FROM eusers";
$eresult = $econn->query($esql);

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Trainer and Employee Status</title>";
echo "<style>
        body{
            background-color: #F53D68;
        }
        .trainer-card, .employee-card {
            background-color:#EEEEEE;
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .trainer-container, .employee-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .logo{
            display: flex;
            justify-content: left;
            color: rgb(69, 37, 16);
            margin-left: 45px;
            margin-top: 0px;
            position: relative;
        }
        .img{
            width: 45px;
            height: auto;
            margin-top: 0px;
            padding: 0px;
            margin-right: 8px;
            position: absolute;
        }
        #questhive{
            color:#fff;
            position: absolute;
            margin-top: 0px;
        }
        .head{
            position: relative;
        }
        .game{
    
            float: right;
            margin-left: 1000px;
            padding: 0px;
            font-size: 24px
        }
        
        span{
            font-size: 44px;
        }
        h2{
            font-size: 30px;
        }
        h3{
            font-size: 28px;
    
        }
        h4{
            font-size: 16px;
            font-weight: bolder;
            float: left;
            margin-left: 40px;
            margin-top:45px;
        }
        a{
            float: right;
            padding-top:17px;
            margin-right: 10px;
            color: #1e1b18;
            position: relative ;
            text-decoration:none;
            font-size: 22px;
            font-weight: bold;
            margin-left: 255px;
            color: rgb(69, 37, 16);
        }
        a:hover{
            text-decoration: underline;
        }
      </style>";
echo "</head>";
echo "<body>";
echo "<img class='img' src='images/image2.png' alt='text'>";
echo "<div class='logo'>";    
echo "<h3 id='questhive'><span>Q</span>uesthive</h3>";        
echo "<h4 class='head'>Learn to lead</h4>";               
echo "<div class='game'>";        
       
echo "<a  href='admin_page.php' id='logoutButton'>Back</a>";        
echo "</div>";      
echo "</div>";         
echo "<h2>Trainer List</h2>";
echo "<div class='trainer-container'>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
        $status = check_active_status($email);

        echo "<div class='trainer-card'>";
        echo "<h2>Name: " . htmlspecialchars($row['firstName']) . " " . htmlspecialchars($row['lastName']) . "</h2>";
        echo "<p>Role: Trainer</p>";
        echo "<p>Status: " . htmlspecialchars($status) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No trainers found.</p>";
}

echo "</div>";

echo "<h2>Employee List</h2>";
echo "<div class='employee-container'>";

if ($eresult->num_rows > 0) {
    while ($row = $eresult->fetch_assoc()) {
        $email = $row['email'];
        $status = check_active_status($email);

        echo "<div class='employee-card'>";
        echo "<h2>Name: " . htmlspecialchars($row['firstName']) . " " . htmlspecialchars($row['lastName']) . "</h2>";
        echo "<p>Role: Employee</p>";
        echo "<p>Status: " . htmlspecialchars($status) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No employees found.</p>";
}

echo "</div>";
echo "</body>";
echo "</html>";

$conn->close();
$econn->close();

function check_active_status($email) {
    if (isset($_SESSION['trainer_email']) && $_SESSION['trainer_email'] == $email) {
        if (isset($_SESSION['current_page']) && $_SESSION['current_page'] == 'trainer_page.php') {
            return "Active now";
        }
    }

    if (isset($_SESSION['last_login_time'][$email])) {
        $last_login_time = $_SESSION['last_login_time'][$email];
        return "Online before " . htmlspecialchars($last_login_time);
    } else {
        return "Offline";
    }
}
?>

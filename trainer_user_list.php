<?php
include 'connect.php';

$sql = "SELECT firstName, lastName FROM tusers";
$result = $conn->query($sql);

echo "
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
        color: #333333;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        
    }

    .logo {
        display: flex;
        align-items: center;
        animation: fadeIn 1.5s ease-in-out;
    }

    .logo img {
        width: 50px;
        margin-right: 10px;
        transition: transform 0.5s ease;
    }

    .logo img:hover {
        transform: scale(1.1);
    }

    #questhive {
        font-family: 'Montserrant-Bold';
        font-size: 30px;
        font-weight: bold;
        color: #F53D68;
    }

    .f0 {
        display: inline-block;
        padding: 10px 20px;
        background-color: #F53D68;
        color: #ffffff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .f0:hover {
        background-color: white;
        color: #F53D68;
    }

    h1 {
        font-size: 28px;
        color: #F53D68;
        margin-top: 40px;
        animation: fadeInDown 1s ease-in-out;
    }

    table {
        width: 60%;
        margin: 20px auto;
        border-collapse: collapse;
        animation: fadeInUp 1s ease-in-out;
    }

    table th, table td {
        padding: 15px;
        border: 1px solid #F53D68;
        font-size: 16px;
    }

    table th {
        background-color: #F53D68;
        color: #ffffff;
    }

    table td {
        color: #333333;
        background-color: #ffffff;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
";

if ($result->num_rows > 0) {
    echo "
    <div class='header'>
        <div class='logo'>
            <img src='images/image2.png' alt='Questhive Logo'>
            <h3 id='questhive'><span>Q</span>uesthive</h3>
        </div>
        <a class='f0' href='admin_UM.php'>Back</a>
    </div>
    ";
    
    echo "<h1 >Trainer User List</h1>";
    echo "<table  border='2'>";
    echo "<tr ><th >UserName</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr ><td >" . $row["firstName"]." "   . $row["lastName"] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No users found.";
}

$conn->close();
?>
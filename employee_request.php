<?php
$jsonDir = 'json';
$jsonFilePath = $jsonDir . '/requests.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_request'])) {
    $userName = $_POST['user_name'];
    $trainerID = $_POST['trainer_id'];
    $questionDetails = $_POST['question_details'];

    if (!is_dir($jsonDir)) {
        mkdir($jsonDir, 0755, true);
    }

    $requests = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];

    $requests[] = [
        'user_name' => $userName,
        'trainer_id' => $trainerID,
        'question_details' => $questionDetails
    ];

    file_put_contents($jsonFilePath, json_encode($requests));

    header('Location: employee_request.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Question Paper</title>
    <style>
        body {
            background-color: #F53D68;
            font-family: "Montserrant-Bold";
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
        }

        @keyframes entrance {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate {
            animation: entrance 0.5s ease-out forwards;
        }

        h1 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: white;
            font-size: 36px;
            margin: 20px 0;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            animation: slideDown 0.5s ease;
        }

        .logo {
            display: flex;
            align-items: center;
            color: white;
            animation: bounceIn 1s ease;
        }

        h3 {
            margin: 0;
        }

        #questhive {
            font-size: 44px;
            font-weight: bold;
            margin: 0 10px;
            animation: popIn 0.6s ease;
        }

        .f0 {
            color: white;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
            margin-right: 20px;
            animation: fadeIn 1s ease;
        }

        .f0:hover {
            color: #d03b48;
            text-decoration: underline;
        }

        .img {
            width: 45px;
            height: auto;
            margin-right: 0px;
            margin-left: 25px;
        }

        .form-container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            animation: fadeIn 1s ease, zoomIn 0.5s ease;
            animation: float 3s infinite ease-in-out;
        }

        .form-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }

        label {
            font-size: 1.1rem;
            color: #333;
            display: block;
            margin-top: 15px;
            float: left;
            animation: slideIn 0.5s ease;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 20px);
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 8px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s, transform 0.2s;
            animation: fadeIn 1.5s ease;
        }

        #question_details{
            height: 150px;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #F53D68;
            box-shadow: 0 0 5px rgba(245, 61, 104, 0.5);
            outline: none;
            transform: scale(1.02);
        }

        button {
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #F53D68;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            animation: pulse 2s infinite; 
        }

        button:hover {
            background-color: #d03b48;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes popIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
                margin: 10px 0;
            }

            .form-container {
                width: 95%;
                padding: 20px;
            }

            .header {
                flex-direction: column;
                align-items: center;
            }

            .logo {
                justify-content: center;
            }

            .f0 {
                font-size: 18px;
                margin: 10px 0;
            }

            #questhive {
                font-size: 36px;
            }
        }

    </style>
</head>
<body class="animate">
    <div class="header">
        <div class="logo">
            <img class="img" src="images/image2.png" alt="Logo">
            <h3 id="questhive"><span>Q</span>uesthive</h3>
        </div>
        <a class="f0" href="employee_page.php">Back</a>
    </div>

    <h1>Request a Question Paper</h1>
    <div class="form-container">
        <form action="" method="post">
            <label for="user_name">User Name:</label><br>
            <input type="text" id="user_name" name="user_name" required><br><br>

            <label for="trainer_id">Trainer ID:</label><br>
            <input type="text" id="trainer_id" name="trainer_id" required><br><br>

            <label for="question_details">Question Details:</label><br>
            <textarea id="question_details" name="question_details" rows="4" cols="50" required></textarea><br><br>

            <input type="submit" name="submit_request" value="Submit Request">
        </form>
    </div>
    <script>
        document.body.addEventListener('click', function () {
            this.classList.add('animate');
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questhive Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #E93371;
            font-family: Arial, sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .header {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
        }

        .img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            animation: pulse 2s infinite;
        }

        #questhive {
            font-size: 2em;
            margin: 0 0 0 15px;
            color: #ffffff;
            letter-spacing: 2px;
            font-family: "Montserrat-Bold";
        }

        #questhive span {
            color: #ffffff;
            font-size: 1.5em;
        }

        .head {
            font-size: 1em;
            font-weight: 300;
            color: #ffffff;
            margin-top: 0px;
            padding-left: 55px;
            font-family: "Montserrat-Bold";
        }

        .game {
            position: absolute;
            top: 40px;
            right: 40px;
        }

        .game #logout {
            color: #f53d68;
            background-color: #ffffff;
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .login-container {
            background-color:#CBCBCB;
            border-radius: 15px;
            padding: 30px 20px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.5s ease-in-out;
        }

        .login-container h2 {
            color: #E93371;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .role-btn {
            display: inline-block;
            width: 80%;
            padding: 12px 0;
            font-size: 1.1em;
            font-weight: bold;
            margin: 10px 0;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .role-btn.admin {
            background-color: #ffffff;
            color: #f53d68;
        }

        .role-btn.trainer {
            background-color: #ffffff;
            color: #f53d68;
        }

        .role-btn.employee {
            background-color: #ffffff;
            color: #f53d68;
        }

        .role-btn:hover {
            transform: scale(1.05);
            box-shadow: 0px 6px 14px rgba(0, 0, 0, 0.3);
        }

    </style>
</head>
<body>
    <div class="header">
        <img class="img" src="images/image2.png" alt="Questhive Logo">
        <div>
            <h3 id="questhive"><span>Q</span>uesthive</h3>
            <h4 class="head">Learn to lead</h4> 
        </div>
    </div>

    <div class="game">
        <a id="logout" href="index.html">Back</a>
    </div>

    <div class="login-container">
        <h2>Login as</h2>
        <button class="role-btn admin" onclick="window.location.href='admin_login.php'">Administrator</button>
        <button class="role-btn trainer" onclick="window.location.href='trainer_login.php'">Trainer</button>
        <button class="role-btn employee" onclick="window.location.href='employee_login.php'">Employee</button>
    </div>
</body>
</html>

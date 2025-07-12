<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            background-color: #F53D68;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            animation: backgroundAnimation 10s ease-in-out infinite;
        }

        .logo {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            color: white;
            font-size: 45px;
            margin-right: 100px;
            animation: slideIn 1s ease-in-out;
        }

        #questhive {
            font-size: 150px;
            width: 100%;
            animation: bounce 1.5s infinite;
        }

        .logo h4 {
            margin: 10px;
            font-size: 35px;
            animation: fadeInUp 1s ease-in-out;
        }

        .logo p {
            margin: 10px;
            animation: fadeInUp 1.2s ease-in-out;
        }

        .f0 {
            width: 80px;
            padding: 9px 10px;
            text-align: center;
            background-color: white;
            border: 1px solid #F53D68;
            color: #5f5d5d;
            border-radius: 10px;
            text-decoration: none;
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 15px;
            animation: fadeIn 1s ease-in-out;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            animation: slideIn 1s ease-in-out;
        }

        .bt1 {
            width: 400px;
            padding: 20px;
            background-color: white;
            border: 1px solid #F53D68;
            color: #F53D68;
            margin-top: 5px;
            font-size: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-align: center;
            animation: fadeInUp 1.5s ease-in-out;
        }

        .bt1:hover {
            background-color: #F53D68;
            color: white;
            transform: scale(1.05);
        }

        img {
            width: 100px;
            height: 100px;
        }

        @keyframes backgroundAnimation {
            0% { background-color: #F53D68; }
            50% { background-color: #F5007D; }
            100% { background-color: #F53D68; }
        }

        @keyframes slideIn {
            0% { transform: translateX(-100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-30px); }
            60% { transform: translateY(-15px); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="game">
        <a class="f0" href="trainer_page.php">Back</a>
    </div>

    <div class="logo">
        <div id="questhive">
            Questhive
            <img src="images/image2.png" alt="logo" class="img" style="margin-left: 10px;">
        </div>
        <h4>Learn to lead</h4>
        <p>Automated Question Generator</p>
    </div>

    <div class="button-container">
        <button onclick="window.location.href = 'paragraph.php'" class="bt1">Paragraph</button>
        <button onclick="window.location.href = 'coding.php'" class="bt1">Coding</button>
        <button onclick="window.location.href = 'mcq.php'" class="bt1">MCQs</button>
    </div>
</body>
</html>
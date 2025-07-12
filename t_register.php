<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background-color: #F53D68;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            overflow: hidden;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateY(-50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes staggeredFadeIn {
            0% { opacity: 0; transform: translateX(-30px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        @keyframes spinner {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 10px 20px;
            color: white;
            animation: slideIn 1s ease-out forwards;
        }

        .img {
            width: 45px;
            height: auto;
            margin-right: 10px;
            margin-left: 10px;
            animation: slideIn 1s ease-out forwards;
        }

        .logo h3 {
            font-size: 2rem;
            font-weight: bold;
            font-family: "Montserrant-Bold";
            display: flex;
            align-items: center;
            animation: slideIn 1s ease-out forwards;
        }

        .logo span {
            font-size: 2.5rem;
        }

        .game {
            margin-left: auto;
        }

        .game a.f0 {
            color: #F53D68;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            background-color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: transform 0.3s, background-color 0.3s;
            margin-right: 20px;
        }

        .game a.f0:hover {
            background-color: #F53D68;
            color: white;
            transform: scale(1.1);
        }

        .container {
            background-color: white;
            max-width: 500px;
            width: 90%;
            padding: 40px;
            margin-top: 20px;
            border-radius: 10px;
            text-align: center;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: slideIn 1.2s ease-out forwards;
        }

        .form-title {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #F53D68;
        }

        .input-group {
            margin-bottom: 20px;
            opacity: 0;
            transform: translateX(-30px);
            animation: staggeredFadeIn 1s ease forwards;
        }

        .input-group:nth-child(1) { animation-delay: 0.3s; }
        .input-group:nth-child(2) { animation-delay: 0.5s; }
        .input-group:nth-child(3) { animation-delay: 0.7s; }
        .input-group:nth-child(4) { animation-delay: 0.9s; }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 2px solid #F53D68;
            border-radius: 5px;
            font-size: 1rem;
            transition: box-shadow 0.3s;
        }

        .input-group input::placeholder {
            color: #888;
        }

        .input-group input:focus {
            border-color: #F53D68;
            outline: none;
            box-shadow: 0 0 10px rgba(245, 61, 104, 0.5);
        }

        .btn {
            background-color: #F53D68;
            color: white;
            border: none;
            padding: 12px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            transition: transform 0.2s ease;
            position: relative;
        }

        .btn:hover {
            animation: bounce 0.6s ease;
        }

        .btn:active::after {
            content: "";
            border: 3px solid #fff;
            border-radius: 50%;
            border-top-color: #F53D68;
            width: 16px;
            height: 16px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: spinner 0.6s linear infinite;
        }

    </style>
</head>
<body>
    <div class="logo">
        <img class="img" src="images/image2.png" alt="Logo">
        <h3 id="questhive"><span>Q</span>uesthive</h3>
        <div class="game">
            <a class="f0" href="admin_UM.php">Back</a>
        </div>
    </div>
    <div class="container" id="signup">
        <h1 class="form-title">Trainer Register</h1>
        <form method="post" action="register.php">
            <div class="input-group">
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
            </div>
            <div class="input-group">
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <input type="submit" class="btn" value="Add Trainer" name="signUp">
        </form>
    </div>
</body>
</html>
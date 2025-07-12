<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Quicksand", sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #E93371;
            width: 100%;
            overflow: hidden;
        }

        .logo1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            background-color: #E93371;
            z-index: 10;
            animation: backgroundAnimation 10s ease-in-out infinite;
        }
        #questhive1{
            font-family: "Montserrant-Bold";
        }
        .logo1 #questhive1 {
            display: flex;
            align-items: center;
            font-size: 45px;
            color: white;
            font-weight: bold;
            
        }
        .logo1 #questhive1 img {
            width: 50px;
            height: 50px;
            vertical-align: middle;
        }
        #questhive1 span {
            font-family: "Montserrat-Bold";
        }
        #logout {
            width: 80px;
            padding: 5px 9px;
            text-align: center;
            align-items: center;
            justify-content: center;
            display: flex;
            background-color: white;
            border: 1px solid #F53D68;
            color: #F53D68;
            font-size: 15px;
            border-radius: 10px;
            text-decoration: none;
            margin: 0 20px;
        }
        .ring {
            position: relative;
            width: 500px;
            height: 500px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .ring i {
            position: absolute;
            inset: 0;
            border: 2px solid #fff;
            transition: 0.5s;
        }
        .ring i:nth-child(1) {
            border-radius: 38% 62% 63% 37% / 41% 44% 56% 59%;
            animation: animate 6s linear infinite;
        }
        .ring i:nth-child(2) {
            border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
            animation: animate 4s linear infinite;
        }
        .ring i:nth-child(3) {
            border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
            animation: animate2 10s linear infinite;
        }
        .ring:hover i {
            border: 6px solid var(--clr);
            filter: drop-shadow(0 0 20px var(--clr));
        }
        @keyframes animate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        @keyframes animate2 {
            0% {
                transform: rotate(360deg);
            }
            100% {
                transform: rotate(0deg);
            }
        }
        .login {
            position: relative;
            width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
            z-index: 1;
        }
        .login h2 {
            font-size: 2em;
            color: #fff;
        }
        .login .inputBx {
            position: relative;
            width: 100%;
        }
        .login .inputBx input {
            position: relative;
            width: 100%;
            padding: 12px 20px;
            background: transparent;
            border: 2px solid #fff;
            border-radius: 40px;
            font-size: 1.2em;
            color: #fff;
            box-shadow: none;
            outline: none;
        }
        .login .inputBx input[type="submit"] {
            width: 100%;
            background: linear-gradient(45deg, #ff216b, #f7ea75);
            border: none;
            cursor: pointer;
        }
        .login .inputBx input::placeholder {
            color: rgba(255, 255, 255, 0.75);
        }
        .login .links {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
        }
        .login .links a {
            color: #fff;
            text-decoration: none;
        }
        #error-message {
            display: none;
            color:white;
            margin-top: 10px;
            text-align: center;
        }
        span{
            font-family: "Montserrat-Bold";
        }
    </style>
</head>
<body>

    <div class="logo1">
        <div id="questhive1">
            <img src="images/image2.png" alt="logo" style="width: 50px; height: 60px; margin-top: 6px; margin-right: 2px;" class="img">
            <span>Q</span>uesthive
        </div>
        <a id="logout" href="login.php">Back</a>
    </div>
    <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>

        <form method="post" action="eregister.php">
            <div class="login">
                <h2>Employee Login</h2>
                <div class="inputBx">
                    <input type="email" name="email" id="email" placeholder="Username" required>
                </div>
                <div class="inputBx">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="inputBx">
                    <input type="submit" class="login-btn" value="Login" name="signIn">
                </div>
                <div class="links">
                    Didn't have Account?<a href="index.html">. Contact us</a>
                </div>
                <p id="error-message" class="error-message">Invalid username or password</p>
            </div>
        </form>
    </div>
</body>
</html>

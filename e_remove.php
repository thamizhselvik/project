<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="static/project1.css">
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

        .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            margin-top: 20px;
            animation: slideIn 1s ease-out forwards;
        }

        .img {
            width: 45px;
            height: auto;
            position: absolute;
            margin-left: -1430px;
            margin-top: 20px;    
            }


        #questhive {
            font-family: "Montserrant-Bold";
            font-size: 2rem;
            font-weight: bold;
            margin: 5px 0;
            margin-left: -1220px;
        }

        #questhive span {
            font-size: 2.5rem;
        }

        .head {
            font-size: 1.2rem;
            font-weight: 500;
            color: #fff;
            margin: 0;
        }

        .game {
            margin-top: -20px;
        }

        .game a.f0 {
            color: #F53D68;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            background-color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            margin-right: -1400px;
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
            transition: transform 0.2s ease, background-color 0.3s;
            position: relative;
        }

        .btn:hover {
            animation: bounce 0.6s ease;
            background-color: #ff6b8d;
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
    </style>

</head>
<body>
   
    <img class="img" src="images/image2.png" alt="text">
    <div class="logo">
        <h3 id="questhive"><span>Q</span>uesthive</h3>
        <div class="game">
            <a class="f0" href="admin_UM.php" >Back</a>
        </div>
    </div> 
    <div class="container" id="signup">
      <h1 class="form-title">Employee Remove</h1>
      <form method="post" action="e_remote.php">
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
       <input type="submit" class="btn" value="Remove Employee" name="signUp">
      </form>
    </div>
</body>
</html>
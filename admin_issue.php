<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Issue</title>
    <style>
        body {
            background-color: #F53D68;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .img {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }
        .logo h3 {
            font-family: "Montserrant-Bold";
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }
        .logo span {
            font-size: 2.5rem;
        }

        .game {
            position: absolute;
            top: 40px;
            right: 10px;
        }
        .game a {
            color: #F53D68;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
            background-color: white;
            padding: 5px 9px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .game a:hover {
            background-color: #F53D68;
            color: white;
        }

        h1 {
            font-size: 2rem;
            margin: 60px 0 20px;
        }

        #responsesList {
            list-style: none;
            padding: 0;
            width: 40%;
            margin: 20px auto;
            text-align: left;
        }
        #responsesList li {
            background-color: white;
            color: #000;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        #responsesList p {
            margin: 5px 0;
            font-size: 1rem;
        }

        button {
            background-color:#F53D68;
            color: #fff;
            border: none;
            padding: 3px 7px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #333;
        }
       
    </style>
</head>
<body>
    <div class="logo">
        <img class="img" src="images/image2.png" alt="Logo">
        <h3><span>Q</span>uesthive</h3>
    </div>
    <div class="game">
        <a href="admin_page.php" id="logoutButton">Back</a>
    </div>
    <h1>Feedbacks</h1>
    <ol id="responsesList"></ol>
    <script>
        var responses = JSON.parse(localStorage.getItem('responses')) || [];

        var responsesList = document.getElementById('responsesList');

        function displayResponses() {
            responsesList.innerHTML = '';

            responses.forEach(function(response, index) {
                var listItem = document.createElement('li');
                listItem.innerHTML = `<p><strong>Name:</strong> ${response.name}</p>
                                      <p><strong>Report:</strong> ${response.text}</p>
                                      <p><button onclick="deleteResponse(${index})">Delete</button></p>`;
                responsesList.appendChild(listItem);
            });
        }

        function deleteResponse(index) {
            responses.splice(index, 1);
            localStorage.setItem('responses', JSON.stringify(responses));
            displayResponses(); 
        }

        displayResponses();
    </script>
</body>
</html>
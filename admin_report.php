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
            font-family: "Montserrat-Bold";
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
            padding: 7px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-right: -2500px;
        }
        .game a:hover {
            background-color: #F53D68;
            color: white;
        }

        h1 {
            font-size: 2rem;
            margin: 60px 0 20px;
        }

        #responsesList1 {
            list-style: none;
            padding: 0;
            width: 40%;
            margin: 20px auto;
            text-align: left;
        }
        #responsesList1 li {
            background-color: white;
            color: black;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        #responsesList1 p {
            margin: 5px 0;
            font-size: 1rem;
        }

        button {
            background-color: #F53D68;
            color: white;
            border: none;
            padding: 3px 7px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            color: gray;
        }
    </style>
</head>
<body>

    <div class="logo">
        <img class="img" src="images/image2.png" alt="text">
        <h3 id="questhive"><span>Q</span>uesthive</h3>
        <div class="game">
            <a href="admin_page.php" id="logoutButton">Back</a>
        </div>
    </div> 
    <h1>Reports</h1>
    <ol id="responsesList1"></ol>
    
    <script>
        var responses1 = JSON.parse(localStorage.getItem('responses1')) || [];

        var responsesList1 = document.getElementById('responsesList1');

        function displayResponses() {
            responsesList1.innerHTML = '';

            responses1.forEach(function(response1, index) {
                var listItem = document.createElement('li');
                listItem.innerHTML = `<p><strong>Name:</strong> ${response1.name}</p>
                                      <p><strong>Report:</strong> ${response1.text}</p>
                                      <p><button onclick="deleteResponse(${index})">Delete</button></p>`;
                responsesList1.appendChild(listItem);
            });
        }

        function deleteResponse(index) {
            responses1.splice(index, 1);
            localStorage.setItem('responses1', JSON.stringify(responses1));
            displayResponses();
        }

        displayResponses();
    </script>
</body>
</html>
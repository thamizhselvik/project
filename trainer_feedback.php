<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Feedback</title>
    <link rel="stylesheet" href="static/feed.css">
    <style>
        span{
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img class="img" src="images/image2.png" alt="text">
        <h3 id="questhive"><span>Q</span>uesthive</h3>
        <div class="game">
            <a id="logout" href="trainer_page.php">Back</a>
        </div>
    </div>
    <div class="form">
        <form id="infoForm">
            <h1>Feedback</h1>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="text">Feedback</label>
            <input type="text" id="text" name="text" required><br><br>

            <button type="button" onclick="saveData()">Submit</button>
        </form>
    </div>
    <script>
        function saveData() {
            var name = document.getElementById('name').value;
            var text = document.getElementById('text').value;

            var responses = JSON.parse(localStorage.getItem('responses')) || [];

            responses.push({ name: name, text: text });

            localStorage.setItem('responses', JSON.stringify(responses));

            window.location.href='trainer_feedback.php';
        }
    </script>
</body>
</html>
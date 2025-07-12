<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Report</title>
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
        <h1>Report</h1>
    <form id="infoForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="text">Report:</label>
        <input type="text" id="text" name="text" required><br><br>

        <button type="button" onclick="saveData()">Submit</button>
      </form>
    </div>
      <script>
        function saveData() {
            var name = document.getElementById('name').value;
            var text = document.getElementById('text').value;

            var responses1 = JSON.parse(localStorage.getItem('responses1')) || [];

            responses1.push({ name: name, text: text });

            localStorage.setItem('responses1', JSON.stringify(responses1));
            window.location.href='trainer_report.php';
        }
      </script>
</body>
</html>
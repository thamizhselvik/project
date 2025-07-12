<?php
$number = $_POST['number'];
$topic = $_POST['topic'];
$difficulty = $_POST['difficulty'];
$command = escapeshellcmd("python3 py_files/generate_coding.py $number $topic $difficulty");
$output = shell_exec($command);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Coding Questions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F53D68;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 40px;
            position: fixed;
            top: 0;
            background-color: #F53D68;
            z-index: 10;
        }

        .header #questhive {
            display: flex;
            align-items: center;
            font-size: 45px;
            color: white;
            font-weight: bold;
            margin-left: 10px;
        }

        .header #questhive img {
            margin-left: 8px;
        }

        .header a#logout {
            width: 80px;
            padding: 9px 10px;
            text-align: center;
            background-color: white;
            border: 1px solid #F53D68;
            color: #F53D68;
            font-size: 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s ease;
            margin-right: 20px;
        }

        .header a#logout:hover {
            background-color: #F53D68;
            color: white;
        }

        h2 {
            color: white;
            font-size: 35px;
            margin-top: 80px;
            margin-bottom: 15px;
            animation: fadeIn 1s ease-in-out;
        }

        ol {
            background: linear-gradient(135deg, #F53D68 0%, #ff9a85 100%);
            padding: 45px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 65%;
            animation: fadeIn 1s ease-in-out, slideUp 1s ease-in-out;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        ol li {
            font-size: 25px;
            color: #fff;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-bottom: 8px;
            text-shadow: none;
            position: relative;
            z-index: 2;
        }

        ol li:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateX(8px);
            transition: all 0.4s ease-in-out;
        }

        p {
            background: white;
            padding: 12px 18px;
            border-radius: 10px;
            margin: 15px auto;
            width: 55%;
            color: #333;
            font-size: 16px;
            line-height: 1.5;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: justify;
            border: 2px solid #ff9a85;
            background: linear-gradient(145deg, #f7f7f7, #ffffff);
        }

        #button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        #button-group button {
            background-color: #fff;
            color: #F53D68;
            border: 1px solid #F53D68;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s ease;
        }

        #button-group button:hover {
            background-color: #ff6f91;
            color: white;
        }

        #button-group i {
            font-size: 18px;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes slideUp {
            0% { transform: translateY(15px); }
            100% { transform: translateY(0); }
        }

    </style>
</head>
<body>
    <div class="header">
        <div id="questhive">
            Questhive
            <img src="images/image2.png" alt="logo" style="width: 50px; height: 50px;">
        </div>
        <a id="logout" href="coding.php">Back</a>
    </div>
    <?php
    if ($output) {
    echo "<h2>Generated Coding Questions</h2>";
    echo "<ol id='coded'>";
    $questions = json_decode($output, true);
    if (is_array($questions)) {
        foreach ($questions as $question) {
            echo "<li>" . htmlspecialchars($question) . "</li>";
        }
    } else {
        echo "<p>Error: Could not parse the questions from the output.</p>";
    }
    echo "</ol>";
    } else {
        echo "<p>No questions were generated. Please try again.</p>";
    }
    ?>
  
    <div id='button-group'>
        <button onclick='printPage()'><i class='fa fa-print'></i>Print</button>
        <button onclick='generatePDF()'><i class='fa fa-download'></i>Download PDF</button>
        <button id='copyText'><i class='fa fa-copy'></i>Copy Text</button>
    </div>

    
    <script>
        function printPage() {
            window.print();
        }

        function generatePDF() {
            const { jsPDF } = window.jspdf;
            var doc = new jsPDF();
            doc.text(document.getElementById('coded').innerText, 10, 10);
            doc.save('coding.pdf');
        }

        document.getElementById('copyText').addEventListener('click', function() {
            var text = document.body.innerText;
            var textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Text copied to clipboard!');
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</body>
</html>
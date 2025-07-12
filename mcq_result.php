<?php
function generate_mcqs($num_questions, $topic, $difficulty) {
    $command = escapeshellcmd("python3 py_files/generate_mcq.py $num_questions $topic $difficulty");
    $output = shell_exec($command);
    return json_decode($output, true);
}

$num_questions = isset($_POST['num_questions']) ? (int)$_POST['num_questions'] : 0;
$topic = isset($_POST['topic']) ? escapeshellarg($_POST['topic']) : '';
$difficulty = isset($_POST['difficulty']) ? escapeshellarg($_POST['difficulty']) : '';

$questions = generate_mcqs($num_questions, $topic, $difficulty);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated MCQs</title>
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

        .logo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 40px;
            position: fixed;
            top: 0;
            background-color: #F53D68;
            z-index: 10;
            animation: slideIn 0.5s ease-in-out;
        }

        .logo #questhive {
            display: flex;
            align-items: center;
            font-size: 45px;
            color: white;
            font-weight: bold;
            margin-left: 10px;
        }

        .logo #questhive img {
            margin-left: 8px;
        }

        .logo a#bank {
            width: 80px;
            padding: 9px 10px;
            text-align: center;
            background-color: white;
            border: 1px solid #F53D68;
            color: #F53D68;
            font-size: 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            margin-right: 20px;
        }

        .logo a#bank:hover {
            background-color: #F53D68;
            color: white;
        }

        h1 {
            font-size: 38px;
            color: white;
            margin-top: 100px;
            animation: fadeIn 1s ease-in-out;
        }

        #generated-content {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 80%;
            max-width: 800px;
            animation: fadeIn 1s ease-in-out;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.5s forwards;
        }

        ol {
            margin: 0;
            padding-left: 20px;
            font-size: 20px;
        }

        ol li {
            margin: 10px 0;
            transition: transform 0.3s, box-shadow 0.3s;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        ol li:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background-color: #e9e9e9;
            transition: all 0.3s ease;
        }

        #buttons {
            margin-top: 20px;
        }

        button {
            padding: 10px 15px;
            margin: 5px;
            background-color: white;
            border: 2px solid #F53D68;
            color: #F53D68;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
            animation: buttonFadeIn 0.5s forwards;
        }

        button:hover {
            background-color: #F53D68;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .generate-more {
            padding: 10px 20px;
            margin-top: 20px;
            background-color: white;
            color: #F53D68;
            border: 2px solid #F53D68;
            border-radius: 5px;
            font-size: 20px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s, color 0.3s, transform 0.2s;
            animation: buttonFadeIn 0.5s forwards;
        }

        .generate-more:hover {
            background-color: #F53D68;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes buttonFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }
    </style>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>
<body>

    <div class="logo">
        <div id="questhive">
            Questhive
            <img src="images/image2.png" alt="logo" style="width: 50px; height: 50px;" class="img">
        </div>
        <a id="bank" href="mcq.php">Back</a>
    </div>

    <h1>Generated MCQ Questions</h1>
    <div id="generated-content">
        <ol>
        <?php if (!empty($questions)) : ?>
            <?php foreach ($questions as $question) : ?>
                <li>
                    <strong>Question:</strong> <?php echo htmlspecialchars($question['question']); ?>
                    <ol>
                        <?php foreach ($question['options'] as $option) : ?>
                            <li><?php echo htmlspecialchars($option); ?></li>
                        <?php endforeach; ?>
                    </ol>
                </li>
                <br>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No questions were generated.</p>
        <?php endif; ?>
        </ol>
    </div>

    <div id="buttons">
        <button onclick="printPage()"><i class='fa fa-print'></i> Print</button>
        <button onclick="downloadPDF()"><i class='fa fa-download'></i> Download PDF</button>
        <button onclick="copyToClipboard()"><i class='fa fa-copy'></i> Copy Text</button>
    </div>

    <a href="mcq.php" class="generate-more">Generate More Questions</a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script>
        function printPage() {
            window.print();
        }

        function downloadPDF() {
            const content = document.getElementById('generated-content').innerHTML;
            const opt = {
                margin: 1,
                filename: 'GeneratedMCQs.pdf',
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(content).set(opt).save();
        }

        function copyToClipboard() {
            const content = document.getElementById('generated-content').innerText;
            navigator.clipboard.writeText(content).then(function() {
                alert('Text copied to clipboard!');
            }, function(err) {
                alert('Failed to copy text: ', err);
            });
        }
    </script>
</body>
</html>
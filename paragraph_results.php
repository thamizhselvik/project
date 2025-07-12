<?php
$paragraph = $_POST['itext'];
$number_of_questions = $_POST['noq'];
$command = escapeshellcmd("python3 py_files/generate_para.py " . escapeshellarg($number_of_questions) . " " . escapeshellarg($paragraph));
$output = shell_exec($command);
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Generated Questions</title>
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

        #questions {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            width: 60%;
            margin: 20px auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.5s forwards, slideUp 0.5s forwards;
        }

        h1 {
            text-align: center;
            color: #F53D68;
            font-size: 28px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #555;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
            line-height: 1.5;
        }

        #button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            animation: fadeInButtons 0.8s forwards;
        }

        button {
            background-color: #ffffff; 
            color: #F53D68;
            border: 2px solid #F53D68; 
            padding: 12px 25px;
            font-size: 16px;
            margin: 0 10px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(245, 61, 104, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease, color 0.3s ease;
        }

        button:hover {
            background-color: #F53D68; 
            color: white;
            transform: scale(1.05);
        }

        button i {
            margin-right: 8px;
        }

        .question-box {
            background-color: white;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 15px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.5s forwards, slideUp 0.5s forwards;
        }

        .question-box:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: scale(1.02);
        }

        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 15px 50px; 
            position: fixed; 
            top: 0;
            background-color: #F53D68;
        }

        .header a#logout {
            color:#F53D68;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            margin-right: 20px;
        }

        

        .header #questhive {
            display: flex;
            align-items: center;
            font-size: 45px;
            color: #ffffff;
            font-weight: bold;
            margin-left: 20px; 
        }

        .header #questhive img {
            margin-left: 10px;
        }

        #logout {
            width: 80px;
            padding: 9px 10px;
            text-align: center;
            background-color: white;
            border: 1px solid #F53D68;
            color: #5f5d5d;
            font-size: 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
        }

        
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
            }
        }

        @keyframes fadeInButtons {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.72/pdfmake.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.72/vfs_fonts.js'></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>
<?php
echo "<body>";?>

    <div class="header">
        <div id="questhive">
            Questhive
            <img src="images/image2.png" alt="logo" style="width: 50px; height: 50px;">
        </div>
        <a id="logout" href="paragraph.php">Back</a>
    </div>

    <div id='questions'>
        <h1>Generated Questions</h1>
        <div class="question-box">
        <?php
            echo "<p id='question-content'>" . nl2br($output) . "</p>";
        ?>
        </div>
    </div>

    <div id='button-group'>
        <button onclick='printPage()'><i class='fa fa-print'></i>Print</button>
        <button onclick='generatePDF()'><i class='fa fa-download'></i>Download PDF</button>
        <button id='copyText'><i class='fa fa-copy'></i>Copy Text</button>
    </div>

    <script>
        function printPage() { window.print(); }
        function generatePDF() {
            const { jsPDF } = window.jspdf;
            var doc = new jsPDF();
            doc.text(document.getElementById('questions').innerText, 10, 10);
            doc.save('paragraph.pdf');
        }
        document.getElementById('copyText').addEventListener('click', function() {
            var content = document.getElementById('questions').innerText;
            navigator.clipboard.writeText(content).then(function() {
                alert('Questions copied to clipboard');
            }, function(err) {
                alert('Failed to copy text: ', err);
            });
        });
    </script>
</body>
</html>
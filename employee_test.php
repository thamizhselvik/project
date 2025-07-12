<?php
session_start();

if (!isset($_SESSION['curriculums'])) {
    $_SESSION['curriculums'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf_file'])) {
    $curriculumName = $_POST['curriculum_name'];
    $file = $_FILES['pdf_file'];
    $train = $_POST['trainer_id'];

    if ($file['type'] === 'application/pdf') {
        $uploadDir = 'caraxes/';
        $uploadFile = $uploadDir . basename($file['name']);

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $_SESSION['curriculums'][] = ['name' => $curriculumName, 'file' => $uploadFile, 'train' => $train];
        } else {
            $error = "Error uploading the file.";
        }
    } else {
        $error = "Please upload a valid PDF file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Test</title>
    <style>
        body {
            background-color: #F53D68;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        h1 {
            color: white;
            text-align: center;
            margin-top: 20px;
            font-size: 3rem;
            animation: fadeInDown 1s ease forwards;
        }

        #questhive {
            font-family: "Montserrant-Bold";
            font-size: 44px;
            font-weight: bold;
            margin: 0 20px;
            animation: popIn 0.6s ease;
        }

        .button {
            height: 40px;
            width: 120px;
            border: none;
            background-color: #F53D68;
            color: white;
            box-shadow: 2px 2px 5px gray;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s, box-shadow 0.2s;
            font-size: 1rem;
            animation: fadeInUp 1s ease forwards;
            border-radius: 10px;
            font-size: 20px;
        }

        .button:hover {
            background-color: #d03b48;
            transform: scale(1.05) rotate(2deg);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        }

        label {
            font-size: 25px;
            color: #333;
            display: inline-block;
            text-align: left;
            float: left;
            margin-left: 20px;
            opacity: 0;
            transform: translateX(-20px);
            animation: slideInLeft 1s ease forwards;
            animation-delay: 0.3s;
        }

        .f1 {
            height: 50px;
            width: calc(100% - 30px);
            padding: 5px;
            margin: 10px auto;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 1rem;
            transition: box-shadow 0.3s ease, transform 0.2s;
            animation: fadeInUp 1s ease forwards;
            outline: none;
        }

        .f1:focus {
            box-shadow: 0 0 8px rgba(245, 61, 104, 0.5);
            transform: scale(1.02);
        }

        .custom-file-input {
            position: relative;
            overflow: hidden;
            display: inline-block;
            height: 50px;
            width: calc(100% - 30px);
            padding: 5px;
            margin-top: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: white;
            cursor: pointer;
            color: #333;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 1rem;
            transition: box-shadow 0.3s ease, transform 0.2s;
            animation: fadeInUp 1s ease forwards;
        }

        .custom-file-input:hover {
            box-shadow: 0 0 8px rgba(245, 61, 104, 0.3);
            transform: scale(1.02);
        }

        .custom-file-input input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            opacity: 0;
            height: 100%;
            width: 100%;
            cursor: pointer;
        }

        .custom-file-input::before {
            content: 'Choose File';
            position: absolute;
            left: 20px;
            font-size: 1rem;
            color: #333;
        }

        .custom-file-input.has-file::before {
            content: attr(data-file);
            color: #666;
        }

        .logo {
            display: flex;
            justify-content: left;
            color: white;
            font-size: 35px;
            margin-left: 45px;
            margin-top: 0px;
            position: relative;
        }

        .img {
            width: 45px;
            height: auto;
            position: absolute;
            margin-left: 15px;
            margin-top: 3px;
        }

        .f0 {
            float: right;
            padding-top: 18px;
            margin-right: 20px;
            position: relative;
            text-decoration: none;
            font-size: 22px;
            font-weight: bold;
            color: white;
            margin-left: 1150px;
        }

        .f0:hover {
            color: #d03b48;
            text-decoration: underline;
        }

        form {
            text-align: center;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            box-sizing: border-box;
            opacity: 0;
            transform: scale(0.95);
            animation: fadeIn 1s ease forwards;
            animation-delay: 0.5s;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInLeft {
            0% { opacity: 0; transform: translateX(-20px); }
            100% { opacity: 1; transform: translateX(0); }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-20px);
            }
            60% {
                transform: translateY(-10px);
            }
        }

        input:focus {
            animation: bounce 0.5s ease;
        }

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.querySelector(".custom-file-input input[type='file']");
            const customFileInput = document.querySelector(".custom-file-input");

            fileInput.addEventListener("change", function() {
                const fileName = fileInput.files[0] ? fileInput.files[0].name : "Choose File";
                customFileInput.dataset.file = fileName;
                customFileInput.classList.toggle("has-file", !!fileInput.files[0]);
            });
        });
    </script>
</head>
<body>
    <img class="img" src="images/image2.png" alt="Logo">
    <div class="logo">
        <h3 id="questhive"><span>Q</span>uesthive</h3>
        <a class="f0" href="employee_page.php">Back</a>
    </div>
    <h1>Upload Test</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="curriculum_name">Curriculum Name</label><br>
        <input class="f1" type="text" name="curriculum_name" required><br><br>

        <label for="curriculum_name">Trainer ID</label><br>
        <input class="f1" type="text" name="trainer_id" required><br><br>

        <label for="pdf_file">Upload PDF File</label><br>
        <div class="custom-file-input" data-file="Choose File" aria-label="Choose a PDF file">
            <input type="file" name="pdf_file" accept=".pdf" required>
        </div><br><br>

        <input class="button" type="submit" value="Submit">
    </form>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</body>
</html>
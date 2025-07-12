<?php
$jsonDir = 'json';
$jsonFilePath = $jsonDir . '/topics.json';
$uploadDir = 'uploads';

if (!is_dir($jsonDir)) {
    mkdir($jsonDir, 0755, true);
}
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $topicName = $_POST['topic'];
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']);
        $targetPath = $uploadDir . '/' . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $topics = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
            if (!isset($topics[$topicName])) {
                $topics[$topicName] = [];
            }
            $topics[$topicName][] = $fileName;
            file_put_contents($jsonFilePath, json_encode($topics));
        } else {
            echo "<p>Error: Unable to move the uploaded file.</p>";
        }
    } else {
        echo "<p>Error: " . $file['error'] . "</p>";
    }
}

if (isset($_POST['delete'])) {
    $topicToDelete = $_POST['delete'];
    $fileToDelete = $_POST['file'];
    $filePath = $uploadDir . '/' . $fileToDelete;

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $topics = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
    if (isset($topics[$topicToDelete])) {
        $topics[$topicToDelete] = array_filter($topics[$topicToDelete], function ($file) use ($fileToDelete) {
            return $file !== $fileToDelete;
        });

        if (empty($topics[$topicToDelete])) {
            unset($topics[$topicToDelete]);
        }

        file_put_contents($jsonFilePath, json_encode($topics));
    }
}

$topics = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Topics</title>
    <style>
       body {
          background-color: #F53D68;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
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

        .f2 {
            height: 50px;
            width: 120px;
            border: none;
            background-color: #F53D68;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s, box-shadow 0.2s;
            font-size: 20px;
            border-radius: 10px;
            animation: fadeInUp 1s ease forwards;
        }

        .f2:hover {
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

        .int, .custom-file-input {
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

        .int:focus, .custom-file-input:hover {
            box-shadow: 0 0 8px rgba(245, 61, 104, 0.5);
            transform: scale(1.02);
        }

        .custom-file-input {
            position: relative;
            overflow: hidden;
            display: inline-block;
            cursor: pointer;
            background-color: white;
            color: #333;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
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
            margin-left: -1430px;
            margin-top: 3px;
           
            
        }

        .f0 {
            float: right;
            padding-top: 18px;
            margin-right: 20px;
            text-decoration: none;
            font-size: 22px;
            font-weight: bold;
            color: white;
            margin-left: 1140px;
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
        h1 {
            color: white;
            margin-bottom: 20px;
        }

        .topics-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
        }

        .topic-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .topic-card h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
        }

        .topic-card p {
            margin: 5px 0;
        }

        .topic-card a {
            color: #1e88e5;
            text-decoration: none;
        }

        .topic-card a:hover {
            text-decoration: underline;
        }

        .delete-form {
            margin-top: 10px;
        }

        .delete-button {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c9302c;
        }

    </style>
</head>
<body>
    <img class="img" src="images/image2.png" alt="Logo">
  <div class="logo">
      <h3 id="questhive"><span>Q</span>uesthive</h3>
      <a class="f0" href="trainer_page.php">Back</a>
  </div> 

  <h1>Upload Question</h1>
  <form action="" method="post" enctype="multipart/form-data" class="f1">
      <label for="topic">Topic Name</label>
      <input class="int" type="text" name="topic" id="topic" required>

      <label for="file">Upload File</label>
      <div class="custom-file-input">
          <input type="file" id="file" name="file" required>
      </div>

      <input type="submit" name="upload" value="Upload" class="f2">
  </form>

    <h1>Uploaded Questions</h1>
    <div class="topics-container">
        <?php if (!empty($topics)) : ?>
            <?php foreach ($topics as $topicName => $files) : ?>
                <?php foreach ($files as $file) : ?>
                    <div class="topic-card">
                        <h3><?php echo htmlspecialchars($topicName); ?></h3>
                        <p><a href="uploads/<?php echo htmlspecialchars($file); ?>" target="_blank"><?php echo htmlspecialchars($file); ?></a></p>
                        <form method="post" class="delete-form">
                            <input type="hidden" name="delete" value="<?php echo htmlspecialchars($topicName); ?>">
                            <input type="hidden" name="file" value="<?php echo htmlspecialchars($file); ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No topics uploaded yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
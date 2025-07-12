<?php

if (!isset($_SESSION['curriculums'])) {
    $_SESSION['curriculums'] = [];
}

$jsonDir = 'json';
$jsonFilePath = $jsonDir . '/requests.json';

if (isset($_POST['delete_request'])) {
    $indexToDelete = $_POST['delete_request'];

    if (isset($_POST['request_type']) && $_POST['request_type'] === 'question') {
        if (!is_dir($jsonDir)) {
            mkdir($jsonDir, 0755, true);
        }

        $requests = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];

        if (isset($requests[$indexToDelete])) {
            unset($requests[$indexToDelete]);
            file_put_contents($jsonFilePath, json_encode(array_values($requests)));
        }
    }

    if (isset($_POST['request_type']) && $_POST['request_type'] === 'curriculum') {
        if (isset($_SESSION['curriculums'][$indexToDelete])) {
            unset($_SESSION['curriculums'][$indexToDelete]);
            $_SESSION['curriculums'] = array_values($_SESSION['curriculums']);
        }
    }
}

$requests = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
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
    <title>Requests and Submissions</title>
    <style>
        body {
            background-color: #f53d68;
            display: flex;
            flex-direction: row;
        }
        h1 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: black;
            font-size: 36px;
        }
        p {
            font-size: 1.2rem;
            color: black;
        }
        button {
            height: 40px;
            width: 190px;
            background-color: white;
            color: #f53d68;
            border-width: 0px;
            box-shadow: 2px 2px 5px gray;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 15px;
        }
        button:hover {
            background-color: #fff0f5;
        }
        .sidebar {
            width: 200px;
            background-color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            position: fixed;
            height: 100%;
        }
        .sidebar button {
            background-color: #f53d68;
            color: white;
            font-size: 16px;
        }
        .sidebar button:hover {
            background-color: #ff6f91;
        }
        .content {
            margin-left: 220px;
            padding-left: 50px;
            width: calc(100% - 220px);
        }
        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        li {
            background-color: white;
            border: 1px solid #f53d68;
            width: 46%;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            color: #f53d68;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        a {
            color: #f53d68;
            font-weight: bold;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <button onclick="showSection('request')">Receive Request</button>
        <button onclick="showSection('submission')">Test Submission</button>
    </div>

    <div class="content">
        <div id="request-section">
            <h1>Question Paper Requests</h1>
            <?php if (!empty($requests)) : ?>
                <ul>
                    <?php foreach ($requests as $index => $request) : ?>
                        <li>
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($request['user_name']); ?><br></p>
                            <p><strong>Trainer Name:</strong> <?php echo htmlspecialchars($request['trainer_id']); ?><br></p>
                            <p><strong>Question Paper Details:</strong> <?php echo htmlspecialchars($request['question_details']); ?><br></p>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="delete_request" value="<?php echo $index; ?>">
                                <input type="hidden" name="request_type" value="question">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this request?');">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul><br>
            <?php else : ?>
                <p>No requests found.</p>
            <?php endif; ?>
        </div>

        <div id="submission-section" class="hidden">
            <h1>Test Submissions</h1>
            <?php if (!empty($_SESSION['curriculums'])) : ?>
                <ul>
                    <?php foreach ($_SESSION['curriculums'] as $index => $curriculum) : ?>
                        <li>
                            <p><strong>Curriculum Name:</strong> <?php echo htmlspecialchars($curriculum['name']); ?></p>
                            <p><strong>Trainer ID:</strong> <?php echo htmlspecialchars($curriculum['train']); ?></p>
                            <p><strong>Uploaded PDF File:</strong> <a href="<?php echo htmlspecialchars($curriculum['file']); ?>" target="_blank">View PDF</a></p>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="delete_request" value="<?php echo $index; ?>">
                                <input type="hidden" name="request_type" value="curriculum">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this curriculum?');">Delete</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No curriculums uploaded. Please upload a curriculum first.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function showSection(section) {
            document.getElementById('request-section').classList.add('hidden');
            document.getElementById('submission-section').classList.add('hidden');
            if (section === 'request') {
                document.getElementById('request-section').classList.remove('hidden');
            } else if (section === 'submission') {
                document.getElementById('submission-section').classList.remove('hidden');
            }
        }
    </script>
</body>
</html>

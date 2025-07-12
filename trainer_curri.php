<?php
if (!is_dir('json')) {
    mkdir('json', 0755, true);
}

$jsonFilePath = 'json/curricula.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    $courseName = $_POST['course_name'];
    $courseDesc = $_POST['course_desc'];
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($file['name']);
        $targetPath = 'curricula/' . $fileName;

        if (!is_dir('curricula')) {
            mkdir('curricula', 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $curricula = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];

            $curricula[] = [
                'course_name' => $courseName,
                'course_desc' => $courseDesc,
                'file' => $fileName
            ];

            file_put_contents($jsonFilePath, json_encode($curricula));
        } else {
            echo "Error: Unable to move the uploaded file.";
        }
    } else {
        echo "Error: " . $file['error'];
    }
}

if (isset($_POST['delete'])) {
    $indexToDelete = $_POST['delete'];
    $curricula = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];

    if (isset($curricula[$indexToDelete])) {
        $fileToDelete = $curricula[$indexToDelete]['file'];
        $filePath = 'curricula/' . $fileToDelete;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        unset($curricula[$indexToDelete]);
        file_put_contents($jsonFilePath, json_encode($curricula));
    }
}

$generatedCurriculum = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {
    $topic = $_POST['topic'];
    $generatedCurriculum = shell_exec("python3 py_files/curri.py " . escapeshellarg($topic));
}

$curricula = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Curriculum Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            height: 100%;
            background-color: #f53d68;
        }
        .sidebar {
            width: 200px;
            background-color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }
        .sidebar button {
            background-color: #ff6f88;
            color: white;
            border: none;
            padding: 10px;
            margin: 10px 0;
            cursor: pointer;
            font-size: 16px;
        }
        .sidebar button:hover {
            background-color: #cc586c;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #f53d68;
            display: none;
        }
        .active {
            display: block;
        }
        .container h1 {
            color: white;
        }
        form input, form textarea, form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            box-sizing: border-box;
        }
        form textarea {
            height: 240px;
        }
        form button {
            background-color: #86000c;
            color: white;
            cursor: pointer;
        }
        form button:hover {
            background-color: #61000a;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
            }
            .sidebar button {
                width: 45%;
            }
        }
        .curricula-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .curriculum-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .card-header {
            border-bottom: 1px solid #ddd;
            margin-bottom: 15px;
        }
        
        .card-body {
            padding: 10px 0;
        }
        
        .card-footer {
            text-align: right;
        }
        
        .delete-btn {
            background-color: #f53d68;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        
        .delete-btn:hover {
            background-color: #d12a4d;
        }
        
        @media (max-width: 768px) {
            .curriculum-card {
                width: 100%;
            }
        }
        pre{
            font-size: 1.1rem;
        }
        .button-group {
        display: flex;
        margin-top: 20px;
        }

        .download-btn, .copy-btn, .print-btn {
            background-color: #86000c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }

        .download-btn:hover, .copy-btn:hover, .print-btn:hover {
            background-color: #61000a;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <button id="uploadBtn">Upload Curriculum</button>
            <button id="generateBtn">Generate Curriculum</button>
        </div>

        <div id="uploadSection" class="content active">
            <h1>Upload Curriculum</h1>
            <form class="f1" action="" method="post" enctype="multipart/form-data">
                <label for="course_name">Course Name:</label>
                <input class="int" type="text" name="course_name" id="course_name" required>
                
                <label for="course_desc">Course Description:</label>
                <textarea class="desc" name="course_desc" id="course_desc" required></textarea>
                
                <label for="file">Choose Curriculum File:</label>
                <input type="file" name="file" id="file" accept=".pdf, .docx" required>
                
                <button type="submit" name="upload">Upload Curriculum</button>
            </form>
            <h2>Uploaded Curricula</h2>
            <?php if (!empty($curricula)) : ?>
                <div class="curricula-list">
                    <?php foreach ($curricula as $index => $curriculum) : ?>
                        <div class="curriculum-card">
                            <div class="card-header">
                                <p><strong>Course Name:</strong> <?php echo htmlspecialchars($curriculum['course_name']); ?></p>
                            </div>
                            <div class="card-body">
                                <p><strong>Description:</strong> <?php echo htmlspecialchars($curriculum['course_desc']); ?></p>
                                <p><strong>File:</strong> 
                                    <a href="curricula/<?php echo htmlspecialchars($curriculum['file']); ?>" target="_blank">
                                        <?php echo htmlspecialchars($curriculum['file']); ?>
                                    </a>
                                </p>
                            </div>
                            <div class="card-footer">
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="delete" value="<?php echo $index; ?>">
                                    <button class="delete-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>No curricula uploaded yet.</p>
            <?php endif; ?>
        </div>

        <div id="generateSection" class="content">
            <h1>Generate Curriculum</h1>
            <form action="" method="POST">
                <label for="topic">Enter Curriculum Topic:</label>
                <input type="text" id="topic" name="topic" required>
                <button type="submit" name="generate">Generate Curriculum</button>
            </form>
            <?php if (!empty($generatedCurriculum)) : ?>
                <h2>Generated Curriculum</h2>
                <pre id="curriculum"><?php echo htmlspecialchars($generatedCurriculum); ?></pre>
                <div class="button-group">
                <button class="copy-btn" onclick="copyToClipboard()"><i class="fa fa-copy" style="font-size:24px"></i></button><br>
                <button class="print-btn" onclick="window.print()"><i class="fa fa-print" style="font-size:24px"></i></button><br>
                <button class="download-btn" onclick="downloadPDF()"><i class="fa fa-download" style="font-size:24px"></i></button>
        </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const uploadBtn = document.getElementById('uploadBtn');
        const generateBtn = document.getElementById('generateBtn');
        const uploadSection = document.getElementById('uploadSection');
        const generateSection = document.getElementById('generateSection');

        function showSection(sectionToShow) {
            uploadSection.classList.remove('active');
            generateSection.classList.remove('active');
            sectionToShow.classList.add('active');
        }

        uploadBtn.addEventListener('click', function() {
            showSection(uploadSection);
        });

        generateBtn.addEventListener('click', function() {
            showSection(generateSection);
        });

        showSection(uploadSection);

        function copyToClipboard() {
        const curriculumText = document.getElementById('curriculum').innerText;
        navigator.clipboard.writeText(curriculumText).then(() => {
            alert('Curriculum copied to clipboard!');
        }).catch(err => {
            console.error('Error copying text: ', err);
        });
        }

        function downloadPDF() {
            const pdfContent = document.getElementById('curriculum').innerText;
            const blob = new Blob([pdfContent], { type: 'application/pdf' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'curriculum.pdf';
            a.click();
            URL.revokeObjectURL(url);
        }
    </script>
</body>
</html>

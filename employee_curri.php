<?php
$jsonFilePath = 'json/curricula.json';
$curricula = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Curricula</title>
    <style>
        body {
            background-color: #E93371;
            font-family: "Montserrat-Bold";
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }
        
        h1 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            margin-top: 20px;
        }

        .logo {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            color: rgb(69, 37, 16);
            width: 100%;
            padding-left: 20px;
            background-color: #E93371;
        }

        .img {
            width: 45px;
            height: auto;
            margin-right: 10px;
        }

        .header-title {
            font-size: 32px;
            color: #4a2e1e;
        }

        .sub-title {
            font-size: 16px;
            font-weight: bold;
            color: #4a2e1e;
            margin-left: 5px;
        }

        .back-link {
            margin-left: auto;
            margin-right: 20px;
            font-size: 18px;
            font-weight: bold;
            color: rgb(69, 37, 16);
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .curricula-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            max-width: 1200px; 
            padding: 20px;
        }

        .curriculum-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            width: 360px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        .curriculum-card p {
            margin: 8px 0;
            font-size: 1.1rem;
        }
        .curriculum-card a {
            color: #1e88e5;
            text-decoration: none;
        }
        .curriculum-card a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="logo">
        <img class="img" src="images/image2.png" alt="logo">
        <div>
            <div class="header-title"><span>Q</span>uesthive</div>
            <div class="sub-title">Learn to lead</div>
        </div>
        <a class="back-link" href="employee_page.php">Back</a>
    </div>
    
    <h1>Uploaded Curricula</h1>
    
    <div class="curricula-container">
        <?php if (!empty($curricula)) : ?>
            <?php foreach ($curricula as $index => $curriculum) : ?>
                <div class="curriculum-card">
                    <p><strong>Course Name:</strong> <?php echo htmlspecialchars($curriculum['course_name']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($curriculum['course_desc']); ?></p>
                    <p><strong>File:</strong> <a href="curricula/<?php echo htmlspecialchars($curriculum['file']); ?>" target="_blank"><?php echo htmlspecialchars($curriculum['file']); ?></a></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No curricula uploaded yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>

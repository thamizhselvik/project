<?php

$jsonDir = 'json';
$jsonFilePath = $jsonDir . '/topics.json';

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
            background-color: #E93371;
            font-family: "Montserrat-Bold";
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }
        
        h1 {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: #4a2e1e;
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

        .topics-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
            width: 90%;
        }

        .topic-card {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            width: 300px;
            flex: 1 1 30%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .topic-card h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #4a2e1e;
        }

        .topic-card ul {
            list-style-type: none;
            padding: 0;
            margin-top: 10px;
        }

        .topic-card li {
            font-size: 1rem;
            padding: 5px 0;
        }

        .topic-card a {
            color: #1e88e5;
            text-decoration: none;
        }

        .topic-card a:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .topic-card {
                flex: 1 1 45%;
            }
        }

        @media (max-width: 600px) {
            .topic-card {
                flex: 1 1 100%;
            }
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

    <h1>Uploaded Topics</h1>
    
    <div class="topics-container">
        <?php if (!empty($topics)) : ?>
            <?php foreach ($topics as $topic => $files) : ?>
                <div class="topic-card">
                    <h3>Topic: <?php echo htmlspecialchars($topic); ?></h3>
                    <ul>
                        <?php foreach ($files as $file) : ?>
                            <li>
                                <strong>File:</strong> 
                                <a href="uploads/<?php echo htmlspecialchars($file); ?>" target="_blank"><?php echo htmlspecialchars($file); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No uploaded topics found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php

if (isset($_GET['picture']) && isset($_GET['name']) && isset($_GET['position'])) {
    $profilePicture = $_GET['picture'];
    $employeeName = $_GET['name'];
    $employeePosition = $_GET['position'];

    $templatePath = "assets/image/stl/idtemplate.jpg";
    $outputPath = "assets/image/generated/agent_id_" . time() . ".jpg";

    header('Content-Type: application/json');

    if (!file_exists($templatePath)) {
        echo json_encode(['error' => 'Template not found']);
        exit;
    }

    $template = imagecreatefromjpeg($templatePath);
    $profileImg = imagecreatefromjpeg($profilePicture);
    
    // Resize profile image to fit the placeholder (adjust as needed)
    $profileWidth = 200; // Adjust based on template size
    $profileHeight = 200;
    $destX = 150; // Adjust based on template position
    $destY = 80;

    imagecopyresampled($template, $profileImg, $destX, $destY, 0, 0, $profileWidth, $profileHeight, imagesx($profileImg), imagesy($profileImg));

    // Add text (name & position)
    $black = imagecolorallocate($template, 0, 0, 0);
    $fontPath = __DIR__ . "/assets/fonts/Arial.ttf"; // Adjust path
    imagettftext($template, 24, 0, 150, 320, $black, $fontPath, $employeeName);
    imagettftext($template, 18, 0, 150, 350, $black, $fontPath, $employeePosition);

    imagejpeg($template, $outputPath, 100);
    imagedestroy($template);
    imagedestroy($profileImg);

    echo json_encode(['image_url' => "/" . $outputPath]);
} else {
    echo json_encode(['error' => 'Missing parameters']);
}
?>

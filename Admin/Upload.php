<?php 
include "../object/sendPic.php";
$uploadMessage = '';

if(isset($_POST["submit"])) {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $FileUploader = new FileUploader($_FILES);
        $uploadMessage = $FileUploader->uploadMoviePic();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        h2 {
            margin-bottom: 20px;
        }
        
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
        }
        
        input[type="file"] {
            display: block;
            width: 100%;
        }
        
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        
        .message {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
        }
        </style>
</head>
<body>
    <div class="form-container">
        <h2>File Upload Form</h2>
        <form method="POST" enctype="multipart/form-data" action="Upload.php">
            <div class="form-group">
                <label for="fileUpload">Select File:</label>
                <input type="file" id="fileUpload" name="file" accept=".jpg, .gif, .png, .bmp">
            </div>
            <button type="submit" name="submit">Upload</button>
        </form>
        <?php if (!empty($uploadMessage)): ?>
            <div class="message">
                <?php echo $uploadMessage; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
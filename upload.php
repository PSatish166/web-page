<?php
// Define the directory where files will be uploaded
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file is a valid type
$allowedTypes = array("doc", "docx", "pdf", "ppt", "pptx", "txt");
if (!in_array($fileType, $allowedTypes)) {
    echo "Sorry, only DOC, DOCX, PDF, PPT, PPTX & TXT files are allowed.";
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size (e.g., 5MB limit)
if ($_FILES["file"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($_FILES["file"]["name"])). " has been uploaded.";

        // Collect and sanitize form data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "form_db";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert file information into the database
        $sql = "INSERT INTO uploads (name, email, file_path)
        VALUES ('$name', '$email', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            echo "<br>File information stored successfully.";
        } else {
            echo "<br>Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

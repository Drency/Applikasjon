<?php
session_start();
// Include the database configuration file
$db = mysqli_connect('localhost', 'root', '', 'app');
// $statusMsg = '';

// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    header("Location: index.php");
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $db->query("INSERT into bilder (bildeLink) VALUES ('".$fileName."')");
            if ($insert) {
                echo "<img src='uploads/".$fileName."' class='preview'>";
            } else {
              echo "failed";
          }
          else
            echo "Image file size max 1 MB";
        }
        else
          echo "Invalid file format..";
      }
      else
        echo "Please select image..!";
      exit;
      
require_once __DIR__ . 'header.php';
//                 $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
//             }else{
//                 $statusMsg = "File upload failed, please try again.";
//             } 
//         }else{
//             $statusMsg = "Sorry, there was an error uploading your file.";
//         }
//     }else{
//         $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
//     }
// }else{
//     $statusMsg = 'Please select a file to upload.';
// }

// Display status message
// echo $statusMsg;
?> <!--TRENGER IKKE avslutte php
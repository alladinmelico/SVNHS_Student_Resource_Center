<?php 
$fileMetadata = new Google_Service_Drive_DriveFile(array(
    'title' => 'photo.jpg'));
$content = file_get_contents('files/photo.jpg');
$file = $driveService->files->insert($fileMetadata, array(
    'data' => $content,
    'mimeType' => 'image/jpeg',
    'uploadType' => 'multipart',
    'fields' => 'id'));
printf("File ID: %s\n", $file->id);
?>

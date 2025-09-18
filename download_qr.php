<?php
$dir = __DIR__ . '/qrcodes';
$zipFile = __DIR__ . '/qrcodes.zip';

if (!is_dir($dir)) {
    die("QR codes folder not found.");
}

$zip = new ZipArchive();
if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
    die("Cannot create ZIP file.");
}

$files = scandir($dir);
foreach ($files as $file) {
    $filePath = $dir . '/' . $file;
    if (is_file($filePath)) {
        $zip->addFile($filePath, $file);
    }
}
$zip->close();

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="qrcodes.zip"');
header('Content-Length: ' . filesize($zipFile));
readfile($zipFile);
unlink($zipFile);
exit;
?>
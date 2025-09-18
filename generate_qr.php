<?php
require_once __DIR__ . '/../src/db.php';
require_once __DIR__ . '/../vendor/autoload.php';

$sql = "SELECT * FROM guests";
$result = $conn->query($sql);

$dir = __DIR__ . '/qrcodes';
if (!is_dir($dir)) mkdir($dir, 0777, true);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $token = $row['qr_token'];
        $url = "https://{$_SERVER['HTTP_HOST']}/qr-checkin/public/checkin.php?token={$token}";

        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $row['name']);
        $safeCategory = preg_replace('/[^A-Za-z0-9_\-]/', '_', $row['category']);
        $file = $dir . '/' . $safeName . '_' . $safeCategory . '.png';

        \QRcode::png($url, $file, QR_ECLEVEL_H, 10, 2);

        $qrImage = imagecreatefrompng($file);
        $logoPath = __DIR__ . '/logo.png';
        if (file_exists($logoPath)) {
            $logo = imagecreatefrompng($logoPath);
            $qrWidth = imagesx($qrImage);
            $qrHeight = imagesy($qrImage);
            $logoWidth = imagesx($logo);
            $logoHeight = imagesy($logo);
            $logo_qr_width = $qrWidth / 5;
            $scale = $logoWidth / $logo_qr_width;
            $logo_qr_height = $logoHeight / $scale;
            $posX = ($qrWidth - $logo_qr_width) / 2;
            $posY = ($qrHeight - $logo_qr_height) / 2;
            imagecopyresampled($qrImage, $logo, $posX, $posY, 0, 0, $logo_qr_width, $logo_qr_height, $logoWidth, $logoHeight);
            imagepng($qrImage, $file);
            imagedestroy($logo);
        }
        imagedestroy($qrImage);
    }
    echo "QR codes generated successfully with logos.";
} else {
    echo "No guests found.";
}
?>
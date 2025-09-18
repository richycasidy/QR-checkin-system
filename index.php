<?php
require_once __DIR__ . '/../src/db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>QR Check-in System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

<h1 class="mb-4">QR Check-in System</h1>

<!-- Upload CSV -->
<form action="upload.php" method="post" enctype="multipart/form-data" class="mb-3">
  <input type="file" name="csv_file" class="form-control" required>
  <button type="submit" class="btn btn-primary mt-2">Upload Guest List</button>
</form>

<!-- Generate QR Codes -->
<form method="get" action="generate_qr.php" class="mb-3">
  <button type="submit" class="btn btn-secondary">Generate QR Codes</button>
</form>

<!-- Reset Check-ins -->
<form method="post" action="reset.php" class="mb-3">
  <button type="submit" class="btn btn-warning">Reset All Check-ins</button>
</form>

<!-- Delete All Guests -->
<form method="post" action="delete_all.php" class="mb-3">
  <button type="submit" class="btn btn-danger">Delete All Guests</button>
</form>

<!-- Download QR Codes -->
<form method="get" action="download_qr.php" class="mb-3">
  <button type="submit" class="btn btn-success">⬇️ Download All QR Codes (ZIP)</button>
</form>

</body>
</html>

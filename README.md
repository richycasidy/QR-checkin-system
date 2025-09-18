# QR Check-in System

A lightweight web-based system for event guest check-in using QR codes.

## Features
- Bulk CSV upload of guest list
- Generates QR codes (with optional logo in center)
- Guest categories (VIP / VVIP)
- Prevents duplicate check-in
- Web-based check-in page
- Tracks check-in status in database

## Installation
1. Upload `qr-checkin` folder to your server (e.g., `public_html/qr-checkin`).
2. Run `composer install` in project root to install dependencies.
3. Create MySQL database and run:
   ```sql
   CREATE TABLE guests (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(255) NOT NULL,
     category VARCHAR(50) NOT NULL,
     qr_token VARCHAR(255) UNIQUE,
     checked_in TINYINT(1) DEFAULT 0
   );
   ```
4. Update `src/db.php` with your DB credentials.
5. Ensure `public/qrcodes/` is writable by PHP.

## Usage
- Upload guest list CSV at `index.php`.
- Generate QR codes.
- Download all as ZIP or distribute individually.
- Scan QR → check-in page opens, validates guest.

## Notes
- Place `logo.png` in `public/` for embedded logo in QR codes.
- If blank page, check `vendor/autoload.php` exists (run composer).

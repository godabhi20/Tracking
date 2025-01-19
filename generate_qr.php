<?php
require_once 'phpqrcode/qrlib.php';

$data = $_GET['data'] ?? '';

if (empty($data)) {
    die('No data provided for QR code generation.');
}

// Set appropriate content type
header('Content-Type: image/png');

// Generate QR code
QRcode::png($data, null, QR_ECLEVEL_L, 4, 2);


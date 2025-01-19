<?php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerId = $_POST['customerId'] ?? '';
    $name = $_POST['name'] ?? '';
    $datetime = $_POST['datetime'] ?? '';
    $location = $_POST['location'] ?? '';
    $product = $_POST['product'] ?? '';
    $liter = $_POST['liter'] ?? '';
    $perLiterAmount = $_POST['perLiterAmount'] ?? '';
    $totalAmount = $_POST['totalAmount'] ?? '';

    if (empty($customerId) || empty($name) || empty($datetime) || empty($location) || empty($product) || empty($liter) || empty($perLiterAmount) || empty($totalAmount)) {
        $response['message'] = 'All fields are required.';
    } else {
        $scanData = json_decode(file_get_contents('scan_data.json'), true) ?? [];
        
        $scanData[] = [
            'customerId' => $customerId,
            'name' => $name,
            'datetime' => $datetime,
            'location' => $location,
            'product' => $product,
            'liter' => $liter,
            'perLiterAmount' => $perLiterAmount,
            'totalAmount' => $totalAmount
        ];

        if (file_put_contents('scan_data.json', json_encode($scanData, JSON_PRETTY_PRINT))) {
            $response['success'] = true;
            $response['message'] = 'QR scan data saved successfully.';
        } else {
            $response['message'] = 'Error saving QR scan data.';
        }
    }
}

echo json_encode($response);
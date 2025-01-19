<?php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'customerId' => ''];

function generateCustomerId($customers) {
    $lastId = 0;
    foreach ($customers as $id => $customer) {
        if (preg_match('/^M(\d+)$/', $id, $matches)) {
            $lastId = max($lastId, intval($matches[1]));
        }
    }
    return 'M' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $product = $_POST['product'] ?? '';

    if (empty($name) || empty($mobile) || empty($address) || empty($product)) {
        $response['message'] = 'All fields are required.';
    } else {
        $customersFile = 'customers.json';
        $customers = file_exists($customersFile) ? json_decode(file_get_contents($customersFile), true) : [];
        
        $customerId = generateCustomerId($customers);
        
        $customers[$customerId] = [
            'name' => $name,
            'mobile' => $mobile,
            'address' => $address,
            'product' => $product
        ];

        if (file_put_contents($customersFile, json_encode($customers, JSON_PRETTY_PRINT))) {
            $response['success'] = true;
            $response['message'] = 'Customer added successfully.';
            $response['customerId'] = $customerId;
        } else {
            $response['message'] = 'Error saving customer data.';
        }
    }
}

echo json_encode($response);


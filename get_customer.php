<?php
header('Content-Type: application/json');

$customerId = $_GET['id'] ?? '';

if (empty($customerId)) {
    echo json_encode(null);
} else {
    $customers = json_decode(file_get_contents('customers.json'), true) ?? [];
    
    if (isset($customers[$customerId])) {
        $customer = $customers[$customerId];
        $customer['customerId'] = $customerId;
        echo json_encode($customer);
    } else {
        echo json_encode(null);
    }
}
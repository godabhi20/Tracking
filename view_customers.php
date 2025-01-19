<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Customer List</h1>
        <table>
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Mobile No.</th>
                    <th>Address (Lat, Lng)</th>
                    <th>Product</th>
                    <th>QR Code</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $customers = json_decode(file_get_contents('customers.json'), true) ?? [];
                foreach ($customers as $customerId => $customer) {
                    echo "<tr>";
                    echo "<td>{$customerId}</td>";
                    echo "<td>{$customer['name']}</td>";
                    echo "<td>{$customer['mobile']}</td>";
                    echo "<td>{$customer['address']}</td>";
                    echo "<td>{$customer['product']}</td>";
                    echo "<td><img src='generate_qr.php?data=" . urlencode($customerId) . "' alt='QR Code'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.html" class="button">Back to Home</a>
    </div>
</body>
</html>


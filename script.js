// ... (keep existing code)

document.getElementById("addCustomerForm")?.addEventListener("submit", function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch("add_customer.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const customerId = data.customerId;
            document.getElementById("generatedCustomerId").textContent = customerId;
            
            // Generate QR code image
            const qrCodeImg = document.createElement('img');
            qrCodeImg.src = `generate_qr.php?data=${encodeURIComponent(customerId)}`;
            qrCodeImg.alt = 'QR Code';
            
            // Clear previous QR code and append new one
            const qrCodeContainer = document.getElementById("qrCode");
            qrCodeContainer.innerHTML = '';
            qrCodeContainer.appendChild(qrCodeImg);
            
            document.getElementById("qrCodeContainer").style.display = "block";
            this.reset();
        } else {
            alert("Error adding customer: " + data.message);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred. Please try again.");
    });
});

document.getElementById("printQRCode")?.addEventListener("click", function() {
    const qrCodeImg = document.getElementById("qrCode").querySelector("img");
    const customerId = document.getElementById("generatedCustomerId").textContent;
    
    const printWindow = window.open('', '', 'height=400,width=800');
    printWindow.document.write('<html><head><title>Print QR Code</title></head><body>');
    printWindow.document.write('<h1>Customer ID: ' + customerId + '</h1>');
    printWindow.document.write('<img src="' + qrCodeImg.src + '" />');
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
});

// ... (keep existing code)


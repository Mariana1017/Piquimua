<?php
include 'db_connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $city = htmlspecialchars($_POST['city']);
    $description = htmlspecialchars($_POST['description']);
    $payment = htmlspecialchars($_POST['payment']);

    
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($city) || empty($description) || empty($payment)) {
        echo "Todos los campos son obligatorios.";
    } else {
        
        $stmt = $conn->prepare("INSERT INTO pedidos (nombre, email, telefono, direccion, ciudad, descripcion, metodo_pago) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $phone, $address, $city, $description, $payment);

        
        if ($stmt->execute()) {
            echo "Pedido guardado con éxito!";
        } else {
            echo "Error: " . $stmt->error;
        }

        
        $stmt->close();
    }
}


$conn->close();
?>

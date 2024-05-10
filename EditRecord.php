<?php
include 'config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "No user found with that ID.";
        exit;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];

        $stmt = $pdo->prepare("UPDATE users SET name = ?, surname = ?, email = ?, telephone = ?, address = ?, city = ?, postal_code = ? WHERE id = ?");
        $stmt->execute([$name, $surname, $email, $telephone, $address, $city, $postal_code, $id]);

        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Edit User Record</h2>
    <form action="EditRecord.php?id=<?= $user['id'] ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?= htmlspecialchars($user['name']) ?>">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Surname:</label>
            <input type="text" class="form-control" id="surname" name="surname" required value="<?= htmlspecialchars($user['surname']) ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>">
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Telephone:</label>
            <input type="text" class="form-control" id="telephone" name="telephone" required value="<?= htmlspecialchars($user['telephone']) ?>">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required value="<?= htmlspecialchars($user['address']) ?>">
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City:</label>
            <input type="text" class="form-control" id="city" name="city" required value="<?= htmlspecialchars($user['city']) ?>">
        </div>
        <div class="mb-3">
            <label for="postal_code" class="form-label">Postal Code:</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" required value="<?= htmlspecialchars($user['postal_code']) ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update Record</button>
    </form>
</div>
</body>
</html>


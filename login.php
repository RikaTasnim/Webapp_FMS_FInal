<?php
session_start();
require 'db_config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $userType = $_POST['userType'] ?? ''; // Visible role from the dropdown

    if (!empty($email) && !empty($password) && !empty($userType)) {

        // Map new UI roles to existing DB tables + new dashboards
        if ($userType === 'Farmer') {
            $table = 'farmers';
            $redirectPage = 'farmer_dashboard.php';
        } elseif ($userType === 'Admin') {
            $table = 'admins';
            $redirectPage = 'admin_dashboard.php';
        } elseif ($userType === 'Supplier' || $userType === 'Seller') {
            // UI shows Supplier, but DB/table remains 'sellers'
            $table = 'sellers';
            $redirectPage = 'supplier_dashboard.php';
        } elseif ($userType === 'Wholesaler' || $userType === 'Buyer') {
            // UI shows Wholesaler, but DB/table remains 'buyers'
            $table = 'buyers';
            $redirectPage = 'wholesaler_dashboard.php';
        } else {
            echo "<script>alert('Invalid user type.');</script>";
            exit;
        }

        $sql = "SELECT * FROM $table WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('MySQL prepare error: ' . $conn->error);
        }

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // NOTE: Passwords are compared in plaintext to match your current DB
                if ($password == $user['password']) {
                    // Set session variables for user
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['name'] = $user['name'];

                    header("Location: $redirectPage");
                    exit;
                } else {
                    echo "<script>alert('Incorrect password.');</script>";
                }
            } else {
                echo "<script>alert('No user found with this email.');</script>";
            }
        } else {
            echo "<script>alert('Error executing the query.');</script>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<script>alert('Please fill in all fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Farmers Management System (FMS)</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header class="header">
        <h1>🔐 FMS Login 🔐</h1>
    </header>

    <main class="dashboard">
        <section class="registration-form">
            <h2>Login to Your Account</h2>
            <form id="login-form" method="POST" action="login.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="Enter your email" required />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Enter your password" required />
                </div>

                <div class="mb-3">
                    <label for="userType" class="form-label">Login as</label>
                    <select class="form-select" id="userType" name="userType" required>
                        <option value="" selected disabled>Choose...</option>
                        <option value="Farmer">Farmer</option>
                        <option value="Admin">Admin</option>
                        <!-- New labels for UI; backend mapping above accepts both new & old terms -->
                        <option value="Supplier">Supplier</option>
                        <option value="Wholesaler">Wholesaler</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <a href="index.php">
                    <button type="button" class="btn btn-secondary">Home</button>
                </a>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Farmers Management System</p>
    </footer>

    <script src="script.js"></script>
</body>

</html>

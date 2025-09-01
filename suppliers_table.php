<?php
session_start();
require 'db_config.php'; // Database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch the user information from the session
$user_name = $_SESSION['name'] ?? '';

// Handle deletion of supplier (DB table remains `sellers`)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_seller'])) {
    $seller_id = $_POST['seller_id'] ?? '';

    $delete_sql = "DELETE FROM sellers WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $seller_id);

    if ($stmt->execute()) {
        echo "<script>alert('Supplier deleted successfully');</script>";
        // If you renamed this page, keep the redirect filename in sync:
        echo "<script>window.location.href = 'admin_suppliers.php';</script>";
    } else {
        echo "<script>alert('Error deleting supplier');</script>";
    }
    $stmt->close();
}

// Fetch all suppliers (from `sellers` table)
$sql_sellers = "SELECT id, name, inputs, contact, location FROM sellers";
$result_sellers = $conn->query($sql_sellers);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Suppliers (FMS)</title>
    <link rel="stylesheet" href="admin_style.css" />
</head>

<body>

    <header class="header">
        <div class="header-left">
            <h1>📋 Admin Dashboard 📋</h1>
        </div>
        <div class="header-right">
            <button type="button" onclick="location.href='admin_dashboard.php'">Home</button>
            <span>Welcome Admin, <?php echo htmlspecialchars($user_name); ?></span>
            <a href="logout.php">
                <button type="button">Logout</button>
            </a>
        </div>
    </header>

    <main class="dashboard">
        <section>
            <h2 class="text-success text-center">Suppliers List</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Inputs</th>
                            <th>Contact</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_sellers && $result_sellers->num_rows > 0) {
                            while ($row = $result_sellers->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['inputs']); ?></td>
                                    <td><?php echo htmlspecialchars($row['contact']); ?></td>
                                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="seller_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" name="delete_seller" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this supplier?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No suppliers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="text-center p-3 bg-success text-white mt-0">
        <p>&copy; 2025 Farmers Management System</p>
    </footer>

</body>
</html>

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

// Handle deletion of wholesaler (DB table remains `buyers`)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_buyer'])) {
    $buyer_id = $_POST['buyer_id'] ?? '';

    $delete_sql = "DELETE FROM buyers WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $buyer_id);

    if ($stmt->execute()) {
        echo "<script>alert('Wholesaler deleted successfully');</script>";
        // If you renamed this page, keep the redirect filename in sync:
        echo "<script>window.location.href = 'admin_wholesalers.php';</script>";
    } else {
        echo "<script>alert('Error deleting wholesaler');</script>";
    }
    $stmt->close();
}

// Fetch all wholesalers (from `buyers` table)
$sql_buyers = "SELECT id, name, category, contact_info, location FROM buyers";
$result_buyers = $conn->query($sql_buyers);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Wholesalers (FMS)</title>
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
            <h2 class="text-success text-center">Wholesalers List</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Wholesaler Name</th>
                            <th>Category</th>
                            <th>Contact Info</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_buyers && $result_buyers->num_rows > 0) {
                            while ($row = $result_buyers->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                                    <td><?php echo htmlspecialchars($row['contact_info']); ?></td>
                                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="buyer_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                            <button type="submit" name="delete_buyer" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this wholesaler?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No wholesalers found</td></tr>";
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

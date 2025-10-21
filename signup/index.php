<?php
include("../includes/db.conn.php"); // your DB connection

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    if (!empty($user) && !empty($pass)) {
        // Check if admin table already has a user
        $check = mysqli_query($conn, "SELECT COUNT(*) AS total FROM admin");
        $row = mysqli_fetch_assoc($check);

        if ($row['total'] >= 1) {
            // Already one admin exists
            $error = "⚠️ Admin account already exists!";
            header("Location: index.php?error=1");
            exit;
        }

        // Hash the password
        $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

        // Prepared statement for insertion
        $stmt = mysqli_prepare($conn, "INSERT INTO admin (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $user, $hashedPass);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php?success=1");
            exit;
        } else {
            $error = "❌ Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);

    } else {
        $error = "⚠️ Please enter both username and password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Sign Up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f0f2f5; display: flex; align-items: center; justify-content: center; height: 100vh; }
.card { border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
.btn-custom { border-radius: 25px; padding: 10px; font-weight: bold; }
</style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center mb-4">📝 Admin Sign Up</h3>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 btn-custom">Sign Up</button>
                </form>
                <p class="text-center mt-3">
                    Already have an account? <a href="../index.php">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

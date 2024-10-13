<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gradient background for body */
        body {
            background: linear-gradient(135deg, #A7F3D0, #93C5FD, #D8B4FE);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
        }

        /* Flex layout and full-screen container */
        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card-style form container */
        .form-container {
            background-color: #fdfdfd;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            transition: box-shadow 0.3s ease;
        }

        .form-container:hover {
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        /* Custom form input and button styles */
        input,
        button {
            transition: all 0.3s ease;
        }

        /* Button hover effect */
        button:hover {
            transform: translateY(-3px);
        }

        /* Light shadow for form inputs */
        input {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }

        /* Soft colors for text gradient */
        .text-gradient {
            background: linear-gradient(90deg, #4ADE80, #60A5FA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-4xl font-bold text-center mb-6 text-gradient bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-400">
                User Profile
            </h1>

            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            require './src/db/connection.php';

            $pdo = getDBConnection();
            $message = '';
            $error = '';

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $stmt = $pdo->prepare('SELECT username, email FROM users WHERE id = ?');
                $stmt->execute([$user_id]);
                $user = $stmt->fetch();

                if (!$user) {
                    $error = 'User not found.';
                }
            } else {
                $error = 'You are not logged in.';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $new_username = trim($_POST['username']);
                $new_email = trim($_POST['email']);

                if (empty($new_username) || empty($new_email)) {
                    $error = 'Username and email cannot be empty.';
                } else {
                    $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
                    $stmt->execute([$new_username, $new_email, $user_id]);
                    $_SESSION['username'] = $new_username;
                    $message = 'Profile updated successfully!';
                }
            }

            if (isset($_POST['deleteAccount'])) {
                try {
                    $pdo->beginTransaction();
                    $stmt = $pdo->prepare('DELETE FROM user_logs WHERE user_id = ?');
                    $stmt->execute([$user_id]);

                    $stmt = $pdo->prepare('DELETE FROM failed_logins WHERE user_id = ?');
                    $stmt->execute([$user_id]);

                    $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
                    $stmt->execute([$user_id]);

                    $pdo->commit();
                    session_destroy();
                    header('Location: ./login.php');
                    exit();
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $error = 'Failed to delete the account: ' . $e->getMessage();
                }
            }
            ?>

            <!-- Profile Update Form -->
            <form action="./profile.php" method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" required
                        value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>"
                        class="mt-2 w-full px-4 py-3 bg-green-100 text-gray-800 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>"
                        class="mt-2 w-full px-4 py-3 bg-green-100 text-gray-800 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500">
                </div>

                <div class="flex justify-between">
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-green-400 to-blue-400 hover:from-green-500 hover:to-blue-500 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        Update Profile
                    </button>
                </div>
            </form>

            <!-- Account Deletion Form -->
            <form action="./profile.php" method="POST" class="mt-6">
                <input type="hidden" name="deleteAccount" value="1">
                <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-pink-400 to-red-400 hover:from-pink-500 hover:to-red-500 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300">
                    Delete Account
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="./my_dashboard.php" class="text-gray-500 hover:text-blue-500 transition duration-200">Back to
                    Dashboard</a>
            </div>
        </div>
    </div>
</body>

</html>

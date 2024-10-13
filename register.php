<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure PHP Authentication | Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Use a vibrant background image with a gradient overlay */
        body {
            background: linear-gradient(to right, rgba(34, 193, 195, 0.8), rgba(253, 187, 45, 0.8)), url('assets/register.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        /* Apply backdrop filter and vibrant colors to the form */
        .backdrop-blur-md {
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen text-white">
    <div class="bg-black bg-opacity-60 backdrop-blur-md p-8 rounded-xl shadow-2xl max-w-md w-full">
        <h1 class="text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-yellow-500 mb-6">Register</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500 text-white p-3 rounded-lg mb-6">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="./src/auth/register.php" method="POST" class="space-y-6">
            <div>
                <label for="username" class="block text-sm font-medium text-pink-200">Username</label>
                <input type="text" id="username" name="username" required class="mt-2 w-full px-4 py-3 bg-pink-700 text-white border border-pink-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-pink-400" placeholder="Enter your username">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-pink-200">Email</label>
                <input type="email" id="email" name="email" required class="mt-2 w-full px-4 py-3 bg-pink-700 text-white border border-pink-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-pink-400" placeholder="Enter your email">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-pink-200">Password</label>
                <input type="password" id="password" name="password" required class="mt-2 w-full px-4 py-3 bg-pink-700 text-white border border-pink-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-pink-400" placeholder="Enter your password">
            </div>

            <div>
                <input type="submit" value="Register" class="w-full py-3 bg-gradient-to-r from-green-400 to-blue-500 text-white font-semibold rounded-lg hover:from-green-500 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-green-500 cursor-pointer transition duration-300">
            </div>
        </form>
        <p class="text-sm text-center text-pink-200 mt-6">Already have an account? <a href="./login.php" class="text-blue-400 hover:text-blue-500 transition duration-200">Login here</a></p>
    </div>
</body>

</html>

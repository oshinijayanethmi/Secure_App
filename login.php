<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure PHP Authentication | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        };
    </script>
    <style>
        body {
            /* Use the uploaded image as background with added gradient overlay */
            background: linear-gradient(to right, rgba(255, 120, 150, 0.8), rgba(100, 180, 255, 0.8)), url('assets/login.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        /* Apply backdrop filter to the form to blur the background */
        .backdrop-blur-sm {
            backdrop-filter:(10px);
        }
    </style>
</head>

<body class="min-h-screen text-white flex items-center justify-center p-6">
    <form action="./src/auth/login.php" method="POST" class="bg-black bg-opacity-70 backdrop-blur-sm p-8 rounded-xl shadow-2xl w-full max-w-md space-y-6">
        <h1 class="text-4xl font-extrabold text-white text-center mb-6 bg-clip-text text-transparent bg-gradient-to-r from-pink-400 to-purple-600">Login</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500 text-white p-3 rounded-lg mb-6">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>
        
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-pink-200 mb-2">Email:</label>
            <input type="email" id="email" name="email" required 
                   class="w-full px-4 py-3 bg-pink-700 text-white border border-pink-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-pink-400" placeholder="Enter your email">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-pink-200 mb-2">Password:</label>
            <input type="password" id="password" name="password" required 
                   class="w-full px-4 py-3 bg-pink-700 text-white border border-pink-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 placeholder-pink-400" placeholder="Enter your password">
        </div>

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 bg-pink-700 border-pink-600 rounded focus:ring-blue-500">
                <label for="remember" class="ml-2 block text-sm text-pink-200">Remember me</label>
            </div>
            <a href="#" class="text-sm text-blue-400 hover:text-blue-500">Forgot password?</a>
        </div>

        <div>
            <input type="submit" value="Login" 
                   class="w-full px-4 py-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-semibold rounded-lg hover:from-yellow-500 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 cursor-pointer transition duration-300">
        </div>

        <div class="text-center mt-4">
            <p class="text-sm text-pink-200">Don't have an account? <a href="./register.php" class="text-blue-400 hover:text-blue-500">Sign up</a></p>
        </div>
    </form>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
    @routes
</head>
<body class="flex flex-col min-h-screen bg-gray-300">
    @inertia
</body>
</html>
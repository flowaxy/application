<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Welcome' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            color: #007BFF;
        }
    </style>
</head>

<body>

    <!-- Page Title -->
    <h1><?= $title ?? 'Welcome' ?></h1>

    <!-- Main Welcome Message -->
    <p>Congratulations! 🎉 You have successfully launched your first website using your framework!</p>
    <p>Now you can create new pages, routes, and grow your project.</p>

</body>

</html>
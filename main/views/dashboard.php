<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="views/main.css">
</style>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="dashboard-container">
        <h1>Вітаємо, <?php  echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        
        <?php include 'residents.php'; ?>
        
        <?php include 'rooms.php'; ?>
        </div>
        
        <script src="views/script.js"></script>
</body>
</html>
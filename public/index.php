<?
require '../connect.php';
require '../func.php';


$title = 'main page';


// debug($_SERVER['REQUEST_URI']);



// debug($users);

// debug($search);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <a class="btn btn-warning btn-lg" href="search.php?search=">поиск по имени</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
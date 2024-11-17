<?
require '../connect.php';
require '../func.php';


$title = 'search page';



// debug($_SERVER['REQUEST_URI']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'search_city') {
        if (!empty($_POST['city_name'])) {
            $name = trim($_POST['city_name']);
            $stmt = $pdo->prepare("select name from users where name like ?");
            $stmt->execute(["{$name}%"]);
            // debug($stmt->fetchAll());
            $html = '';
            if ($names = $stmt->fetchAll()) {
                foreach ($names as $name) {
                    $html .= '<li data-value="' . $name['name'] . '">' . htmlspecialchars($name['name']) . '</li>';
                }
            }
            echo $html;
            die;
        }
    }
}

$search = $_GET['search'];



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
    <div class="container mt-5">
        <h2>НАЙТИ ИМЯ</h2>
     
        <div class="row">
            <div class="col-md-6">
                <form action="" class="search-form">
                    <div class="mb-3 position-relative">
                        <input type="text" name="search" id="search" class="form-control" placeholder="searching..." autocomplete="off">
                        <button type="submit" class="btn btn-link">search</button>

                        <ul class="search-results" id="search-results">

                        </ul>

                        <div class="spinner-border text-info spinner-loader" role="status" id="spinner-loader">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <? if ($search == '') { ?>
                    <div class="alert alert-danger">
                        введите имя
                    </div>
                <? }else{  ?>
                    <div class="alert alert-success">
                        <?=$search?>
                    </div>
                    <?}?>
            </div>
        </div>

        <!-- <form action="" class="my-3">
            <input type="text" class="form-control mb-2" name="search" placeholder="search">
            <button class="btn btn-warning" type="submit">найти</button>
        </form>
        <div class="box">
            <? if (!empty($users)) { ?>
                <? foreach ($users as $user) { ?>
                    <div class="alert alert-warning">
                        <p class="h6">имя: <?= $user['name'] ?></p>
                    </div>

                <? } ?>

            <? } else {  ?>
                <div class="alert alert-primary">
                    <p>такого имени нет в базе данных</p>
                </div>
            <? } ?>
        </div> -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {
            let searchInput = $('#search')
            let searchResults = $('#search-results')
            let loader = $('#spinner-loader')

            searchInput.on('focus', function() {
                searchResults.fadeIn()
            })

            searchInput.on('blur', function() {
                searchResults.fadeOut()
            })

            searchResults.on('click', 'li', function() {
                searchInput.val($(this).data('value'))
            })

            searchInput.on('input', function() {
                let cityName = $.trim($(this).val())
                if (cityName.length > 1) {
                    $.ajax({
                        url: 'search.php?search=',
                        type: 'POST',
                        data: {
                            city_name: cityName,
                            action: 'search_city',
                        },
                        beforeSend: function() {
                            loader.stop(true, true).fadeIn()
                        },
                        success: function(res) {
                            searchResults.html(res)
                            loader.stop(true, true).fadeOut()
                        },
                        error: function() {
                            alert('error searching...')
                            loader.stop(true, true).fadeOut()
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>
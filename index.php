<?php
    $url = "resources/views/layouts/app.blade.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is the Online community site.">
    <title>Online community</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <img src="Car-Sea.jpg" alt="Sea with a car" class="mt-5">
        <p class="mt-4">This is my site. <a href="<?php echo $url ?>" class="btn btn-outline-primary">Please click here to check it.</a></p>
    </div>
</body>
</html>
<?php 



    $reviews = json_decode(file_get_contents('reviews.json'), true);
    $rating_scope = [5, 4, 3, 2, 1];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Filter reviews</h2>
        <div>
            <label for="">Order by rating:</label>
            <select name="rating" id="rating">
                <option value="">Highest First</option>
                <option value="">Oldest First</option>
            </select>
        </div>
        <div>
            <label for="">Minimum rating</label>
            <select name="rating_scope" id="rating_scope">
                <?php foreach($rating_scope as $rating) : ?>
                    <option value=<?= $rating ?>><?= $rating ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <label for="">Order by date:</label>
            <select name="date" id="date">
                <option value="">Oldest First:</option>
                <option value="">Newest First:</option>
            </select>
        </div>
        <div>
            <label for="">Prioritize by text:</label>
            <select name="prioritize" id="prioritize">
                <option value="">Yes</option>
                <option value="">No</option>
            </select>
        </div>
        <button type="submit" name="submit">Filter</button>
    </form>
</body>
</html>




<?php 



$reviews = json_decode(file_get_contents('reviews.json'), true);
$rating_scope = [5, 4, 3, 2, 1];
?>

<form action="" method="POST">
    <label for="">Order by rating:</label>
    <select name="rating" id="rating">
        <option value="">Highest First</option>
        <option value="">Oldest First</option>
    </select>
    <label for="">Minimum rating</label>
    <select name="" id="">
        <?php foreach($rating_scope as $rating) : ?>
            <option value=<?= $rating ?>><?= $rating ?></option>
        <?php endforeach ?>
    </select>
    <label for="">Order by date:</label>
    <select name="date" id="date">
        <option value="">Oldest First:</option>
        <option value="">Newest First:</option>
    </select>
    <label for="">Prioritize by text:</label>
    <select name="prioritize" id="prioritize">
        <option value="">Yes</option>
        <option value="">No</option>
    </select>
</form>


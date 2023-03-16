<?php 

    $reviews = json_decode(file_get_contents('reviews.json'), true);
    $rating_scope = [5, 4, 3, 2, 1];

    function filterByScope($reviews, $review, $key, $scope){
        if($review['rating'] < $scope){
            unset($reviews[$key]);
        }

        return $reviews; 
    }

    function filterByRating($reviews, $rating){
        
        if($rating == 'highest_rating'){
            usort($reviews, function($a, $b) {return $b['rating'] - $a['rating']; });
        }else{
            usort($reviews, function($a, $b) {return $a['rating'] - $b['rating']; });
        }

        return $reviews;
    }

    function filterByDate($reviews, $date){
        if($date == 'oldest_date'){
            usort($reviews, function($a, $b) {return $a['reviewCreatedOnTime'] - $b['reviewCreatedOnTime']; });
        }
        else{
                usort($reviews, function($a, $b) {return $b['reviewCreatedOnTime'] - $a['reviewCreatedOnTime']; });
            }
        return $reviews;    
    }

    function prioritizeByText($reviews){
        foreach($reviews as $key => $review){
            if(empty($review['reviewText'])){
                unset($reviews[$key]);
                $emptyTextReview[] = $review;
            }
        }

        return array_merge($reviews, $emptyTextReview);
    }

    function filter($reviews, $date, $prioritize, $rating, $scope){

        $reviews = filterByDate($reviews, $date);
        $reviews = filterByRating($reviews, $rating);
        foreach($reviews as $key => $review){
            $reviews = filterByScope($reviews, $review, $key, $scope);
        }    

        $prioritize ? $reviews = prioritizeByText($reviews) : $reviews;
        
        return $reviews;
    }

    if(!is_null($_POST['date'] ?? $_POST['prioritize'] ??  $_POST['rating_scope'] ?? $_POST['rating'] ?? null)){
        $reviews = filter($reviews, $_POST['date'], $_POST['prioritize'], $_POST['rating'], $_POST['rating_scope']);
    }

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
                <option value="highest_rating">Highest First</option>
                <option value="lowest_rating">lowest First</option>
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
                <option value="oldest_date">Oldest First:</option>
                <option value="newest_date">Newest First:</option>
            </select>
        </div>
        <div>
            <label for="">Prioritize by text:</label>
            <select name="prioritize" id="prioritize">
                <option value=<?= true ?>>Yes</option>
                <option value=<?= false ?>>No</option>
            </select>
        </div>
        <button type="submit" name="submit">Filter</button>
    </form>

    <table>
    <tr>
        <th>Id</th>
        <th>Review Id</th>
        <th>Rating</th>
        <th>Review Text</th>
        <th>Review Created on Date</th>
        <th>timestamp</th>
    </tr>
    <?php foreach($reviews as $review) : ?>
        <tr>
        <td><?= $review['id'] ?></td>
        <td><?= $review['reviewId'] ?></td>
        <td><?= $review['rating'] ?></td>
        <td><?= $review['reviewText'] ?></td>
        <td><?= date('m/d/Y H:i', $review['reviewCreatedOnTime']) ?></td>
        <td><?= $review['reviewCreatedOnTime'] ?></td>
    </tr>
    <?php endforeach ?>
    </table>
</body>
</html>




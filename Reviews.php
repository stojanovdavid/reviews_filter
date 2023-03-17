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
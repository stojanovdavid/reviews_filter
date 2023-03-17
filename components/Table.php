<table id="reviews">
    <tr>
        <th>Id</th>
        <th>Review Id</th>
        <th>Rating</th>
        <th>Review Text</th>
        <th>Review Created on Date</th>
    </tr>
    <?php foreach($reviews as $review) : ?>
        <tr>
        <td><?= $review['id'] ?></td>
        <td><?= $review['reviewId'] ?></td>
        <td><?= $review['rating'] ?></td>
        <td><?= $review['reviewText'] ?></td>
        <td><?= date('m/d/Y H:i', $review['reviewCreatedOnTime']) ?></td>
    </tr>
    <?php endforeach ?>
    </table>
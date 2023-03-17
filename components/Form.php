<form action="" method="POST">
        <h2>Filter reviews</h2>
        <div>
            <label for="">Order by rating:</label>
            <select name="rating" id="rating">
                <option value=""></option>
                <option value="highest_rating">Highest First</option>
                <option value="lowest_rating">lowest First</option>
            </select>
        </div>
        <div>
            <label for="">Minimum rating</label>
            <select name="rating_scope" id="rating_scope">
                <option value=""></option>
                <?php foreach($rating_scope as $rating) : ?>
                    <option value=<?= $rating ?>><?= $rating ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <label for="">Order by date:</label>
            <select name="date" id="date">
                <option value=""></option>
                <option value="oldest_date">Oldest First:</option>
                <option value="newest_date">Newest First:</option>
            </select>
        </div>
        <div>
            <label for="">Prioritize by text:</label>
            <select name="prioritize" id="prioritize">
                <option value=""></option>
                <option value=<?= true ?>>Yes</option>
                <option value=<?= false ?>>No</option>
            </select>
        </div>
        <button type="submit" name="submit">Filter</button>
    </form>
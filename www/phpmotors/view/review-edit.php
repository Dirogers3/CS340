
    <?php require '.././modules/header.php'?>
    <?php echo $navList; ?>
        <h1><?php echo $invMake,' ', $invModel; ?> Review</h1>
        <h3><?php echo 'Reviewed on: ', date_format(new DateTime($review['reviewDate']), 'd F, Y'); ?></h3>
        

<div class="reviewform">
    <?php if($_SESSION['updateMessage']) {echo $_SESSION['updateMessage'];} ?>
<form action="/phpmotors/reviews/index.php" method="post">
    <label id="largeText" for="review">Review Text:</label>
    <textarea name='updatedReviewText' id='review' cols='10' rows='10' required><?php echo $invReview ?></textarea>
    <input id="reviewSubmitBtn" type="submit" name="submit" value="Edit Review">
    <input type="hidden" name="action" value="updateReview">
    <input type="hidden" name="reviewId" value="<?php echo $reviewId; ?>">
    <input type='hidden' name='invId' value='<?php echo $invId ?>'>
    <input type='hidden' name='clientId' value='<?php echo $clientId ?>'>
</form>
</div>
    <?php require '.././modules/footer.php'?>
</body>
</html>

    <?php require '.././modules/header.php'?>
    <?php echo $navList; ?>
        <h1><?php echo 'Delete ',$invMake,' ', $invModel; ?> Review</h1>
        <h3><?php echo 'Reviewed on: ', date_format(new DateTime($review['reviewDate']), 'd F, Y'); ?></h3>
        

<div class="reviewform">
    <h3 class="notice">Deletes cannot be undone. Are you sure you want to delete this review?</h3>
<form action="/phpmotors/reviews/index.php" method="post">
    <h3>Review Text:</h3>
    <h4 id="yellowbackground"><?php echo $invReview ?></h4>
    <input id="reviewSubmitBtn" type="submit" name="submit" value="Delete">
    <input type="hidden" name="action" value="deleteReview">
    <input type="hidden" name="reviewId" value="<?php echo $reviewId; ?>">
    <input type='hidden' name='invId' value='<?php echo $invId ?>'>
    <input type='hidden' name='clientId' value='<?php echo $clientId ?>'>
</form>
</div>
    <?php require '.././modules/footer.php'?>
</body>
</html>
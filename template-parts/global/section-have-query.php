<?php
$have_query = get_field("query");
if (empty($have_query['cta_url'])) {
    $have_query = get_field("query", 'option');
}
?>
<?php if (!empty($have_query['cta_url'])) : ?>
    <div class="have-query-section">
        <div class="container">
            <h1 class="section-title section-title-dark"><?php echo $have_query['title'] ?></h1>
            <p class="query-subtitle"><?php echo $have_query['subtitle'] ?></p>
            <a href="<?php echo $have_query['cta_url'] ?>" class="button-filled"><?php echo $have_query['cta_text'] ?></a>
        </div>
    </div>
<?php endif; ?>
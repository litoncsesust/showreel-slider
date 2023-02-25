<?php
$job_counter_items = get_field('job_counter_items');
?>
<div class="site-global-job-counter-section">
    <div class="job-counter-container container">
        <div class="counter-grid">
            <?php foreach ($job_counter_items as $key => $job_counter_item) : ?>
                <div class="conter-grid-items">
                    <p class="jobs-top-prefix"><?php echo $job_counter_item['unit']; ?></p>
                    <p class="job-subject-title"><?php echo $job_counter_item['title']; ?></p>
                    <p class="job-count"><span data-number="<?php echo $job_counter_item['number']; ?>" class="count-number">0</span><span class="plus-sign">+</span></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="jumbotron">
    <div class="container">
        <h1><?php echo $data['title'];?></h1>
        <p><?php echo $data['description'];?></p>
    </div>
</div>

<!-- <ul>
    <?php //foreach($data['posts'] as $post) : ?>
        <li><?php //echo $post->specialty; ?></li>
    <?php //endforeach; ?>
</ul> -->
<?php require APPROOT . '/views/inc/footer.php'; ?>
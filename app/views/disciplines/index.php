<?php require APPROOT . '/views/inc/header.php'; ?>


<div class="jumbotron">
    <div class="container">
        <h1>Disciplines</h1>
        <a href="<?php echo URLROOT; ?>/disciplines/add" class="btn">Добави дисциплина</a>
    </div>
</div>

<?php foreach($data['disciplines'] as $discipline) : ?>
        <p class="shortDescription" style="display: none;"><?php echo $discipline->mainInfo; //we should propapby get this with JS to display it nicely?></p>
    <div id="showData">
    </div>
<?php endforeach; ?>

</body>
<script src="<?php echo URLROOT; ?>/js/discipline.js"></script>
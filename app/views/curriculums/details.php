
<div class="jumbotron">
    <div class="container">
        <h1>Disciplines</h1>
        <a href="<?php echo URLROOT; ?>/disciplines/import" class="btn">Добави дисциплина</a>
    </div>
</div>

<p class="shortDescription" id="<?php echo $data['curriculum']->id;?>"><?php echo $data['curriculum']->specialty;?></p>
        <p><?php echo $data['curriculum']->academicYear;?></p>

<?php foreach($data['disciplines'] as $discipline) : ?>
        <p class="shortDescription" id="<?php echo $discipline->id;?>"><?php echo $discipline->disciplineNameBg;?></p>
        <a href="<?php echo URLROOT . "/disciplines/visualise/" . $discipline->id;?>">View</a>

<?php endforeach; ?>

    <div id="showData">
    </div>

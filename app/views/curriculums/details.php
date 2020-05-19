<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="title">
        <h2>Дисциплини, изучавани от специалност <?php echo $data['curriculum']->specialty;?></h2>
        <h2>Випуск, приет през академичната <?php echo $data['curriculum']->academicYear;?></h2>
    </div>


<div class="curriculumsPageContainer">

    <div class="curriculumList">
        <?php foreach($data['disciplines'] as $discipline) : ?>
                <a class="commonLink" href="<?php echo URLROOT . "/disciplines/visualise/" . $discipline->id;?>"> <div class="curriculumRow"><?php echo $discipline->disciplineNameBg;?></div></a>
        <?php endforeach; ?>
    </div>
</div>
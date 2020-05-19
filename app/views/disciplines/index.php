<div class="disciplinesAllContainer">
    <div class="title">
        <h1>Дисциплини</h1>
    </div>
    <a class="adminLink" href="<?php echo URLROOT; ?>/disciplines/import" class="btn">Добави дисциплина</a>


    <div class="curriculumList">
        <?php foreach($data['disciplines'] as $discipline) : ?>
                <a class="commonLink" href="<?php echo URLROOT . "/disciplines/visualise/" . $discipline->id;?>"> <div class="curriculumRow" ><?php echo $discipline->disciplineNameBg;?></div></a>
        <?php endforeach; ?>
    </div>
</div>
</body>
<script src="<?php echo URLROOT; ?>/js/main.js"></script>

<?php require APPROOT . '/views/inc/header.php'; ?>


    <div class="curriculumsPageContainer">
        <h1>Учебни планове</h1>

        <div class="curriculumList">
            <h3>Бакалавърски програми</h3>
            <?php foreach($data['curriculums'] as $curriculum) : ?>
                <?php if ($curriculum->oks == "Бакалавър") {?>
                    <div class="curriculumRow" id="bachelor">
                        <a href="<?php echo URLROOT . "/curriculums/details/" . $curriculum->id;?>"><?php echo $curriculum->specialty ."&emsp;&emsp;&emsp;" . $curriculum->academicYear; ?></a>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
            
            <h3>Магистърски програми</h3>
            <?php foreach($data['curriculums'] as $curriculum) : ?>
                <?php if ($curriculum->oks == "Магистър") {?>
                    <div class="curriculumRow" id="master">
                    <a href="<?php echo URLROOT . "/curriculums/details/" . $curriculum->id;?>"><?php echo $curriculum->specialty ."&emsp;&emsp;&emsp;" . $curriculum->academicYear; ?></a>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    </div>



<?php 
$json_data = file_get_contents(URLROOT . "/public/JSONS/file" . $data['discipline']->id . ".json");

$json = json_decode($json_data, true);
$path = URLROOT . "/public/JSONS/file" . $data['discipline']->id . ".json";
?>
<!-- Both link and form work for export -->
<!-- <form action="" method="post"> -->
<!-- <input type="submit" name="submit" value="Свали JSON файл за тази дисциплина"/> -->
<!-- </form> -->



<div id="reviewNav">
    <a class="adminLink" disabled href="#"?>Преглед:</a>
    <a class="adminLink" active href="<?php echo URLROOT . "/disciplines/visualise/" . $data['discipline']->id ."/#short"?>">Кратък</a>
    <a class="adminLink" href="<?php echo URLROOT . "/disciplines/visualise/" . $data['discipline']->id ."/#detailed"?>">Подробен</a>
    <a class="adminLink" href="<?php echo URLROOT . "/disciplines/visualise/" . $data['discipline']->id ."/#admin"?>">Служебен</a>
    <a class="adminLink" href="<?php echo URLROOT . "/disciplines/download/" . $data['discipline']->id ?>">Експорт на JSON файл за тази дисциплина</a>
</div>

<div class="mainContainer">

        <div class="title">
            <h1><?php echo $json["Дисциплина"]; ?></h1>
            <h3><?php echo $json["Discipline"];?></h3>
        </div>
        <div id="credits">
            <h3><?php echo $json["Кредити"];?> кредита</h3>
        </div>
        <div class="mainInfoContainer">
            <div id="specialties">
                <h4>Изучава се от специалности:</h4>
                <ul>
            <?php foreach($json["Специалности"] as $specialty){ ?>
                <li><?php echo $specialty . "</br>";  ?></li>
                <?php } ?>
                 </ul>
            </div>
            <div id="elective">
                <h4>Статут:</h4>
                <h3><?php echo $json["Статут"] . "</br>";  ?></h3>
            </div>
        </div>
        <div id="lecturer">
            <h4>Преподавател</h4>
            <p><?php echo $json["Преподавател"];?></p>
        </div>
        <div class="grayContainer">
            <div id="annotation">
                <h4>Анотация</h4>
                <p><?php echo $json["Анотация"];  ?></p>
            </div>
        </div>
        <div id="prerequisites">
            <h4>Предварителни изисквания</h4>
            <p><?php echo $json["Предварителни изисквания"];  ?></p>
        </div>
        <div id="expectations">
            <h4>Очаквани резултати</h4>
            <p><?php echo $json["Очаквани резултати"]; ?></p>
            <p><?php //echo str_replace('.', ". " . "</br>", $json["Очаквани резултати"]); ?></p>
        </div>
    
        <div id="content">
            <div class="tableTitle">
                <h4>Съдържание</h4>
            </div>
            <table>
                    <tr>
                        <th>№</th>
                        <th>Тема</th>
                    </tr>
                    <?php $count = 0; ?>
                    <?php foreach($json["Съдържание"] as $topic){ ?>
                        <tr>
                            <td><?php echo ++$count?></td>
                            <td><?php echo $topic . "</br>"; ?></td>
                        </tr>
                    <?php } ?>
                 </ul>
            </table>
        </div>
    
        <div id="synopsis">
            <div class="tableTitle">
                <h4>Конспект</h4>
            </div>
            <table>
                    <tr>
                        <th>№</th>
                        <th>Тема</th>
                    </tr>
                    <?php $count = 0; ?>
                    <?php foreach($json["Конспект"] as $topic){ ?>
                        <tr>
                            <td><?php echo ++$count?></td>
                            <td><?php echo $topic . "</br>"; ?></td>
                        </tr>
                    <?php } ?>
                 </ul>
            </table>
        </div>
    
        <div id="bibliography">
            <div class="tableTitle">
                <h4>Библиография</h4>
            </div>
            <table>
                    <tr>
                        <th>№</th>
                        <th>Тема</th>
                    </tr>
                    <?php $count = 0; ?>
                    <?php foreach($json["Библиография"] as $literature){ ?>
                        <tr>
                            <td><?php echo ++$count?></td>
                            <td><?php echo $literature . "</br>"; ?></td>
                        </tr>
                    <?php } ?>
                 </ul>
            </table>
        </div>
    
        <div id="administrative">
            <h2>Административна информация</h2>
            <?php foreach($json["Административна информация"] as $adminInfoTitle => $value){?>
                <?php echo "<strong>" . $adminInfoTitle . ": </strong> " . $value . "</br>";?>
                <?php } ?>

    </div>
    
</div>
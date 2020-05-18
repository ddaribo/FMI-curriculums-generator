<?php require APPROOT . '/views/inc/header.php'; ?>


<div class="jumbotron">
    <div class="container">
        <h1>Добави дисциплина</h1>
    </div>

     <form method="POST" action="<?php echo URLROOT; ?>/disciplines/import">

        <label for="mainInfo">Обща информация за дисциплина: </label> 
        <textarea name="mainInfo" class="<?php echo (!empty($data['mainInfo_err'])) ? 'is_invalid' : '';?>" value="<?php echo $data['mainInfo'];?>"></textarea>
        <span class="invalid-feedback"><?php echo $data['mainInfo_err'];?></span>
        <label for="content">Съдържание на дисциплината: </label> 
        <textarea name="content"></textarea>

        <label for="synopsis">Конспект: </label> 
        <textarea name="synopsis"></textarea>

        <label for="bibliography">Библиография: </label>
        <textarea name="bibliography"></textarea>

        <label for="administrativeInfo">Административна информация: </label>
        <textarea name="administrativeInfo"></textarea>

        <input type="submit" value="Submit">
     </form>

</div>

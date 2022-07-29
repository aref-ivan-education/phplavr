<?php include 'v_header.php'; ?>

<form method='post'>
    Название<br>
    <input type='text' name='title' value='<?=$title ?? ""?>'><br>
    <?php if ($bad && $title_errors): ?>
        <?php foreach ($title_errors as $error): ?>
            <span style='color: red'><?=$error?></span><br>
        <?php endforeach; ?>
    <?php endif; ?>

    Контент<br>
    <textarea name='content'><?=$content ?? ''?></textarea><br>
    <?php if ($bad && $content_errors): ?>
        <?php foreach ($content_errors as $error): ?>
            <span style='color: red'><?=$error?></span><br>
        <?php endforeach; ?>
    <?php endif; ?>

    <br>
    <input type='submit' value='Edit'>
</form>

<?php if ($bad && $param_errors): ?>
    <?php foreach ($param_errors as $error): ?>
        <span style='color: red'><?=$error?></span><br>
    <?php endforeach; ?>
<?php endif; ?>

<?php include 'v_footer.php'; ?>
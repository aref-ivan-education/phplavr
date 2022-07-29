<?php include 'v_header.php'; ?>

<? if (!$bad): ?>
	<h1><?=$article['title']?></h1>
	<span><?=$article['dt']?></span>
	<p><?=$article['content']?></p>
<? else: ?>
	<?php if ($param_errors): ?>
        <?php foreach ($param_errors as $error): ?>
            <span style='color: red'><?=$error?></span><br>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($article_errors): ?>
        <?php foreach ($article_errors as $error): ?>
            <span style='color: red'><?=$error?></span><br>
        <?php endforeach; ?>
    <?php endif; ?>
<? endif; ?>

<?php include 'v_footer.php'; ?>
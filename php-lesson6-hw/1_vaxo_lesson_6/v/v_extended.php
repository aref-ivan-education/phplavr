<?php include 'v_header.php'; ?>

<a href='index.php?view=compact'>Compact view</a>
<? if (isset($articles) && $articles): ?>
	<div style='width: 250px'>
		<? foreach ($articles as $article): ?>
			<h3><a href="post.php?id=<?=$article['id_news']?>"><?=$article['title']?></a></h3>
			<span><?=$article['dt']?></span>
			<? if ($is_auth): ?>
				- <i><a href="edit.php?id=<?=$article['id_news']?>">Edit</a></i>
			<? endif; ?>
			<hr>
		<? endforeach; ?>
	</div>
<? else: ?>
  <p>There are no articles yet!... :(</p>
<? endif; ?>

<?php include 'v_footer.php'; ?>
<?php include 'v_header.php'; ?>

<a href='index.php?view=extended'>Extended view</a>
<? if (isset($articles) && $articles): ?>
	<ul>
		<? foreach ($articles as $article): ?>
			<li>
				<? if ($is_auth): ?>
					<a href="edit.php?id=<?=$article['id_news']?>">Edit</a><span>&nbsp;&nbsp;&nbsp;</span>
				<? endif; ?>
					<?=$article['dt']?> - <a href="post.php?id=<?=$article['id_news']?>"><?=$article['title']?></a>
			</li>
		<? endforeach; ?>
	</ul>
<? else: ?>
  <p>There are no articles yet!... :(</p>
<? endif; ?>

<?php include 'v_footer.php'; ?>
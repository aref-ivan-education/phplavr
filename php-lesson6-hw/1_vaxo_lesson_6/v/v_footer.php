		<br>
		<footer>
			<? if ($page_title != 'Index'): ?>
				<a href='index.php'>Index</a><span>&nbsp;&nbsp;&nbsp;</span>
			<? endif; ?>
			<? if ($is_auth && $page_title != 'Add'): ?>
			  	<a href='add.php'>Add</a><span>&nbsp;&nbsp;&nbsp;</span>
			<? endif; ?>
			<? if ($page_title != 'Login'): ?>
				<a href='login.php'><?=$is_auth ? 'Logout' : 'Login'?></a><span>&nbsp;&nbsp;&nbsp;</span>
			<? endif; ?>
		</footer>
	</body>
</html>
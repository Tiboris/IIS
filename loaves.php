<h1>Informácie o bochníkoch</h1>

<div id="home">
<?php
	if (isset($_SESSION['login_user'])) { ?>
		<form action="?page=loaf" method="post">
			<button name="loaf" value="sklad">Na sklade</button>
			<button name="loaf" value="predajna">Na predajni</button>
		</form>
	<?php }
	else { ?>
		<h2>Neprihlásený užívateľ</h2>
		Pre prácu s informačným systém sa prosím prihláste.
	<?php }
?>
</div>

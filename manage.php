<h1>Správa zamestnancov</h1>

<div id="home">
<?php
	if (isset($_SESSION['login_user'])) {
		if ($_SESSION['veduci'] != '1') { ?>
			<h2>Prístup odmietnutý!</h2>
			Nemáte dostatočné práva na spravovanie zamestancov.
		<?php } else { ?>
			<a href="?page=add_employee">
			   <button>Pridať zamestnanca</button>
			</a>
			<a href="?page=fire_employee">
			   <button>Vyhodiť zamestnanca</button>
			</a>
			<a href="?page=change_salary">
			   <button>Zmeniť plat</button>
			</a>
		<?php }
	} else { ?>
		<h2>Neprihlásený užívateľ</h2>
		Pre prácu s informačným systém sa prosím prihláste.
	<?php }
?>
</div>

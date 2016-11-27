<h1>Informačný systém pre predajňu so syrmi</h1>
<div id="home">
<?php
	if (isset($_SESSION['login_user'])) {
	?>
		<h2>Vitajte <?php echo "${_SESSION['login_user']}, ${_SESSION['meno']} ${_SESSION['priezvisko']}"; ?>!</h2>
		Teraz môžete pracovať s informačným systémom.
	<?php } else { ?>
		<h2>Neprihlásený užívateľ</h2>
		Pre prácu s informačným systém sa prosím prihláste.
	<?php }
?>
</div>

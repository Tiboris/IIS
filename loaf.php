<script src="sorttable.js"></script>
<?php
	if (!isset($_POST['loaf']))
		header("location: ?page=loaves");
	include('config.php');
	$sql = "SELECT syry.nazov AS nazov_syra, syry.typ AS typ_syra, zivocich, tuk, akt_hmot, poc_hmot, krajiny.nazov AS krajina, objednavky.id_obj, dodavatelia.nazov AS dod_nazov, zamestnanci.meno, zamestnanci.priezvisko, trvanlivost, datum
			FROM bochniky INNER JOIN objednavky ON bochniky.id_obj=objednavky.id_obj
						  INNER JOIN syry ON syry.id_syr=bochniky.id_syr
						  INNER JOIN dodavatelia ON dodavatelia.id_dod=objednavky.id_dod
						  INNER JOIN zamestnanci ON zamestnanci.r_cislo=objednavky.r_cislo
						  INNER JOIN krajiny ON krajiny.skratka=bochniky.krajina
			WHERE bochniky.umiestnenie='${_POST['loaf']}'";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<h1>Informácie o bochníkoch na sklade</h1>
* pre zoradenie kliknite na názov stĺpca
<table class="sortable">
	<tr>
		<th>Názov syra</th>
		<th>Druh syra</th>
		<th>Živočích</th>
		<th>% tuku</th>
		<th>Aktuálna hmotnosť</th>
		<th>Počiatočná hmotnosť</th>
		<th>Trvanlivosť</th>
		<th>Krajina pôvodu</th>
		<th>Číslo objednávky</th>
		<th>Dátum objednávky</th>
		<th>Dodávateľ</th>
		<th>Objednal</th>
	</tr>
	<?php
		foreach ($rows as $row) { ?>
			<tr>
				<td><?php echo $row['nazov_syra'] ?></td>
				<td><?php echo $row['typ_syra'] ?></td>
				<td><?php echo $row['zivocich'] ?></td>
				<td><?php echo $row['tuk'] ?></td>
				<td><?php echo $row['akt_hmot'] ?></td>
				<td><?php echo $row['poc_hmot'] ?></td>
				<td><?php echo $row['trvanlivost'] ?></td>
				<td><?php echo $row['krajina'] ?></td>
				<td><?php echo $row['id_obj'] ?></td>
				<td><?php echo $row['datum'] ?></td>
				<td><?php echo $row['dod_nazov'] ?></td>
				<td><?php echo "${row['meno']} ${row['priezvisko']}" ?></td>
			</tr>
		<?php }
	?>
</table>

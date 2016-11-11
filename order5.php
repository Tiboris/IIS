<?php
	include('session.php');
	$_SESSION['datum'] = $_POST['datum'];
	$_SESSION['suma'] = $_POST['suma'];
	$_SESSION['umiestnenie'] = $_POST['umiestnenie'];
	unset($_POST);

	// objednavka
	$sql = "SELECT r_cislo FROM zamestnanci WHERE login='${_SESSION['login_user']}'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$sql = "INSERT INTO objednavky (datum, suma, r_cislo, id_dod) VALUES ('${_SESSION['datum']}', ${_SESSION['suma']}, '${row['r_cislo']}', ${_SESSION['id_dod']})";
	$result = mysqli_query($db, $sql);
	$last_id = mysqli_insert_id($db);

	// bochniky
	for ($i=0; $i < sizeof($_SESSION['id_syrov']); $i++) { 
		$id_syr = $_SESSION['id_syrov'][$i];
		$hmot = $_SESSION['hmot_syrov'][$i];
		$krajina = $_SESSION['krajiny_syrov'][$i];
		$trvan = $_SESSION['trvan_syrov'][$i];
		$tuk = $_SESSION['tuk_syrov'][$i];

		$sql = "INSERT INTO bochniky (id_syr, akt_hmot, poc_hmot, krajina, trvanlivost, tuk, umiestnenie, id_obj) VALUES ($id_syr, $hmot, $hmot, '$krajina', '$trvan', $tuk, '${_SESSION['umiestnenie']}', $last_id)";
		$result = mysqli_query($db, $sql);
	}
?>
<h1>Vaša objednávka</h1>
<table>
	<tr>
		<td><b>Objednávateľ: </b></td>
		<td><?php echo "${_SESSION['meno']}  ${_SESSION['priezvisko']}"?></td>
	</tr>
	<tr>
		<td><b>Dodávateľ: </b></td>
		<td><?php echo $_SESSION['id_dod'] ?></td>
	</tr>
	<tr>
		<td><b>ID objednávky: </b></td>
		<td><?php echo $last_id ?></td>
	</tr>
	<tr>
		<td><b>SUMA: </b></td>
		<td><?php echo $_SESSION['suma'] ?>&euro;</td>
	</tr>
</table>
<table class="sortable">
	<tr>
		<th>Syr</th>
		<th>Typ</th>
		<th>Živočích</th>
		<th>Tuk</th>
		<th>Krajina</th>
		<th>Hmotnosť</th>
		<th>Trvanlivosť</th>
		<th>Umiestnenie</th>
	</tr>
	<?php 
		for ($i=0; $i < sizeof($_SESSION['id_syrov']); $i++) { 
			$id_syr = $_SESSION['id_syrov'][$i];
			$sql = "SELECT * FROM bochniky NATURAL JOIN syry WHERE syry.id_syr=$id_syr AND bochniky.id_obj=$last_id";
			$result = mysqli_query($db, $sql);
			$rows = mysqli_fetch_array($result, MYSQLI_ASSOC);
			?>
			<tr>
				<td><?php echo $rows['nazov'] ?></td>
				<td><?php echo $rows['typ'] ?></td>
				<td><?php echo $rows['zivocich'] ?></td>
				<td><?php echo $rows['tuk'] ?></td>
				<td><?php echo $rows['krajina'] ?></td>
				<td><?php echo $rows['poc_hmot'] ?></td>
				<td><?php echo $rows['trvanlivost'] ?></td>
				<td><?php echo $rows['umiestnenie'] ?></td>
			</tr>
			<?php
		}
	?>
</table>
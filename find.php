<script src="sorttable.js"></script>
<?php
	include('config.php');
	$sql = "SELECT syry.nazov AS nazov_syra, syry.typ AS typ_syra, zivocich, tuk, krajiny.nazov AS krajina, info, dodavatelia.nazov AS dod_nazov, umiestnenie, objednavky.id_obj
			FROM bochniky INNER JOIN objednavky ON bochniky.id_obj=objednavky.id_obj 
						  INNER JOIN syry ON syry.id_syr=bochniky.id_syr
						  INNER JOIN dodavatelia ON dodavatelia.id_dod=objednavky.id_dod
						  INNER JOIN zamestnanci ON zamestnanci.r_cislo=objednavky.r_cislo
						  INNER JOIN krajiny ON krajiny.skratka=bochniky.krajina";
	if (isset($_POST['find_submit'])) {
		$visible=true;
	}
?>
<h1>Vyhľadávacie kritéria</h1>
<form action="" method="post">
	<select name="name">
		<option value="0"></option>
		<?php
		$query = "SELECT DISTINCT nazov FROM syry";
		$res = mysqli_query($db, $query);
		$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
		foreach ($rows as $cheese) { ?>
			<option value="<?php echo $cheese['nazov'] ?>" <?php if (isset($_POST['name']) && $_POST['name'] == $cheese['nazov']) echo "selected='true'" ?>><?php echo "${cheese['nazov']}" ?></option>
		<?php } 
		?>
	</select>
	<select name="type">
		<option value="0"></option>
		<?php
		$query = "SELECT DISTINCT typ FROM syry";
		$res = mysqli_query($db, $query);
		$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
		foreach ($rows as $cheese) { ?>
			<option value="<?php echo $cheese['typ'] ?>" <?php if (isset($_POST['type']) && $_POST['type'] == $cheese['typ']) echo "selected='true'" ?>><?php echo "${cheese['typ']}" ?></option>
		<?php } 
		?>
	</select>
	<select name="animal">
		<option value="0"></option>
		<?php
		$query = "SELECT DISTINCT zivocich FROM syry";
		$res = mysqli_query($db, $query);
		$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
		foreach ($rows as $cheese) { ?>
			<option value="<?php echo $cheese['zivocich'] ?>" <?php if (isset($_POST['animal']) && $_POST['animal'] == $cheese['zivocich']) echo "selected='true'" ?>><?php echo "${cheese['zivocich']}" ?></option>
		<?php } 
		?>
	</select>
	<select name="country">
		<option value="0"></option>
		<?php
		$query = "SELECT * FROM krajiny";
		$res = mysqli_query($db, $query);
		$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
		foreach ($rows as $country) { ?>
			<option value="<?php echo $country['skratka'] ?>" <?php if (isset($_POST['country']) && $_POST['country'] == $country['skratka']) echo "selected='true'" ?>><?php echo "${country['nazov']}" ?></option>
		<?php } 
		?>
	</select>
	<input type="number" name="fat" min="1" max="100" value="<?php if (isset($_POST['fat'])) echo $_POST['fat'] ?>"> % tuku
	<br>
	<input type="submit" name="find_submit" value="Hľadať">
</form>
<br>
<?php
	if (isset($visible)) {
		$i = 0;
		if ($_POST['country'] != '0') {
			$i += 1;
			$print_info = true;
			$sql .= " WHERE krajiny.skratka='${_POST['country']}'";
		}
		if ($_POST['name'] != '0') {
			$i += 1;
			$string = ($i == 1) ? " WHERE" : " AND" ;
			$string .= " syry.nazov='${_POST['name']}'";
			$sql .= $string;
		}
		if ($_POST['type'] != '0') {
			$i += 1;
			$string = ($i == 1) ? " WHERE" : " AND" ;
			$string .= " syry.typ='${_POST['type']}'";
			$sql .= $string;
		}
		if ($_POST['animal'] != '0') {
			$i += 1;
			$string = ($i == 1) ? " WHERE" : " AND" ;
			$string .= " syry.zivocich='${_POST['animal']}'";
			$sql .= $string;
		}
		if ($_POST['fat'] != '') {
			$i += 1;
			$string = ($i == 1) ? " WHERE" : " AND" ;
			$string .= " bochniky.tuk='${_POST['fat']}'";
			$sql .= $string;
		}
		if ($i != 0) {
			$result = mysqli_query($db, $sql);
			$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
			if (isset($print_info) && isset($rows[0])) {
				$krajina = $rows[0]['krajina'];
				$info = $rows[0]['info'];
				echo "Informácie o krajine <b>$krajina</b>: $info<br><br>";
			}
			?>
			* pre zoradenie kliknite na názov stĺpca
			<table class="sortable">
				<tr>
					<th>Názov syra</th>
					<th>Druh syra</th>
					<th>Živočích</th>
					<th>% tuku</th>
					<th>Krajina pôvodu</th>
					<th>Číslo objednávky</th>
					<th>Dodávateľ</th>
					<th>Umiestnenie</th>
				</tr>
				<?php 
					foreach ($rows as $row) { ?>
						<tr>
							<td><?php echo $row['nazov_syra'] ?></td>
							<td><?php echo $row['typ_syra'] ?></td>
							<td><?php echo $row['zivocich'] ?></td>
							<td><?php echo $row['tuk'] ?></td>
							<td><?php echo $row['krajina'] ?></td>
							<td><?php echo $row['id_obj'] ?></td>
							<td><?php echo $row['dod_nazov'] ?></td>
							<td><?php echo $row['umiestnenie'] ?></td>
						</tr>
					<?php }
				?>
			</table>
		<?php
		}
	}
?>

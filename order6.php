<script src="sorttable.js"></script>
<?php include('session.php'); ?>
<h1>Vaša objednávka</h1>
<table>
	<tr>
		<td><b>Objednávateľ: </b></td>
		<td><?php echo "${_SESSION['meno']}  ${_SESSION['priezvisko']}"?></td>
	</tr>
	<tr>
		<td><b>Dodávateľ: </b></td>
		<td>
			<?php
				$sql = "SELECT dodavatelia.nazov FROM dodavatelia WHERE id_dod=${_SESSION['id_dod']}";
				$result = mysqli_query($db, $sql);
				$res = mysqli_fetch_array($result, MYSQLI_ASSOC);
				echo $res['nazov'];
			?>
		</td>
	</tr>
	<tr>
		<td><b>ID objednávky: </b></td>
		<td><?php echo $_SESSION['last_id'] ?></td>
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
			$sql = "SELECT * FROM bochniky NATURAL JOIN syry WHERE syry.id_syr=$id_syr AND bochniky.id_obj=${_SESSION['last_id']}";
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

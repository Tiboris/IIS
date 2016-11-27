<?php
	include('session.php');
	$sql = "SELECT bochniky.id_bochnika, bochniky.umiestnenie, syry.nazov as nazov_syr, dodavatelia.nazov , bochniky.akt_hmot FROM bochniky INNER JOIN objednavky ON bochniky.id_obj=objednavky.id_obj INNER JOIN dodavatelia ON dodavatelia.id_dod=objednavky.id_dod INNER JOIN syry ON bochniky.id_syr=syry.id_syr ORDER BY bochniky.id_bochnika";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (isset($_POST['submit'])) {
		unset($_POST['submit']);
		$sql = "SELECT umiestnenie FROM bochniky WHERE id_bochnika='${_POST['loaves']}'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$place = $row['umiestnenie'];
		if ( $place == 'predajna') {
			$sql = "UPDATE bochniky SET umiestnenie='sklad' WHERE id_bochnika='${_POST['loaves']}'";
		} else {
			$sql = "UPDATE bochniky SET umiestnenie='predajna' WHERE id_bochnika='${_POST['loaves']}'";
		}
		$result = mysqli_query($db, $sql);
		if ($result) {
			echo "<script>alert('Bochník s ID:${_POST['loaves']} bol prehodený!')</script>";
		} else {
			echo "<script>alert('Bochník sa nepodarilo prehodiť')</script>";
		}
	}
?>
<h1>Prehodenie bochníkov</h1>
<form action="" method="POST">
	<table>
		<tr>
			<td>Vyberte bochník: </td>
			<td>
				<select id="loaf" name="loaves">
					<?php
					foreach ($rows as $loaf) { ?>
						<option value="<?php echo $loaf['id_bochnika'] ?>"><?php echo "ID:${loaf['id_bochnika']}, ${loaf['nazov']}, ${loaf['nazov_syr']}, ${loaf['umiestnenie']}, hmotnosť = ${loaf['akt_hmot']}; kg" ?></option>
					<?php }
					?>
				</select>
			</td>
		</tr>
	</table>
	<br>
	<input type="submit" name="submit" value="Premiestniť bochník">
</form>

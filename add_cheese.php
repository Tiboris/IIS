<h1>Pridať syr od dodávateľa</h1>
<?php
	include('session.php');
	$sql = "SELECT * FROM dodavatelia";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$sql = "SELECT * FROM syry";
	$result = mysqli_query($db, $sql);
	$cheeses = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (isset($_POST['submit'])) {
		unset($_POST['submit']);
		$sql = "INSERT INTO syry (nazov, typ, zivocich ) VALUES ('${_POST['nazov']}', '${_POST['typ']}', '${_POST['zivocich']}')";
		$result = mysqli_query($db, $sql);
		if (!$result) {
			$sql = "SELECT id_syr FROM syry WHERE nazov = '${_POST['nazov']}' AND typ = '${_POST['typ']}' AND zivocich = '${_POST['zivocich']}'";
			$result = mysqli_query($db, $sql);
			$last_id = mysqli_fetch_all($result, MYSQLI_ASSOC);
			$last_id = $last_id[0];
			$last_id = $last_id['id_syr'];
		}
		else {
			$last_id = mysqli_insert_id($db);
		}
		$sql = "INSERT INTO ponukaju (id_dod, id_syr, cena_za_kg) VALUES (${_POST['dodavatel']}, $last_id, ${_POST['cena']} )";
		$result = mysqli_query($db, $sql);
		if ($result) {
			$sql = "SELECT nazov FROM dodavatelia WHERE id_dod = ${_POST['dodavatel']}";
			$result = mysqli_query($db, $sql);
			$dod = mysqli_fetch_all($result, MYSQLI_ASSOC);
			$dod = $dod[0];
			$dod = $dod['nazov'];
			echo "<script>alert('Syr ${_POST['nazov']} od dodávateľa $dod bol pridaný!');</script>";
		} else {
			echo "<script>alert('Chyba! Skontrolujte údaje alebo pripojenie k databáze a skúste znova.');</script>";
		}
	}
?>
<form action="" method="POST">
	<table>
	<tr>
		<td>
			<table>
				<tr>
					<td>* Dodávateľ:</td>
				</tr>
				<tr>
					<td>
						<select class="" name="dodavatel">
							<?php
							foreach ($rows as $supplier) { ?>
								<option value="<?php echo $supplier['id_dod'] ?>"><?php echo "${supplier['nazov']}" ?></option>
							<?php }
							?>
						</select>
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td>* Názov syra:</td>
				</tr>
				<tr>
					<td><input type="text" name="nazov" maxlength="30" placeholder="Niva" required="yes" pattern="[a-zA-ZľščťžýáíéôäúňůĽŠČŤŽÝÁÍÉÚÄÔŮ]+"></td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td>* Typ syra:</td>
				</tr>
				<tr>
					<td><input type="text" name="typ" maxlength="20" placeholder="plesnivý" required="yes" pattern="[a-zA-ZľščťžýáíéôäúňůĽŠČŤŽÝÁÍÉÚÄÔŮ]+"></td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td>* Cena za kilogram: (€)</td>
				</tr>
				<tr>
					<td>
						<input type="number" name="cena" min="1" placeholder="4.3" required="yes" step="0.01">
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td>* Živočích:</td>
				</tr>
				<tr>
					<td><input type="text" name="zivocich" maxlength="20" placeholder="krava" required="yes" pattern="[a-zA-ZľščťžýáíéôäúňůĽŠČŤŽÝÁÍÉÚÄÔŮ]+"></td>
				</tr>
			</table>
		</td>
	</tr>
	</table>
	<br>
	<input type="submit" name="submit" value="Pridať syr">
</form>

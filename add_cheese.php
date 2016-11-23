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
		$last_id = mysqli_insert_id($db);
		$sql = "INSERT INTO ponukaju (id_dod, id_syr) VALUES (${_POST['dodavatel']}, $last_id)";
		$result = mysqli_query($db, $sql);
		if ($result) {
			echo "Syr ${_POST['meno']} od dodávateľa ${_POST['priezvisko']} bol pridaný!<br>";
		} else {
			echo "<h3>Chyba! Skontrolujte pripojenie k databáze a skúste znova.</h3><br>";
		}
	}
?>
<form action="" method="POST">
	<table>
	<tr>
		<td>
			<table>
				<tr>
					<td>Dodávateľ:</td>
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
					<td>Názov syra:</td>
				</tr>
				<tr>
					<td><input type="text" name="nazov" maxlength="30" placeholder="Niva" required="yes" pattern="[a-zA-ZľščťžýáíéôäúňůĽŠČŤŽÝÁÍÉÚÄÔŮ]+"> *</td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td>Typ syra:</td>
				</tr>
				<tr>
					<td><input type="text" name="typ" maxlength="20" placeholder="plesnivý" required="yes" pattern="[a-zA-ZľščťžýáíéôäúňůĽŠČŤŽÝÁÍÉÚÄÔŮ]+"> *</td>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td>Živočích:</td>
				</tr>
				<tr>
					<td><input type="text" name="zivocich" maxlength="20" placeholder="krava" required="yes" pattern="[a-zA-ZľščťžýáíéôäúňůĽŠČŤŽÝÁÍÉÚÄÔŮ]+"> *</td>
				</tr>
			</table>
		</td>
	</tr>
	</table>
	<br>
	<input type="submit" name="submit" value="Pridať syr">
</form>

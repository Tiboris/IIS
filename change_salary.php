<?php
	include('session.php');
	if ($_SESSION['veduci'] != '1') {
		header("location: ?page=manage");
	}
	$sql = "SELECT * FROM zamestnanci";
	$result = mysqli_query($db, $sql);
	$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if (isset($_POST['submit'])) {
		unset($_POST['submit']);
		$sql = "UPDATE zamestnanci SET plat=${_POST['salary']} WHERE r_cislo='${_POST['employees']}'";
		$result = mysqli_query($db, $sql);
		$sql = "SELECT * FROM zamestnanci";
		$result = mysqli_query($db, $sql);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
		if ($result) {
			echo "<script>alert('Plat zmenený na ${_POST['salary']} !')</script>";
		}
		else {
			echo "<script>alert('Plat sa nepodarilo zmeniť')</script>";
		}
	}
?>
<form action="" method="POST">
	<table>
		<tr>
			<td>Vyberte zamestnanca </td>
			<td>
				<select id="emp" name="employees">
					<?php
					foreach ($rows as $employee) { ?>
						<option value="<?php echo $employee['r_cislo'] ?>"><?php echo "${employee['meno']} ${employee['priezvisko']}, ${employee['r_cislo']}, plat = ${employee['plat']}&euro; " ?></option>
					<?php }
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Nový plat: </td>
			<td><input type="number" name="salary" min="0" max="1000000" placeholder="350" required="yes"> EUR/mesiac *</td>
		</tr>
	</table>
	<br>
	<input type="submit" name="submit" value="Potvrdiť zmenu platu">
</form>

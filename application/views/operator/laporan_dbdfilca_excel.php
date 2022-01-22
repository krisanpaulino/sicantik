<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<h1><?= $judul ?></h1>
<h1> Bulan <?= $sesi['nama_bulan'] ?> Tahun <?= $sesi['tahun'] ?></h1>
<table border="1" width="100%">

</table>
<table border="1" width="100%">
	<thead>
		<tr>
			<th>Jumlah Desa</th>
			<th>Jumlah Desa Diberi Obat</th>
			<th>(%) Desa Diberi Obat</th>
			<th>Jumlah Penduduk</th>
			<th>Jumlah Sasaran</th>

		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?= $dbdfilca['jumlah_desa'] ?></td>
			<td><?= $dbdfilca['jumlah_desa_diberi_obat'] ?></td>
			<td><?= $dbdfilca['jumlah_desa'] / $dbdfilca['jumlah_desa_diberi_obat'] * 100 ?>%</td>
			<td><?= $dbdfilca['jumlah_penduduk'] ?></td>
			<td><?= $dbdfilca['jumlah_sasaran'] ?></td>
		</tr>
	</tbody>
</table>


<h3>Jumlah Penduduk Minum Obat</h3>
<table border="1" width="100%">
	<thead>
		<tr>
			<?php foreach ($usia_dbdfilca as $usia) : ?>
				<th colspan="3"><?= $usia['rentang_usia'] ?></th>
			<?php endforeach; ?>
			<th rowspan="2">LK</th>
			<th rowspan="2">PR</th>
			<th rowspan="2">TOTAL</th>
			<th rowspan="2">(%) Pddk minum obat dari jumlah penduduk</th>
			<th rowspan="2">(%) Pddk minum obat dari jumlah sasaran</th>
		</tr>
		<tr>
			<?php foreach ($usia_dbdfilca as $usia) : ?>
				<th>LK</th>
				<th>PR</th>
				<th>TOTAL</th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php
			$l = 0;
			$p = 0;
			?>
			<?php foreach ($dbdfilca['detail'] as $detail) : ?>
				<td><?= $detail['l'] ?></td>
				<td><?= $detail['p'] ?></td>
				<td><?= $detail['l'] + $detail['p'] ?></td>
				<?php
				$l += $detail['l'];
				$p += $detail['p'];
				?>
			<?php endforeach; ?>
			<td><?= $l ?></td>
			<td><?= $p ?></td>
			<td><?= $l + $p ?></td>
			<td><?= ($l + $p) / $dbdfilca['jumlah_penduduk'] * 100 ?>%</td>
			<td><?= ($l + $p) / $dbdfilca['jumlah_sasaran'] * 100 ?>%</td>
			<td></td>
		</tr>
	</tbody>
</table>

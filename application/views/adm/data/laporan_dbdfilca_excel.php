<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<h1><?= $judul ?></h1>
<h1> Bulan <?= $sesi['nama_bulan'] ?> Tahun <?= $sesi['tahun'] ?></h1>
<table border="1" width="100%">
	<thead>
		<tr>
			<th rowspan="3">Nama Puskesmas</th>
			<th rowspan="3">Jumlah Desa</th>
			<th rowspan="3">Jumlah Desa Diberi Obat</th>
			<th rowspan="3"> (%) Desa diberi Obat</th>
			<th rowspan="3"> Jumlah Pddk</th>
			<th rowspan="3"> Jumlah Sasaran</th>
			<th colspan="<?= count($usia_dbdfilca) * 3 + 3 ?>">Jumlah Pddk Minum Obat
			</th>
			<th rowspan="3"> (%) Pddk minum obat dari jumlah penduduk</th>
			<th rowspan="3"> (%) Pddk minum obat dari jumlah sasaran</th>
		</tr>
		<tr>
			<?php foreach ($usia_dbdfilca as $usia) : ?>
				<th colspan="3"><?= $usia['rentang_usia'] ?></th>
			<?php endforeach; ?>
			<th rowspan="2">LK</th>
			<th rowspan="2">PR</th>
			<th rowspan="2">TOTAL</th>
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
		<?php foreach ($data_dbdfilca as $dbdfilca) : ?>
			<?php
			$l = 0;
			$p = 0;
			?>
			<td><?= $dbdfilca['nama_puskesmas'] ?></td>
			<td><?= $dbdfilca['jumlah_desa'] ?></td>
			<td><?= $dbdfilca['jumlah_desa_diberi_obat'] ?></td>
			<td><?= $dbdfilca['jumlah_desa_diberi_obat'] / $dbdfilca['jumlah_desa'] * 100 ?> %</td>
			<td><?= $dbdfilca['jumlah_penduduk'] ?></td>
			<td><?= $dbdfilca['jumlah_sasaran'] ?></td>

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
		<?php endforeach; ?>
	</tbody>
</table>

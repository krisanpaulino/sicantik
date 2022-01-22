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
		<th>Jenis Imunisasi</th>
		<th>#L</th>
		<th>#P</th>
		<th>Jumlah</th>
	</thead>
	<tbody>
		<?php foreach ($data_imunisasi as $imunisasi) : ?>
			<tr>
				<td><?= $imunisasi['nama_imunisasi'] ?></td>
				<td><?= $imunisasi['l'] ?></td>
				<td><?= $imunisasi['p'] ?></td>
				<td><?= $imunisasi['l'] + $imunisasi['p'] ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

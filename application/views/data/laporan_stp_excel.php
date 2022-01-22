<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>
<h2><?= $judul ?></h2>
<h3><?= $puskesmas['nama_puskesmas'] ?></h3>
<table border="1" width="100%">
	<thead>
		<tr>
			<th rowspan="2">Jenis Penyakit</th>
			<?php foreach ($usia_stp as $usia) : ?>
				<th colspan="2"><?= $usia['rentang_usia'] ?></th>
			<?php endforeach; ?>
			<th colspan="2">Total</th>
			<th rowspan="2">Total Kunjungan</th>
		</tr>
		<tr>
			<?php foreach ($usia_stp as $usia) : ?>
				<th>L</th>
				<th>P</th>
			<?php endforeach; ?>
			<th>L</th>
			<th>P</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data_stp as $data) : ?>
			<tr>
				<td><?= $data['nama_data'] ?></td>
				<?php $l = 0;
				$p = 0; ?>
				<?php foreach ($data['usia'] as $usia) : ?>
					<td><?= $usia['l'] ?></td>
					<td><?= $usia['p'] ?></td>
					<?php $l += $usia['l'];
					$p += $usia['p']; ?>
				<?php endforeach; ?>
				<td><?= $l ?></td>
				<td><?= $p ?></td>
				<td><?= $l + $p ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

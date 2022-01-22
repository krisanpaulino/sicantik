<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<h1><?= $judul ?></h1>
<!-- <h1> Bulan <?= $sesi['nama_bulan'] ?> Tahun <?= $sesi['tahun'] ?></h1> -->

<table border="1" width="100%">
	<thead>
		<tr>
			<th rowspan="3">Nama Penyakit</th>
			<th colspan="<?= count($usia_ptm) * 2 ?>">KUNJUNGAN MENURUT GOLONGAN UMUR (TAHUN) </th>
			<th rowspan="2" colspan="3">Total</th>
		</tr>
		<tr>
			<?php foreach ($usia_ptm as $usia) : ?>
				<th colspan="2"><?= $usia['rentang_usia'] ?></th>
			<?php endforeach; ?>


		</tr>
		<?php foreach ($usia_ptm as $usia) : ?>
			<th>L</th>
			<th>P</th>
		<?php endforeach; ?>
		<th>L</th>
		<th>P</th>
		<th>L+P</th>
	</thead>
	<tbody>
		<!-- $l_total = 0 -->
		<?php foreach ($data_ptm as $ptm) : ?>
			<tr>
				<td class="bg-success"><?= $ptm['nama_data'] ?></td>
				<td colspan="<?= count($usia_ptm) * 2 + 3 ?>" class="bg-success"></td>
			</tr>
			<?php foreach ($ptm['atribut'] as $atribut) : ?>
				<?php
				$l = 0;
				$p = 0;
				?>
				<tr>
					<td><?= $atribut['nama_atribut'] ?></td>
					<?php foreach ($atribut['usia'] as $usia) : ?>
						<td><?= $usia['detail']['l'] ?></td>
						<td><?= $usia['detail']['p'] ?></td>
						<?php
						$l += $usia['detail']['l'];
						$p += $usia['detail']['p'];
						?>
					<?php endforeach; ?>
					<td><?= $l ?></td>
					<td><?= $p ?></td>
					<td><?= $l + $p ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>

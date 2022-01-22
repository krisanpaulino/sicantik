<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>
<h1><?= $judul ?></h1>
<table border="1" width="100%">
	<thead>
		<tr>
			<td rowspan="2">Jenis Kegiatan</td>
			<td rowspan="2">Sasaran</td>
			<td rowspan="2">Target Capaian</td>
			<td rowspan="2">Jumlah Sasaran</td>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<td colspan="2"><?= $puskesmas['nama_puskesmas'] ?></td>
			<?php endforeach; ?>
			<td colspan="2">Total</td>
		</tr>
		<tr>
			<?php for ($i = 0; $i < count($data_puskesmas); $i++) { ?>
				<td>ABS</td>
				<td>KOM</td>
			<?php } ?>
			<td>ABS</td>
			<td>KOM</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($jenis_kegiatan as $jenis) : ?>
			<tr>
				<td class="bg-primary"><?= $jenis['nama_jenis'] ?></td>
			</tr>
			<?php $kelompok = null ?>
			<?php foreach ($jenis['kegiatan'] as $kegiatan) : ?>
				<?php if ($kelompok != $kegiatan['kelompok_kegiatan']) : ?>
					<tr>
						<th>
							<?= $kegiatan['kelompok_kegiatan'] ?>
						</th>
					</tr>
					<?php $kelompok = $kegiatan['kelompok_kegiatan'] ?>
				<?php endif; ?>
				<tr>
					<td><?= $kegiatan['nama_kegiatan'] ?></td>
					<td><?= $kegiatan['sasaran'] ?></td>
					<td><?= $kegiatan['pkp']['target_capaian'] ?></td>
					<td><?= $kegiatan['pkp']['jumlah_sasaran'] ?></td>
					<?php
					$abs = 0;
					$kom = 0;
					?>
					<?php foreach ($kegiatan['puskesmas'] as $puskesmas) : ?>
						<td><?= ($puskesmas['abs'] != null) ? $puskesmas['abs'] : '-' ?></td>
						<td><?= ($puskesmas['kom'] != null) ? $puskesmas['kom'] : '-' ?></td>
						<?php
						$abs += $puskesmas['abs'];
						$kom += $puskesmas['kom'];
						?>
					<?php endforeach; ?>
					<td><?= $abs ?></td>
					<td><?= $kom ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>

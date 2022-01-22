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
			<th>Jenis Kegiatan</th>
			<th>Sasaran</th>
			<th>Target Capaian</th>
			<th>Jumlah Sasaran</th>
			<th>ABS</th>
			<th>KOM</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($jenis_kegiatan as $jenis) : ?>
			<tr>
				<td><strong><?= $jenis['nama_jenis'] ?></strong></td>
			</tr>
			<?php $kelompok = null ?>
			<?php foreach ($jenis['kegiatan'] as $kegiatan) : ?>
				<?php if ($kelompok != $kegiatan['kelompok_kegiatan']) : ?>
					<tr>
						<td>
							<b><?= $kegiatan['kelompok_kegiatan'] ?></b>
						</td>
					</tr>
					<?php $kelompok = $kegiatan['kelompok_kegiatan'] ?>
				<?php endif; ?>
				<tr>
					<td><?= $kegiatan['nama_kegiatan'] ?></td>
					<td><?= $kegiatan['sasaran'] ?></td>
					<td><?= $kegiatan['pkp']['target_capaian'] ?></td>
					<td><?= $kegiatan['pkp']['jumlah_sasaran'] ?></td>
					<td><?= $kegiatan['abs'] ?></td>
					<td><?= $kegiatan['kom'] ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>

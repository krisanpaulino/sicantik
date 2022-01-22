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
			<th rowspan="2">Nama Pasien</th>
			<th rowspan="2">JK</th>
			<th rowspan="2">Umur</th>
			<th rowspan="2">Tgl Mulai Pengobatan</th>
			<th rowspan="2">Jenis</th>
			<th rowspan="2">Tipe</th>
			<th rowspan="2">Hasil PX HIV</th>
			<th colspan="4">Hasil Pemeriksaan Lab</th>
			<th rowspan="2">Tgl Selesai Berobat</th>
			<th rowspan="2">Status</th>
		</tr>
		<tr>
			<th>Awal</th>
			<th>Bulan Ke-2/3</th>
			<th>Bulan Ke-5/6</th>
			<th>AP</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($data_tbprogram as $data) : ?>
			<tr>
				<td><?= $data['nama_pasien'] ?></td>
				<td><?= $data['jk_pasien'] ?></td>
				<td><?= $data['umur_pasien'] ?></td>
				<td><?= $data['tanggal_mulai'] ?>/<?= $data['bulan_mulai'] ?>/<?= $data['tahun_mulai'] ?></td>
				<td><?= $data['jenis_tb'] ?></td>
				<td><?= $data['tipe_tb'] ?></td>
				<td><?= $data['hasil_hiv'] ?></td>
				<td><?= $data['lab_awal'] ?></td>
				<td><?= $data['lab_2'] ?></td>
				<td><?= $data['lab_3'] ?></td>
				<td><?= $data['lab_ap'] ?></td>
				<td><?= $data['tanggal_selesai'] ?>/<?= $data['bulan_selesai'] ?>/<?= $data['tahun_selesai'] ?></td>
				<td><?= $data['status'] ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

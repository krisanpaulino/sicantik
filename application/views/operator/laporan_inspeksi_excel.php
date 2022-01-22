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
			<th>Sarana</th>
			<th>Jumlah</th>
			<th>%</th>
		</tr>

	</thead>
	<tbody>
		<tr>
			<th>Total Kegiatan Pembinaan :</th>
		</tr>
		<tr>
			<th>Bulan Ini</th>
			<td><?= $inspeksi_sarana['bulan_ini_jumlah'] ?></td>
			<td><?= $inspeksi_sarana['bulan_ini_persen'] ?></td>
		</tr>
		<tr>
			<td>Kumulatif s.d bulan lalu</td>
			<td><?= $inspeksi_sarana['kumulatif_bulan_lalu_jumlah'] ?></td>
			<td><?= $inspeksi_sarana['kumulatif_bulan_lalu_persen'] ?></td>
		</tr>
		<?php foreach ($inspeksi_sarana['jenis_sarana'] as $jenis) : ?>
			<tr>
				<th>
					<h3>Sarana <?= $jenis['nama_jenis'] ?></h3>
				</th>
				<th></th>
				<th></th>
			</tr>
			<?php foreach ($jenis['sarana'] as $sarana) : ?>
				<tr>
					<th><?= $sarana['nama_sarana'] ?></th>
					<td></td>
					<td></td>
				</tr>

				<?php foreach ($sarana['atribut'] as $atribut) : ?>
					<tr>
						<td><?= $atribut['nama_atribut'] ?></td>
						<td><?= $atribut['detail']['jumlah'] ?></td>
						<td><?= $atribut['detail']['persen'] ?> %</td>
					</tr>
				<?php endforeach; ?>

			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>

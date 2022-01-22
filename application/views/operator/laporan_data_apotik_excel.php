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
			<th>Elemen Data</th>
			<th>Jumlah Pemakaian Obat</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($kategori_data as $kategori) : ?>
			<tr>
				<td><b><?= $kategori['nama_kategori'] ?></b></td>
			</tr>
			<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
				<tr>
					<td><?= $elemen['nama_elemen'] ?></td>
					<td><?= $elemen['detail_elemen_data']['jumlah_pemakaian_obat'] ?></td>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>

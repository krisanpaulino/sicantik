<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<table border="1" width="100%">
	<thead>
		<tr>
			<th rowspan="2">Elemen Data</th>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<th><?= $puskesmas['nama_puskesmas'] ?></th>
			<?php endforeach; ?>
		</tr>
		<tr>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<th>Jumlah Pemakaian Obat</th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($kategori_data as $kategori) : ?>
			<tr>
				<th><?= $kategori['nama_kategori'] ?></th>
				<th colspan="<?= count($data_puskesmas) ?>"></th>
			</tr>
			<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
				<tr>
					<td><?= $elemen['nama_elemen'] ?></td>
					<?php foreach ($elemen['puskesmas'] as $puskesmas) : ?>
						<?php if (!empty($puskesmas['detail_elemen_data'])) : ?>
							<td><?= $puskesmas['detail_elemen_data']['jumlah_pemakaian_obat'] ?></td>
						<?php else : ?>
							<td>Blm Isi</td>
						<?php endif; ?>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>
<br>
<table border="1" width="100%">
	<thead>
		<tr>
			<th rowspan="2">Obat</th>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<th colspan="6"><?= $puskesmas['nama_puskesmas'] ?></th>
			<?php endforeach; ?>
		</tr>
		<tr>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<td>Satuan</td>
				<td>Jumlah Pemakaian Obat</td>
				<td>Stok Awal</td>
				<td>Sisa Stok</td>
				<td>Yang diterima</td>
				<td>Ketersediaan</td>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data_obat as $obat) : ?>
			<tr>
				<td><?= $obat['nama_obat'] ?></td>

				<?php foreach ($obat['puskesmas'] as $puskesmas) : ?>
					<td><?= $obat['satuan'] ?></td>
					<?php if (!empty($puskesmas['detail'])) : ?>
						<td><?= $puskesmas['detail']['jumlah_pemakaian_obat'] ?></td>
						<td><?= $puskesmas['detail']['stok_awal'] ?></td>
						<td><?= $puskesmas['detail']['sisa_stok'] ?></td>
						<td><?= $puskesmas['detail']['diterima'] ?></td>
						<td><?= $puskesmas['detail']['ketersediaan'] ?></td>
					<?php else : ?>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					<?php endif; ?>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

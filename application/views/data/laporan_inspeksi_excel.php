<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$judul.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>
<h2><?= $judul ?></h2>
<table border="1" width="100%">
	<thead>
		<tr>
			<th rowspan="2">Sarana</th>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<th colspan="2"><?= $puskesmas['nama_puskesmas'] ?></th>
			<?php endforeach; ?>
		</tr>
		<tr>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<th>Jumlah</th>
				<th>%</th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th>Total Kegiatan Pembinaan :</th>
			<th colspan="<?= count($data_puskesmas) * 2 ?>"></th>
		</tr>
		<tr>
			<th>Bulan Ini</th>
			<?php foreach ($inspeksi_sarana['puskesmas'] as $puskesmas) : ?>
				<?php if ($puskesmas['inspeksi'] != null) : ?>
					<td><?= $puskesmas['inspeksi']['bulan_ini_jumlah'] ?></td>
					<td><?= $puskesmas['inspeksi']['bulan_ini_persen'] ?></td>
				<?php else : ?>
					<td>Blm Isi</td>
					<td>Blm Isi</td>
				<?php endif; ?>
			<?php endforeach; ?>
		</tr>
		<tr>
			<td>Kumulatif s.d bulan lalu</td>
			<?php foreach ($inspeksi_sarana['puskesmas'] as $puskesmas) : ?>
				<?php if ($puskesmas['inspeksi'] != null) : ?>
					<td><?= $puskesmas['inspeksi']['kumulatif_bulan_lalu_jumlah'] ?></td>
					<td><?= $puskesmas['inspeksi']['kumulatif_bulan_lalu_persen'] ?></td>
				<?php else : ?>
					<td>Blm Isi</td>
					<td>Blm Isi</td>
				<?php endif; ?>
			<?php endforeach; ?>
		</tr>
		<?php foreach ($inspeksi_sarana['jenis_sarana'] as $jenis) : ?>
			<tr>
				<th>
					<h3>Sarana<?= $jenis['nama_jenis'] ?></h3>
				</th>
				<th colspan="<?= count($data_puskesmas) * 2 ?>"></th>

			</tr>
			<?php foreach ($jenis['sarana'] as $sarana) : ?>
				<tr>
					<th><?= $sarana['nama_sarana'] ?></th>
					<th colspan="<?= count($data_puskesmas) * 2 ?>"></th>
				</tr>

				<?php foreach ($sarana['atribut'] as $atribut) : ?>
					<tr>
						<td><?= $atribut['nama_atribut'] ?></td>
						<?php foreach ($atribut['puskesmas'] as $puskesmas) : ?>
							<?php if ($puskesmas['detail'] != null) : ?>
								<td><?= $puskesmas['detail']['jumlah'] ?></td>
								<td><?= $puskesmas['detail']['persen'] ?> %</td>
							<?php else : ?>
								<td>Blm Isi</td>
								<td>Blm Isi</td>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>

			<?php endforeach; ?>
		<?php endforeach; ?>
	</tbody>
</table>

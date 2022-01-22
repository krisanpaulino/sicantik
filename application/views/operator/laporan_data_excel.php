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
			<?php foreach ($atribut_data as $atribut) : ?>
				<th><?= $atribut['nama_atribut'] ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1 ?>
		<?php foreach ($kategori_data as $kategori) : ?>
			<?php if ($i == 2) : ?>
				<?php if ($detail_turunan != null) : ?>
					<?php foreach ($detail_turunan as $turunan) : ?>
						<?php if ($turunan['punya_elemen_data'] == 1) : ?>
							<tr>
								<td><b><?= $turunan['nama_data'] ?></b></td>
							</tr>
							<?php foreach ($turunan['kategori_data'] as $ktg) : ?>
								<?php foreach ($ktg['elemen_data'] as $el) : ?>
									<tr>
										<td><?= $el['nama_elemen_data'] ?></td>
										<?php foreach ($el['detail_elemen_data'] as $det) : ?>
											<td><?= $det['jumlah'] ?></td>
										<?php endforeach; ?>
									</tr>
								<?php endforeach; ?>
							<?php endforeach; ?>
						<?php endif; ?>


						<?php if ($turunan['is_stp'] == 1 || $turunan['punya_elemen_usia'] == 1) : ?>
							<tr>
								<td><b><?= $turunan['nama_data'] ?></b></td>
							</tr>
							<?php foreach ($turunan['elemen_usia'] as $usia) : ?>
								<tr>
									<td>'<?= $usia['rentang_usia'] ?></td>
									<?php foreach ($usia['detail_elemen_usia'] as $detail) : ?>
										<td><?= $detail['jumlah'] ?></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			<?php endif; ?>
			<tr>
				<th class="bg-primary"><?= $kategori['nama_kategori'] ?></th>
			</tr>
			<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
				<tr>
					<td><?= $elemen['nama_elemen_data'] ?></td>
					<?php foreach ($elemen['detail_elemen_data'] as $detail) : ?>
						<td><?= $detail['jumlah'] ?></td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			<?php $i++; ?>

		<?php endforeach; ?>
	</tbody>
</table>

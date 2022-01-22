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
			<th rowspan="2">Elemen Data</th>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<th colspan="2"><?= $puskesmas['nama_puskesmas'] ?></th>
			<?php endforeach; ?>
		</tr>
		<tr>
			<?php foreach ($data_puskesmas as $puskesmas) : ?>
				<?php foreach ($atribut_data as $atribut) : ?>
					<th><?= $atribut['nama_atribut'] ?></th>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php $i = 1; ?>
		<?php foreach ($kategori_data as $kategori) : ?>
			<?php if ($i == 2) : ?>
				<?php foreach ($detail_turunan as $turunan) : ?>
					<?php if ($turunan['punya_elemen_data'] == 1) : ?>

						<?php foreach ($turunan['kategori_data'] as $_kategori) : ?>
							<tr>
								<th><?= $turunan['nama_data'] ?></th>
							</tr>

							<?php foreach ($_kategori['elemen_data'] as $elemen) : ?>
								<tr>
									<td><?= $elemen['nama_elemen_data'] ?></td>
									<?php foreach ($elemen['puskesmas'] as $puskesmas) : ?>
										<?php if (!empty($puskesmas['detail_elemen_data'])) : ?>
											<?php foreach ($puskesmas['detail_elemen_data'] as $detail) : ?>
												<td><?= $detail['jumlah'] ?></td>
											<?php endforeach; ?>
										<?php else : ?>
											<?php foreach ($atribut_data as $atribut) : ?>
												<td>-</td>
											<?php endforeach; ?>
										<?php endif; ?>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>

						<?php endforeach; ?>

					<?php endif; ?>

					<?php if ($turunan['punya_elemen_usia'] == 1 || $turunan['is_stp'] == 1) : ?>
						<tr>
							<th><?= $turunan['nama_data'] ?></th>
						</tr>
						<?php foreach ($turunan['elemen_usia'] as $usia) : ?>
							<tr>
								<td><?= $usia['rentang_usia'] ?></td>
								<?php foreach ($usia['puskesmas'] as $puskesmas) : ?>
									<?php if (!empty($puskesmas['detail_elemen_usia'])) : ?>
										<?php foreach ($puskesmas['detail_elemen_usia'] as $detail) : ?>
											<td><?= $detail['jumlah'] ?></td>
										<?php endforeach; ?>
									<?php else : ?>
										<?php foreach ($atribut_data as $atribut) : ?>
											<td>-</td>
										<?php endforeach; ?>
									<?php endif; ?>
								<?php endforeach; ?>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>

			<tr>
				<th><?= $kategori['nama_kategori'] ?></th>
			</tr>
			<?php foreach ($kategori['elemen_data'] as $elemen) : ?>
				<tr>
					<td><?= $elemen['nama_elemen_data'] ?></td>
					<?php foreach ($elemen['puskesmas'] as $puskesmas) : ?>
						<?php if (!empty($puskesmas['detail_elemen_data'])) : ?>
							<?php foreach ($puskesmas['detail_elemen_data'] as $detail) : ?>
								<td><?= $detail['jumlah'] ?></td>
							<?php endforeach; ?>
						<?php else : ?>
							<?php foreach ($atribut_data as $atribut) : ?>
								<td>-</td>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			<?php $i++; ?>
		<?php endforeach; ?>
	</tbody>
</table>

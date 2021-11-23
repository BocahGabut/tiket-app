<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo base_url('assets/') ?>css/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/') ?>css/custom.css" rel="stylesheet" type="text/css" />

</head>

<body id="app">
	<div class="table-responsive mt-30">
		<?php
		if (isset($_GET['data'])) {
			switch ($_GET['data']) {
				case 'airlines':
		?>
					<table class="table mb-0">
						<thead>
							<tr>
								<th>Thumbnail</th>
								<th>Name</th>
								<th>3-Digit-Code</th>
								<th>Country</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($data->result() as $dt) {
							?>
								<tr>
									<td>
										<img style="width: 75px;" src="<?= base_url() . 'assets/image/' . $dt->thumb ?>" alt="thumbnail">
										<span style="display: none;"><?= base_url() . 'assets/image/' . $dt->thumb ?></span>
									</td>
									<td><?= $dt->airlines ?></td>
									<td><?= $dt->digit_code ?></td>
									<td><?= $dt->country ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				<?php
					break;
				case 'airports':
				?>
					<table class="table mb-0">
						<thead>
							<tr>
								<th width="10px">#</th>
								<th width="10px">Codes</th>
								<th width="10px">Name</th>
								<th width="10px">Citycode</th>
								<th width="10px">Cityname</th>
								<th width="10px">Countrycode</th>
								<th width="10px">Countryname</th>
								<th width="10px">Timezone</th>
								<th width="10px">Lat</th>
								<th width="10px">Lon</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($data->result() as $dt) {
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $dt->code ?></td>
									<td><?= $dt->airports ?></td>
									<td><?= $dt->citycode ?></td>
									<td><?= $dt->cityname ?></td>
									<td><?= $dt->countrycode ?></td>
									<td><?= $dt->countryname ?></td>
									<td><?= $dt->timezone ?></td>
									<td><?= $dt->lat ?></td>
									<td><?= $dt->lon ?></td>
								</tr>
							<?php
								$no++;
							}
							?>
						</tbody>
					</table>
		<?php
					break;
			}
		}
		?>
	</div>
</body>
<script src="<?php echo base_url('assets/') ?>js/print.min.js"></script>
<script>
	window.print()
	window.onafterprint = _ => {
		window.history.back()
	}
</script>

</html>

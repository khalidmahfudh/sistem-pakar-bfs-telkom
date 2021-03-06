<!-- Begin Page Content -->

<!-- Page Heading -->

<?php


for ($i = 0; $i < count($questions); $i++) {
	$theQuestions[$i] = array_slice($questions[$i], 3);
}

for ($i = 0; $i < count($questions); $i++) {
	$allGejala[$i] = array_chunk($theQuestions[$i], 2);
}

for ($i = 0; $i < count($theQuestions); $i++) {
	$countChance[$i] = $cfc[$i];
}

$i = 0;
foreach ($results as $result) {
	$theGangguans[$i++] = $result;
}

?>


<nav class="title">
	<h1 class="h3 mb-4 text-gray-800 text-center">Hasil Diagnosa <?= $title; ?></h1>
</nav>

<div class="container">

	<?php for ($i = 0; $i < count($countChance); $i++) : ?>

		<input type="hidden" name="kemungkinan<?= $i; ?>" value="<?= $cfc[$i]; ?>" class="kemungkinan">
		<input type="hidden" name="gangguanNames<?= $i; ?>" value="<?= $questions[$i][0]; ?>" class="gangguanNames">

	<?php endfor; ?>

	<!-- Donut Chart -->
	<div class="row">
		<div class="col-lg">
			<div class="card shadow mb-4 cardChart">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="row">
						<div class="col-md">
							<div class="card border-primary">
								<div class="card-body text-center bodyChart text-light">
									<div class="chart-pie py-4" style="height: 400px !important;">
										<canvas id="myPieChart"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<?php $i = 0;
						$borderColors = ['#4e73df', '#1cc88a', '#36b9cc', '#858796']; ?>
						<?php foreach ($questions as $question) : ?>
							<div class="col-sm-4 ">

								<?php if ($cfc[$i] >= 50) : ?>
									<div class="card percentageCard text-gray-900 overflow-auto border-dark" style="border-left: solid 5px <?= $borderColors[$i] ?> !important; height: 300px;">
									<?php else : ?>
										<div class="card percentageCard overflow-auto border-dark" style="border-left: solid 5px <?= $borderColors[$i] ?> !important; height: 300px;">
										<?php endif; ?>
										<div class="card-body text-center">
											<h5 class="card-title"><?= $question[0]; ?></h5>
											<p class="card-text"><?= $cfc[$i++] ?>%</p>
											<p class="card-text">SOLUSI<br><?= $question[2]; ?></p>
										</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
					</div>
					<a href="<?= base_url('konsultasitelepon/diagnosa');  ?>" class=" btn btn-danger btn-lg text-light mb-4 mx-auto"><i class="fas fa-stethoscope"></i> DIAGNOSA KEMBALI</a>
				</div>
			</div>
		</div>

	</div>
	<!-- End of Main Content -->
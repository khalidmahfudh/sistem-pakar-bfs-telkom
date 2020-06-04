<!-- Begin Page Content -->

<!-- Page Heading -->

<?php  


for ($i=0; $i < count($questions); $i++) { 
	$theQuestions[$i] = array_slice($questions[$i],3);
}

for ($i=0; $i < count($questions); $i++) { 
	$allGejala[$i] = array_chunk($theQuestions[$i], 2);
}


$i=0;
foreach ($theQuestions as $que) {
	$theQue[$i] = array_slice($que, 2);
	$i++;
}

for ($i=0; $i < count($theQuestions); $i++) { 
	$countChance[$i] = 0;
}


$i=0;
foreach ($results as $result) {
	$theGangguans[$i++] = explode('-', $result);
}

$i = 1;
foreach ($theGangguans as $tg) {
	switch ($tg[0]) {
		case 1:
		$countChance[0]++;
		break;
		case 2:
		$countChance[1]++;
		break;
		case 3:
		$countChance[2]++;
		break;
		case 4:
		$countChance[3]++;
		break;
	}
}


for ($i=0; $i < count($countChance); $i++) { 
	if (count($countChance) == 1) {
		$percentage[$i] = round(( 100 / count($allGejala[0]) ) * array_sum($countChance));
	} else {
		$percentage[$i] = round(( 100 / array_sum($countChance) ) * $countChance[$i]);
	}
}

?>


<nav class="title">
	<h1 class="h3 mb-4 text-gray-800 text-center">Hasil Diagnosa <?= $title; ?></h1>
</nav>

<div class="container">

	<?php for ($i=0; $i < count($countChance); $i++) : ?> 

		<input type="hidden" name="kemungkinan<?= $i; ?>" value="<?= $percentage[$i]; ?>" class="kemungkinan"> 
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
						<?php $i=0; $borderColors = ['#4e73df','#1cc88a','#36b9cc','#858796']; ?>
						<?php foreach ($questions as $question) : ?>
							<div class="col-sm-4 ">

								<?php if ($percentage[$i] >= 50) : ?>
									<div class="card percentageCard text-gray-900 overflow-auto border-dark" style="border-left: solid 5px <?= $borderColors[$i] ?> !important; height: 300px;">
										<?php else : ?> 
											<div class="card percentageCard overflow-auto border-dark" style="border-left: solid 5px <?= $borderColors[$i] ?> !important; height: 300px;">
											<?php endif; ?>
											<div class="card-body text-center">
												<h5 class="card-title"><?= $question[0]; ?></h5>
												<p class="card-text"><?= $percentage[$i++] ?>%</p>
												<p class="card-text">SOLUSI<br><?= $question[2]; ?></p>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
								<?php if ( count($percentage) == 1 && count($allGejala[0]) != array_sum($countChance) ) : ?>
								<div class="col-sm-4">
									<?php if ($percentage[0] <= 50) : ?>
										<div class="card percentageCard text-gray-900" style="border-left: solid 5px <?= $borderColors[1] ?>; height: 300px;">
											<?php else : ?> 
												<div class="card percentageCard" style="border-left: solid 5px <?= $borderColors[1] ?>; height: 300px;">
												<?php endif; ?>
												<div class="card-body text-center">
													<h5 class="card-title">Unknown</h5>
													<p class="card-text"><?= 100 - $percentage[0] ?>%</p>
													<p class="card-text">SOLUSI<br>Dilakukannya Pengecekan Lebih Mendalam Atau Menghubungi Rekan</p>
												</div>
											</div>
										</div>
								<?php endif; ?>
									
							</div>
						</div>
						<a href="<?= base_url('konsultasiuseetv/diagnosa/first');  ?>" class=" btn btn-danger btn-lg text-light mb-4 mx-auto"><i class="fas fa-stethoscope"></i> DIAGNOSA KEMBALI</a>
					</div>
				</div>
			</div>

		</div>
		<!-- End of Main Content -->


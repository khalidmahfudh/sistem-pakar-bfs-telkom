<!-- Begin Page Content -->

<!-- Page Heading -->


<nav class="title">
	<h1 class="h3 mb-4 text-gray-800 text-center">Hasil Diagnosa <?= $title; ?></h1>
</nav>

<div class="container">

	<input type="hidden" name="kemungkinan0" value="0" class="kemungkinan">
	<input type="hidden" name="gangguanNames0" value="-" class="gangguanNames">

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
						<div class="col-sm-4">
							<div class="card percentageCard my-3 text-gray-900 fade-in" style="border-left: solid 5px #1cc88a; height: 300px;">
								<div class="card-body text-center">
									<h5 class="card-title">Unknown (Tidak diketahui)</h5>
									<p class="card-text">100%</p>
									<p class="card-text">SOLUSI<br>Menunggu, masih dilakukan pengecekan mendalam</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<a href="<?= base_url('konsultasiuseetv/diagnosa');  ?>" class=" btn btn-danger btn-lg text-light mb-4 mx-auto"><i class="fas fa-stethoscope"></i> DIAGNOSA KEMBALI</a>
			</div>
		</div>
	</div>
</div>

</div>
<!-- End of Main Content -->
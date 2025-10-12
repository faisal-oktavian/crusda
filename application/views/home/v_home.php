<style>
	.centered {
		/* width: ; */
		float: none;
		margin: 20px auto;
	}

	.dropdown-menu {
		padding: 10px;
	}

	.setting-btn {
		background-color: #f2f2f2;
		padding: 5px 10px;
		border-radius: 6px;
		border: 2px #87ceeb solid;
		display: flex;
		align-items: center;
		/* justify-content: space-between; */
	}

	.setting-btn span {
		margin-left: 10px;
		color: gray;
	}

	/* .dropdown-child a:hover {
		color: #232323 !important;
		background: #f3f3f3 !important;
	} */

	.chart-box {
		border-bottom: 5px dashed #f5f5f5;
	}

	.title-chart {
		font-weight: bold;
		padding-bottom: 5px;
	}

	.h3-not-found {
		text-align: center;
		/* height: fit-content; */
		margin: 100px;
		color: #dadada;
		display: flex;
		/* flex-wrap: ; */
		justify-content: center;
	}

	.dropdown-label {
		margin-right: 10px;
	}

	/* table tr{
		margin-bottom: 2px;
	} */
	.progress {
        width: 100%;
        background-color: #f3f3f3;
        border-radius: 5px;
        overflow: hidden;
    }
    .progress-bar {
        height: 20px;
        background-color: #4caf50;
        text-align: center;
        color: white;
    }
</style>
<?php
	if (aznav('role_table')) {
?>		
		<!-- grafik realisasi anggaran & grafik potensi sisa anggaran -->
		<div class="row" style="margin-top:30px;">
			<div class="col-md-6 col-xs-12" style="margin:auto;">
				<div class="card shadow" style="border-radius:16px; border:1px solid #e0e0e0; padding:24px 18px 18px 18px; background:#fff;">
					<div class="d-flex align-items-center" style="margin-bottom:18px;">
						<i class="fa fa-pie-chart" style="font-size:26px;color:#4caf50;margin-right:10px;"></i>
						<span class="title-chart" style="font-size:20px;">Grafik Realisasi Anggaran Tahun <?php echo $tahun_ini; ?></span>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6" style="display:flex;align-items:center;justify-content:center;">
							<canvas id="pieAnggaranChart" width="180" height="180"></canvas>
						</div>
						<div class="col-xs-12 col-md-6" style="display:flex;flex-direction:column;justify-content:center;">
							<div class="mb-3" style="background:#f6f6f6;border-radius:8px;padding:12px 14px;margin-bottom:10px;display:flex;align-items:center;">
								<span style="display:inline-block;width:18px;height:18px;background:#4caf50;margin-right:10px;border-radius:4px;"></span>
								<div>
									<div style="font-weight:600;">Sudah Dibayar</div>
									<div id="label-sudah-dibayar" style="font-size:15px;"></div>
								</div>
							</div>
							<div class="mb-3" style="background:#f6f6f6;border-radius:8px;padding:12px 14px;margin-bottom:10px;display:flex;align-items:center;">
								<span style="display:inline-block;width:18px;height:18px;background:#ff9800;margin-right:10px;border-radius:4px;"></span>
								<div>
									<div style="font-weight:600;">Proses Verifikasi</div>
									<div id="label-belum-dibayar" style="font-size:15px;"></div>
								</div>
							</div>
							<div class="mb-3" style="background:#f6f6f6;border-radius:8px;padding:12px 14px;display:flex;align-items:center;">
								<span style="display:inline-block;width:18px;height:18px;background:#f44336;margin-right:10px;border-radius:4px;"></span>
								<div>
									<div style="font-weight:600;">Belum Direalisasi</div>
									<div id="label-belum-direalisasi" style="font-size:15px;"></div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xs-12" style="margin:auto;">
				<div class="card shadow" style="border-radius:16px; border:1px solid #e0e0e0; padding:24px 18px 18px 18px; background:#fff;">
					<div class="d-flex align-items-center" style="margin-bottom:18px;">
						<span class="title-chart" style="font-size:22px;font-weight:700;color:#263238;">Potensi Sisa Anggaran Tahun <?php echo $tahun_ini; ?></span>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6" style="display:flex;align-items:center;justify-content:center;">
							<canvas id="piePotensiSisaChart" width="180" height="180"></canvas>
						</div>
						<div class="col-xs-12 col-md-6" style="display:flex;flex-direction:column;justify-content:center;">
							<div class="mb-3" style="background:#f6f6f6;border-radius:10px;padding:14px 16px;margin-bottom:12px;display:flex;align-items:center;">
								<span style="display:inline-block;width:22px;height:22px;background:#c500ff;margin-right:14px;border-radius:5px;"></span>
								<div>
									<div style="font-weight:700;color:#263238;">Total Anggaran</div>
									<div id="label-total-anggaran-sisa" style="font-size:17px;color:#263238;"></div>
								</div>
							</div>
							<div class="mb-3" style="background:#f6f6f6;border-radius:10px;padding:14px 16px;margin-bottom:12px;display:flex;align-items:center;">
								<span style="display:inline-block;width:22px;height:22px;background:#2196f3;margin-right:14px;border-radius:5px;"></span>
								<div>
									<div style="font-weight:700;color:#263238;">Realisasi Anggaran</div>
									<div id="label-realisasi-anggaran-sisa" style="font-size:17px;color:#263238;"></div>
								</div>
							</div>
							<div class="mb-3" style="background:#f6f6f6;border-radius:10px;padding:14px 16px;display:flex;align-items:center;">
								<span style="display:inline-block;width:22px;height:22px;background:#c3c3c3;margin-right:14px;border-radius:5px;"></span>
								<div>
									<div style="font-weight:700;color:#263238;">Sisa Anggaran</div>
									<div id="label-sisa-anggaran-sisa" style="font-size:17px;color:#263238;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- CDN Chart.js -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

		<!-- grafik realisasi anggaran -->
		<script>
			// Contoh data, silakan ganti dengan data dari backend PHP
			// var nominal_sudah_dibayar = 50000000;
			// var nominal_belum_dibayar = 30000000;
			// var nominal_belum_direalisasi = 20000000;
			var nominal_sudah_dibayar = <?php echo isset($sudah_dibayar) ? $sudah_dibayar : 0; ?>;
			var nominal_belum_dibayar = <?php echo isset($belum_dibayar) ? $belum_dibayar : 0; ?>;
			var nominal_belum_direalisasi = <?php echo isset($belum_direalisasi) ? $belum_direalisasi : 0; ?>;

			var total = nominal_sudah_dibayar + nominal_belum_dibayar + nominal_belum_direalisasi;
			// var total = <?php echo isset($total_anggaran_tahun_ini) ? $total_anggaran_tahun_ini : 0; ?>;

			var persen_sudah_dibayar = total ? Math.round(nominal_sudah_dibayar / total * 100) : 0;
			var persen_belum_dibayar = total ? Math.round(nominal_belum_dibayar / total * 100) : 0;
			var persen_belum_direalisasi = total ? 100 - persen_sudah_dibayar - persen_belum_dibayar : 0;

			function formatRupiah(angka) {
				return 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}

			document.getElementById('label-sudah-dibayar').innerText = persen_sudah_dibayar + '% (' + formatRupiah(nominal_sudah_dibayar) + ')';
			document.getElementById('label-belum-dibayar').innerText = persen_belum_dibayar + '% (' + formatRupiah(nominal_belum_dibayar) + ')';
			document.getElementById('label-belum-direalisasi').innerText = persen_belum_direalisasi + '% (' + formatRupiah(nominal_belum_direalisasi) + ')';

			var ctx = document.getElementById('pieAnggaranChart').getContext('2d');
			var pieAnggaranChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: [
						'Sudah Dibayar',
						'Belum Dibayar',
						'Belum Direalisasi'
					],
					datasets: [{
						data: [
							nominal_sudah_dibayar,
							nominal_belum_dibayar,
							nominal_belum_direalisasi
						],
						backgroundColor: [
							'#4caf50',
							'#ff9800',
							'#f44336'
						],
						borderWidth: 2,
						borderColor: '#fff',
						hoverOffset: 8
					}]
				},
				options: {
					cutout: '65%',
					plugins: {
						legend: {
							display: false
						},
						tooltip: {
							callbacks: {
								label: function(context) {
									var label = context.label || '';
									var value = context.raw || 0;
									var percent = total ? Math.round(value / total * 100) : 0;
									return label + ': ' + percent + '% (' + formatRupiah(value) + ')';
								}
							}
						}
					}
				}
			});

			// Tambahkan event click pada chart Realisasi Anggaran
			document.getElementById('pieAnggaranChart').onclick = function(evt) {
				var activePoints = pieAnggaranChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
				if (activePoints.length > 0) {
					var idx = activePoints[0].index;
					// Tentukan link berdasarkan index
					if (idx === 0) {
						window.open('<?= site_url("realisasi_anggaran_detail/sudah_dibayar") ?>', '_blank');
					} else if (idx === 1) {
						window.open('<?= site_url("realisasi_anggaran_detail/belum_dibayar") ?>', '_blank');
					} else if (idx === 2) {
						window.open('<?= site_url("realisasi_anggaran_detail/belum_direalisasi") ?>', '_blank');
					}
				}
			};
		</script>

		<!-- grafik potensi sisa anggaran -->
		<script>
			// Data dummy, silakan ganti dengan data backend jika perlu
			// var realisasi_anggaran_tahun_ini = <?php echo isset($total_realisasi_tahun_ini) ? $total_realisasi_tahun_ini : 0; ?>;
			// var realisasi_anggaran_tahun_ini = 10000000000; // TODO: ganti dengan data realisasi dari backend jika perlu
			var total_anggaran_tahun_ini = <?php echo isset($total_anggaran_tahun_ini) ? $total_anggaran_tahun_ini : 0; ?>;
			var realisasi_anggaran_tahun_ini = <?php echo isset($realisasi_anggaran_tahun_ini) ? $realisasi_anggaran_tahun_ini : 0; ?>;
			
			var sisa_anggaran_tahun_ini = total_anggaran_tahun_ini - realisasi_anggaran_tahun_ini;

			var persen_realisasi = total_anggaran_tahun_ini ? Math.round(realisasi_anggaran_tahun_ini / total_anggaran_tahun_ini * 100) : 0;
			var persen_sisa = total_anggaran_tahun_ini ? 100 - persen_realisasi : 0;

			function formatRupiah(angka) {
				return 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}

			// Label
			document.getElementById('label-total-anggaran-sisa').innerText = formatRupiah(total_anggaran_tahun_ini);
			document.getElementById('label-realisasi-anggaran-sisa').innerText = persen_realisasi + '% (' + formatRupiah(realisasi_anggaran_tahun_ini) + ')';
			document.getElementById('label-sisa-anggaran-sisa').innerText = persen_sisa + '% (' + formatRupiah(sisa_anggaran_tahun_ini) + ')';

			// Pie chart: hanya tampilkan realisasi dan sisa (total anggaran = 100%)
			var ctxPotensi = document.getElementById('piePotensiSisaChart').getContext('2d');
			var piePotensiSisaChart = new Chart(ctxPotensi, {
				type: 'doughnut',
				data: {
					labels: [
						'Realisasi Anggaran',
						'Sisa Anggaran'
					],
					datasets: [{
						data: [
							realisasi_anggaran_tahun_ini,
							sisa_anggaran_tahun_ini
						],
						backgroundColor: [
							'#2196f3', // Biru untuk Realisasi Anggaran
							'#c3c3c3'  // Abu-abu untuk Sisa Anggaran
						],
						borderWidth: 2,
						borderColor: '#fff',
						hoverOffset: 8
					}]
				},
				options: {
					cutout: '65%',
					plugins: {
						legend: {
							display: false
						},
						tooltip: {
							callbacks: {
								label: function(context) {
									var label = context.label || '';
									var value = context.raw || 0;
									var percent = total_anggaran_tahun_ini ? Math.round(value / total_anggaran_tahun_ini * 100) : 0;
									return label + ': ' + percent + '% (' + formatRupiah(value) + ')';
								}
							}
						}
					}
				}
			});

			// Tambahkan event click pada chart Potensi Sisa Anggaran
			// document.getElementById('piePotensiSisaChart').onclick = function(evt) {
			// 	var activePoints = piePotensiSisaChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
			// 	if (activePoints.length > 0) {
			// 		var idx = activePoints[0].index;
			// 		// Tentukan link berdasarkan index
			// 		if (idx === 0) {
			// 			window.open('<?= site_url("realisasi_anggaran_detail/sudah_dibayar") ?>', '_blank');
			// 		} else if (idx === 1) {
			// 			window.open('<?= site_url("realisasi_anggaran_detail/potensi_sisa_anggaran") ?>', '_blank');
			// 		}
			// 	}
			// };
		</script>



		<!-- grafik Sisa Anggaran per Sumber Dana per Tahun & grafik Realisasi Anggaran per Sumber Dana -->
		<div class="row" style="margin-top:30px;">
			<div class="col-md-6 col-xs-12" style="margin:auto;">
				<div class="card shadow" style="border-radius:16px; border:1px solid #e0e0e0; padding:24px 18px 18px 18px; background:#fff;">
					<div class="d-flex align-items-center" style="margin-bottom:18px;">
						<span class="title-chart" style="font-size:22px;font-weight:700;color:#263238;">Realisasi Anggaran per Sumber Dana Tahun <?php echo $tahun_ini; ?></span>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6" style="display:flex;align-items:center;justify-content:center;">
							<canvas id="pieRealisasiSumberDanaChart" width="180" height="180"></canvas>
						</div>
						<div class="col-xs-12 col-md-6" style="display:flex;flex-direction:column;justify-content:center;">
							<div class="mb-3" style="background:#f6f6f6;border-radius:10px;padding:14px 16px;margin-bottom:12px;display:flex;align-items:center;">
								<span style="display:inline-block;width:22px;height:22px;background:#2196f3;margin-right:14px;border-radius:5px;"></span>
								<div>
									<div style="font-weight:700;color:#263238;">DBH Cukai Hasil Tembakau (CHT)</div>
									<div id="label-realisasi-dbh" style="font-size:17px;color:#263238;"></div>
								</div>
							</div>
							<div class="mb-3" style="background:#f6f6f6;border-radius:10px;padding:14px 16px;display:flex;align-items:center;">
								<span style="display:inline-block;width:22px;height:22px;background:#c500ff;margin-right:14px;border-radius:5px;"></span>
								<div>
									<div style="font-weight:700;color:#263238;">Pendapatan dari BLUD</div>
									<div id="label-realisasi-blud" style="font-size:17px;color:#263238;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xs-12" style="margin:auto;">
				<!-- <div class="card shadow" style="border-radius:16px; border:1px solid #e0e0e0; padding:24px 18px 18px 18px; background:#fff;">
					<div class="d-flex align-items-center" style="margin-bottom:18px;">
						<i class="fa fa-pie-chart" style="font-size:26px;color:#4caf50;margin-right:10px;"></i>
						<span class="title-chart" style="font-size:20px;">Grafik Sisa Anggaran per Sumber Dana Tahun <?php echo $tahun_ini; ?></span>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-6" style="display:flex;align-items:center;justify-content:center;">
							<canvas id="pieSisaSumberDanaChart" width="180" height="180"></canvas>
						</div>
						<div class="col-xs-12 col-md-6" style="display:flex;flex-direction:column;justify-content:center;">
							<div class="mb-3" style="background:#f6f6f6;border-radius:10px;padding:14px 16px;margin-bottom:12px;display:flex;align-items:center;">
								<span style="display:inline-block;width:22px;height:22px;background:#ff9800;margin-right:14px;border-radius:5px;"></span>
								<div>
									<div style="font-weight:700;color:#263238;">Sisa Anggaran</div>
									<div id="label-sisa-anggaran" style="font-size:17px;color:#263238;"></div>
								</div>
							</div>
							<div class="mb-3" style="background:#f6f6f6;border-radius:10px;padding:14px 16px;margin-bottom:12px;display:flex;align-items:center;">
								<span style="display:inline-block;width:22px;height:22px;background:#2196f3;margin-right:14px;border-radius:5px;"></span>
								<div>
									<div style="font-weight:700;color:#263238;">DBH Cukai Hasil Tembakau (CHT)</div>
									<div id="label-sisa-dbh" style="font-size:17px;color:#263238;"></div>
								</div>
							</div>
							<div class="mb-3" style="background:#f6f6f6;border-radius:10px;padding:14px 16px;display:flex;align-items:center;">
								<span style="display:inline-block;width:22px;height:22px;background:#c500ff;margin-right:14px;border-radius:5px;"></span>
								<div>
									<div style="font-weight:700;color:#263238;">Pendapatan dari BLUD</div>
									<div id="label-sisa-blud" style="font-size:17px;color:#263238;"></div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>

		<!-- grafik Realisasi Anggaran per Sumber Dana -->
		<script>
			// Dummy data realisasi per sumber dana (hanya DBH CHT & BLUD)
			// var realisasi_dbh = 21000000000;
			// var realisasi_blud = 9000000000;

			var realisasi_dbh = <?php echo isset($dbh) ? $dbh : 0; ?>;
			var realisasi_blud = <?php echo isset($blud) ? $blud : 0; ?>;
			var total_realisasi = realisasi_dbh + realisasi_blud;

			document.getElementById('label-realisasi-dbh').innerText = Math.round(realisasi_dbh / total_realisasi * 100) + '% (' + formatRupiah(realisasi_dbh) + ')';
			document.getElementById('label-realisasi-blud').innerText = Math.round(realisasi_blud / total_realisasi * 100) + '% (' + formatRupiah(realisasi_blud) + ')';

			var ctxRealisasiSumberDana = document.getElementById('pieRealisasiSumberDanaChart').getContext('2d');
			var pieRealisasiSumberDanaChart = new Chart(ctxRealisasiSumberDana, {
				type: 'doughnut',
				data: {
					labels: ['DBH Cukai Hasil Tembakau (CHT)', 'Pendapatan dari BLUD'],
					datasets: [{
						data: [realisasi_dbh, realisasi_blud],
						backgroundColor: [
							'#2196f3', // DBH CHT
							'#c500ff'  // BLUD
						],
						borderWidth: 2,
						borderColor: '#fff',
						hoverOffset: 8
					}]
				},
				options: {
					cutout: '65%',
					plugins: {
						legend: {
							display: false
						},
						tooltip: {
							callbacks: {
								label: function(context) {
									var label = context.label || '';
									var value = context.raw || 0;
									var percent = total_realisasi ? Math.round(value / total_realisasi * 100) : 0;
									return label + ': ' + percent + '% (' + formatRupiah(value) + ')';
								}
							}
						}
					}
				}
			});

			// Event click pada chart Realisasi Anggaran per Sumber Dana
			document.getElementById('pieRealisasiSumberDanaChart').onclick = function(evt) {
				var activePoints = pieRealisasiSumberDanaChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
				if (activePoints.length > 0) {
					var idx = activePoints[0].index;
					// 0: DBH, 1: BLUD
					if (idx === 0) {
						window.open('<?= site_url("realisasi_anggaran_detail/dbh") ?>', '_blank');
					} else if (idx === 1) {
						window.open('<?= site_url("realisasi_anggaran_detail/blud") ?>', '_blank');
					}
				}
			};
		</script>
		
		<!-- grafik Sisa Anggaran per Sumber Dana per Tahun -->
		<!-- <script>
			var sisa_anggaran = sisa_anggaran_tahun_ini;
			var sisa_dbh = <?php echo isset($dbh) ? $dbh : 0; ?>;
			var sisa_blud = <?php echo isset($blud) ? $blud : 0; ?>;
			var total_sisa = sisa_anggaran + sisa_dbh + sisa_blud;

			function formatRupiah(angka) {
				return 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}

			document.getElementById('label-sisa-anggaran').innerText = Math.round(sisa_anggaran / total_sisa * 100) + '% (' + formatRupiah(sisa_anggaran) + ')';
			document.getElementById('label-sisa-dbh').innerText = Math.round(sisa_dbh / total_sisa * 100) + '% (' + formatRupiah(sisa_dbh) + ')';
			document.getElementById('label-sisa-blud').innerText = Math.round(sisa_blud / total_sisa * 100) + '% (' + formatRupiah(sisa_blud) + ')';

			var ctxSisaSumberDana = document.getElementById('pieSisaSumberDanaChart').getContext('2d');
			var pieSisaSumberDanaChart = new Chart(ctxSisaSumberDana, {
				type: 'doughnut',
				data: {
					labels: ['SISA ANGGARAN', 'DBH', 'BLUD'],
					datasets: [{
						data: [sisa_anggaran, sisa_dbh, sisa_blud],
						backgroundColor: [
							'#ff9800', // DAU Sisa Anggaran
							'#2196f3', // DBH DBH Cukai Hasil Tembakau (CHT)
							'#c500ff'  // DAK Pendapatan dari BLUD
						],
						borderWidth: 2,
						borderColor: '#fff',
						hoverOffset: 8
					}]
				},
				options: {
					cutout: '65%',
					plugins: {
						legend: {
							display: false
						},
						tooltip: {
							callbacks: {
								label: function(context) {
									var label = context.label || '';
									var value = context.raw || 0;
									var percent = total_sisa ? Math.round(value / total_sisa * 100) : 0;
									return label + ': ' + percent + '% (' + formatRupiah(value) + ')';
								}
							}
						}
					}
				}
			});
		</script> -->

		

		<!-- grafik Perbandingan Target & Realisasi Anggaran per Bulan -->
		<div class="row" style="margin-top:30px;">
			<div class="col-md-12 col-xs-12" style="margin:auto;">
				<div class="card shadow" style="border-radius:16px; border:1px solid #e0e0e0; padding:24px 18px 18px 18px; background:#fff;">
					<!-- <div class="d-flex align-items-center" style="margin-bottom:18px;">
						<i class="fa fa-bar-chart" style="font-size:26px;color:#2196f3;margin-right:10px;"></i>
						<span class="title-chart" style="font-size:20px;">Perbandingan Target & Realisasi Anggaran per Bulan (Tahun <?php echo $tahun_ini; ?>)</span>
					</div> -->
					<div class="row">
						<div class="col-xs-12" style="display:flex;align-items:center;justify-content:center;">
							<canvas id="perbandingan" height="120"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- grafik Perbandingan Target & Realisasi Anggaran per Bulan -->
		<script>
			var bulanLabels = [
				'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
				'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
			];
			// Data dari backend PHP
			var targetPerBulan = <?php echo json_encode($target_per_bulan); ?>;
			var realisasiPerBulan = <?php echo json_encode($realisasi_per_bulan); ?>;
			var tahunGrafik = <?php echo isset($tahun_ini) ? $tahun_ini : date('Y'); ?>;

			var ctx2 = document.getElementById("perbandingan").getContext('2d');
			var perbandingan = new Chart(ctx2, {
				type: 'bar',
				data: {
					labels: bulanLabels,
					datasets: [
						{
							label: 'Target',
							backgroundColor: 'rgba(220, 0, 48, 0.85)',
							data: <?= json_encode($target_per_bulan) ?>
						},
						{
							label: 'Realisasi',
							backgroundColor: 'rgba(54, 163, 235, 0.87)',
							data: <?= json_encode($realisasi_per_bulan) ?>
						}
					]
				},
				options: {
					responsive: true,
					plugins: {
						title: {
							display: true,
							text: 'Perbandingan Target & Realisasi Anggaran per Bulan (Tahun ' + tahunGrafik + ')',
							font: {
								size: 18
							}
						},
						tooltip: {
							mode: 'index',
							intersect: false
						},
						legend: {
							position: 'bottom'
						}
					},
					interaction: {
						mode: 'nearest',
						axis: 'x',
						intersect: false
					},
					scales: {
						x: {
							title: {
								display: true,
								text: 'Bulan'
							},
							ticks: {
								font: {
									weight: 'bold'
								}
							}
						},
						y: {
							title: {
								display: true,
								text: 'Nilai Anggaran'
							},
							beginAtZero: true,
							ticks: {
								callback: function(value) {
									return 'Rp ' + new Intl.NumberFormat().format(value);
								}
							}
						}
					}
				}
			});

		</script>

		<!-- Grafik Bar Target & Realisasi dalam beberapa Tahun -->
		 <div class="row" style="margin-top:24px;">
			<div class="col-md-12">
				<div class="card shadow" style="border-radius:16px; border:1px solid #e0e0e0; padding:18px 0 18px 0; background:#fff;">
					<div class="d-flex align-items-center" style="margin-bottom:10px; text-align:center;">
						<i class="fa fa-bar-chart" style="font-size:26px;color:#2196f3;margin-right:10px;"></i>
						<span class="title-chart" style="font-size:20px;">Data Paket Belanja Yang Belum Terealisasi Pada Tahun <?php echo $tahun_ini; ?></span>
					</div>
					<div class="table-responsive" style="padding:0 18px;">
						<?php echo $belum_terealisasi;?>
					</div>
				</div>
			</div>
		</div>
<?php
	} 
?>
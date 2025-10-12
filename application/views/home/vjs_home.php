<script>
	$("#transDate_1").datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'MM yy',
		// onClose: function(dateText, inst) {
		// 	$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
		// }
	});

	// Untuk merubah sifat asli option input dalam dropdown
	$('.dropdown-menu').on('click', function(e) {
		e.stopPropagation();
	});


	function getTransChart(id = 'chart-modal') {
		var data = $('#trans-chart-filter').serialize();
		$.ajax({
			url: app_url + 'home/get_transaction?' + data,
			method: 'get',
			dataType: 'json',
			success: function(response) {
				buildTransactionChart(response, id);
			}
		});

	}

	function getAccCostChart(id = 'chart-modal') {
		var data = $('#acc-cost-chart-filter').serialize();
		$.ajax({
			url: app_url + 'home/get_acc_cost?' + data,
			method: 'get',
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					$('.acc-cost-chart').append('<h3 class="h3-not-found">' + response.err_message + ' </h3>');
				} else {
					$('.acc-cost-chart').find('h3').remove();
					buildAccCostChart(response, id);
				}
			}
		});

	}

	function getQueueChart(id = 'chart-modal') {
		var data = $('#queue-chart-filter').serialize();
		$.ajax({
			url: app_url + 'home/get_queue?' + data,
			method: 'get',
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					$('.queue-chart').find('h3').remove();
					$('.queue-chart').append('<h3 class="h3-not-found">' + response.err_message + ' </h3>');
					$('#queue-chart').css('display', 'none');
				} else {
					$('#queue-chart').css('display', 'block');
					$('.queue-chart').find('h3').remove();
					// $('.queue-chart').append()
					buildQueueChart(response, id);
				}

			}
		});

	}

	function getQueueTypeChart(id = 'chart-modal') {
		var data = $('#queue-type-chart-filter').serialize();
		$.ajax({
			url: app_url + 'home/get_queue_type?' + data,
			method: 'get',
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					$('.queue-type-chart').find('h3').remove();
					$('.queue-type-chart').append('<h3 class="h3-not-found">' + response.err_message + '</h3>');
					$('#queue-type-chart').css('display', 'none');
				} else {
					$('#queue-type-chart').css('display', 'block');
					$('.queue-type-chart').find('h3').remove();
					buildQueueTypeChart(response, id);
				}
			}
		});
	}

	function getTrendProdChart(id = 'chart-modal') {
		var data = $('#trend-prod-chart-filter').serialize();
		$.ajax({
			url: app_url + 'home/get_trend_prod?' + data,
			method: 'get',
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					$('.trend-prod-chart').find('h3').remove();
					$('.trend-prod-chart').append('<h3 class="h3-not-found">' + response.err_message + '</h3>');
					$('#trend-prod-chart').css('display', 'none');
				} else {
					$('#trend-prod-chart').css('display', 'block');
					$('.trend-prod-chart').find('h3').remove();
					buildTrendProdChart(response, id);
				}
			}
		});

	}

	function getTransTypeChart(id = 'chart-modal') {
		var data = $('#trans-type-chart-filter').serialize();
		$.ajax({
			url: app_url + 'home/get_transaction_type?' + data,
			method: 'get',
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					$('.trans-type-chart').find('h3').remove();
					$('.trans-type-chart').append('<h3 class="h3-not-found">' + response.err_message + '</h3>');
					$('#trans-type-chart').css('display', 'none');
				} else {
					$('#trans-type-chart').css('display', 'block');
					$('.trans-type-chart').find('h3').remove();
					buildTransTypeChart(response, id);
				}
			}
		});
	}

	function getMarketingIncomeChart(id = 'chart-modal') {
		var data = $('#marketing-income-chart-filter').serialize();
		$.ajax({
			url: app_url + 'home/get_marketing_income?' + data,
			method: 'get',
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					$('.marketing-income-chart').find('h3').remove();
					$('.marketing-income-chart').append('<h3 class="h3-not-found">' + response.err_message + '</h3>');
					$('#marketing-income-chart').css('display', 'none');
				} else {
					$('#marketing-income-chart').css('display', 'block');
					$('.marketing-income-chart').find('h3').remove();
					buildMarketingIncomeChart(response, id);
				}
			}
		});
	}

	getTransChart(id = 'trans-chart');
	getAccCostChart(id = 'acc-cost-chart');
	getQueueChart(id = 'queue-chart');
	getQueueTypeChart(id = 'queue-type-chart');
	getTrendProdChart(id = 'trend-prod-chart');
	getTransTypeChart(id = 'trans-type-chart');
	getMarketingIncomeChart(id = 'marketing-income-chart');


	$('.dropdown-menu').on('click', '.btn-chart-filter', function() {
		id = $(this).attr('data-id');
		// console.log(id);
		if (id == 'trans-chart') {
			getTransChart(id);
		} else if (id == 'acc-cost-chart') {
			getAccCostChart(id);
		} else if (id == 'queue-chart') {
			getQueueChart(id);
		} else if (id == 'queue-type-chart') {
			getQueueTypeChart(id);
		} else if (id == 'trend-prod-chart') {
			getTrendProdChart(id);
		} else if (id == 'trans-type-chart') {
			getTransTypeChart(id);
		} else if (id == 'marketing-income-chart') {
			getMarketingIncomeChart(id);
		}
	});

	var transChart,
		accCostChart,
		queueChart,
		queueTypeChart,
		trendProdChart,
		transTypeChart,
		marketingIncomeChart;

	// grafik penjualan, harian, bulanan
	// grafik piutang, harian, bulanan
	// grafik hutang, harian, bulanan 
	function buildTransactionChart(response, id) {
		if (transChart != undefined) {
			transChart.destroy();
		}
		// console.log(transChart);
		const ctx = document.getElementById(id);
		transChart = new Chart(ctx, {
			type: response.type,
			data: {
				labels: response.labels,
				datasets: response.datasets,
			},
			options: {
				legend: {
					position: 'bottom',
					labels: {
						boxWidth: 20,
						fontSize: 20,
					}
				},
				scales: {
					yAxes: [{
						position: 'left',
						scaleLabel: {
							display: true,
							fontSize: 14,
							labelString: response.labelString,
						},
						// ticks: {
						// 	min: 0,
						// }
					}],
					xAxes: [{
						position: 'top',
						scaleLabel: {
							display: true,
							fontSize: 18,
							labelString: 'Penjualan berdasarkan ' + response.interval,
						},
					}],
				}
			}
		});
	}

	// grafik biaya operasional (tabel acc_cost)
	function buildAccCostChart(response, id) {
		if (accCostChart != undefined) {
			accCostChart.destroy();
		}

		const ctx = document.getElementById(id);
		accCostChart = new Chart(ctx, {
			type: response.type,
			data: {
				labels: response.labels,
				datasets: response.datasets,
			},
			options: {
				legend: {
					position: 'bottom',
					labels: {
						boxWidth: 20,
						fontSize: 20,
					}
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						},
						position: 'left',
						scaleLabel: {
							display: true,
							fontSize: 14,
							labelString: 'Jumlah Biaya Oprasional',
						},
						ticks: {
							min: 0,
						}
					}],
					xAxes: [{
						position: 'top',
						scaleLabel: {
							display: true,
							fontSize: 18,
							labelString: 'Berdasarkan ' + response.interval,
						},
					}],
				}
			}
		});
	}

	// grafik antrian, harian, bulanan
	function buildQueueChart(response, id) {
		if (queueChart != undefined) {
			queueChart.destroy();
		}
		// console.log(queueChart);
		const ctx = document.getElementById(id);
		queueChart = new Chart(ctx, {
			type: response.type,
			data: {
				labels: response.labels,
				datasets: response.datasets,
			},
			options: {
				legend: {
					position: 'bottom',
					labels: {
						boxWidth: 20,
						fontSize: 20,
					}
				},
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						},
						position: 'left',
						scaleLabel: {
							display: true,
							fontSize: 14,
							labelString: 'Jumlah Antrian',
						},
						ticks: {
							min: 0,
						}
					}],
					xAxes: [{
						position: 'top',
						scaleLabel: {
							display: true,
							fontSize: 18,
							labelString: 'Antrian berdasarkan ' + response.interval,
						},
					}],
				}
			}
		});
	}

	// grafik donat, antrian berdasarkan jenis
	function buildQueueTypeChart(response, id) {
		if (queueTypeChart != undefined) {
			queueTypeChart.destroy();
		}

		const ctx = document.getElementById(id);
		queueTypeChart = new Chart(ctx, {
			type: response.type,
			data: {
				labels: response.labels,
				datasets: response.datasets,
			},
			options: {
				legend: {
					position: 'right',
					labels: {
						boxWidth: 20,
						fontSize: 20,
					}
				},
			}
		});
	}

	// grafik donat, 10 produk terlaris, harian, bulanan
	function buildTrendProdChart(response, id) {
		if (trendProdChart != undefined) {
			trendProdChart.destroy();
		}

		const ctx = document.getElementById(id);
		trendProdChart = new Chart(ctx, {
			type: response.type,
			data: {
				labels: response.labels,
				datasets: response.datasets,
			},
			options: {
				tooltips: {
					enabled: true
				},
				// plugins: {
				// 	datalabels: {
				// 		formatter: (value, ctx) => {
				// 			let sum = 0;
				// 			let dataArr = ctx.chart.data.datasets[0].data;
				// 			dataArr.map(data => {
				// 				sum += data;
				// 			});
				// 			let percentage = (value * 100 / sum).toFixed(2) + "%";
				// 			return percentage;
				// 		},
				// 		color: '#fff',
				// 	}
				// },
				legend: {
					position: 'right',
					labels: {
						boxWidth: 13,
						fontSize: 13,
					}
				},

			}
		});
	}

	// grafik donat, transaksi berdasarkan tipe (ONTHESPOT, WA , MARKETPLACE)
	function buildTransTypeChart(response, id) {
		if (transTypeChart != undefined) {
			transTypeChart.destroy();
		}

		const ctx = document.getElementById(id);
		transTypeChart = new Chart(ctx, {
			type: response.type,
			data: {
				labels: response.labels,
				datasets: response.datasets,
			},
			options: {
				legend: {
					position: 'right',
					labels: {
						boxWidth: 13,
						fontSize: 13,
					}
				},
			}
		});
	}

	// grafik donat, marketing income
	function buildMarketingIncomeChart(response, id) {
		if (marketingIncomeChart != undefined) {
			marketingIncomeChart.destroy();
		}

		const ctx = document.getElementById(id);
		marketingIncomeChart = new Chart(ctx, {
			type: response.type,
			data: {
				labels: response.labels,
				datasets: response.datasets,
			},
			options: {
				legend: {
					position: 'right',
					labels: {
						boxWidth: 13,
						fontSize: 13,
					}
				},
			}
		});
	}
"use strict";

// Shared Colors Definition
const primary = '#6993FF';
const success = '#1BC5BD';
const info = '#8950FC';
const warning = '#FFA800';
const danger = '#F64E60';

function number_format(number, decimals, dec_point, thousands_sep) {
	// Strip all characters but numerical ones.
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}

// Class definition
function generateBubbleData(baseval, count, yrange) {
	var i = 0;
	var series = [];
	while (i < count) {
		var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
		var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
		var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

		series.push([x, y, z]);
		baseval += 86400000;
		i++;
	}
	return series;
}

function generateData(count, yrange) {
	var i = 0;
	var series = [];
	while (i < count) {
		var x = 'w' + (i + 1).toString();
		var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

		series.push({
			x: x,
			y: y
		});
		i++;
	}
	return series;
}

function generateMonth(month) {
	month = month - 1;
	var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	return months[month];
}

function number_format(number, decimals, dec_point, thousands_sep) {
	// Strip all characters but numerical ones.
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}


/**Generate Chart omset */

var KTApexChartsDemo = function () {
	// Private functions
	var _demo1 = function () {
		$.getJSON('/statistic-omset', function (response) {
			console.log(response);
			var data = [];
			var categories = [];
			for (var i = 0; i < response.data.length; i++) {
				data[i] = response.data[i].omset;
				categories[i] = response.data[i].new_date
			}
			console.log(data, categories)
			const apexChart = "#chart_1";
			var options = {
				series: [{
					name: "Omset",
					data: data
				}],
				chart: {
					height: 350,
					type: 'line',
					zoom: {
						enabled: false
					}
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					curve: 'straight'
				},
				grid: {
					row: {
						colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
						opacity: 0.5
					},
				},
				xaxis: {
					categories: categories,
				},
				colors: [primary]
			};

			var chart = new ApexCharts(document.querySelector(apexChart), options);
			chart.render();
		});

	}

	var _demo11 = function () {
		$.getJSON('/statistic-omset', function (response) {
			console.log('grafik bulat', response);
			var data = [];
			var categories = [];
			for (var i = 0; i < response.data.length; i++) {
				data[i] = parseInt(response.data[i].omset);
				categories[i] = response.data[i].new_date;
			}
			console.log(data, categories)

			const apexChart = "#chart_11";
			var options = {
				series: data,
				chart: {
					width: 600,
					type: 'donut',
				},
				labels: categories,
				responsive: [{
					breakpoint: 480,
					options: {
						chart: {
							width: 200
						},
						legend: {
							position: 'bottom'
						}
					}
				}]
			};

			var chart = new ApexCharts(document.querySelector(apexChart), options);
			chart.render();
		});
	}

	var _demo12 = function () {
		$.getJSON('/statistic-product', function (response) {
			console.log(response);
			var data = [];
			var categories = [];
			for (var i = 0; i < response.data.length; i++) {
				data[i] = parseInt(response.data[i].data);
				categories[i] = response.data[i].active_product_name + " : " + data[i] + " Terjual";
			}

			const apexChart = "#chart_12";
			var options = {
				series: data,
				chart: {
					width: 600,
					type: 'pie',
				},
				labels: categories,
				responsive: [{
					breakpoint: 480,
					options: {
						chart: {
							width: 200
						},
						legend: {
							position: 'bottom'
						}
					}
				}]
			};

			var chart = new ApexCharts(document.querySelector(apexChart), options);
			chart.render();
		});
	}

	var _demo3 = function () {
		$.getJSON('/statistic-product-permonth', function (response) {
			console.log('product permonth', response);
			var data = [];
			var categories = [];

			for (var i = 0; i < response.data.categories.length; i++) {
				categories[i] = response.data.categories[i].date;
			}

			console.log(response.data.value)
			const apexChart = "#chart_3";
			var options = {
				series: response.data.value,
				chart: {
					type: 'bar',
					height: 350
				},
				plotOptions: {
					bar: {
						horizontal: false,
						columnWidth: '55%',
						endingShape: 'rounded'
					},
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					show: true,
					width: 2,
					colors: ['transparent']
				},
				xaxis: {
					categories: categories,
				},
				yaxis: {
					title: {
						text: 'Total Penjualan'
					}
				},
				fill: {
					opacity: 1
				},
				tooltip: {
					y: {
						formatter: function (val) {
							return " " + val + " terjual"
						}
					}
				},
				colors: [primary, success, warning]
			};

			var chart = new ApexCharts(document.querySelector(apexChart), options);
			chart.render();
		});
	}

	return {
		// public functions
		init: function () {
			_demo1();
			_demo3();
			_demo11();
			_demo12();
		}
	};
}();

var KTEcommerceMyOrders = function () {
	// Private functions
	var demo = function () {
		var datatable = $('#statistic_1').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						method: 'GET',
						url: '/statistic-omset-day',
						// sample custom headers
						// headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
						map: function (raw) {
							// sample data mapping
							console.log(raw)
							var dataSet = raw.data;
							if (typeof raw.data !== 'undefined') {
								dataSet = raw.data;
							}
							return dataSet;
						},
					},
				},
				pageSize: 10,
				serverPaging: false,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false,
				footer: false,
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#kt_datatable_search_query'),
				key: 'generalSearch'
			},

			// columns definition
			columns: [{
				field: 'new_date',
				title: 'Tanggal',
			},
			{
				field: 'omset',
				title: 'Omset',
				template: function (raw) {
					return "Rp. " + number_format(raw.omset) + ",-"
				}
			}],

		});

		$('#kt_datatable_search_status').on('change', function () {
			console.log($(this).val().toLowerCase());
			datatable.search($(this).val().toLowerCase(), 'payment_status');
		});

		$('#kt_datatable_search_type').on('change', function () {
			datatable.search($(this).val().toLowerCase(), 'Type');
		});

		$('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
	};

	return {
		// public functions
		init: function () {
			demo();
		},
	};
}();

jQuery(document).ready(function () {
	KTApexChartsDemo.init();
	KTEcommerceMyOrders.init();
});

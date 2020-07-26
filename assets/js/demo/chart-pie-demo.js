// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


var percentage = document.getElementsByClassName("kemungkinan");
var gangguanNames = document.getElementsByClassName("gangguanNames");
var dataPercentage = [];
var dataGangguanNames = [];

for (var i = 0; i < percentage.length; i++) {
	dataPercentage[i] = percentage[i].value;
}
for (var i = 0; i < gangguanNames.length; i++) {
	dataGangguanNames[i] = gangguanNames[i].value;
}

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
	type: 'doughnut',
	data: {
		labels: dataGangguanNames,
		datasets: [{
			data: dataPercentage,
			backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
			hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
			hoverBorderColor: "rgba(234, 236, 244, 1)",
		}],
	},
	options: {
		maintainAspectRatio: false,
		tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: '#dddfeb',
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: true,
			caretPadding: 10,
		},
		legend: {
			display: true
		},
		cutoutPercentage: 80,
	},
});

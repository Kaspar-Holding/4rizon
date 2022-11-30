// /*------------------------------------------------------------------
//     jynx website and dashboard
// -------------------------------------------------------------------*/	
// var ctx = document.getElementById('canvas').getContext("2d");

// var gradientStroke = ctx.createLinearGradient(500, 200, 100, 300);
// gradientStroke.addColorStop(0, '#80b6f4');
// gradientStroke.addColorStop(1, '#f49080');
// var gradientFill = ctx.createLinearGradient(0, 500, 100, 0);
// gradientFill.addColorStop(1, "rgba(107,236,235, 1)");
// gradientFill.addColorStop(0.7, "rgba(69, 161, 243,1)");
// gradientFill.addColorStop(0, "rgba(13, 45, 80, 1)");
// var myFill = ctx.createLinearGradient(0, 500, 100, 0);
// myFill.addColorStop(1, "rgba(244,96,96, 1)");
// myFill.addColorStop(0, "rgba(13, 45, 80,1)");


//      var color = Chart.helpers.color;
	 
	 
// 		var barChartData = {
// 			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
// 			datasets: [{
// 				type: 'bar',
// 				label: 'Total App Downloads',
// 				backgroundColor: gradientFill,
// 				borderTop:2,
// 				color: 'white',
// 				borderRadius: 20,
// 				borderSkipped: 'bottom',
// 				data: [
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor()
// 				]
// 			}, {
// 				type: 'bar',
// 				label: 'Total User Registered',
// 				backgroundColor: myFill,
// 				borderWidth: 2,
// 				color: 'white',
// 				borderRadius: 20,
// 				borderSkipped: 'bottom',
// 				data: [
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor(),
// 					randomScalingFactor()
// 				]
// 			},
// 			 ]
// 		};

// 		// Define a plugin to provide data labels
// 		Chart.plugins.register({
// 			afterDatasetsDraw: function(chart) {
// 				var ctx = chart.ctx;

// 				chart.data.datasets.forEach(function(dataset, i) {
// 					var meta = chart.getDatasetMeta(i);
// 					if (!meta.hidden) {
// 						meta.data.forEach(function(element, index) {
// 							// Draw the text in black, with the specified font
// 							ctx.fillStyle = 'rgb(0, 0, 0)';

// 							var fontSize = 0;
// 							var fontStyle = 'normal';
// 							var fontFamily = 'Helvetica Neue';
// 							ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

// 							// Just naively convert to string for now
// 							var dataString = dataset.data[index].toString();

// 							// Make sure alignment settings are correct
// 							ctx.textAlign = 'center';
// 							ctx.textBaseline = 'middle';

// 							var padding = 5;
// 							var position = element.tooltipPosition();
// 							ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
// 						});
// 					}
// 				});
// 			}
// 		});

// 		window.onload = function() {
// 			var ctx = document.getElementById('canvas').getContext('2d');
// 			window.myBar = new Chart(ctx, {
// 				type: 'bar',
// 				data: barChartData,
// 				options: {
// 					responsive: true,
// 					title: {
// 						display: false,
// 						text: 'Chart.js Combo Bar Line Chart'
// 					},
// 					scales: {
// 						 xAxes: [{
// 						 ticks: {
// 						 fontColor: "white",
// 						 },
// 						 gridLines:{
//                           borderDash: [8,4],
// 						  color: "white"
// 						 }
// 						 }],
// 						 yAxes: [{
// 							 ticks: {
// 								 color: "white",},
// 								 gridLines:{
// 									borderDash: [8,4],
// 									color: "white",
// 								   },
// 								   display: true,
// 								}]
								

// 						}	
// 				}
// 			});
// 		};

// 		document.getElementById('randomizeData').addEventListener('click', function() {
// 			barChartData.datasets.forEach(function(dataset) {
// 				dataset.data = dataset.data.map(function() {
// 					return randomScalingFactor();
// 				});
// 			});
// 			window.myBar.update();
// 		});
		



const ctx = document.getElementById('canvas').getContext('2d');
var gradientFill = ctx.createLinearGradient(0, 500, 100, 0);
gradientFill.addColorStop(1, "rgba(107,236,235, 1)");
gradientFill.addColorStop(0.7, "rgba(69, 161, 243,1)");
gradientFill.addColorStop(0, "rgba(13, 45, 80, 1)");
var myFill = ctx.createLinearGradient(0, 500, 100, 0);
myFill.addColorStop(1, "rgba(244,96,96, 1)");
myFill.addColorStop(0, "rgba(13, 45, 80,1)");
var january = $('#january').val();
var feburary = $('#feburary').val();
var march = $('#march').val();
var april = $('#april').val();
var may = $('#may').val();
var june = $('#june').val();
var july = $('#july').val();
var august = $('#august').val();
var september = $('#september').val();
var october = $('#october').val();
var november = $('#november').val();
var december = $('#december').val();
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        

        datasets: [{
            label: 'Total App Downloads',
            data: [
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
                randomScalingFactor(),
            ],
            backgroundColor: gradientFill,	
			borderWidth: 2,
			borderRadius: 50,
			borderSkipped: 'bottom',

        },
		{
            label: 'Total Users Registered',
            data: [january, feburary, march, april, may, june, july, august, september, october, november, december],
            backgroundColor: myFill,		
			borderWidth: 2,
			borderRadius: 50,
			borderSkipped: 'bottom',
        }
	],
    },
    options: {
        scales: {
			x: {
				ticks: {
					color: "white"
				},
				
			},
            y: {
                beginAtZero: true,
				ticks: {
					color: "white",
                    stepSize: 10,
                    min: 0,
                    max: 60
				},
				grid: {
					borderDash: [2, 4],
					color: "#566d85"
				}

            }
        },
        plugins: {
            legend: {
                display: true,
                labels: {
                    color: 'white',
                    padding: 10,
                    usePointStyle: true,
                    pointStyle: "rectRounded",
                }
            }
        }
        
            // tooltip: {
            //     callbacks: {
            //         labelColor: function(context) {
            //             return {
            //                 borderColor: 'rgb(0, 0, 255)',
            //                 backgroundColor: 'rgb(255, 0, 0)',
            //                 borderWidth: 2,
            //                 borderDash: [2, 2],
            //                 borderRadius: 2,
            //             };
            //         },
            //         labelTextColor: function(context) {
            //             return '#543453';
            //         }
            //     }
            // }
        

    }


});


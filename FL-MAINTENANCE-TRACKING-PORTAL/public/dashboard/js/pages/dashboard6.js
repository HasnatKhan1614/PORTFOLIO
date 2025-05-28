//[Dashboard Javascript]

//Project:	Etikto Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';


  // bar chart
  $(".bar").peity("bar");
	
        var options = {
          series: [{
            name: 'Total Patients',
            data: [40, 30, 50, 25, 20, 50, 40]
          },{
              name: 'Inpatients',
              data: [20, 15, 20, 30, 10, 40, 30]
            },{
              name: 'Outpatients',
              data: [30, 10, 25, 30, 5, 34, 28]
            }],
          chart: {
          height: 300,
          type: 'bar',
          toolbar: {
            show: false
          },
        },
        plotOptions: {
          bar: {
            borderRadius: 5,  
            dataLabels: {
              position: 'top', // top, center, bottom
            },
          }
        },
        colors: ["#6488ea" , "#FFAA05", "#04a08b"],
        stroke: {
          show: true,
          width: 4,
          colors: ['transparent']
        },
        dataLabels: {
          enabled: false,
          formatter: function (val) {
            return val + "%";
          },
          offsetY: -20,
          style: {
            fontSize: '12px',
            colors: ["#6488ea" , "#FFAA05", "#04a08b" ]
          }
        },
        legend: {
            show: false,
        },
        grid: {
            show: false,
          },
        xaxis: {
          categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
          position: 'bottom',
          labels: {
            show: true,
          },
          axisBorder: {
            show: true
          },
          axisTicks: {
            show: true
          },
          crosshairs: {
            fill: {
              type: 'gradient',
              gradient: {
                colorFrom: '#D8E3F0',
                colorTo: '#BED1E6',
                stops: [0, 100],
                opacityFrom: 0.4,
                opacityTo: 0.5,
              }
            }
          },
          tooltip: {
            enabled: false,
          }
        },
        yaxis: {
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false,
          },
          labels: {
            show: false,
            formatter: function (val) {
              return val + "%";
            }
          }
        
        },
        title: {
          text: '',
          floating: false,
          offsetY: 330,
          align: 'center',
          style: {
            color: '#444'
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#reality-chart"), options);
        chart.render();



                // ------------------------------
        // nightingale chart
        // ------------------------------
        // based on prepared DOM, initialize echarts instance
            var nightingaleChart = echarts.init(document.getElementById('nightingale-chart'));
            var option = {

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    formatter: ""
                },

                // Add legend
                legend: {
                    x: 'center',
                    y: 'top',
                    orient: 'horizontal',
                    data:['cardiology','Neurology','Dermatology']
                },

                color: ['#ff8f00', '#673ab7', '#4974e0'],

                // Display toolbox
                toolbox: {
                    show: false,
                    orient: 'vertical',
                    feature: {
                        mark: {
                            show: false,
                            title: {
                                mark: 'Markline switch',
                                markUndo: 'Undo markline',
                                markClear: 'Clear markline'
                            }
                        },
                        dataView: {
                            show: false,
                            readOnly: false,
                            title: 'View data',
                            lang: ['View chart data', 'Close', 'Update']
                        },
                        magicType: {
                            show: false,
                            title: {
                                pie: 'Switch to pies',
                                funnel: 'Switch to funnel',
                            },
                            type: ['pie', 'funnel']
                        },
                        restore: {
                            show: false,
                            title: 'Restore'
                        },
                        saveAsImage: {
                            show: false,
                            title: 'Same as image',
                            lang: ['Save']
                        }
                    }
                },

                // Enable drag recalculate
                calculable: false,

                // Add series
                series: [
                    {
                        name: 'Area Mode',
                        type: 'pie',
                        radius: ['15%', '73%'],
                        center: ['50%', '50%'],
                        roseType: 'area',

                        // Funnel
                        width: '20%',
                        height: '40%',
                        x: '30%',
                        y: '17.5%',
                        max: 450,
                        sort: 'ascending',

                        data: [
                            {value: 50, name: 'cardiology'},
                            {value: 60, name: 'Neurology'},
                            {value: 80, name: 'Dermatology'}
                        ]
                    }
                ]
            };
        nightingaleChart.setOption(option);






	
	
}); // End of use strict


var dom = document.getElementById('chart-container');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    top: '5%',
    left: 'center'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: ['40%', '60%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: '#fff',
        borderWidth: 2
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: true,
          fontSize: 20,
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: [
        {value: 50, name: 'cardiology'},
        {value: 60, name: 'Neurology'},
        {value: 80, name: 'Dermatology'}
      ]
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);
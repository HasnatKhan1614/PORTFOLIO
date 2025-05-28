//[Dashboard Javascript]

//Project:	Etikto Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';


  $('.resent-tickets').slimScroll({
    height: 'auto'
  });
	
	
  var orderSummaryChartOptions = {
        chart: {
          height: 300,
          type: 'line',
          stacked: false,
          toolbar: {
          show: false,
          },
          sparkline: {
          enabled: true
          },
        },
        colors: ['#2e62b9',],
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 2.5,
          dashArray: [0, 8]
        },
        fill: {
          type: 'gradient',
          gradient: {
          inverseColors: false,
          shade: 'light',
          type: "vertical",
          gradientToColors: ['#a1bce8', '#FF2829'],
          opacityFrom: 0.7,
          opacityTo: 0.55,
          stops: [0, 70, 100]
          }
        },
        series: [{
          name: 'Reply',
          data: [165, 175, 162, 173, 160, 195, 160, 170, 160, 190, 180, 165, 175, 162, 173],
          type: 'area',
        }],

        xaxis: {
          offsetY: -10,
          categories: ['', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ''],
          axisBorder: {
          show: false,
          },
          axisTicks: {
          show: false,
          },
          labels: {
          show: true,
          style: {
            colors: '#8097b1'
          }
          }
        },
        tooltip: {
          x: { show: false }
        },
        }

        var orderSummaryChart = new ApexCharts(
        document.querySelector("#order-summary-chart"),
        orderSummaryChartOptions
        );

        orderSummaryChart.render();


  var options = {
    series: [{
    name: 'Ticket Solved',
    data: [600, 550, 850, 450, 750, 950, 630]
  }, {
    name: 'Ticket Create',
    data: [760, 850, 1001, 980, 870, 1005, 910]
  }],
    chart: {
    type: 'bar',
    height: 309,
    stacked: true, 
    toolbar: {
      show: false,
    }, 
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '45%',
      borderRadius: 7,
    },
  },
  legend: {
      show: false,
  },
  dataLabels: {
    enabled: false
  },
  grid: {
      show: true,
      borderColor: '#f0f0f0',
      strokeDashArray: 5,
    },
  stroke: {
    show: false,
    width: 1,
    colors: ['transparent']
  },
  xaxis: {
    categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov', 'Dec'],
  },
  yaxis: {
    title: {
      text: ''
    }
  },
  colors: ['#6963BB', '#C2A1FC' ],
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return "" + val + ""
      }
    }
  }
  };

  var chart = new ApexCharts(document.querySelector("#chart-Overall"), options);
  chart.render();





    var o = c3.generate({
        bindto: "#pie-chart",
        color: { pattern: ['#04a08b', '#F6B749', '#C2A1FC', '#6963BB', '#FF6C6C'] },
        data: {
            columns: [
                ['0-1 Hours', 72],
                ['1-8 Hours', 11],
                ['8-24 Hours', 4],
                ['> 24 Hours', 8],
                ['No Replies', 5],
            ],
            type: "pie",
            onclick: function(o, n) { console.log("onclick", o, n) },
            onmouseover: function(o, n) { console.log("onmouseover", o, n) },
            onmouseout: function(o, n) { console.log("onmouseout", o, n) }
        }
    });


	
	
	
}); // End of use strict



var dom = document.getElementById('chart-channels');
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
    bottom: '5%',
    left: 'center'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: ['80%', '100%'],
      center: ['50%', '70%'],
      startAngle: 180,
      endAngle: 358,
      avoidLabelOverlap: false,
      padAngle: 3,
      itemStyle: {
        borderRadius: 10
      },
      label: {
        show: false,
        position: 'center',
      },
      emphasis: {
        label: {
          show: true,
          fontSize: 20,
          fontWeight: 'bold',
        }
      },
      labelLine: {
        show: false
      },
      data: [
        { value: 1048, name: 'Email' },
        { value: 735, name: 'Chat' },
        { value: 580, name: 'Messenger' },
        { value: 484, name: 'wahtsapp' },
        { value: 300, name: 'Form' },
      ]
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);


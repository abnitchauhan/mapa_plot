$.post('data_process.php',
    {method: 'GET'},
    function(data)
    {
        var cumul_data = JSON.parse(data);
        console.log(cumul_data);
        var dates = cumul_data['dates'];
        var truevalue = cumul_data['true']; 
        var pred_line = cumul_data['pred'];
        

        // For true Value because rest of the data contains 0.
        truevalue = truevalue.map(function(val, i) {
            return val === 0 ? null : val;
        });
   
// PREPARE CHART

        Highcharts.chart('cumulative_cases', { 
            chart:{
                zoomType: 'x',
                panning: true,
                panKey: 'shift',   
            },

            title: {   text: 'Cumulative Cases'    },
        
            subtitle: {text: ''},
        
            yAxis: {
                title: {  text: 'Cases'  }
            },
        
            xAxis: {
                  type: 'datetime', 
                   labels:{
                    formatter: function()
                    {       
                        return  dates[this.value];
                    }
                } 
            },
        
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
        
            plotOptions: {
                series:{
                    marker: {
                        enabled: false
                    },
                }
            },
        
            series: [
                // Prediction Lines
                {name: 'EP',
                 data: cumul_data['ep']
                },
                {name: 'MP',
                 data: cumul_data['mp']
                },
                {name: 'PP',
                 data: cumul_data['pp']
                },
                 {name: 'True',
                data: truevalue
               }, 
               {
                name : 'Prediction 1',
                data : pred_line
               }
               ,
                // Prediction Bands
                {
                    name : 'EP Band',
                    type : 'arearange',
                    data : cumul_data['ep_band']
                },
                {
                    name : 'MP Band',
                    type : 'arearange',
                    data : cumul_data['mp_band']
                },
                {
                    name : 'PP Band',
                    type : 'arearange',
                    data : cumul_data['pp_band']
                }
             ],
        
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        
        }); //Highcharts Ends for Cumulative Cases.

    }
)
        

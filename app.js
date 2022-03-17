$.post('data_process.php',
    {method: 'GET'},
    function(data)
    {
        var cumul_data = JSON.parse(data); 
        
 
// PREPARE CHART : CUMULATIVE CASES 

// TO Display Correct Date Time
    Highcharts.setOptions({
        global: {
        useUTC: false
        }
    });
  
  
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
                data: cumul_data['true']
                }, 
                {name : 'Prediction 1',
                    data : cumul_data['pred']
                }, 
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

});


// PREPARE CHART : DAILY CASES

$.post('daily_data.php',
    {method: 'GET'},
    function(data)
    {
        var daily_data = JSON.parse(data); 
        
 
// PREPARE CHART : CUMULATIVE CASES

        Highcharts.chart('daily_cases', { 
            chart:{
                zoomType: 'x',
                panning: true,
                panKey: 'shift',   
            }, 
            title: {   text: 'Daily Cases'    }, 
            subtitle: {text: ''}, 
            yAxis: {
                title: {  text: 'Cases'  }
            }, 
            xAxis: {
                useUTC: false,
                  type: 'datetime',  
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
                    {name: 'TRUE',
                    data: daily_data['true']
                    },
                    {name: 'PREDICTION',
                    data: daily_data['prediction']
                    },  
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
        }); //Highcharts Ends for Daily Cases.

});




        

$(function() {
   
    $.plot('#piechart1', data, {
        series: {
            pie: { 
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 3/4,
                    formatter: labelFormatter,
                    background: { 
                        opacity: 0.5,
                        color: '#000'
                    }
                }
            }
        },
        legend: {
            show: false
        }
    });

    $.plot('#piechart2', data, {
        series: {
            pie: {
                show: true,
                radius: 1,
                tilt: 0.5,
                label: {
                    show: true,
                    radius: 1,
                    formatter: labelFormatter,
                    background: {
                        opacity: 0.8
                    }
                },
                combine: {
                    color: '#999',
                    threshold: 0.1
                }
            }
        },
        legend: {
            show: false
        }
    });



function euroFormatter(v, axis) {
    return v.toFixed(axis.tickDecimals) + "€";
}

function doPlot(position) {
    $.plot("#timechart", [
        { data: oilprices, label: "Oil price ($)" },
        { data: exchangerates, label: "USD/EUR exchange rate", yaxis: 2 }
    ], {
        xaxes: [ { mode: "time" } ],
        yaxes: [ { min: 0 }, {
            // align if we are to the right
            alignTicksWithAxis: position == "right" ? 1 : null,
            position: position,
            tickFormatter: euroFormatter
        } ],
        legend: { position: "sw" }
    });
}

doPlot("right");

});

function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
}
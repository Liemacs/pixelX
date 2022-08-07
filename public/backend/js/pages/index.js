
$(function () {
    getMorris('area', 'area_chart');
    getMorris('donut', 'donut_chart');
});

function getMorris(type, element) {
    if (type === 'area') {
        Morris.Area({
            element: element,
            data: [{
                period: '2017 Q2',
                iphone: 3480,
                ipad: 2102,
                itouch: 2365
            }, {
                    period: '2010 Q3',
                    iphone: 4912,
                    ipad: 1969,
                    itouch: 2501
                }, {
                    period: '2011 Q3',
                    iphone: 3152,
                    ipad: 4215,
                    itouch: 2458
                }, {
                    period: '2012 Q4',
                    iphone: 6158,
                    ipad: 5967,
                    itouch: 5175
                },{
                    period: '2013 Q4',
                    iphone: 3767,
                    ipad: 3597,
                    itouch: 4512
                }, {
                    period: '2014 Q1',
                    iphone: 5148,
                    ipad: 1914,
                    itouch: 2293
                }, {
                    period: '2015 Q2',
                    iphone: 4125,
                    ipad: 3451,
                    itouch: 6124
                },{
                    period: '2016 Q3',
                    iphone: 2068,
                    ipad: 4460,
                    itouch: 2028
                }, {
                    period: '2017 Q4',
                    iphone: 6412,
                    ipad: 5713,
                    itouch: 3450
                }],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
            pointSize: 3,
            hideHover: 'auto',
			fillOpacity: 0.9,
            lineColors: ["#c2d9a1", "#8be6e4", "#ffc378"]
			
        });
    } else if (type === 'donut') {
        Morris.Donut({
            element: element,
            data: [{
                label: 'Crome',
                value: 25
            }, {
                    label: 'Mozila',
                    value: 40
                }, {
                    label: 'Safari',
                    value: 15
                },{
                    label: 'IE',
                    value: 20
                }, {
                    label: 'Other',
                    value: 10
                }],
            colors: ['rgb(0,189,209)', 'rgb(137,197,75)', 'rgb(27,138,207)', 'rgb(168,104,224)', 'rgb(255,200,0)'],
            formatter: function (y) {
                return y + '%'
            }
        });
    }
}

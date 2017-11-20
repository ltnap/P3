/* =*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

	#O.C PROJECT 3 // Billet Simple Pour L'Alaska
	@Author		   Christophe Corenthy
	@Type          JS
	@Version       1.1
	@Last Update   Samedi 16 Septembre, 2017

	TABLE OF CONTENTS
	---------------------------
	 1. Fullpage.js                        [31.08.17]
	 	 1.1 Fullpage.js
         1.2 Fullpage Options Activees     [02.09.17]
	 2. Constellation                      [16.09.17]
	 3. Animated Menu                      [11.09.17]  
	 4. Search UI Effect                   [12.09.17]
     5. Animated Headlines                 [14.09.17]
	 6. Global Menu for Episodes           [25.09.17]
	 7. Booklet jQuery                     [26.09.17]
	 8. Minimal Contact Form               [06.09.17]
        8.1 Custom Modernizr
        8.2 Classie.js
        8.3 Steps
	 7. 
	 8. 
	 9. 
	10.  
	11. 

=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=* */

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ======================================================================
// ============================== LOADER ================================
// ======================================================================
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// console.log("===== 1 - LOADER EN CHARGE =====");

var checkmarkIdPrefix = "loadingCheckSVG-";
var checkmarkCircleIdPrefix = "loadingCheckCircleSVG-";
var verticalSpacing = 50;

function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}

function createSVG(tag, properties, opt_children) {
  var newElement = document.createElementNS("http://www.w3.org/2000/svg", tag);
  for(prop in properties) {
    newElement.setAttribute(prop, properties[prop]);
  }
  if (opt_children) {
    opt_children.forEach(function(child) {
      newElement.appendChild(child);
    })
  }
  return newElement;
}

function createPhraseSvg(phrase, yOffset) {
  var text = createSVG("text", {
    fill: "white",
    x: 50,
    y: yOffset,
    "font-size": 18,
    "font-family": "Roboto Slab"
  });
  text.appendChild(document.createTextNode(phrase + "..."));
  return text;
}
function createCheckSvg(yOffset, index) {
  var check = createSVG("polygon", {
    points: "21.661,7.643 13.396,19.328 9.429,15.361 7.075,17.714 13.745,24.384 24.345,9.708 ",
    fill: "rgba(255,255,255,1)",
    id: checkmarkIdPrefix + index
  });
  var circle_outline = createSVG("path", {
    d: "M16,0C7.163,0,0,7.163,0,16s7.163,16,16,16s16-7.163,16-16S24.837,0,16,0z M16,30C8.28,30,2,23.72,2,16C2,8.28,8.28,2,16,2 c7.72,0,14,6.28,14,14C30,23.72,23.72,30,16,30z",
    fill: "white"
  })
  var circle = createSVG("circle", {
    id: checkmarkCircleIdPrefix + index,
    fill: "rgba(255,255,255,0)",
    cx: 16,
    cy: 16,
    r: 15
  })
  var group = createSVG("g", {
    transform: "translate(10 " + (yOffset - 20) + ") scale(.9)"
  }, [circle, check, circle_outline]);
  return group;
}

function addPhrasesToDocument(phrases) {
  phrases.forEach(function(phrase, index) {
    var yOffset = 30 + verticalSpacing * index;
    document.getElementById("phrases").appendChild(createPhraseSvg(phrase, yOffset));
    document.getElementById("phrases").appendChild(createCheckSvg(yOffset, index));
  });
}

function easeInOut(t) {
  var period = 200;
  return (Math.sin(t / period + 100) + 1) /2;
}

document.addEventListener("DOMContentLoaded", function(event) {
  var phrases = shuffleArray(["Initialisation", "Fullpage", "Backgrounds", "Titres", "Constellation", "Animations", "Biographie", "Interface Utilisateur", "Chapitres", "Episodes", "Formulaire de Contact", "Barre de Recherche", "Menu", "Backend", "Commentaires", "Cookies", "Feuilles de Style", "Scripts JavaScript", "Base de Données", "Scripts jQuery", "Trucs Inutiles"]);
  addPhrasesToDocument(phrases);
  var start_time = new Date().getTime();
  var upward_moving_group = document.getElementById("phrases");
  upward_moving_group.currentY = 0;
  var checks = phrases.map(function(_, i) {
    return {check: document.getElementById(checkmarkIdPrefix + i), circle: document.getElementById(checkmarkCircleIdPrefix + i)};
  });
  function animateLoading() {
    var now = new Date().getTime();
    upward_moving_group.setAttribute("transform", "translate(0 " + upward_moving_group.currentY + ")");
    upward_moving_group.currentY -= 1.35 * easeInOut(now);
    checks.forEach(function(check, i) {
      var color_change_boundary = - i * verticalSpacing + verticalSpacing + 15;
      if (upward_moving_group.currentY < color_change_boundary) {
        var alpha = Math.max(Math.min(1 - (upward_moving_group.currentY - color_change_boundary + 15)/30, 1), 0);
        check.circle.setAttribute("fill", "rgba(255, 255, 255, " + alpha + ")");
        var check_color = [Math.round(255 * (1-alpha) + 120 * alpha), Math.round(255 * (1-alpha) + 154 * alpha)];
        check.check.setAttribute("fill", "rgba(255, " + check_color[0] + "," + check_color[1] + ", 1)");
      }
    })
    if (now - start_time < 30000 && upward_moving_group.currentY > -710) {
      requestAnimationFrame(animateLoading);
    }
  }
  //animateLoading();
  //   console.log("===== 1 - LOADER CHARGER =====");
});










// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ======================================================================
// =======================       FULLPAGE.JS     ========================
// ======================================================================
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++




//FULLPAGE.JS
//====================================================================================================




var currentSection = -1;
var currentSlideIndex = -1;


//FULLPAGE OPTIONS ACTIVEES
//====================================================================================================

$(document).ready(function() {
    
    $('#fullpage').fullpage({
            anchors: ['firstPage', 'secondPage', '3rdPage', '4thPage'],
            menu: '#menu',
            easingcss3: 'cubic-bezier(0.175, 0.885, 0.320, 1.275)',


        
            onLeave: function(index, nextIndex, direction){
						// console.log("onLeave--" + "index: " + index + " nextIndex: " + nextIndex + " direction: " +  direction);
                  if(currentSection == 3 && currentSlideIndex == 1){
                    $.fn.fullpage.moveSlideLeft();
                  }
                },
            afterLoad: function(anchorLink, index){
						// console.log("afterLoad--" + "anchorLink: " + anchorLink + " index: " + index );
//                if(anchorLink == '3rdPage/1' && index == 3) {
//                    $.fn.fullpage.setAllowScrolling(false);
//                    console.log("Scroll OFF");
//                    normalScrollElements: '.scrollable-element',
//                    console.log("NormalScrollElements ON afterLoad");
//                } else {
//                    $.fn.fullpage.setAllowScrolling(true);
//                    console.log("Scroll ON afterLoad");
//                }
                currentSection = index;
					},
        
            onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex){
						//console.log("onSlideLeave -- Quand on quitte le slide " + "ayant pour anchorLink: " + anchorLink + " et ayant l'index: " + index + " avec le slideIndex: " + slideIndex + " On part dans la direction: " + direction + " pour le Prochain Slide d'Index: " + nextSlideIndex);
//                if(anchorLink == '3rdPage/1' && index == 3 && slideIndex == 1) {
//                    $.fn.fullpage.setAllowScrolling(false);
//                    console.log("Scroll OFF");
//                    normalScrollElements: '.scrollable-element',
//                    console.log("NormalScrollElements ON onSlideLeave");
//                } else {
//                    $.fn.fullpage.setAllowScrolling(true);
//                    console.log("Scroll ON onSlideLeave");
//                }
                        if(index == 3 && slideIndex == 0 && direction == 'right'){
			             $.fn.fullpage.setAllowScrolling(false);
                        $.fn.fullpage.setKeyboardScrolling(false);
                            normalScrollElements: '.scrollable-element'
                            //console.log("SCROLL OFF onSlideLeave");
		              } else {
                         $.fn.fullpage.setAllowScrolling(true);
                          $.fn.fullpage.setKeyboardScrolling(true);
                           // console.log("SCROLL ON onSlideLeave");
                      }
					},
        
            afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){
            //    console.log("afterSlideLoad--" + "anchorLink: " + anchorLink + " index: " + index + " slideAnchor: " + slideAnchor + " slideIndex: " + slideIndex);
//                if(index == 3 && slideAnchor == 1 && slideIndex == 1) {
//                    $.fn.fullpage.setAllowScrolling(false);
//                    console.log("Scroll OFF");
//                    normalScrollElements: '.scrollable-element',
//                    console.log("NormalScrollElements ON afterSlideLoad");
//                }
                if(index == 3 && slideIndex == 1){
                    $.fn.fullpage.setAllowScrolling(false);
                    $.fn.fullpage.setKeyboardScrolling(false);
                   // console.log("SCROLL est OFF");
                }
                currentSlideIndex = slideIndex;
            }
    });


    $(".scrollOn").click(function(){
                $.fn.fullpage.setAllowScrolling(true);
               // console.log("Scroll ON itemMenu");
    });
    
    $(".scrollOFF").click(function(){
                $.fn.fullpage.setAllowScrolling(false);
           //     console.log("Scroll OFF itemMenu");
    });
    
   // console.log("===== 2 - FULLPAGE JS CHARGED =====");
    
});










// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ======================================================================
// =======================    CONSTELLATION        ======================
// ======================================================================
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function Constellation(i) {
    function n() {
        this.x = Math.random() * i.width, this.y = Math.random() * i.height, this.vx = t.config.velocity - .5 * Math.random(), this.vy = t.config.velocity - .5 * Math.random(), this.radius = Math.random()
    }
    var t = this,
        o = i.getContext("2d");
    n.prototype = {
        create: function() {
            o.beginPath(), o.arc(this.x, this.y, this.radius, 0, 2 * Math.PI, !1), o.fill()
        },
        animate: function() {
            var n;
            for (n = 0; n < t.config.length; n++) {
                var o = t.config.stars[n];
                o.y < 0 || o.y > i.height ? (o.y = 0, o.vx = o.vx, o.vy = -o.vy) : (o.x < 0 || o.x > i.width) && (o.x = 0, o.vx = -o.vx, o.vy = o.vy), o.x += o.vx, o.y += o.vy
            }
        },
        line: function() {
            var i, n, e, a, c = t.config.length;
            for (e = 0; c > e; e++)
                for (a = 0; c > a; a++) i = t.config.stars[e], n = t.config.stars[a], i.x - n.x < t.config.distance && i.y - n.y < t.config.distance && i.x - n.x > -t.config.distance && i.y - n.y > -t.config.distance && i.x - t.config.position.x < t.config.radius && i.y - t.config.position.y < t.config.radius && i.x - t.config.position.x > -t.config.radius && i.y - t.config.position.y > -t.config.radius && (o.beginPath(), o.moveTo(i.x, i.y), o.lineTo(n.x, n.y), o.stroke(), o.closePath())
        }
    }, t.config = {
        star: {
            color: "rgba(255, 255, 255, .5)"
        },
        line: {
            color: "rgba(255, 255, 255, .2)",
            width: .2
        },
        position: {
            x: .5 * i.width,
            y: .5 * i.height
        },
        velocity: .1,
        length: 160,
        distance: 150,
        radius: 200,
        stars: []
    }, t.createStars = function() {
        var e, a, c = t.config.length;
        for (o.clearRect(0, 0, i.width, i.height), a = 0; c > a; a++) t.config.stars.push(new n), e = t.config.stars[a], e.create();
        e.line(), e.animate()
    }, t.setCanvas = function() {
        i.width = window.innerWidth, i.height = window.innerHeight
    }, t.setContext = function() {
        o.fillStyle = t.config.star.color, o.strokeStyle = t.config.line.color, o.lineWidth = t.config.line.width
    }, t.loop = function(i) {
        i(), reqAnimFrame(function() {
            t.loop(i)
        })
    }, t.bind = function() {
        $(window).on("mousemove", function(i) {
            t.config.position.x = i.pageX, t.config.position.y = i.pageY
        }).on("resize", function() {
            t.setCanvas(), t.setContext()
        })
    }, t.init = function() {
        t.setCanvas(), t.setContext(), t.loop(function() {
            t.createStars()
        }), t.bind()
    }
}
var reqAnimFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function(i) {
        window.setTimeout(i, 1e3 / 60)
    },
    app = window.app || {};
app.bind = function() {
    var i = this;
    $(document).on("readystatechange", function() {
        "complete" === document.readyState && i.constellation.init()
    })
}, app.init = function() {
    app.constellation = new Constellation($("#background")[0]), this.bind()
   // console.log("===== 3 - CONSTELLATION CHARGED =====");
}, app.init();














// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ======================================================================
// ===================== ANIMATED MENU JS           =====================
// ======================================================================
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$(document).ready(function(){
  
  /* 
   *  General event binding
   */
  (function() {
    var className = {
      forMenuOpenState: "is-open",
      forNoScrolling: "no-scroll"
    };
    
    var selector = {
      forMenuToggleButton: ".js-menuToggle",
      forMenuContainer: ".js-menu",
      forAnimatedMenuIcon: ".js-animatedMenuIcon",
      forNavLink: ".navLink"
    };
      
    var menuState = false;
    
    // Handle nav menu show/hide
    function _bindNavMenuHandler() {


      $(selector.forMenuToggleButton).on("click", function() {
        menuState = !menuState;

          $(selector.forAnimatedMenuIcon).toggleClass(className.forMenuOpenState);
        $(selector.forMenuContainer).toggleClass(className.forMenuOpenState);
        
        $("body").toggleClass(className.forNoScrolling);
      });
    }
      
    function _closeNavMenuHandler() {
        
        $(selector.forNavLink).on("click", function() {
            console.log("navLink");
            console.log();
            $(selector.forAnimatedMenuIcon).removeClass(className.forMenuOpenState);
            $(selector.forMenuContainer).removeClass(className.forMenuOpenState);
            $("body").removeClass(className.forNoScrolling);
            if( $(this)[0].hash == "#3rdPage" && currentSection == 3 && currentSlideIndex == 1) {
              $.fn.fullpage.moveSlideLeft();
            }
        });
    }
      
    function init() {
      _bindNavMenuHandler();
      _closeNavMenuHandler();
    }

        
    init();
      
    
//console.log("===== 4 - ANIMATION MENU CHARGED =====");
  }());
  

});










// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ======================================================================
// ===================== SEARCH UI EFFECT           =====================
// ======================================================================
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

;(function(window) {

	'use strict';

	var mainContainer = document.querySelector('.main-wrap'),
		openCtrl = document.getElementById('btn-search'),
		closeCtrl = document.getElementById('btn-search-close'),
		searchContainer = document.querySelector('.search'),
		inputSearch = searchContainer.querySelector('.search__input');

	function init() {
		initEvents();	
	}

	function initEvents() {
		openCtrl.addEventListener('click', openSearch);
		closeCtrl.addEventListener('click', closeSearch);
		document.addEventListener('keyup', function(ev) {
			// escape key.
			if( ev.keyCode == 27 ) {
				closeSearch();
			}
		});
	}

	function openSearch() {
		mainContainer.classList.add('main-wrap--move');
		searchContainer.classList.add('search--open');
		setTimeout(function() {
			inputSearch.focus();
		}, 600);
	}

	function closeSearch() {
		mainContainer.classList.remove('main-wrap--move');
		searchContainer.classList.remove('search--open');
		inputSearch.blur();
		inputSearch.value = '';
	}

	init();
//console.log("===== 5 - SEARCH UI CHARGED =====");
})(window);













// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ======================================================================
// =====================    ANIMATED HEADLINES        ===================
// ======================================================================
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

jQuery(document).ready(function($){
	//set animation timing
	var animationDelay = 2500,
		//letters effect
		lettersDelay = 50,
		//type effect
		typeLettersDelay = 150,
		selectionDuration = 500,
		typeAnimationDelay = selectionDuration + 800;
	
	initHeadline();
	

	function initHeadline() {
		//insert <i> element for each letter of a changing word
		singleLetters($('.cd-headline.letters').find('b'));
		//initialise headline animation
		animateHeadline($('.cd-headline'));
	}

	function singleLetters($words) {
		$words.each(function(){
			var word = $(this),
				letters = word.text().split(''),
				selected = word.hasClass('is-visible');
			for (i in letters) {
				if(word.parents('.rotate-2').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
				letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>': '<i>' + letters[i] + '</i>';
			}
		    var newLetters = letters.join('');
		    word.html(newLetters).css('opacity', 1);
		});
	}

	function animateHeadline($headlines) {
		var duration = animationDelay;
		$headlines.each(function(){
			var headline = $(this);
			
            if (!headline.hasClass('type') ) {
				//assign to .cd-words-wrapper the width of its longest word
				var words = headline.find('.cd-words-wrapper b'),
					width = 0;
				words.each(function(){
					var wordWidth = $(this).width();
				    if (wordWidth > width) width = wordWidth;
				});
				headline.find('.cd-words-wrapper').css('width', width);
			};

			//trigger animation
			setTimeout(function(){ hideWord( headline.find('.is-visible').eq(0) ) }, duration);
		});
	}

	function hideWord($word) {
		var nextWord = takeNext($word);
		
		if($word.parents('.cd-headline').hasClass('type')) {
			var parentSpan = $word.parent('.cd-words-wrapper');
			parentSpan.addClass('selected').removeClass('waiting');	
			setTimeout(function(){ 
				parentSpan.removeClass('selected'); 
				$word.removeClass('is-visible').addClass('is-hidden').children('i').removeClass('in').addClass('out');
			}, selectionDuration);
			setTimeout(function(){ showWord(nextWord, typeLettersDelay) }, typeAnimationDelay);

		} else {
			switchWord($word, nextWord);
			setTimeout(function(){ hideWord(nextWord) }, animationDelay);
		}
	}

	function showWord($word, $duration) {
		if($word.parents('.cd-headline').hasClass('type')) {
			showLetter($word.find('i').eq(0), $word, false, $duration);
			$word.addClass('is-visible').removeClass('is-hidden');
		}
	}

	function hideLetter($letter, $word, $bool, $duration) {
		$letter.removeClass('in').addClass('out');
		
		if(!$letter.is(':last-child')) {
		 	setTimeout(function(){ hideLetter($letter.next(), $word, $bool, $duration); }, $duration);  
		} else if($bool) { 
		 	setTimeout(function(){ hideWord(takeNext($word)) }, animationDelay);
		}

		if($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
			var nextWord = takeNext($word);
			switchWord($word, nextWord);
		} 
	}

	function showLetter($letter, $word, $bool, $duration) {
		$letter.addClass('in').removeClass('out');
		
		if(!$letter.is(':last-child')) { 
			setTimeout(function(){ showLetter($letter.next(), $word, $bool, $duration); }, $duration); 
		} else { 
			if($word.parents('.cd-headline').hasClass('type')) { setTimeout(function(){ $word.parents('.cd-words-wrapper').addClass('waiting'); }, 200);}
			if(!$bool) { setTimeout(function(){ hideWord($word) }, animationDelay) }
		}
	}

	function takeNext($word) {
		return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
	}

	function takePrev($word) {
		return (!$word.is(':first-child')) ? $word.prev() : $word.parent().children().last();
	}

	function switchWord($oldWord, $newWord) {
		$oldWord.removeClass('is-visible').addClass('is-hidden');
		$newWord.removeClass('is-hidden').addClass('is-visible');
	}
    
   // console.log("===== 6 - ANIMATED HEADLINE CHARGED =====");
}); 

    















// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ======================================================================
// =================== MINIMAL CONTACT FORM           ===================
// ======================================================================
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



//CUSTOM MODERNIZR FOR MINIMAL CONTACT FORM
//====================================================================================================

;window.Modernizr=function(a,b,c){function x(a){j.cssText=a}function y(a,b){return x(prefixes.join(a+";")+(b||""))}function z(a,b){return typeof a===b}function A(a,b){return!!~(""+a).indexOf(b)}function B(a,b){for(var d in a){var e=a[d];if(!A(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function C(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:z(f,"function")?f.bind(d||b):f}return!1}function D(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+n.join(d+" ")+d).split(" ");return z(b,"string")||z(b,"undefined")?B(e,b):(e=(a+" "+o.join(d+" ")+d).split(" "),C(e,b,c))}var d="2.7.1",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m="Webkit Moz O ms",n=m.split(" "),o=m.toLowerCase().split(" "),p={},q={},r={},s=[],t=s.slice,u,v={}.hasOwnProperty,w;!z(v,"undefined")&&!z(v.call,"undefined")?w=function(a,b){return v.call(a,b)}:w=function(a,b){return b in a&&z(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=t.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(t.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(t.call(arguments)))};return e}),p.csstransitions=function(){return D("transition")};for(var E in p)w(p,E)&&(u=E.toLowerCase(),e[u]=p[E](),s.push((e[u]?"":"no-")+u));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)w(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},x(""),i=k=null,function(a,b){function l(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function m(){var a=s.elements;return typeof a=="string"?a.split(" "):a}function n(a){var b=j[a[h]];return b||(b={},i++,a[h]=i,j[i]=b),b}function o(a,c,d){c||(c=b);if(k)return c.createElement(a);d||(d=n(c));var g;return d.cache[a]?g=d.cache[a].cloneNode():f.test(a)?g=(d.cache[a]=d.createElem(a)).cloneNode():g=d.createElem(a),g.canHaveChildren&&!e.test(a)&&!g.tagUrn?d.frag.appendChild(g):g}function p(a,c){a||(a=b);if(k)return a.createDocumentFragment();c=c||n(a);var d=c.frag.cloneNode(),e=0,f=m(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function q(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return s.shivMethods?o(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+m().join().replace(/[\w\-]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(s,b.frag)}function r(a){a||(a=b);var c=n(a);return s.shivCSS&&!g&&!c.hasCSS&&(c.hasCSS=!!l(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),k||q(a,c),a}var c="3.7.0",d=a.html5||{},e=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,f=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,g,h="_html5shiv",i=0,j={},k;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",g="hidden"in a,k=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){g=!0,k=!0}})();var s={elements:d.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",version:c,shivCSS:d.shivCSS!==!1,supportsUnknownElements:k,shivMethods:d.shivMethods!==!1,type:"default",shivDocument:r,createElement:o,createDocumentFragment:p};a.html5=s,r(b)}(this,b),e._version=d,e._domPrefixes=o,e._cssomPrefixes=n,e.testProp=function(a){return B([a])},e.testAllProps=D,e.prefixed=function(a,b,c){return b?D(a,b,c):D(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+s.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};








//CLASSIE.JS  FOR CONTACT MINIMAL FORM
//====================================================================================================

/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false */

( function( window ) {

'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else {
  // browser global
  window.classie = classie;
}

})( window );









//STEPS FORM FOR MINIMAL FORM
//====================================================================================================

;( function( window ) {
	
	'use strict';

	var transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		support = { transitions : Modernizr.csstransitions };

	function extend( a, b ) {
		for( var key in b ) { 
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function stepsForm( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
  		extend( this.options, options );
  		this._init();
	}

	stepsForm.prototype.options = {
		onSubmit : function() { return false; }
	};

	stepsForm.prototype._init = function() {
		// current question
		this.current = 0;

		// questions
		this.questions = [].slice.call( this.el.querySelectorAll( 'ol.questions > li' ) );
		// total questions
		this.questionsCount = this.questions.length;
		// show first question
		classie.addClass( this.questions[0], 'current' );
		
		// next question control
		this.ctrlNext = this.el.querySelector( 'button.next' );

		// progress bar
		this.progress = this.el.querySelector( 'div.progress' );
		
		// question number status
		this.questionStatus = this.el.querySelector( 'span.number' );
		// current question placeholder
		this.currentNum = this.questionStatus.querySelector( 'span.number-current' );
		this.currentNum.innerHTML = Number( this.current + 1 );
		// total questions placeholder
		this.totalQuestionNum = this.questionStatus.querySelector( 'span.number-total' );
		this.totalQuestionNum.innerHTML = this.questionsCount;

		// error message
		this.error = this.el.querySelector( 'span.error-message' );
		
		// init events
		this._initEvents();
	};

	stepsForm.prototype._initEvents = function() {
		var self = this,
			// first input
			firstElInput = this.questions[ this.current ].querySelector( 'input' ),
			// focus
			onFocusStartFn = function() {
				firstElInput.removeEventListener( 'focus', onFocusStartFn );
				classie.addClass( self.ctrlNext, 'show' );
			};

		// show the next question control first time the input gets focused
		firstElInput.addEventListener( 'focus', onFocusStartFn );

		// show next question
		this.ctrlNext.addEventListener( 'click', function( ev ) { 
			ev.preventDefault();
			self._nextQuestion(); 
		} );

		// pressing enter will jump to next question
		document.addEventListener( 'keydown', function( ev ) {
			var keyCode = ev.keyCode || ev.which;
			// enter
			if( keyCode === 13 ) {
				ev.preventDefault();
				self._nextQuestion();
			}
		} );

		// disable tab
		this.el.addEventListener( 'keydown', function( ev ) {
			var keyCode = ev.keyCode || ev.which;
			// tab
			if( keyCode === 9 ) {
				ev.preventDefault();
			} 
		} );
	};

	stepsForm.prototype._nextQuestion = function() {
		if( !this._validade() ) {
			return false;
		}

		// check if form is filled
		if( this.current === this.questionsCount - 1 ) {
			this.isFilled = true;
		}

		// clear any previous error messages
		this._clearError();

		// current question
		var currentQuestion = this.questions[ this.current ];

		// increment current question iterator
		++this.current;

		// update progress bar
		this._progress();

		if( !this.isFilled ) {
			// change the current question number/status
			this._updateQuestionNumber();

			// add class "show-next" to form element (start animations)
			classie.addClass( this.el, 'show-next' );

			// remove class "current" from current question and add it to the next one
			// current question
			var nextQuestion = this.questions[ this.current ];
			classie.removeClass( currentQuestion, 'current' );
			classie.addClass( nextQuestion, 'current' );
		}

		// after animation ends, remove class "show-next" from form element and change current question placeholder
		var self = this,
			onEndTransitionFn = function( ev ) {
				if( support.transitions ) {
					this.removeEventListener( transEndEventName, onEndTransitionFn );
				}
				if( self.isFilled ) {
					self._submit();
				}
				else {
					classie.removeClass( self.el, 'show-next' );
					self.currentNum.innerHTML = self.nextQuestionNum.innerHTML;
					self.questionStatus.removeChild( self.nextQuestionNum );
					// force the focus on the next input
					nextQuestion.querySelector( 'input' ).focus();
				}
			};

		if( support.transitions ) {
			this.progress.addEventListener( transEndEventName, onEndTransitionFn );
		}
		else {
			onEndTransitionFn();
		}
	}

	// updates the progress bar by setting its width
	stepsForm.prototype._progress = function() {
		this.progress.style.width = this.current * ( 100 / this.questionsCount ) + '%';
	}

	// changes the current question number
	stepsForm.prototype._updateQuestionNumber = function() {
		// first, create next question number placeholder
		this.nextQuestionNum = document.createElement( 'span' );
		this.nextQuestionNum.className = 'number-next';
		this.nextQuestionNum.innerHTML = Number( this.current + 1 );
		// insert it in the DOM
		this.questionStatus.appendChild( this.nextQuestionNum );
	}

	// submits the form
	stepsForm.prototype._submit = function() {
		this.options.onSubmit( this.el );
	}

	// TODO (next version..)
	// the validation function
	stepsForm.prototype._validade = function() {
		// current question´s input
		var input = this.questions[ this.current ].querySelector( 'input' ).value;
        
        var email = document.forms["theForm"]["q3"].value;
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        
		if( input === '' ) {
			this._showError( 'EMPTYSTR' );
			return false;
		}
        
        if (email != ''){
            if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
                this._showError( 'INVALIDEMAIL' );
                return false;
            }
            return true;
        }

		return true;
	}

	// TODO (next version..)
	stepsForm.prototype._showError = function( err ) {
		var message = '';
		switch( err ) {
			case 'EMPTYSTR' : 
				message = 'Remplissez le champ avant de continuer svp';
				break;
			case 'INVALIDEMAIL' : 
				message = 'Ceci n\'est pas une adresse mail valide';
				break;
			// ...
		};
		this.error.innerHTML = message;
		classie.addClass( this.error, 'show' );
	}

	// clears/hides the current error message
	stepsForm.prototype._clearError = function() {
		classie.removeClass( this.error, 'show' );
	}

	// add to global namespace
	window.stepsForm = stepsForm;
    
   // console.log("===== 8 - CONTACT FORM CHARGED =====");

})( window );

			var theForm = document.getElementById( 'theForm' );

			new stepsForm( theForm, {
				onSubmit : function( form ) {
					// hide form
					classie.addClass( theForm.querySelector( '.simform-inner' ), 'hide' );

					/*
					form.submit()
					or
					AJAX request (maybe show loading indicator while we don't have an answer..)
					*/

					// let's just simulate something...
					var messageEl = theForm.querySelector( '.final-message' );
					messageEl.innerHTML = 'Merci, votre message a bien été envoyé';
					classie.addClass( messageEl, 'show' );
				}
			} );













//FIN DU LOADER
//====================================================================================================

// When all the files were been loaded
$(window).load(function() {
    
    	// Fade Out for the loading after 3s
	setTimeout(function() {
		$("#page").addClass("fadeOut animated-middle");
       // console.log("===== 1 - page fadeout =====");
	}, 50); //3000
    
    	// Display none for the loading after 1s
	setTimeout(function() {
		$("#page").addClass("displayNone").removeClass("fadeOut animated-middle");
      //  console.log(" 2 - La #page a ete enlevée ");
	}, 10); //1000

});

// Scrollable function for keep scroll on episode after hide scrollbar
$(document).ready(function() {



    jQuery( ".news" ).on( "click", function() {
        $("#div1").hide();
        $.get( "http://blog/api/get-news-"+ $(this).attr("id"), function( data ) {
            $( "#div2" ).html( data );
            $('.scrollable-element').bind('mousewheel', function(event) {
                event.preventDefault();
                var scrollTop = this.scrollTop;
                this.scrollTop = (scrollTop + ((event.deltaY * event.deltaFactor) * -1));
                //console.log(event.deltaY, event.deltaFactor, event.originalEvent.deltaMode, event.originalEvent.wheelDelta);
            });
        });
        $("#div2").show('fast');
    });

});

$(function() {
    $("body").on("click", ".retour", function () {
        console.log("Clic sur Retour");
        $("#div2").hide();
        console.log("div2 vidée");
        $("#div1").show('fast');
    });

    $("body").on("click", ".report", function () {
        console.log("Clic sur Report");
        $.get( "http://blog/api/comment-report-"+ $(this).attr("id"), function( data ) {
            $('#alert').show().slideDown(500).delay(2000).slideUp();
        });
    });

    $("body").on("click", ".add", function () {
        console.log("Clic sur add");
        var newsID = $(this).attr("id");
        $.get( "http://blog/api/comment-"+ $(this).attr("id"), function( data ) {
            $( "#div2" ).html( data );
            $(".combtn").on("click", function() {
                console.log("Clic sur comment Post newsID: " + newsID);
                $.post("http://blog/api/comment-"+ newsID,
                 {
                 news : newsID,
                 auteur : $("#auteur").val(),
                 content : $("#content").val(),
                 state : 0
                 });
                console.log("newsID: " + newsID + " - auteur : " + $("#auteur").val() + " - content : " + $("#content").val() );
            });
        });
    });


});

/*
 api/get-news-<?= $news['id'] ?>#3rdPage/1
*/

















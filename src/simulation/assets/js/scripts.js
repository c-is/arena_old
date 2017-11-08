import $ from 'jquery';
import route from 'riot-route';
import { decodeHtmlEntity, mobilecheck, getOrientation, getUrlVars, readCookie } from './app/globals';
import {TweenMax} from "gsap";
import classie from 'classie';
import Ps from 'perfect-scrollbar';
import {Base, strageValue, orderLink, newOrderLink, styleNum} from './app/base.js';
import ColourFunction from './app/app.js';

let Encoding = require('encoding-japanese');

'use strict';

let fontServer = 'https://mark.arena-jp.com/simulation/servlet/MarkSample';
let eventtype = 'click';
let eventtype2 = mobilecheck() ? 'touchstart' : 'click';
let headerHeight = $('.header').outerHeight();
let orderInfoActive = false;
let orderLinkActive = false;

$(() => {
	route.start(true);
	route.base('/simulation');

	let simulation;

	scrollEvents.topScroll();
	scrollEvents.scrollNav();
	scrollEvents.scrollNavDisplay();
	scrollEvents.scrollBottom();
	globalEvents();

	
	if($('body').hasClass('single-post')) {
		
		simulation = new SimulationCommon();
		
		orderMenu.styleRegistration();
		orderMenu.orderSheet();	
		orderMenu.orderInfoShow();
		orderMenu.orderLinkMake();

		if (!mobilecheck()) scrollEvents.scrollBarStyle();
	}

});

let globalEvents = () => {
	$(document).on(eventtype, '.js-popup-trigger', (event)=> {
		popups.popup(event);
	});
	$(document).on(eventtype, '.js-popup-close', (event) => {
		popups.popupClose(event);
	});
}

let scrollEvents = {
	topScroll: function topScroll() {
		$(document).on(eventtype, '.js-scroll-link', (event) => {
			event.preventDefault();
			let tar = $(event.currentTarget).attr('href');
			let bannerHeight = $(tar).find('.item-head').outerHeight();
			let tarTop = $(tar).offset().top + bannerHeight - headerHeight + 2;

			$('html, body').animate({ scrollTop: tarTop });
		})
	},
	scrollNavDisplay: function scrollNavDisplay() {
		let elHeight = $('.custom-menu').height() - $('.custom-menu__tabs').height();
		let innerElHeight = $('.custom-menu__content.active').height();
		if (elHeight < innerElHeight) {
			TweenMax.set('.js-read-more', { autoAlpha: 1 });
		} else {
			TweenMax.set('.js-read-more', { autoAlpha: 0 });
		}
	},
	scrollNav: function scrollNav() {
		$('.custom-menu').on('scroll', (event) => {
			let elTop = $(event.currentTarget).scrollTop();
			let elHeight = $(event.currentTarget).height();
			if (elTop == 0) {
				TweenMax.to('.js-read-more', 0.4, { autoAlpha: 1 });
			} else {
				TweenMax.to('.js-read-more', 0.4, { autoAlpha: 0 });
			}
		});
	},
	scrollBottom: function scrollBottom() {
		$(document).on('click', '.js-read-more', () => {
			let elHeight = $(event.currentTarget).height();
			$('.custom-menu').animate({ scrollTop: elHeight });
		});
	},
	scrollBarStyle: function scrollBarStyle () {
		let el = document.querySelector('.custom-menu');
		setTimeout(() => {
			Ps.initialize(el, {
				wheelSpeed: 3,
				minScrollbarLength: 5
			});
		}, 400);
	},
}

let popups = {
	popup: function popup(event) {
		event.preventDefault();

		let popupTar = $(event.currentTarget).attr('data-popup');
		TweenMax.to(popupTar, 0.4, { y: '0%' });
	},
	popupClose: function popupClose(event) {
		event.preventDefault();
		TweenMax.to('.js-popup', 0.4, { y: '100%' });
	}
}

let orderMenu = {
	styleRegistration: function styleRegistration () {
		if (mobilecheck()) {
			$('.navigation-style__list').on(eventtype, '.button--remove', (event) => {
				removeFn(event);
			});
		} else {
			$('.header-style__list').on(eventtype, '.icon', (event) => {
				removeFn(event);
			});
		}

		function removeFn(event) {
			let $tar = (mobilecheck()) ? $(event.currentTarget).parent() : $(event.currentTarget).parent().find('a');
			let styleName = (mobilecheck()) ? $tar.children('.navigation-style__head').text().toLowerCase() : $tar.text().toLowerCase();
			let num = $(event.currentTarget).parent().attr('data-number');
			let $styleList = $(`.js-order-sheet-list li[data-number=${num}]`);

			$styleList.remove();

			$tar.removeClass('registered').removeClass('active');
			readCookie.setItem(styleName, 0, null, '/simulation/');


			if (mobilecheck()) {
				$(event.currentTarget).parent().find('.navigation-style__desc').html("- 未保存 -");
				$(event.currentTarget).remove();
			}
		}
	},
	orderInfo: function orderInfo() {
		if (mobilecheck() && getOrientation() === 'Portrait') {
			TweenMax.to('.js-order-info', 0.4, { y: '0%' });
			TweenMax.to('.js-order-info-close--sp', 0.4, { autoAlpha: 1 });
		} else {
			TweenMax.to('.js-order-info', 0.4, { autoAlpha: 1 });
		}
		orderInfoActive = true;
	},
	orderInfoHide: function orderInfoHide() {
		if (mobilecheck() && getOrientation() === 'Portrait') {
			TweenMax.to('.js-order-info', 0.4, { y: '100%' });
			TweenMax.to('.js-order-info-close--sp', 0.4, { autoAlpha: 0 });
		} else {
			TweenMax.to('.js-order-info', 0.4, { autoAlpha: 0 });
		}
		orderInfoActive = false;

	},
	orderInfoShow: function orderInfoShow() {
		$(document).on('click', '.js-order-info-close--sp', (event) => {
			event.preventDefault();
			if (orderInfoActive) {
				TweenMax.to('.js-order-info', 0.4, { y: '100%' });
				$(event.currentTarget).addClass('show');
				orderInfoActive = false;
			} else {
				TweenMax.to('.js-order-info', 0.4, { y: '0%' });
				$(event.currentTarget).removeClass('show');
				orderInfoActive = true;
			}
		})
	},
	orderSheet: function orderSheet() {
		$(document).on(eventtype, '.js-order-sheet', (event) => {
			event.preventDefault();

			window.history.pushState({}, 'order', newOrderLink); //output the values set in the localStrage
			orderLinkActive = true;
		});
		$(document).on(eventtype, '.js-order-sheet-list li', (event) => {
			let $pick = $('.js-order-sheet-pick');
			if (!$(event.currentTarget).hasClass('active')){
				$(event.currentTarget).addClass('active');
			} else {
				$(event.currentTarget).removeClass('active');
			}
		});
	},
	orderLinkMake: function orderLinkMake(event) {
		$(document).on(eventtype, '.js-order-link-make', (event) => {
			event.preventDefault();
			let sendURL = $(event.currentTarget).attr('data-send');
			let styleInfo = '';
			$('.js-order-sheet-list li.active').each((i, el)=> {
				styleInfo = `${styleInfo}&${decodeURIComponent($(el).attr('data-style'))}`;
			});
			//let base = new Base;
			if($('.js-order-sheet-list li.active').length > 0) {
				window.location.href = `https:${sendURL}${styleInfo}`;
			}
		});
	}
};

class SimulationCommon extends Base {
	constructor(options) {
		super(options);

		this.path = "/simulation/wpcms/wp-content/uploads/";
		this.markPickActive = false;
		this.markOptions = [ 'a','b','c','j','k','d', 'i', 'l', 'e', 'm', 'n', 'f', 'l', 'g', 'o' ];


		let slug = window.location.href.split('?')[0].split('/').pop();
		this.jsonPath = `/simulation/wp-json/wp/v2/posts/?slug=${slug}`;
		
		this.events();
		this.default();
	}
	default() {
		// set the url for the json
		this.render();
	}
	render() {
		this.setStyleByCookie();
		new ColourFunction({ 'jsonUrl': this.jsonPath, 'callback': () => {
			this.markSetAsStart();
			TweenMax.to('.js-base-display', 0.4, { autoAlpha: 1 });
		}});
	}
	events() {
		$(document).on(eventtype2, '.js-rotation', (event) => {
			event.preventDefault();
			this.rotation(event);
		});
		$(document).on(eventtype, '.js-modal', (event)=> {
			this.modals(event);
		});

		//mark events
		$('.js-colour--mark').on(eventtype, 'li', (event) => {
			this.changeColours(event);
			return false;
		});
		$('.js-mark-pick').on(eventtype, 'a', (event) => {
			this.markPick(event);
			return false;
		});
		$('.custom-pick__input').on(eventtype, '.js-mark-submit', (event) => {
			this.markText(event);
			return false;
		});
		$('.js-mark-pos').on(eventtype, 'a', (event) => {
			this.markPosPick(event);
			return false;
		});
		$('.js-mark-family').on('change', 'input', (event) => {
			this.markFamily(event);
		});

		$('.custom-menu__tabs').on(eventtype, 'li', (event)=> {
			this.tabs(event);
		});

		if (mobilecheck()) {
			$(document).on(eventtype2, '.custom-menu__head', (event) =>{
				this.tapMenu(event);
			});
		}
	}
	tabs (event) {
		let tabName = $(event.currentTarget).attr('data-tab');
		$('.custom-menu__tabs li').removeClass('active');
		$('.custom-menu__content').removeClass('active');
		$(event.currentTarget).addClass('active');
		$(tabName).addClass('active');
		scrollEvents.scrollNavDisplay();

		//update the scrollbar height
		let el = document.querySelector('.custom-menu');
		Ps.update(el);
	}
	tapMenu(event) {
		let $el = $('.custom-menu__content');
		let $tar = $(event.currentTarget).next().next();
		let $tapNav = $('.custom-menu__tap');
		let $tapTar = $(event.currentTarget).next();

		$el.removeClass('active');
		$tar.addClass('active');
		$tapNav.removeClass('is-hidden');
		$tapTar.addClass('is-hidden');
	}
	modals(event) {
		event.preventDefault();

		let modalTar = $(event.currentTarget).attr('data-modal');
		
		if (!$(event.currentTarget).hasClass('active')) {
			$(event.currentTarget).addClass('active');
			TweenMax.to(modalTar, 0.4, { autoAlpha: 1 });
		} else {
			$(event.currentTarget).removeClass('active');
			TweenMax.to(modalTar, 0.4, { autoAlpha: 0 });
		}

		$('.content').on(eventtype, ':not(.modal)', ()=> {
			this.modalClose(event.currentTarget, modalTar);
		});
	}
	modalClose(el, target) {
		$(el).removeClass('active');
		TweenMax.to(target, 0.4, { autoAlpha: 0 });
	}
	rotation (event) {
		let data = $('.js-rotation').attr('data-svg');
		let rotationDir = $('.js-rotation').attr('data-rotation');

		//front or back
		if (rotationDir === 'front') {
			$('.js-base-display').load(`${ this.path }${ data }_back.svg`, () => {
				this.restyle();
			});
			$('.js-rotation').attr('data-rotation', 'back');
		} else {
			$('.js-base-display').load(`${ this.path }${ data }.svg`, () => {
				this.restyle();
			});
			$('.js-rotation').attr('data-rotation', 'front');
		}
	}
	markSetAsStart() {
		// add mark text info at start
		if (getUrlVars().mark && getUrlVars().mark !== '') {
			strageValue['mark'] = getUrlVars().mark;
			orderLink['mark'] = getUrlVars().mark;
		}
		// apply if there are queries
		if (getUrlVars().pos && getUrlVars().pos !== '') { 
			//set initial localStrage
			console.log('with query');
			if (getUrlVars().mark && getUrlVars().mark !== '') {
				console.log('show order');
				orderMenu.orderInfo();
			}
			this.reloadPage();
		} else {
			//apply no-mark option to dom and localStrage
			console.log('initial start');
			this.markPick($('.js-mark-pick .active'));
		}

		if($('.js-mark-family input:checked').attr('data-max-lang') == 'en') {
			$('.js-mark-text').addClass('disabled');
		}

	}
	markPick(event) {
		let $tarEl = (event.currentTarget) ? $(event.currentTarget) : event;

		$('.js-mark-pick a').removeClass('active');
		$tarEl.addClass('active');


		let condition = $($tarEl).attr('data-mark');
		//apply if [マーク有り] picked
		if (condition === 'on') {
			//remove overlay
			$('.custom-mark-simulation').css('overflow', 'auto');
			$('.overlay--inactive').remove();

			//retrive mark info
			let pos = $('.js-mark-pos .active').attr('data-pos');
			if (pos) {
				let markFont = $('.js-mark-family input:checked').val();
				let colour = $('.js-colour--mark').find('li.active').attr('data-colour');
				
				let $posEl = $(posTar).children(markFont).find('path');
				let posTar = `#position-${pos.toLowerCase()}`;

				TweenMax.set($posEl, { fill: colour });
				$('.js-colour--mark').attr('data-target', posTar);
			}

			//apply if mark data already exists in localStrage
			if (orderLink['mark']) {
				//update the order link following the stored localStrage info
				this.orderLinkChange();
			} else {
				//pop up order menu
				orderMenu.orderInfoHide();
			}
			
			//apply initial localStrage
			this.reloadPage();

			this.markSVGShow();
			this.markPickActive = false;
		} else {
			// apply just once
			if (!this.markPickActive) {
				//add overlay on the layer
				let overlay = document.createElement('div');
				overlay.className = 'overlay overlay--inactive';
				document.querySelector('.custom-mark-simulation').appendChild(overlay);
				$('.custom-mark-simulation').css('overflow', 'hidden');

				//update the order link (remove mark data)
				let styleNumData = styleNum || '';
				let styleData = this.styleName || '';
				let baseColourData = orderLink['bcol'] || '';
				this.currentURL = this.currentURL.split(/[?#]/)[0];
				let orderLinkOrginal = `${this.currentURL}?style${styleNumData}=${styleData}&bcol=${baseColourData}`;
				$('.js-order-save').attr('href', orderLinkOrginal);

				//update scrollbar
				Ps.update(document.querySelector('.custom-menu'));
				// set value on localStrage and change the order link
				if (!orderInfoActive) orderMenu.orderInfo();

				this.markSVGRemove();
				this.markPickActive = true;
			}
		}

		// update the scrollbar height
		let el = document.querySelector('.custom-menu');
		Ps.update(el);
	}
	markText(event) {
		let text = $('.js-mark-text').val();
		let posData = (strageValue['pos']) ? strageValue['pos'] : $('.js-mark-pos .active').attr('data-pos');
		let $tar = $('.js-mark-pos').find(`[data-pos="${posData}"]`);
		let $tar2 = $('.js-mark-family input:checked');
		let lang = $tar2.attr('data-max-lang');
		let textLength = $tar.attr(`data-max-${lang}`);

		let encodedText = encodeURIComponent(text);
		
		let jdata = `/simulation/validation/?lang=${lang}&max=${textLength}&text=${encodedText}&json`;

		$.ajax({
			url: jdata,
			dataType: 'json',
		})
		.done((data) => {
			console.log("success");
			let validation = data.validate;
			if (validation) {
				this.markTextToCanvas(text);
				let markPopup = $(event.currentTarget).attr('data-popup');
				TweenMax.to(markPopup, 0.4, { y: '0%' });
				$('.form-message').html('');
			} else {
				let message = data.message;
				$('.form-message').html(message);
			}
		})
		.fail(()=> {
			console.log("error");
		})
		.always(()=> {
			console.log("complete");
		});

		return false;
	}
	markTextToCanvas(text) {

		let posData = strageValue['pos'];
		let familyData = strageValue['font'];
		let baseColourData = strageValue['bcol'];
		let colourData = strageValue['col'];

		// convert text from UTF-8 to SJIS
		let str = text;
		if (str) {
			let imageElem = document.querySelector('.js-mark-check-image'); //Image element
			let str_array = Encoding.stringToCode(str);
			let sjis_array = Encoding.convert(str_array, "SJIS", "UNICODE");
			let convertedText = Encoding.codeToString(sjis_array);
			let sjisText = Encoding.urlEncode(sjis_array);

			imageElem.src = `${fontServer}?bcol=${baseColourData}&pos=${posData}&font=${familyData}&col=${colourData}&mark=${sjisText}`;
		}

		// show order info menu on the bottom right side
		if (!orderInfoActive && text) orderMenu.orderInfo();

		// set value on localStrage and change the order link
		strageValue['mark'] = text;
		this.setLocalStrage();
		this.orderLinkChange('mark', text);
	}
	markPosPick(event) {

		let $tarEl = (event.currentTarget) ? $(event.currentTarget) : event;

		let cate = $tarEl.parents('ul').attr('data-cate');
		let pos = $tarEl.attr('data-pos');
		let side = $tarEl.attr('data-side');
		let rotationInfo = $('.js-rotation').attr('data-rotation');
		let markFont = $('.js-mark-family input:checked').val();
		let colour = $('.js-colour--mark').find('li.active').attr('data-colour');

		$.each(this.markOptions, (index, el) => {
			let $path = $(`#position-${el}`);
			TweenMax.set($path.children().find('path'), { fill: 'none' });
		});

		if (pos) {
			let tar = `#position-${pos.toLowerCase()}`;
			let $el = $(tar).children(markFont).find('path');
			TweenMax.set($el, { fill: colour });
			$('.js-colour--mark').attr('data-target', tar);

			// rotation the item if the mark is positioned on the opposite side
			if(side !== rotationInfo) this.rotation();
		}

		$('.js-mark-pos a').removeClass('active');
		$tarEl.addClass('active');

		//update localStrage and the order link
		this.orderLinkChange(cate, pos);
		strageValue[cate] = pos;
		this.setLocalStrage();
	}
	markFamily(event) {

		let $tarEl = (event.currentTarget) ? $(event.currentTarget) : event;
		let pos = $('.js-mark-pos a.active').attr('data-pos');
		let code = $('.js-mark-family input:checked').attr('data-code');
		let colour = $('.js-colour--mark').find('li.active').attr('data-colour');
		let markFont = $('.js-mark-family input:checked').val();

		$('.js-mark-family input').prop('checked', false);
		$('.js-mark-family li').removeClass('active');
		$tarEl.prop('checked', true);
		$tarEl.parent().addClass('active');

		if ($tarEl.attr('data-max-lang') == 'en') {
			$('.js-mark-text').addClass('disabled');
			console.log('en');
		} else {
			$('.js-mark-text').removeClass('disabled');
			console.log('em');
		}

		$.each(this.markOptions, (index, el) => {
			let $path = $(`#position-${el}`);
			TweenMax.set($path.children().find('path'), { fill: 'none' });
		});

		if (pos) {
			let tar = `#position-${pos.toLowerCase()}`;
			let $el = $(tar).children(markFont).find('path');
			TweenMax.set($el, { fill: colour });
		}

		//update localStrage and the order link
		this.orderLinkChange('font', code);
		strageValue['font'] = code;
		this.setLocalStrage();
	}
	markTab(event) {
		let target = $(event.currentTarget).attr('data-tab');

		$('.js-custom-pick-tab').add('.js-mark-tab-trigger').removeClass('active');
		$(target).add(event.currentTarget).addClass('active');
	}
	markSVGRemove() {
		$.each(this.markOptions, (index, el) => {
			let $path = $(`#position-${el}`);
			TweenMax.set($path.children().find('path'), { display: 'none' });
		});
	}
	markSVGShow() {
		$.each(this.markOptions, (index, el) => {
			let $path = $(`#position-${el}`);
			TweenMax.set($path.children().find('path'), { display: 'inherit' });
		});
	}
	reloadPage() {
		let $posEl;
		let $familyEl;
		let $colEl;

		if(getUrlVars().pos) {
			$posEl = $('.js-mark-pos').find(`*[data-pos=${getUrlVars().pos}]`);
		} else {
			$posEl = $('.js-mark-pos .active');
		}
		if(getUrlVars().font) {
			$familyEl = $('.js-mark-family li').find(`*[data-code=${String(getUrlVars().font)}]`);
		} else {
			$familyEl = $('.js-mark-family input:checked');
		}
		if(getUrlVars().col) {
			$colEl = $('.js-colour--mark').find(`*[data-code=${getUrlVars().col}]`);
		} else {
			$colEl = $('.js-colour--mark').find('li.active');
		}

		this.markPosPick($posEl);
		this.markFamily($familyEl);
		this.changeColours($colEl);
	}
}


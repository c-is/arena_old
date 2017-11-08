import $ from 'jquery';
import { decodeHtmlEntity, mobilecheck, getOrientation, getUrlVars, readCookie } from './globals';
import {TweenMax} from "gsap";

export const strageValue = {};
export const orderLink = {};
export let styleNum;
export let newOrderLink = {};

export class Base {
	constructor() {
		this.currentURL = window.location.href;
		this.pageID = $('.custom-menu').attr('id');
		this.styleName = $('.js-order-save').attr('data-style');
	}
	get getStyleByCookie() {
		let cookies = ['style1', 'style2', 'style3', 'style4', 'style5'];
		let styleLinkURL = '';
		$.each(cookies, (i, el) => {
			//apply the style which ain't 0 in Cookie
			if (readCookie.getItem(`style${i+1}`) !== '0') { 
				let val = readCookie.getItem(`style${i+1}`);
				let res = decodeURIComponent(val);
				styleLinkURL = `${styleLinkURL}&style${i+1}=${res}`;
			};
		});
		return styleLinkURL; 
	}
	setStyleByCookie() {
		let cookies = ['style1', 'style2', 'style3', 'style4', 'style5'];
		$.each(cookies, (i, el) => {
			//apply the style which ain't 0 in Cookie
			if (readCookie.getItem(`style${i+1}`) == '0') { 
				styleNum = i+1;
				return false;
			}
		});
	}
	setLocalStrage(obj) {
		localStorage.setItem(this.pageID, JSON.stringify(strageValue));
	}
	orderLinkChange(key, val) {
		orderLink[key] = val;
		this.currentURL = this.currentURL.split(/[?#]/)[0];

		let styleNumData = styleNum || '';
		let styleData = this.styleName || '';
		let posData = orderLink['pos'] || '';
		let familyData = orderLink['font'] || '';
		let baseColourData = orderLink['bcol'] || '';
		let colourData = orderLink['col'] || '';
		let markData = orderLink['mark'] || '';

		newOrderLink = `${this.currentURL}?style${styleNumData}=${styleData}&bcol=${baseColourData}&pos=${posData}&font=${familyData}&col=${colourData}&mark=${markData}`;
		let directLink = `https://custom.arena-jp.com/order/index.php?module=Flash&action=CreateStyle&style1=${styleData},${baseColourData},${posData},${familyData},${colourData},${markData}`;

		$('.js-order-sheet-direct').attr('href', directLink);
		$('.js-order-save').attr('href', newOrderLink);

		$('.js-facebook-link').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(`${this.currentURL}?bcol=${baseColourData}&pos=${posData}&font=${familyData}&col=${colourData}&mark=${markData}`)}`);
		$('.js-twitter-link').attr('href', `https://twitter.com/home?status=${encodeURIComponent(`${this.currentURL}?bcol=${baseColourData}&pos=${posData}&font=${familyData}&col=${colourData}&mark=${markData}`)}`);
		$('.js-line-link').attr('href', `http://line.me/R/msg/text/?${encodeURIComponent(`${this.currentURL}?bcol=${baseColourData}&pos=${posData}&font=${familyData}&col=${colourData}&mark=${markData}`)}`);
	}
	colourDraw(chilel, colour) {
		//for the svg drawing purpose
		let stroke = $(chilel).css('stroke');
		let fill = $(chilel).css('fill');

		TweenMax.set(chilel, { fill: colour });
	}
	changeColours(event) {
		let $tarEl = (event.currentTarget) ? $(event.currentTarget) : event;

		let svg = $('.js-base-display').find('svg');
		let tar = $tarEl.parent().attr('data-target');
		let cate = $tarEl.parent().attr('data-cate');
		let svgPath;

		let colour = $tarEl.attr('data-colour');
		let code = $tarEl.attr('data-code');

		// apply if it's the cololour for the mark
		if ($tarEl.parents('.js-colour').hasClass('js-colour--mark')) {
			let markFont = $('.js-mark-family input:checked').val();
			svgPath = $(tar).children(markFont).find('path');
			$('.js-colour--mark li').removeClass('active');
			$tarEl.addClass('active');

			//set localStrage and change the order link
			this.orderLinkChange(cate, code);
			strageValue[cate] = code;
			this.setLocalStrage();
		} else {
			svgPath = $(tar).children();
			this.orderLinkChange(cate, code);
		}
		
		//draw svg
		svgPath.each((index, el) => {
			this.colourDraw(el, colour);
		});
	}
	
	restyle() {
		let svg = $('.js-base-display').find('svg');
		let strageKey = JSON.parse(localStorage.getItem(this.pageID));

		if (strageKey) {
			//loop all the selector which can be used for restyling the svg item
			$('*[data-cate]').each( (index, el) => {
				let tar = $(el).attr('data-target');
				let cate = $(el).attr('data-cate');
				let key = strageKey[cate];
				// apply if it's a category for colouring
				if ($(el).hasClass('js-colour')) {
					// apply if it's for the mark
					if ($(el).hasClass('js-colour--mark')) {
						let markFont = $('.custom-pick__fonts input:checked').val();
						let $tarEl = $(tar).children(markFont).find('path');

						let colour = $(el).find(`[data-code="${key}"]`).attr('data-colour');
						$tarEl.each((i, chilel) => {
							this.colourDraw(chilel, colour);
						});
					} else if($(el).hasClass('js-colour--gradation')) {
						let colour = $(el).find('.active').attr('data-colour');
						$('#a-color > path').css('opacity', 0);
						$(`#colourg${colour}`).css('opacity', 1 );
					} else {
						let colour = $(el).find('.active').attr('data-colour');
						$(tar).children().each((i, chilel) => {
							this.colourDraw(chilel, colour);
						});
					}
				}
			});
		}
	}
}
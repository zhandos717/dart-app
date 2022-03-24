
var date = new Date();
var month = date.getMonth() +1;

// var dataTime = new Date().toLocaleString();

$('.rf_title').text('Данi оновлено ' + date.getDate() + '.' + month + '.' + date.getFullYear() +' о ' + (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':' + '' + (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()));


$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}

// $(['/public/dia/img/icons/docac.png', '/public/dia/img/icons/posin.png', '/public/dia/img/icons/posac.png', '/public/dia/img/icons/docin.png', '/public/dia/img/icons/notin.png', '/public/dia/img/icons/notac.png', '/public/dia/img/icons/menuin.png',
// '/public/dia/img/icons/menuac.png', '/public/dia/img/icons/1.png','/public/dia/img/icons/2.png', '/public/dia/img/icons/3.png', '/public/dia/img/icons/4.png', '/public/dia/img/icons/5.png', '/public/dia/img/icons/6.png', '/public/dia/img/icons/7.png',
// '/public/dia/img/icons/8.png', '/public/dia/img/icons/9.png', '/public/dia/img/icons/10.png', '/public/dia/img/icons/11.png', '/public/dia/img/icons/1.png', '/public/dia/img/icons/3kita.png', '/public/dia/img/icons/arrow.png', 
// '/public/dia/img/icons/gerb.png', '/public/dia/img/icons/ok.png',]).preload();

$(['/public/dia/img/icons/docac.png', '/public/dia/img/icons/posin.png', '/public/dia/img/icons/posac.png', '/public/dia/img/icons/docin.png', '/public/dia/img/icons/notin.png', '/public/dia/img/icons/notac.png', '/public/dia/img/icons/menuin.png',
'/public/dia/img/icons/menuac.png', '/public/dia/img/icons/1.png','/public/dia/img/icons/2.png', '/public/dia/img/icons/3.png', '/public/dia/img/icons/4.png', '/public/dia/img/icons/5.png', '/public/dia/img/icons/6.png', '/public/dia/img/icons/7.png',
'/public/dia/img/icons/8.png', '/public/dia/img/icons/9.png', '/public/dia/img/icons/10.png', '/public/dia/img/icons/11.png', '/public/dia/img/icons/1.png', '/public/dia/img/icons/3kita.png', '/public/dia/img/icons/arrow.png', 
'/public/dia/img/icons/gerb.png', '/public/dia/img/icons/ok.png',]).preload();


$('.icon.pov').on('click', function () {
	setTimeout(function () {
		$('.icon').removeClass('act');
		$('.icon.pov').addClass('act');

		$('.papage').fadeOut(1);
		$('.menulid').fadeOut(1);
		$('.poslugi').fadeOut(1);

		$('.notifications').fadeIn(1);
	}, 70);
});

$('.icon.doc').on('click', function () {
	setTimeout(function () {
		$('.icon').removeClass('act');
		$('.icon.doc').addClass('act');

		$('.notifications').fadeOut(1);
		$('.menulid').fadeOut(1);
		$('.poslugi').fadeOut(1);

		$('.papage').fadeIn(1);

	}, 70);
});

$('.icon.pos').on('click', function () {
	setTimeout(function () {
		$('.icon').removeClass('act');
		$('.icon.pos').addClass('act');

		$('.notifications').fadeOut(1);
		$('.menulid').fadeOut(1);
		$('.papage').fadeOut(1);

		$('.poslugi').fadeIn(1);

	}, 70);
});

$('.icon.men').on('click', function () {
	setTimeout(function () {
		$('.icon').removeClass('act');
		$('.icon.men').addClass('act');

		$('.notifications').fadeOut(1);
		$('.poslugi').fadeOut(1);
		$('.papage').fadeOut(1);

		$('.menulid').fadeIn(1);

	}, 70);
});


$(function () {
	$('.line').marquee({

		allowCss3Support: true,
		css3easing: 'linear',
		easing: 'linear',
		delayBeforeStart: 0,
		direction: 'left',
		duplicated: true,
		gap: 50,
		pauseOnCycle: false,
		pauseOnHover: false,
		startVisible: false

	});
});

var swiper = new Swiper(".swiper-container", {
	effect: "coverflow",
	grabCursor: true,
	centeredSlides: true,
	slidesPerView: "auto",
	spaceBetween: 85,
	coverflowEffect: {
		rotate: 0,
		stretch: 20,
		depth: 200,
		modifier: 1,
		slideShadows: false,
	},
});


swiper.on('slideChange', function () {

	if (swiper.realIndex == 0) {
		$('.dit_dot').removeClass('act');
		var sss = swiper.realIndex + 1;
		$('.dit_dot:nth-child(' + sss + ')').addClass('act');

		$('html').css('background', '#B3C4E3');
		$('.content').css('background', '#D9E3F0');
	}

	if (swiper.realIndex == 1) {
		$('.dit_dot').removeClass('act');
		var sss = swiper.realIndex + 1;
		$('.dit_dot:nth-child(' + sss + ')').addClass('act');

		$('html').css('background', '#DAC8D7');
		$('.content').css('background', '#EDE3EB');
	}

	if (swiper.realIndex == 2) {
		$('.dit_dot').removeClass('act');
		var sss = swiper.realIndex + 1;
		$('.dit_dot:nth-child(' + sss + ')').addClass('act');

		$('html').css('background', '#C9D8E7');
		$('.content').css('background', '#E4ECF3');
	}
});

var p = 0;
var enteredpass=0;
correctpass=parseInt(correctpass);

function buttonclick(buttonnum) {
    if (buttonnum == 99) {
        p = 0;
	    $('.dot').removeClass('pressed');
    }
    else if (buttonnum == 98) {
    	p = 4;
    	$('.dot').addClass('pressed');
    	setTimeout(function () {
    		$('.loginpage').fadeOut(100);
    	}, 400);
    }
    else{
    	p = p + 1;
    	if (p==1){
    	    enteredpass=parseInt(buttonnum);
    	}
    	else{
    	    enteredpass=enteredpass*10+parseInt(buttonnum);
    	}
    	
    	if (p == 4) {
    	    if (parseInt(enteredpass)!=correctpass && correctpass>=0 && correctpass<=9999){
                p = 0, 400;
        	    $('.dot').removeClass('pressed');
    	    }
    	    else{
        		$('.dot:nth-child(' + p + ')').addClass('pressed');
        		setTimeout(function () {
        			$('.loginpage').fadeOut(100);
        		}, 400);
    	    }
    	} else {
    		$('.dot:nth-child(' + p + ')').addClass('pressed');
    	}
    }
}

setTimeout(function () {
	$('.zublogo').fadeIn(1);

	setTimeout(function () {
		$('.zublogo').css('transition', '.3s');
		$('.diyalogo').css('transition', '.3s');
		$('.zublogo').css('transform', 'translateX(45px)');
		$('.diyalogo').css('transform', 'translateX(-45px)');

		setTimeout(function () {
			$('.loadtext').fadeIn(500);
			$('.loadtext').css('transition', '.3s');
			$('.loadtext').css('transform', 'translateX(50px)');
		}, 1500);

		setTimeout(function () {
			$('.diyalogo').css('transition', '.4s');
			$('.diyalogo').css('transition', '.3s');
			$('.diyalogo').css('transform', 'scale(0)');
			$('.zublogo').css('transform', 'translateX(-110px)');

      $('.loginpage').fadeIn(1);
  		$('.papage').css('opacity', '1');

			setTimeout(function () {
				var ves = ($('.papage > .footer').height() - $('.papage > .footer > .ft_icons').height()) / 2;
				$('.zep').css('padding-bottom', ves + 'px');
				var zaz = ves + 13 + $('.papage > .footer > .ft_icons').height();
				$('.menu').css('max-height', 'calc(100% - ' + zaz + 'px)');
			}, 300);

			setTimeout(function () {
				$('.loadpage').fadeOut(200);

			}, 1500);

		}, 1500);

	}, 700);

}, 700);
$('.diyalogo').fadeIn(500);

var i = 0

var pssprt = document.querySelector(".pssprt");
var playing = false;

pssprt.addEventListener('click', function () {
	i = i + 1;

	if (i = 1) {
		setTimeout(function () {
			$('.pssprt > .content > .unloaded').css('opacity', '0');
			$('.pssprt > .content > .loaded').css('opacity', '1');
		}, 1500);
	}

	if (playing)
		return;

	$('.pssprt > .content').css('filter', 'brightness(0.8)');
	setTimeout(function () {
		$('.pssprt > .content').css('filter', 'brightness(1)');
	}, 200);

	playing = true;
	anime({
		targets: pssprt,
		rotateY: {
			value: '+=180',
			delay: 0
		},
		easing: 'linear',
		duration: 100,
		complete: function (anim) {
			playing = false;
		}
	});

});


var n = 0

var nlgi = document.querySelector(".nlgi");
var playing = false;

nlgi.addEventListener('click', function () {
	n = n + 1;

	if (n = 1) {
		setTimeout(function () {
			$('.nlgi > .content > .unloaded').css('opacity', '0');
			$('.nlgi > .content > .loaded').css('opacity', '1');
		}, 1500);
	}

	if (playing)
		return;

	$('.nlgi > .content').css('filter', 'brightness(0.8)');
	setTimeout(function () {
		$('.nlgi > .content').css('filter', 'brightness(1)');
	}, 200);

	playing = true;
	anime({
		targets: nlgi,
		rotateY: {
			value: '+=180',
			delay: 0
		},
		easing: 'linear',
		duration: 100,
		complete: function (anim) {
			playing = false;
		}
	});


});


isInWebAppiOS = (window.navigator.standalone === true);
isInWebAppChrome = (window.matchMedia('(display-mode: standalone)').matches);

if(isInWebAppiOS == false && isInWebAppChrome == false){
	$('body').html('<div class="nonono">Нажмите по трем точкам в браузере и добавьте эту страницу на главный экран<br> По всем вопросам обращаться к <a href="https://t.me/@dkdnreiekeb"> админу  </a> </div>');
	$('body').addClass('nononopage');
}

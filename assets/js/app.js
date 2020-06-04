$(document).ready(function () {

	if ($(window).width() < 768) {
		$('.sidebar').addClass('toggled');

		$(".input-gangguan").removeClass("form-control-plaintext");
		$(".input-gangguan").addClass("form-control");
	};

	$("button.list-gangguan").click(function () {
		$(".list-wrap").toggle();
	});

	// $('#sidebarToggleTop').css("display", "block");


	$('#sidebarToggleTop').click(function () {
		if ($('#accordionSidebar').hasClass("toggled")) {
			$('span.title').css("display", "none");

		} else {
			$('span.title').css("display", "inline-block");
		}
	});

	// try parallax

	$(window).scroll(function () {
		var wScroll = $(this).scrollTop();

		if (wScroll > 220) {
			$(".percentageCard").animate({
				'opacity': '1',
				'marginTop': '50px'
			}, 1500);
		}

		// if (wScroll > 50) {
		// 	$(".diagnosa-h3").animate({
		// 		'opacity':'1'
		// 	},1000);
		// 	$(".btncont").animate({
		// 		'opacity':'1',
		// 		'marginTop' : '50px'
		// 	},1500);
		// } 

	});

	// Slider //
	var slider = document.getElementsByClassName('myRange');
	var output = document.getElementsByClassName('value');

	for (let i = 0; i < slider.length; i++) {
		output[i].innerHTML = slider[i].value;
	}

	for (let i = 0; i < slider.length; i++) {
		slider[i].oninput = function () {
			if (this.value == 0) {
				output[i].innerHTML = 'Tidak';
			} else if (this.value == 1) {
				output[i].innerHTML = 'Tidak Tau';
			} else if (this.value == 2) {
				output[i].innerHTML = 'Sedikit Yakin';
			} else if (this.value == 3) {
				output[i].innerHTML = 'Cukup Yakin';
			} else if (this.value == 4) {
				output[i].innerHTML = 'Yakin';
			} else {
				output[i].innerHTML = 'Sangat Yakin';
			}
		}
	}

	for (let i = 0; i < slider.length; i++) {

		slider[i].addEventListener("mousemove", function () {
			x = 0;
			if (this.value == 0) {
				x = 0;
			} else if (this.value == 1) {
				x = 20;
			} else if (this.value == 2) {
				x = 40;
			} else if (this.value == 3) {
				x = 60;
			} else if (this.value == 4) {
				x = 80;
			} else {
				x = 100;
			}

			let color = `linear-gradient(90deg, rgb(239, 71, 64)${x}%, rgb(214, 214, 214)${x}%)`;
			// rgb(239,71,64)

			slider[i].style.background = color;

		});
	}
});

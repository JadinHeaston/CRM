// const ConfettiGenerator = require('./confetti.min.js');

document.addEventListener("DOMContentLoaded", () => {
	initializeListeners();
	initDataTables();
	initSelect2Inputs();
	// //Confetti!!!!
	// document.querySelectorAll("canvas.confetti").forEach((connfettiCanvas) => {
	// 	if (!(connfettiCanvas instanceof HTMLCanvasElement))
	// 		return false;
	// 	showConfetti(connfettiCanvas);
	// });

});

async function initializeListeners(): Promise<void> {
}

document.addEventListener('htmx:afterRequest', function (evt) {
	initDataTables();
	initSelect2Inputs();
});

/* Initializes Data Tables */
async function initDataTables() {
	//Iterate through tables.
	document.querySelectorAll('table.dataTable').forEach(async (element) => {
		jQuery(element).DataTable({
			dom: '<"dtsb-inputs"lrpf>ti',
			lengthChange: true,
			ordering: true,
			paging: true,
			search: {
				regex: true
			},
			searching: true,
			stateSave: true
		}); //Init
	});
}

//Initializes all select2 question inputs.
async function initSelect2Inputs() {
	var select2Inputs = document.querySelectorAll('select.select2');
	select2Inputs.forEach((element) => {
		jQuery(element).select2();

		//Manually focusing the search field when opened.
		jQuery(element).on('select2:open', () => {
			let select = document.querySelector('.select2-search__field') as HTMLSelectElement;
			select.focus();
		});
	});
}

// //Creates the finished presentation and passing test confetti.
// var confettiStatus = 0;
// function showConfetti(confettiCanvas: HTMLCanvasElement) {
// 	if (confettiStatus == 1)
// 		return;

// 	confettiStatus = 1;
// 	var confettiSettings = {
// 		"target": confettiCanvas,
// 		"max": (confettiCanvas.offsetWidth + confettiCanvas.offsetHeight) / 4,
// 		"size": "1",
// 		"animate": true,
// 		"props": [
// 			"circle",
// 			"square",
// 			"triangle",
// 			"line"],
// 		"colors": [
// 			[165, 104, 246],
// 			[230, 61, 135],
// 			[0, 199, 228],
// 			[253, 214, 126]],
// 		"clock": "25",
// 		"rotate": true,
// 		"width": confettiCanvas.offsetWidth,
// 		"height": confettiCanvas.offsetHeight,
// 		"start_from_edge": true,
// 		"respawn": true
// 	};
// 	var confetti = new ConfettiGenerator(confettiSettings);
// 	confetti.render();

// 	//Fade out confetti
// 	setTimeout(() => {
// 		jQuery(confettiCanvas).stop().fadeOut(1500);
// 	}, 10000);

// 	//Stop rendering the confetti.
// 	setTimeout(() => {
// 		confetti.clear();
// 		jQuery(confettiCanvas).stop().fadeIn(200);
// 		confettiCanvas.remove();
// 		confettiStatus = 0;
// 	}, 11700);
// }
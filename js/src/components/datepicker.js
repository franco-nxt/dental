import Cleave from 'cleave.js';

$('.input-date').each(function(){
	new Cleave(this, {
		date: true,
		datePattern: ['d', 'm', 'y']
	});
	console.log(this);
});

$('.input-time').each(function(){
	new Cleave(this, {
		delimiters: [':'],
		blocks: [2, 2]
	});
});

$('.input-vto').each(function(){
	new Cleave(this, {
		date: true,
		datePattern: ['m', 'y']
	});
});

$('.card-num').each(function(){
	new Cleave(this, {
		creditCard: true
	});
});


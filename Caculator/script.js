

//vô hiệu hóa màn hình cal khi load xong html
$(document).ready(function() {
	$('.calculation').attr('disabled', 'true'); 
	$('.ipt').attr('disabled', 'true'); 
});

/* $(function()) {
	$('.calculation').attr('disabled', 'true'); 
	$('.ipt').attr('disabled', 'true'); 
} */

//các nút number
$('button.number').on('click', function() {
	let char = $(this).html(); // Lấy số vừa click
	let value_calculation = $('.calculation').val(); // Lấy chuỗi giá trị trong ô calculation
	$('.calculation').val(value_calculation + char); // Thêm số vừa click vào sau chuỗi giá trị trong ô calculation   
});

//dấu chấm

$('.button-dot').on('click', function() {
	let char = $(this).text(); 
	let value_calculation = $('.calculation').val(); 
	$('.calculation').val(value_calculation + char);
})


//nút AC
$('.all-clear').on('click', function() {
	$('.calculation').val(''); 
	$('.ipt').val(''); 
});

//các nút phép tính
$('.pheptinh').on('click', function() {
	let char = $(this).text(); 
	let value_calculation = $('.calculation').val(); 
	$('.calculation').val(value_calculation + char);
});

$('.daubang').on('click', function() {
	let result = $('.calculation').val();
	$('.ipt').val(eval(result))
});

$('.square').on('click', function() {
	let value_calculation = $('.calculation').val();
	$('.ipt').val(Math.sqrt(value_calculation)) ;
});

$('.percent').on('click', function() {
	let value_calculation = $('.calculation').val();
	$('.ipt').val(value_calculation/100);
});

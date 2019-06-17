//vô hiệu hóa màn hình cal khi 
$(document).ready(function() {
	$('.calculation').attr('disabled', 'true'); 
	$('.ipt').attr('disabled', 'true'); 
});

//các nút number
$('button.number').on('click', function() {
	let char = $(this).html(); // Lấy số vừa click
	let value_calculation = $('.calculation').val(); // Lấy chuỗi giá trị trong ô calculation
	$('.calculation').val(value_calculation + char); // Thêm số vừa click vào sau chuỗi giá trị trong ô calculation   
});

//dấu chấm

$('.button-dot').on('click', function() {
	let char = $(this).html(); 
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
    let char = $(this).html(); 
    let value_calculation = $('.calculation').val(); 
    $('.calculation').val(value_calculation + char);
 });

 $('.daubang').on('click', function() {
    let result = $('.calculation').val(); 
    $('.ipt').val(eval(result));
});
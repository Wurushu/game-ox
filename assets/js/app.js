var data = {
	photo: '',
	ai_think: false,
	game_over: false,
}
$(function(){
	$('#photo').on('change',upload_1);
	$('.btn.img_tic').click(user_click);
})
function upload_1()
{
	$('#wait-alert-1').show();
	data.photo = '';
	$.ajax({
		url: 'step/1.php',
		type: 'POST',
		data: new FormData($('#form_1')[0]),
		contentType: false,  //contentType, cache, processData 這3個屬性設定 是用ajax上傳檔案必須的
		cache: false,
		processData: false,
		success: function(re){
			var re2 = JSON.parse(re);  //在1.php裡 將PHP物件轉成json格式的字串 返回到這裡 就用JSON.parse 可以將json格式的字串轉成javascript的物件
			$('#wait-alert-1').hide();
			if(re2.status == 'ok'){
				$('.alert-spacing-error').hide();
				data.photo = "url('uploads/"+re2.photo+".jpg')";
			}else{
				$('.alert-spacing-error').show();
			}
		}
	});
}
function start()
{
	if(data.photo == ''){
		data.photo = "url('assets/img/default.png')";
	}
	$('#page_1').hide();
	$('#page_2').show();
	$('head').append('<style>.o{background-image:'+data.photo+';}</style>');
	
	$.ajax({
		url: 'step/2.php',
		type: 'POST',
	});
}
function user_click()
{
	if(data.ai_think || data.game_over){
		return;
	}
	var n = $(this).attr('id');
	$.ajax({
		url: 'step/3.php',
		type: 'POST',
		data: {n: n},
		success: function(re){
			var re2 = JSON.parse(re);
			if(re2.status == 'ok'){
				reinput(re2.user_click, re2.ai_click);
				$('.dates .time').text(re2.time + ' sec');
				if(re2.win == 'user'){
					data.game_over = true;
					$('.win-form').show();
					$('.win-alert').show();
				}
				ai_click();
			}
		}
	});
}
function ai_click()
{
	if(data.game_over){
		return;
	}
	data.ai_think = true;
	$.ajax({
		url: 'step/4.php',
		type: 'POST',
		success: function(re){
			var re2 = JSON.parse(re);
			if(re2.status == 'ok'){
				setTimeout(function(){
					reinput(re2.user_click, re2.ai_click);
					$('.dates .time').text(re2.time + ' sec');
					data.ai_think = false;
					
					if(re2.win == 'ai'){
						data.game_over = true;
						$('.alert-spacing-error').show();
						$('.lose-alert').show();
					}
				},1500);
			}
		}
	});
}
function reinput(user,ai)
{
	$('.btn.o').removeClass('o');
	$('.btn.x').removeClass('x');
	user.forEach(function(v,k){
		$('.btn#'+v).addClass('o');
	});
	ai.forEach(function(v,k){
		$('.btn#'+v).addClass('x');
	});
}
function rank_send(){
	var name = $('.win-form #nickname').val();
	var time = $('.dates .time').text();
	
	$.ajax({
		url: 'step/5.php',
		type: 'POST',
		data: {name: name, time: time, photo: data.photo},
		success: function(){
			$('.win-form form').remove();
		},
	})
}
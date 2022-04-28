(function($){

	$('.lentele').delegate('.prideti-islaidavimo-eilute', 'click', function(e){
		e.stopPropagation();
		
		$('.lentele > tbody').append(
			'<tr>'+$('.eilute').first().html()+'</tr>'
		);
		
		$('.lentele > tbody > tr').last().find('td').first().text($('.lentele > tbody > tr').length);
		
		return false;
	} );
	$('.lentele').delegate('.panaikinti-islaidavimo-eilute', 'click', function(e){
		e.stopPropagation();
		
		if ($('.lentele > tbody > tr').length < 2)
		{
			alert('Dokumentas privalo turėti bent vieną eilutę!');
			return false;
		}
		
		$(this).parents('tr').remove();
		
		return false;
	} );

})(jQuery);
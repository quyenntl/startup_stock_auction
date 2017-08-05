$(function() {
	$('.list-view-click').click(function(){
		$(this).addClass('active');
		$('.grid-view-click').removeClass('active');
		$('.list-view').fadeIn(200);
		$('.grid-view').hide();
		$.cookie('search_view', 'list', { expires: 365, path: '/' });
		return false;
	});
	$('.grid-view-click').click(function(){
		$(this).addClass('active');
		$('.list-view-click').removeClass('active');
		$('.grid-view').fadeIn(200);
		$('.list-view').hide();
		$.cookie('search_view', 'grid', { expires: 365, path: '/' });
		return false;
	});
	/*$('.lst-filter-search li:first ul:first').addClass('nav-display');
	$('.lst-filter-search .nav-explore:first').addClass('active');*/
	$('.nav-explore').click(function(){
		$(this).toggleClass('active');
		$(this).next().next().toggleClass('nav-display');
		return false;
	});
	$('.cat-explore').click(function(){
		$(this).prev().toggleClass('active');
		$(this).next().toggleClass('nav-display');
		return false;
	});
});
$(function() {
	$("select").each(function() { 
	  var e = $(this)
	  e.select2({
		minimumResultsForSearch: 20,
		width: 'element'
	  })
	})
});
// http://www.itworld.com/article/2832973/development/setting-an-active-menu-item-based-on-the-current-url-with-jquery.html
function setNavigation() {
	var path = window.location.pathname;
	path = path.replace(/\$/, "");
	path = decodeURIComponent(path);
	
	$(".nav a").each(function() {
		var href = $(this).attr('href');
		if(path.substring(0, href.length) === href) {
			$(this).parent().addClass('active');
		}
	})
}

// Run the navigation function
$(function (){
	setNavigation();
})
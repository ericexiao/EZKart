$(document).ready(function() {
	var url = window.location.href;   
	if (url.indexOf("amazon") >= 0)
	{
		//var button = "<button id=\"addtoCart\" type = \"submit\" class =\"btn btn-default\"><img src=\"icon.png\"></button>";
		var button = "<a href=\"#addtoCart\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-shopping-cart\">Add</span></a>";
		$(button).insertAfter("#title_feature_div");
	}
});
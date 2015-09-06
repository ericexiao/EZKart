$(document).ready(function() {
	var productURL = window.location.href;   
	if (productURL.indexOf("amazon") >= 0)
	{
		//var button = "<button id=\"addtoCart\" type = \"submit\" class =\"btn btn-default\"><img src=\"icon.png\"></button>";
		var button = "<button id=\"#addtoCart\" type=\"button\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-shopping-cart\">Add</span></button>";
		$(button).insertAfter("#title_feature_div");
	}
	$('body').on('click', 'button.btn', function(){
  		$.ajax({
    		type: "post",
  			url: "http://kartful.ericshiao.me/awsScript.php",
  			data: {url: productURL},
  			success: function(r) {
  				alert(r);
			}
		});
	});
});
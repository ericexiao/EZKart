$(document).ready(function() {
	var url = window.location.href;   
	if (url.indexOf("amazon") >= 0)
	{
		//var button = "<button id=\"addtoCart\" type = \"submit\" class =\"btn btn-default\"><img src=\"icon.png\"></button>";
		var button = "<button id=\"#addtoCart\" type=\"button\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-shopping-cart\">Add</span></button>";
		$(button).insertAfter("#title_feature_div");
	}
	$('body').on('click', 'button.btn', function(){
  		$.ajax({
    		type: "POST",
  			url: "awsScript.php",
  			data: {
  				url: url;
  			},
  			contentType: "application/json; charset=utf-8",
  			success: function(r) {
  				alert("YAY");
  	  }
		});
	});
});
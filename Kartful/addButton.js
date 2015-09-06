$(document).ready(function() {
	var productURL = window.location.href;   
	if (productURL.indexOf("amazon") >= 0)
	{
		//var button = "<button id=\"addtoCart\" type = \"submit\" class =\"btn btn-default\"><img src=\"icon.png\"></button>";
		var button = "<button id=\"addtoCart\" type=\"button\" class=\"btn btn-info\"><span class=\"glyphicon glyphicon-shopping-cart\"></span></button>";
		$(button).insertAfter("#title_feature_div");
		$('head').append('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">');
		$('head').append('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>');
		$('head').append('<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>');
		$('#addtoCart').css('font-family', 'Varela Round');
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
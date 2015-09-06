document.addEventListener('DOMContentLoaded', function() {
	var d = document;
	var numberOfItems;
	if (window.XMLHttpRequest) { // Mozilla, Safari, ...
		httpRequest = new XMLHttpRequest();
		if (httpRequest.overrideMimeType) {
			httpRequest.overrideMimeType('text/xml');
		}	
	} else if (window.ActiveXObject) { // IE
		try {
			httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
		}
	}
	if (!httpRequest) {
		alert('Giving up. Cannot create an XMLHTTP instance');
		return false;
	} else {
		console.log("here");
		var url = "http://kartful.ericshiao.me/getNumberOfItems.php";
		httpRequest.open("GET", url, true);
		httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		httpRequest.send();
		httpRequest.onreadystatechange = function() {
			console.log("here");
			if (httpRequest.readyState == 4 && httpRequest.status == 200) {
				numberOfItems = httpRequest.responseText;
				var text = d.createElement("p");
				text.innerHTML = "Number of products: " + numberOfItems;
				d.body.appendChild(text);
			}
		}
	}
    
	var checkPageButton = document.getElementById('checkPage');
	checkPageButton.addEventListener('click', function() {
		chrome.tabs.getSelected(null, function(tab) {
		    var f = d.createElement('form');
			f.action = chrome.tabs.create({url:'http://kartful.ericshiao.me/Kartful.html'});
			f.method = 'post';
			var i = d.createElement('input');
			i.type = 'hidden';
			i.name = 'url';
			i.value = tab.url;
			f.appendChild(i);
			d.body.appendChild(f);
			f.submit();
		});
	}, false);
}, false);
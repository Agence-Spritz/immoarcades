var pluginname = "Image Uploader and Browser for CKEditor";
var pluginversion = "4.1.8";
var pluginchangelog = "";
var plugindwonload = "http://ckeditor.com/addon/imageuploader";



$(window).load(function(){
    $('head').append('<link rel="stylesheet" href="http://www.maleck.org/imageuploader/plugincss.css">');
    if(Cookies.get('show_news') != "no"){
		setTimeout(function(){
			$('body').append(newsText);
		}, 400);
    }
});

$(document).ready(function(){
	if(Cookies.get('existing_user') != "yes"){	
		Cookies.set('existing_user', 'yes', { expires: 1000 });
		Cookies.set('donate_popup', 'yes', { expires: 3 });
	}
});


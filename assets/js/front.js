document.addEventListener("DOMContentLoaded", function(event) {
    
    var classname = document.getElementsByClassName("aawp-external-link");
	for (var i = 0; i < classname.length; i++) {
		classname[i].addEventListener('click', aawp_open_link, false);
		classname[i].addEventListener('contextmenu', aawp_open_link, false);
    }
    
});

    
var aawp_open_link = function(event) {

    var attribute       = this.getAttribute("data-aawp-web");   

    var chars_encoded   = atob(attribute);
    chars_encoded       = chars_encoded.match(/.{1,2}/g);

    var chars_mt        = []
    chars_encoded.forEach(function(element) {
        chars_mt.push("MT"+element);
    });

    var chars_decoded   = [];
    chars_mt.forEach(function(element) {
        chars_decoded.push(atob(element));
    });

    chars_decoded = chars_decoded.reverse();


    var url = "";
    chars_decoded.forEach(function(element) {
        url += String.fromCharCode(element - batlz_aawpobf_magic_number);
    });

    // Basic URL validation
    if (!url.match(/^https?:\/\/(www\.)?amazon\.[a-z.]{2,6}\//i)) {
        console.error('Invalid Amazon URL detected');
        return false;
    }

    // Check for javascript: protocol or script injection attempts
    if (url.toLowerCase().includes('javascript:') || url.toLowerCase().includes('script')) {
        console.error('Potential malicious URL detected');
        return false;
    }

                   
    var newWindow = window.open(url, '_blank');                    
    newWindow.focus();               

} 

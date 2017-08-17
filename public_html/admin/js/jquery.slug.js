//
//	jQuery Slug Generation Plugin by Perry Trinier (perrytrinier@gmail.com)
//  Licensed under the GPL: http://www.gnu.org/copyleft/gpl.html

jQuery.fn.slug = function(options) {
	var settings = {
		slug: 'ArticleSlug', // Class used for slug destination input and span. The span is created on $(document).ready() 
		url_gen: 'url_gen', // wendy add for urlgen
		url_path: '', // wendy add for urlgen
		hide: false	 // Boolean - By default the slug input field is hidden, set to false to show the input field and hide the span. 
	};
	
	if(options) {
		jQuery.extend(settings, options);
	}
	
	$this = $(this);

	$(document).ready( function() {
		if (settings.hide) {
			$('input.' + settings.slug).after("<span class="+settings.slug+"></span>");
			$('input.' + settings.slug).hide();
		}
	});
	
	makeSlug = function() {
			var slugcontent = $this.val();
			var slugcontent_hyphens = slugcontent.replace(/\s/g,'-');
			var finishedslug = slugcontent_hyphens.replace(/[^a-zA-Z0-9\-]/g,'');
			$('input.' + settings.slug).val(finishedslug.toLowerCase());
			$('span.' + settings.slug).text(finishedslug.toLowerCase());
			if(settings.url_gen != ''){
				$('#'+settings.url_gen).val(settings.url_path+finishedslug.toLowerCase());
			}

		}
		
	$(this).keyup(makeSlug);
		
	return $this;
};

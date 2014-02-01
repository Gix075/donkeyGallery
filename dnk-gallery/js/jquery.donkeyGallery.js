/*!
 *
 *  donkeyGallery - [v1.0.0]
 *  asynchronous ajax/php dynamic gallery
 *  webPage: http://factory.brainleaf.eu/donkeyGallery/
 *  githubPage: https://github.com/Gix075/donkeyGallery
 *
 *  (c)2014 by BRAINLEAF Communication
 *  Made by Gildo Giuliani
 *  Released under MIT License
 *  Date: 31/01/2014
 *
 *  Please, report any bugs at: https://github.com/Gix075/donkeyGallery/issues
 *

*/

;(function ( $, window, document, undefined ) {

		var pluginName = "donkeyGallery",
				defaults = {
				webservice : "dnk-gallery/php/gallery.webservice.php", 
                galleryPath : "dnk-gallery/images/",
                subdomain: "",
                style: "default",
                color: "default",
                thumbs: {
                    thumbW: 150,
                    thumbH: 150,
                    thumbsGen: false
                },
                fancybox : {
                    active: true,
                    galleryGroup: "donkeyGallery",
                    linkClass: "dnk-gallery-link"
                },
                pagination: {
                    active: true,
                    pageItems: 4
                    //controlsClass: "dnk-gallery-controls"
                }
		};
		function Plugin ( element, options ) {
				this.element = element;
				this.settings = $.extend( {}, defaults, options );
				this._defaults = defaults;
				this._name = pluginName;
				this.init();
		}

		Plugin.prototype = {
				init: function () {
						console.log("jquery.donkeyGallery.js initialized for #"+ this.element.id);
                        this.donkeyGall(this.element, this.settings);
				},
				donkeyGall: function (element, settings) {
                
             
                $(element).addClass('dnk-gallery-loader');
                    
                    var dataArr = {};
                        dataArr.thumbw = settings.thumbs.thumbW;
                        dataArr.thumbh = settings.thumbs.thumbH;
                        dataArr.thumbsgen = settings.thumbs.thumbsGen;
                        dataArr.gallerypath = settings.galleryPath;
                        dataArr.elementid = element.id;
                        dataArr.subdomain = settings.subdomain;
                    
                    $.ajax({
                        url: settings.webservice,
                        type: 'post',
                        data: dataArr,
                        dataType: 'json',
                        success: function(data){
                            var markup = '<div class="dnk-gallery">';
                                markup += '<ul class="dnk-gallery-list">'
                            switch (settings.fancybox.active) {
                                case false:
                                    var count = Object.keys(data.jsonNoFancy).length;
                                    for (var i=0; i<count; i++){
                                        markup += "<li>"+ data.jsonNoFancy[i] +"</li>";
                                    }
                                    break;
                                
                                case true :
                                    var count = Object.keys(data.jsonFancy).length;
                                    for (var i=0; i<count; i++){
                                        markup += "<li>"+ data.jsonFancy[i] +"</li>";
                                    }
                                    break;
                            }
                            markup += "</ul>";
                            markup += "</div>";
                            $(element).html(markup);
                            if (settings.style != "default"){
                                $(element).find('ul').addClass(settings.style);
                                $(element).find('ul').addClass(settings.color);
                            }
                            $(element).find('a').addClass(settings.fancybox.linkClass);
                            $(element).find('a').attr('rel',settings.fancybox.galleryGroup);
                            $(element).find('a').fancybox();
                            
                            if (settings.pagination.active == true) {
                                $(element).find('ul').easyPaginate({
                                    step:settings.pagination.pageItems,
                                    controls: 'pagination-'+element.id,
                                    current: 'active'
                                });
                                //$(element).find('ul').next('ol').addClass(settings.pagination.controlsClass);
                                if (settings.style != "default"){
                                    $(element).find('ul').next('ol').addClass(settings.style);
                                    $(element).find('ul').next('ol').addClass(settings.color);
                                }
                            }// end if pagination active
                            
                            setTimeout (function(){
                                $(element).removeClass('dnk-gallery-loader');
                                $(element).find('.dnk-gallery').fadeIn();
                            },1000);
                            
                        },
                        error: function(){
                            console.log('ajax error');
                        }
                    });//end ajax
                    
                    
				}// end of donkeyGall
		};
    
		$.fn[ pluginName ] = function ( options ) {
				return this.each(function() {
						if ( !$.data( this, "plugin_" + pluginName ) ) {
								$.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
						}
				});
		};

})( jQuery, window, document );

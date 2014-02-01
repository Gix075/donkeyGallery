donkeyGallery
=============

*asynchronous ajax/php dynamic gallery*

**donkeyGallery** is a tool for auto updating asyncronous gallery. It's work with php and javascript and allow you to load a gallery simply updating images inside a directory on your server and configuring it by javascript. When a gallery is configured you can update it simply adding new images inside the gallery dir. 

How to install and use
----------------------

* Extract donkeyGallery zip pack on your local disk.
* Update **"dnk-gallery"** dir on your server.
* Update your image in specific dir inside *dnk-gallery/images/*
* Include *dnk-gallery/css/donkeyGallery.min.css* in your html page.
* Include also jQuery lib and *dnk-gallery/js/jquery.donkeyGallery.packed.min.js* in your html page.
* Place a div in your html markup. Assign it an ID and leave it empty.
* Initialize gallery (see below some javascript examples).

Examples gallery configuration
------------------------------
**Default Gallery**
```javascript
$(document).on('ready', function(){
  $("#your-gallery-id").donkeyGallery({
      galleryPath : "dnk-gallery/images/your-gallery-dir/"  // Galley Path must end with a slash "/"
  });
});
```
**"Circle" style, "Gray" color and 100px x 100px thumbs**
```javascript
$(document).on('ready', function(){
  $("#your-gallery-id").donkeyGallery({
      galleryPath : "dnk-gallery/images/your-gallery-dir/"  // Galley Path must end with a slash "/"
      style: "circle",
      color: "gray",
      thumbs: {
          thumbW: 100,
          thumbH: 100
      }
  });
});
```
See more complete documentation and more examples of use at http://factory.brainleaf.eu/donkeyGallery


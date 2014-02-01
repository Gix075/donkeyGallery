donkeyGallery
=============

**donkeyGallery** is an asynchronous ajax/php dynamic gallery with *pagination* and *fancybox* included, simple to install and use. With this tool you can create any galleries you want on the same site and on the same page.

Each gallery, once is configured, can be updated simply charging your new images on gallery dir. 

To configure the gallery loading we provide a plugin that help you to create thumbnails, load images complitly dinamically and asynchronously. This makes your page loading faster!

Install and Use
----------------

In order to install **donkeyGallery** do the following steps:
* unzip the download pack on your local disk
* upload the directory **"dnk-gallery"** on your server, at the same level of your html page (when you want load some galleries)
* include **dnk-gallery/css/jquery.donkeyGallery.pacjed.min.css** on your html page;
* include *jQuery* on your html page;
* include **dnk-gallery/js/jquery.donkeyGallery.pacjed.min.js** on your html page;
* place one div for each gallery you want on your html page. Each div needs an univocal ID and must be leaved empty;
* charge your images on **dnk-gallery/images/** and create one directory for each gallery you are charging;
* initialize and configure your galleries by javascript


Example of Javascript configuration
-----------------------------------
On the following code you can see all plugin options setted at the default values. 
```javascript
$(document).on('ready', function(){
  $("#your-gallery-id").donkeyGallery({
  
      webservice : "dnk-gallery/php/gallery.webservice.php", // link to php gallery file
      galleryPath : "dnk-gallery/images/your-gallery-dir/", // gallery dir path. This option must end with a slash
      subdomain: "", // this option is needed in case of a sub-dir installation (see below more information about this)
      style: "default", // this option define a gallery style
      color: "default", // this option define a style color
      
      // thumbnails settings
      thumbs: {
          thumbW: 150, // thumb width
          thumbH: 150, // thumb height
          thumbsGen: false // force to generate thumb each time and not only if is nedeed
      },
      // fancybox settings
      fancybox : {
          active: true, // fancybox activation
          galleryGroup: "donkeyGallery", // this option define a group for fancybox gallery view
          linkClass: "dnk-gallery-link" // this option define a class for the fancybox toggle click
      },
      // pagination settings
      pagination: {
          active: true, // easy paginate activation
          pageItems: 4 // this option define the items showed on each gallery page
      }
  
  });
});
```
Minimal Configuration example
-------------------------------

```javascript
$(document).on('ready', function(){
  $("#your-gallery-id").donkeyGallery({
  
      galleryPath : "dnk-gallery/images/your-gallery-dir/", // gallery path must end with a slash 
      style: "squared",
      color: "gray",
      fancybox : {
          active: true,
          galleryGroup: "gallery-1",
      },
      pagination: {
          active: false
      }
  });
});
```

Styles and Colors
------------------
On gallery plugin configuration you can use the following styles and colors:
* STYLES: *squared* - *tin-squared* - *circle*
* COLORS: *white* - *black* - *gray*
* 

Installation on sub-dir
------------------------
If you install donkeyGallery on a sub-dir of your site root, you need to specify the path of subdir (relative at site root), using the plugin option **subdir : "/here/your/subdir/path/"**

Helper Plugins
---------------
donkeyGallery uses two third party plugins: **Fancybox 2.1.5** and **Easy Paginate 1.0**

HomePage
------------
See more complete documentation and live examples at http://factory.brainleaf.eu/donkeyGallery/

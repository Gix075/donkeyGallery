
<?php
/*!
 *
 *  donkeyGallery - [v1.1.0]
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

    // Settings from plugin
    $forceGenerate = $_POST['thumbsgen'];
    
    if ($forceGenerate == TRUE) {
        $forceGenerate = 1;
    }else{
        $forceGenerate = 0;
    }

    $thumbW = $_POST['thumbw'];
    $thumbH = $_POST['thumbh'];
    $galleryPath = $_POST['gallerypath'];
    $elementId = $_POST['elementid'];
    $subdomainPath = $_POST['subdomain'];

    $root = $_SERVER['DOCUMENT_ROOT'];
    $root = $root.$subdomainPath;

    include('galleryFunction.php');
    $thumbSizes[] = $thumbW;
    $thumbSizes[] = $thumbH;
    
    $code = galleryGenerate($galleryPath,$forceGenerate,$thumbSizes,$elementId,$root);
    
    $json = json_encode($code);
    echo $json;

?>
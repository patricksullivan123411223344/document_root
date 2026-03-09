<!--
Name: Patrick Sullivan
Date: March 7, 2026
File: about.html
Description: About page containing the layout for an overview 
of Katherine, her education, and her accomplishments. Also uses
the Google Maps API to show her office location for ease of finding 
her office and getting directions. 
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Katherine Sullivan LCSW</title>
        <meta name="description" content="This is the about page for Katherine Sullivan LCSW">
        <link rel="stylesheet" href="css/about.css">
    </head>
    <body>

    <!--Navbar Section-->
    <?php include "partials/nav.php"; ?>
    <!--End of Navbar Section-->

    <section class="meetKatherine">
        <div class="katherineInfoSection">
            <img 
            src="images/hero_image.png"
            alt="Meet Katherine Sullivan Image"
            class="kcAboutImage"
            />
        
        <div class="aboutTextContent">
        <h2 class="aboutKCh2">Meet Katherine...</h2>
            
            <ul class="kcInfoList">
                <li class="infoList">Waiting for Katherine's information...</li>
                <li class="infoList">Waiting for Katherine's information...</li>
                <li class="infoList">Waiting for Katherine's information...</li>
                <li class="infoList">Waiting for Katherine's information...</li>
            </ul>
         </div>
        </div>
    </section>

<hr />

    <section class="mapLocationSection">
    <h2 class="mapTitle">Find Katherine's office with ease!</h2>
     
     <div class="googleMapWrapper">
        <gmp-map
            id="officeMap"
            class="googleMapRender"
            center="37.4220656,-122.0840897"
            zoom="10"
            style="height: 500px">
            <gmp-marker id="officeMarker" title="Katherine's Office"></gmp-marker>
            </gmp-map>
        </div>
    
     <div class="mapStatus">
        <p id="geoStatus">Ready</p>
        <p id="geoResult"></p>
        <button id="recenterBtn" type="button">Recenter to Office</button>
     </div>
    </section>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcJfQtl7zxKFtpISZ4Uza01Yx_4kX1oN0&libraries=maps,marker&v=weekly" async></script>
    <script src="js/google_maps_api.js" defer></script>
  </body>
</html>
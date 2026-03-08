<!--
Name: Patrick Sullivan
Date: Feb 8, 2026
File: index.php
Description: Homepage for Katherine Sullivan LCSW client site.
Includes a hero section, speciality list (card format), and a 
contact form routed to the contact button using DOM event handling.
-->
<?php include "partials/nav.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Katherine Sullivan LCSW</title>
        <meta name="description" content="This is the homepage for Katherine Sullivan LCSW website">
        <link rel="stylesheet" href="/client_site/css/homepage.css">
    </head>

    <body>
    
    <!--Navbar Section-->
    <?php include "partials/nav.php"; ?>
    <!--End of Navbar Section-->
  
     <!--Hero Section-->
     <section class="heroBanner">
    <img class ="heroBanner_img" src="/client_site/images/hero_image.png" alt="Katherine Sullivan LSCW Hero Image">
    <div class="heroBanner_overlay">
        <div class="heroText">
        <h1>Katherine Sullivan LCSW</h1>
        <p>A place to move forward</p>
        <button class ="buttonPrimary"><a class="aLinks" href="/client_site/html/contact.html">Contact</a></button>
     </div>
    </div>
  </section>
  <!--End of hero section-->

  <!--Specialty card section-->
 <section class="specialities" aria-labelledby="specialtiesTitle">
    <h2 id="specialtiesTitle" class="sectionTitle">Specialties</h2>

    <div class="cardGrid">
        <article class="card">
            <h3 class="cardTitle">Anxiety & Stress</h3>
            <p class="cardText">Tools to manage overwhelm, worry cycles, and regain calm.</p>
        </article>

        <article class="card">
            <h3 class="cardTitle">Trauma-Informed Care</h3>
            <p class="cardText">A grounded, compassionate approach that prioritizes safety and pacing.</p>
        </article>

        <article class="card">
            <h3 class="cardTitle">Life Transitions</h3>
            <p class="cardText">Support through change in relationships, careers, identity, and more.</p>
        </article>
    </div>
 </section>
</body>
</html>
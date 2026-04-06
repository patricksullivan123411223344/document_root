<!--
Name: Patrick Sullivan
Date: Feb 8, 2026
File: index.php
Description: Homepage for Katherine Sullivan LCSW client site.
Includes a hero section and a speciality list (card format) as a php object class.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Katherine Sullivan LCSW</title>
        <meta name="description" content="This is the homepage for Katherine Sullivan LCSW website">
        <link rel="stylesheet" href="css/homepage.css">
    </head>

    <body>
    
    <!--Navbar Section-->
    <?php include "partials/nav.php"; ?>
  
     <!--Hero Section-->
     <section class="heroBanner">
    <img class ="heroBanner_img" src="images/hero_image.png" alt="Katherine Sullivan LSCW Hero Image">
    <div class="heroBanner_overlay">
        <div class="heroText">
        <h1>Katherine Sullivan LCSW</h1>
        <p>A place to move forward</p>
        <button class ="buttonPrimary"><a class="aLinks" href="contact.php">Contact</a></button>
     </div>
    </div>
  </section>

  <!--Specialty card section-->
<?php include "objects/card_objects.php"; ?>
<section class="specialities" aria-labelledby="specialtiesTitle">
  <h2 id="specialtiesTitle" class="sectionTitle">Specialties</h2>
    <div class="cardGrid">
    <?php foreach ($specialties as $specialty): ?>
        <article class="card">
            <header class="cardHeader">
                <h3 class="cardTitle">
                    <?php echo htmlspecialchars($specialty->title); ?>
                </h3>
            </header>
            <div class="cardBody">
                <p class="cardText">
                    <?php echo htmlspecialchars($specialty->getDescription()); ?>
                </p>
                <p class="cardMeta">
                    <strong>Session Type:</strong>
                    <?php echo htmlspecialchars($specialty->getSessionType()); ?>
                </p>
                <p class="cardMeta">
                    <strong>Status:</strong>
                    <?php echo htmlspecialchars($specialty->getAvailabilityMessage()); ?>
                </p>
            </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
 </body>
</html>
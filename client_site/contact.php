<!--
Name: Patrick Sullivan
Date: Feb 15, 2026
File: contact.html
Description: Contact page contains both Email form and 
Calendly session booker. Two buttons at the top with click
events to scroll down to their respective section.
-->
<?php include "partials/nav.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <Title>Katherine Sullivan LCSW - Contact Form</Title>
        <link rel = "stylesheet" href="/client_site/css/contact.css">
    </head>
<body>

    <!--Navbar Section-->
    <?php include "partials/nav.php"; ?>
    <!--End of Navbar Section-->

    <div class="contactBox">
        <h1 class="contactText">Ready to talk?</h1>
        
        <div class ="contactButtonWrap">
            <button id="toEmailForm" class="contactButtons">I have a question</button>
            <button id="toCalendlyBooker" class="contactButtons">I want to book a session</button>
        </div>
    </div>

<hr />

    <div id="weatherBar" class="fullWidthBar">
        <span id="weatherInfo">Fetching weather data...</span>
    </div>

<hr />

    <section id="bookingSection">
      <div class="bookSessionWrapper" id="bookSessionSection">
        <h2 class="bookSessionHeader">Book a session with Katherine!</h2>
            <div class="calendly-inline-widget" data-url="https://calendly.com/patrick-sullivan-uri/30min"></div>
      </div>
    </section>

<hr />

    <section id="contactSection" class="contact" aria-labelledby="contactTitle">
        <h2 class="emailFormHeader">Send Katherine an email!</h2>
        <form class="contactForm">
            <label class="field">
                <span>Name</span>
                <input type="text" required>
            </label>

            <label class="field">
                <span>Email</span>
                <input type="email" required>
            </label>

            <label class="field">
                <span>Message</span>
                <textarea rows="5" required></textarea>
            </label>

            <button type="submit" class="buttonPrimary">Submit</button>
        </form>
    </section>

    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
    <script src="/client_site/js/contact_page_logic.js"></script>
</body>
</html>
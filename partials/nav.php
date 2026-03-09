<!--
Name: Patrick Sullivan
Filename: nav.php
Date: March 7, 2026
Description: This is a reusable php partial. It takes the html render of my navbar and with
php include, we can display it to each page without needing to hardcode it in.
-->

<!--NavBar Component-->
   <nav class="navBar" id="navLogic">
        <div class="innerNav">
            <img
            src="images/KC_Logo.png"
            alt="Katherine Sullivan LCSW logo"
            class="navLogo"
            />
        <ul class="navList">
            <li class="navbar_home"><a href="./index.php">Home</a></li>
            <li class="navbar_about"><a href="./about.php">About</a></li>
            <li class="navbar_contact_CTA"><a href="./contact.php">Contact</a></li>
        </ul>
    </div>
</nav>



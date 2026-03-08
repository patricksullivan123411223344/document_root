/*
Name: Patrick Sullivan
Date: Feb 15, 2026
File name: contact_page_logic.js
Description: This page consists of two seperate click events from 
two seperate buttons next to eachother on the contact page. One button
scrolls "Email Form" into view, the other scrolls "Session Booker" into
view.
*/

/* Declare variables globally to avoid scope problems */
const questionButton = document.getElementById("toEmailForm");
const bookButton = document.getElementById("toCalendlyBooker");
const bookSection = document.getElementById("bookingSection");
const emailSection = document.getElementById("contactSection");

/* DOM Event handler for Email Form button */
questionButton.addEventListener("click", () => {
    emailSection.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
});

/* DOM Event handler for Session Booker buton */
bookButton.addEventListener("click", () => {
    bookingSection.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
});
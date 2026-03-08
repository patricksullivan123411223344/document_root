/*
Name: Patrick Sullivan
Date: Feb 15 2026
File name: google_maps_api.js
Description: JavaScript logic for the About page that integrates the Google
Maps API. uses fetch() to call the Google Geocoding API and retrieves office 
coordinates asynchronously. Dynamically updates the map center and marker position 
based on returned data. Includes a DOM event attatched to a button, where on click
it recenters the map. Also handles loading/error states for a responsive user 
experience.
*/

//API key
const API_KEY = "AIzaSyCcJfQtl7zxKFtpISZ4Uza01Yx_4kX1oN0"; 

//Helper function to simplify id calls
function $(id) {
  return document.getElementById(id);
}

//Updates status message displayed to user
function setStatus(msg) {
  const el = $("geoStatus");
  if (el) el.textContent = msg;
}

//Updates result message (lat/lng display)
function setResult(msg) {
  const el = $("geoResult");
  if (el) el.textContent = msg;
}

//Uses fetch() to call the Google Geocoding API and return coordinates
async function geocodeAddress(address) {
  setStatus("Loading office coordinates…");
  setResult("");

  const params = new URLSearchParams({ address, key: API_KEY });
  const url = `https://maps.googleapis.com/maps/api/geocode/json?${params.toString()}`;

  const res = await fetch(url);
  if (!res.ok) throw new Error(`HTTP ${res.status}`);

  const data = await res.json();

  console.log("GEOCODE:", data.status, data);

  //Validate API response
  if (data.status !== "OK" || !data.results?.length) {
    throw new Error(`Geocode status: ${data.status}`);
  }

  //Extract lat and lng from response
  const loc = data.results[0].geometry.location; 
  return loc;
}

//Apply coords to the map center and marker position, marker still needs work and is not shown yet.
function applyLocationToMapAndMarker(loc) {
  const mapEl = $("officeMap");
  const markerEl = $("officeMarker");

  if (!mapEl) {
    console.warn("officeMap not found");
    return;
  }

  //Conver coords to required string format
  const posString = `${loc.lat},${loc.lng}`;

  mapEl.setAttribute("center", posString);
  mapEl.setAttribute("zoom", "15");

  if (markerEl) {
    markerEl.setAttribute("position", posString);
  }
}

//Wait until DOM is loaded before running any scripts
document.addEventListener("DOMContentLoaded", async () => {
  const mapEl = $("officeMap");
  const btn = $("recenterBtn");

  const address = "181 Post Road West, Westport, CT";

  let officeLoc = null;

  try {
    //Fetch coordinates from geocoding API
    officeLoc = await geocodeAddress(address);
    setStatus("Office coordinates loaded");
    setResult(`Lat: ${officeLoc.lat.toFixed(5)}  Lng: ${officeLoc.lng.toFixed(5)}`);
    applyLocationToMapAndMarker(officeLoc);
  } catch (err) {
    console.error(err);
    setStatus("Couldn’t load office coordinates.");
    setResult(`Error: ${err.message}`);
  }

  //DOM event 1: recenter on button click
  btn?.addEventListener("click", () => {
    if (!officeLoc) return;
    setStatus("Recentered to office");
    applyLocationToMapAndMarker(officeLoc);
  });

  //DOM event 2: click on the map displays coordinates
  mapEl?.addEventListener("gmp-click", (e) => {
    const ll = e?.detail?.latLng;
    if (!ll) return;

    const lat = typeof ll.lat === "function" ? ll.lat() : ll.lat;
    const lng = typeof ll.lng === "function" ? ll.lng() : ll.lng;

    if (typeof lat !== "number" || typeof lng !== "number") return;

    setStatus("Clicked on map:");
    setResult(`Lat: ${lat.toFixed(5)}  Lng: ${lng.toFixed(5)}`);
  });
});


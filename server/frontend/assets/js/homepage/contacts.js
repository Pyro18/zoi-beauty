console.log('contacts.js loaded');
window.onload = function () {
  const map = L.map('map', {
    scrollWheelZoom: false // Disabilita lo zoom con la rotella del mouse
  }); 

  map.setView([51.505, -0.09], 13); 

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
  }).addTo(map); 

  // Abilita lo zoom con la rotella del mouse solo quando viene premuto il tasto Ctrl
  map.on('keydown', function (e) {
    if (e.originalEvent.ctrlKey) {
      map.scrollWheelZoom.enable();
    }
  });

  // Disabilita lo zoom con la rotella del mouse quando viene rilasciato il tasto Ctrl
  map.on('keyup', function (e) {
    if (!e.originalEvent.ctrlKey) {
      map.scrollWheelZoom.disable();
    }
  });
}
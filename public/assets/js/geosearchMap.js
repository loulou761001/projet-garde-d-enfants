// add to leaflet
let geo = navigator.geolocation
function success(pos) {
    let crd = pos.coords;
    let position = []
    position['longitude'] = crd.longitude
    position['latitude'] = crd.latitude
    console.log(position)

    console.log("https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=AIzaSyB7Bd7FBAfcCuG-i0hKlQBpPX3ytXB0qg0")
}
Autocomplete(document.querySelector('#map'))
if (geo) {
    geo.getCurrentPosition(success)
}



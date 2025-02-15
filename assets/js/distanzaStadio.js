function calculateDistance(lat1, long1, lat2, long2) {

    const R=6371; //raggio della terra

    const dLat=(lat2-lat1) * Math.PI/180;
    const dLon=(lon2-lon1) * Math.PI/180;
    
    const a=Math.sin(dLat/2) * Math.sin(dLat/2) + 
    Math.cos(lat1*Math.PI/180) * Math.cos(lat2*Math.PI/180) * Math.sin(dLon/2) * Math.sin(dLon/2);
              
    const c=2*Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return R * c; // per avere la sitanza in km

}

let lat=null;
let long=null;

function myPos() {
    if (!navigator.geolocation) {
        alert("Il tuo browser non supporta la geolocalizzazione");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        function (position) {
            lat=position.coords.latitude;
            long=position.coords.longitude;
            alert("Latitudine ottenuta: " + lat); //prova stampa valore
            alert("Longitudine ottenuta: " + long);
        },
        function () {
            alert("Errore nella geolocalizzazione");
        },
        { timeout: 10000 }
    );
}

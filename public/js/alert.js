let alertCount = 0; //Értesítés számláló id-hez
$('.inLineAlert').hide();

// Generál egy értesítést
function newPopUpAlert(message, type = 'success') {
    alertCount++;
    const alertId = 'alert-' + alertCount; // Egyedi id

    // Megcsinálja a értesítés html-ét
    let alertHTML = `
        <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
    $('#alertContainer').append(alertHTML);


    // Automatikusan kitörli az értesítést 5mp után
    setTimeout(function() {
        $('#' + alertId).alert('close');
    }, 5000);
}

// Előhívja a beépített alert mezőt
function newInLineAlert(message){
    $('.inLineAlert').text(message);
    $('.inLineAlert').show();
}
// Eltünteti a beépített alert mezőt
function hideInLineAlert(){
    $('.inLineAlert').hide();
}
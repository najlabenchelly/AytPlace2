$('#add-image').click(function () {
    //je reecup le num des futurs champs quee je vqis créer
    const index = +$('widget-counter').val();

    // reecup model form prototypee
    const templt = $('#annonce_images').data('prototype').replace(/__name__/g, index);
    // injection du code dans la div 
    $('#annonce_images').append(templt);
    $("widget-counter").val(index + 1);
    //supression 
    handleDeleteButtons();

});

// suppression champs image 
function handleDeleteButtons() {

    $('button[data-action="delete"]').click(function () {

        const targ = this.dataset.target;
        $(targ).remove();

    });

}
function updateCounter() {

    const count = +$('#ad_images div.form-group').length;
    $('#widget-counter').val(count);
}
updateCounter();
handleDeleteButtons();

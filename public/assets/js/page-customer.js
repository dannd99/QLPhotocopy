$('#upload-avatar').on('change', function(e){
    var img = new Image;
    img.src = URL.createObjectURL(e.target.files[0]);
    img.onload = function() {
        $('.image_upload').attr('src', URL.createObjectURL(e.target.files[0]))
    }
})
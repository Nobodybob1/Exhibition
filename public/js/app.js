$(document).ready(function() {
    $('.message-alert').fadeIn('slow');
    setTimeout(function() {
        $('#message-alert').fadeOut('slow');
    }, 1000); // 5 seconds
});

document.querySelector('.image').addEventListener('change', function () {
    var fileInput = this;
    var previewImage = document.querySelector('.image-preview');

    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
});

// document.getElementById('art_image').addEventListener('change', function () {
//     var fileInput = this;
//     var previewImage = document.getElementById('art-image-preview');

//     if (fileInput.files && fileInput.files[0]) {
//         var reader = new FileReader();

//         reader.onload = function (e) {
//             previewImage.src = e.target.result;
//             previewImage.style.display = 'block';
//         };

//         reader.readAsDataURL(fileInput.files[0]);
//     }
// });
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('preview--image').classList.add("open");
            document.getElementById('preview--image').style.backgroundImage = "url('" + e.target.result + "')";
            document.querySelector('.btn--upload').style.backgroundColor = "#b8b8b8";
        }

        reader.readAsDataURL(input.files[0]);
    }
}
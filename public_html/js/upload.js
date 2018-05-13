function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('preview--image').classList.add("open");
            document.getElementById('preview--image').src = e.target.result;
            $('.uploadedPicture').attr("src", e.target.result);
            $('.form__content__filters').addClass("open");
            document.querySelector('.btn--upload').style.backgroundColor = "#b8b8b8";
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){ 

    if (navigator.geolocation) { 
    
        navigator.geolocation.getCurrentPosition(showLocation); 
    
    } else { 
    
        $('#location').val(''); 
    
    } 
    
    }); 
    
    function showLocation(position) { 
    
    var latitude = position.coords.latitude; 
    
    var longitude = position.coords.longitude; 
    
    $("#latitude").val(latitude);
    
    $("#longitude").val(longitude);
    
    $.ajax({ 
    
    type:'POST', 
    
    url:'getLocation.php', 
    
    data:'latitude='+latitude+'&longitude='+longitude, 
    
    success:function(msg){ 
    
            if(msg){ 
    
               $("#location").val(msg); 
    
            }else{ 
    
                $("#location").val(''); 
    
            } 
    
    } 
    
    }); 
    
var prevClass = "";
$("input:checkbox").on('click', function() {
      var $box = $(this);
      if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
      } else {
        $box.prop("checked", false);
      }
      if( prevClass != $(this).val() ){
        $('#figurePreview').removeClass(prevClass);
      }
      $('#figurePreview').toggleClass($(this).val());
      prevClass= $(this).val();
});
} 

    

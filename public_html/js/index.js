var limit = 20;
var offset = 0;

function loadMore(event) {
        var offset = parseInt($(this).val());
        $.ajax({
            url: "loadMore.php",
            context: this,
            method: "POST",
            data: { limit: limit, offset: offset }
            }).done(function(res) {
                console.log(res);
                if(res == "none"){
                    $('.btn.btn--secondary.btn--loadmore').remove();
                    $('.feed').append("<p class='feed__msg'>End of feed</p>");
                } else {
                    //$('.feed').append(res);
                    $(res).hide().appendTo(".content").fadeIn();
                    $(this).val(offset + 1);
                    $(".like").on("click", likePost);
                    $(".liked").on("click", removeLike);
                    $('.feed__post__info--option.option__mark').on('click', markPost);
                    $('.feed__post__info--more--menu').on('click', closeMenu);
                    $('.feed__post__info--more--button').on('click', openMenu); 
                }
                
        });
        event.preventDefault();
}

$('.btn.btn--secondary.btn--loadmore').on('click', loadMore);
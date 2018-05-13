function likePost() {
    $.ajax({
            url: "likePost.php",
            context: this,
            method: "POST",
            data: { postId: $(this).data("post"), likeType: $(this).data("type") }
            }).done(function() {
                var liked = $( this ).parent().parent().find('.liked');
                var parent = $( this ).parent().find('.like--count');
                var old = liked.parent().find('.like--count');
                var oldcount = parseInt(old.html()) - 1;
                old.html(oldcount);
                liked.removeClass('liked-db');
                liked.toggleClass('like liked');
                liked.off();
                liked.on("click", likePost);
                $( this ).toggleClass('like liked');
                $( this ).off();
                $( this ).on("click", removeLike);
                var newlike = parseInt(parent.html()) + 1;
                parent.html(newlike);
        });
        console.log("added like");
}

function removeLike() {
    $.ajax({
            url: "unlikePost.php",
            context: this,
            method: "POST",
            data: { postId: $(this).data("post") }
            }).done(function() {
                var parent = $( this ).parent().find('.like--count');
                $( this ).removeClass('liked-db');
                $( this ).toggleClass('like liked');
                $( this ).off();
                $( this ).on("click", likePost);
                var newlike = parseInt(parent.html()) - 1;
                parent.html(newlike);
        });
        console.log("removed like");
}

$(".like").on("click", likePost);

$(".liked").on("click", removeLike);


function closeMenu(){
        $(this).removeClass('open');
}

function openMenu(){
        $(this).parent().find('.feed__post__info--more--menu').addClass('open');
}

function markPost(){
        $.ajax({
                url: "markPost.php",
                context: this,
                method: "POST",
                data: { postId: $(this).data("post") }
                }).done(function() {
            });
}
$('.feed__post__info--option.option__mark').on('click', markPost);
$('.feed__post__info--more--menu').on('click', closeMenu);
$('.feed__post__info--more--button').on('click', openMenu);

$('.feed__post__info__add-comment-area').keypress(function(e) {
        if(e.which == 13) {
                $.ajax({
                        url: "addComment.php",
                        context: this,
                        method: "POST",
                        data: { comment: $(this).val(), postId: $(this).data("post") },
                        success: function(data) {
                                var parent = $(this).parent().parent().find('.feed__post__info__comments');
                                if(parent.hasClass('commments--all')){
                                        parent.append('<div class="feed__post__info__comments--comment"><a href="profile.php?user='+$(this).data("post")+'" class="feed__post__info__comments--commentUsername">'+ data + '</a><p>' + $(this).val() + '</p></div>');
                                } else {
                                var counter = parent.children().length;
                                if(counter > 3){
                                        parent.find('.feed__post__info__comments--comment:first-child').remove();
                                }
                                parent.append('<div class="feed__post__info__comments--comment"><a href="profile.php?user='+$(this).data("post")+'" class="feed__post__info__comments--commentUsername">'+ data + '</a><p>' + $(this).val() + '</p></div>');
                                
                                var count = parent.parent().find('.feed__post__info__comments--moreComments .count');
                                var newCount = parseInt(count.html()) +1;
                                count.html(newCount);
                                }
                                $(this).val('');
                        }
                        });
            e.preventDefault();
        }
    });


    $('.feed__post__info--option.option__delete').on("click", deletePost);

    function deletePost() {
        $.ajax({
                url: "deletePost.php",
                context: this,
                method: "POST",
                data: { postId: $(this).data("post") }
                }).done(function() {
        });
    }

   function maxSearch(){
           $('.h1--focal').css('width', '0');
           $('.form__search').css('margin-left', '0');
   }

   function minSearch(){
        $('.h1--focal').css('width', 'auto');
        $('.form__search').css('margin-left', '1rem');
}
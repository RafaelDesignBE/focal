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
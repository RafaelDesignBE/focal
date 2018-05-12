function follow () {
    $.ajax({
            url: "follow.php",
            context: this,
            method: "POST",
            data: { userId: $(this).data("post") }
            }).done(function() {
                $( this ).removeClass('btn--follow');
                $( this ).toggleClass('btn--following');
                $( this ).html('Unfollow');
                $( this ).off();
                $( this ).on("click", unfollow);
    });
};

function unfollow () {
    $.ajax({
            url: "unfollow.php",
            context: this,
            method: "POST",
            data: { userId: $(this).data("post") }
            }).done(function() {
                $( this ).removeClass('btn--following');
                $( this ).toggleClass('btn--follow');
                $( this ).html('Follow');
                $( this ).off();
                $( this ).on("click", follow);
    });
};

$(".btn--follow").on("click", follow);

$(".btn--following").on("click", unfollow);
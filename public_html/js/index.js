var limit = 20;
var offset = 0;

function loadMore(event){
    offset = parseInt($(this).val());
    $(this).val(offset + 1);
    loadFeed(offset);
    event.preventDefault();
}

function loadMyFeed(event) {
    $('.feeds__tabs__selected').css('transform', 'translateX(0)');
    var offset = 0;
    loadFeed(offset);
    $('.btn.btn--secondary.btn--loadmore').val(1);
    event.preventDefault();
}

function loadFeed(offset) {
        $.ajax({
            url: "loadFeed.php",
            context: this,
            method: "POST",
            data: { offset: offset }
            }).done(function(res) {
                if(res == "none"){
                    $('.btn.btn--secondary.btn--loadmore').css('display', 'none'); 
                    if(offset != 0){
                        $("<p class='feed__msg'>End of feed</p>").insertAfter('.feed');
                    } else {
                        $('.feed__post').remove();
                        $('<p class="feed__msg">No posts yet, be sure to follow people!</p>').insertAfter('.feed');
                    }
                } else {
                    $('.feed__post').remove();
                    $('.feed__msg').css('display', 'flex');
                    $('.btn.btn--secondary.btn--loadmore').css('display', 'block'); 
                    $('.feed').append(res);
                    $(".like").on("click", likePost);
                    $(".liked").on("click", removeLike);
                    $('.feed__post__info--option.option__mark').on('click', markPost);
                    $('.feed__post__info--more--menu').on('click', closeMenu);
                    $('.feed__post__info--more--button').on('click', openMenu); 
                    $('.feed__post__info--option.option__delete').on("click", deletePost);
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
                }
                
        });
}

function loadLatest(event) {
    $('.feeds__tabs__selected').css('transform', 'translateX(-100%)');
    $.ajax({
        url: "loadLatest.php",
        context: this,
        method: "POST"
        }).done(function(res) {
            if(res == "none"){
            } else {
                $('.feed__post').remove();
                $('.feed').append(res);
                $(".like").on("click", likePost);
                $(".liked").on("click", removeLike);
                $('.feed__post__info--option.option__mark').on('click', markPost);
                $('.feed__post__info--more--menu').on('click', closeMenu);
                $('.feed__post__info--more--button').on('click', openMenu); 
                $('.feed__post__info--option.option__delete').on("click", deletePost);
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
                $('.btn.btn--secondary.btn--loadmore').css('display', 'none');   
                $('.feed__msg').css('display', 'none');
            }
    });
    event.preventDefault();
}

function loadNearby(event) {
    $('.feeds__tabs__selected').css('transform', 'translateX(100%)');
    var city = $('#location').val();
    $.ajax({
        url: "loadNearby.php",
        context: this,
        method: "POST",
        data: { city: city }
        }).done(function(res) {
            if(res == "none"){
            } else {
                $('.feed__post').remove();
                $('.feed').append(res);
                $(".like").on("click", likePost);
                $(".liked").on("click", removeLike);
                $('.feed__post__info--option.option__mark').on('click', markPost);
                $('.feed__post__info--more--menu').on('click', closeMenu);
                $('.feed__post__info--more--button').on('click', openMenu); 
                $('.feed__post__info--option.option__delete').on("click", deletePost);
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
                $('.btn.btn--secondary.btn--loadmore').css('display', 'none');   
                $('.feed__msg').css('display', 'none');
            }
    });
    event.preventDefault();
}

$('.btn.btn--secondary.btn--loadmore').on('click', loadMore);
$('#myfeed').on('click', loadMyFeed);
$('#latest').on('click', loadLatest);
$('#nearby').on('click', loadNearby);

/* GET LOCATION */
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
    
    $.ajax({ 
    
    type:'POST', 
    
    url:'getCity.php', 
    
    data:'latitude='+latitude+'&longitude='+longitude, 
    
    success:function(msg){ 
    
            if(msg){ 
    
               $("#location").val(msg); 
    
            }else{ 
    
                $("#location").val(''); 
            } 
    
    } 
    
    }); 
    
    } 
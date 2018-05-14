var limit = 20;
var offset = 0;

function loadMore(event){
    offset = parseInt($(this).val());
    $(this).val(offset + 1);
    if( $('.btn.btn--secondary.btn--loadmore').hasClass('myfeed') ){
        loadFeed(offset);
    } else if ( $('.btn.btn--secondary.btn--loadmore').hasClass('latest') ) {
        loadLatest(offset);
    } else if ( $('.btn.btn--secondary.btn--loadmore').hasClass('nearby') ) {
        loadNearby(offset);
    }
    
    event.preventDefault();
}

function getFeed(event) {
    $('.feeds__tabs__selected').css('transform', 'translateX(0)');
    var offset = 0;
    loadFeed(offset);
    $('.btn.btn--secondary.btn--loadmore').removeClass('nearby latest');
    $('.btn.btn--secondary.btn--loadmore').addClass('myfeed');
    $('.btn.btn--secondary.btn--loadmore').val(1);
    event.preventDefault();
}

function getLatest(event) {
    $('.feeds__tabs__selected').css('transform', 'translateX(-100%)');
    var offset = 0;
    loadLatest(offset);
    $('.btn.btn--secondary.btn--loadmore').removeClass('nearby myfeed');
    $('.btn.btn--secondary.btn--loadmore').addClass('latest');
    $('.btn.btn--secondary.btn--loadmore').val(1);
    event.preventDefault();
}

function getNearby(event) {
    $('.feeds__tabs__selected').css('transform', 'translateX(100%)');
    var offset = 0;
    loadNearby(offset);
    $('.btn.btn--secondary.btn--loadmore').removeClass('latest myfeed');
    $('.btn.btn--secondary.btn--loadmore').addClass('nearby');
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
                    if(offset != 0){
                        loadLatest(offset);
                    } else {
                        $('.feed__post').remove();
                        loadLatest(offset);
                    }
                } else {
                    if(offset == 0){
                        $('.feed__post').remove();
                        $(".feed__msg").css('display', 'none');
                    }
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

function loadLatest(offset) {
    
    $.ajax({
        url: "loadLatest.php",
        context: this,
        method: "POST",
        data: { offset: offset }
        }).done(function(res) {
            if(res == "none"){
                $('.btn.btn--secondary.btn--loadmore').css('display', 'none'); 
                if(offset != 0){
                    $(".feed__msg").css('display', 'flex');
                } else {
                    $('.feed__post').remove();
                    $(".feed__msg").css('display', 'flex');
                }
            } else {
                if(offset == 0){
                    $('.feed__post').remove();
                    $(".feed__msg").css('display', 'none');
                }
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
                                        if(res == "none"){
                                            $('.btn.btn--secondary.btn--loadmore').css('display', 'none'); 
                                            if(offset != 0){
                                                $("<p class='feed__msg'>End of feed</p>").insertAfter('.feed');
                                            } else {
                                                $('.feed__post').remove();
                                                $('<p class="feed__msg">You should follow some people!</p>').insertAfter('.feed');
                                            }
                                        } else {
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
                                    }
                                    });
                        e.preventDefault();
                    }
                });
            }
    });
    event.preventDefault();
}

function loadNearby(offset) {
    var city = $('#location').val();
    $.ajax({
        url: "loadNearby.php",
        context: this,
        method: "POST",
        data: { offset: offset, city: city }
        }).done(function(res) {
            if(res == "none"){
                $('.btn.btn--secondary.btn--loadmore').css('display', 'none'); 
                if(offset != 0){
                    $(".feed__msg").css('display', 'flex');
                } else {
                    $('.feed__post').remove();
                    $(".feed__msg").css('display', 'flex');
                }
            } else {
                if(offset == 0){
                    $('.feed__post').remove();
                    $(".feed__msg").css('display', 'none');
                }
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
    event.preventDefault();
}

$('.btn.btn--secondary.btn--loadmore').on('click', loadMore);
$('#myfeed').on('click', getFeed);
$('#latest').on('click', getLatest);
$('#nearby').on('click', getNearby);

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
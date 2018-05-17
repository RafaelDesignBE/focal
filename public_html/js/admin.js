function roleChange(event) {
    var userid = $(this).data(userid)['userid'];
    var role = $(this).val();
    $.ajax({
        url: "adminEdit.php",
        context: this,
        method: "POST",
        data: { user: userid, role: role }
        }).done(function(res) {
            $(this).fadeIn().fadeOut().fadeIn();
    });
    event.preventDefault();
}

function emailEdit(event) {
    if (event.which == 13) {
    var userid = $(this).data(userid)['userid'];
    var email = $(this).val();
    $.ajax({
        url: "adminEdit.php",
        context: this,
        method: "POST",
        data: { user: userid, email: email }
        }).done(function(res) {
            $(this).fadeIn().fadeOut().fadeIn();
    });
    event.preventDefault();
    }
}

function usernameEdit(event) {
    if (event.which == 13) {
    var userid = $(this).data(userid)['userid'];
    var username = $(this).val();
    $.ajax({
        url: "adminEdit.php",
        context: this,
        method: "POST",
        data: { user: userid, username: username }
        }).done(function(res) {
            $(this).fadeIn().fadeOut().fadeIn();
    });
    event.preventDefault();
    }
}

function firstnameEdit(event) {
    if (event.which == 13) {
    var userid = $(this).data(userid)['userid'];
    var firstname = $(this).val();
    $.ajax({
        url: "adminEdit.php",
        context: this,
        method: "POST",
        data: { user: userid, firstname: firstname }
        }).done(function(res) {
            $(this).fadeIn().fadeOut().fadeIn();
    });
    event.preventDefault();
    }
}

function lastnameEdit(event) {
    if (event.which == 13) {
    var userid = $(this).data(userid)['userid'];
    var lastname = $(this).val();
    $.ajax({
        url: "adminEdit.php",
        context: this,
        method: "POST",
        data: { user: userid, lastname: lastname }
        }).done(function(res) {
            $(this).fadeIn().fadeOut().fadeIn();
    });
    event.preventDefault();
    }
}

function lockAccount(event) {
    var userid = $(this).data(userid)['userid'];
    var lock = "lock";
    $.ajax({
        url: "adminEdit.php",
        context: this,
        method: "POST",
        data: { user: userid, lock: lock }
        }).done(function(res) {
            $(this).fadeIn().fadeOut().fadeIn();
    });
    event.preventDefault();
}

function deleteAccount(event) {
    var userid = $(this).data(userid)['userid'];
    var del = 1;
    if($(this).parent().parent().hasClass('deleted')){
        del = 0;
    }
    $.ajax({
        url: "adminEdit.php",
        context: this,
        method: "POST",
        data: { user: userid, del: del }
        }).done(function(res) {
            $(this).fadeIn().fadeOut().fadeIn();
            $(this).parent().parent().toggleClass('deleted');
            if(del == 1){
                $(this).html('recover');
            } else {
                $(this).html('delete');
            }
    });
    event.preventDefault();
}

function passwordEdit(event) {
    if (event.which == 13) {
    var userid = $(this).data(userid)['userid'];
    var password = $(this).val();
    $.ajax({
        url: "adminEdit.php",
        context: this,
        method: "POST",
        data: { user: userid, password: password }
        }).done(function(res) {
            $(this).fadeIn().fadeOut().fadeIn();
    });
    event.preventDefault();
    }
}

function selectRow(event) {
    $(this).parent().toggleClass('selected');
}

$('.lock').on('click', lockAccount);
$('.delete').on('click', deleteAccount);
$('.role').on('change', roleChange);
$('input.email').on('keypress', emailEdit);
$('input.username').on('keypress', usernameEdit);
$('input.firstname').on('keypress', firstnameEdit);
$('input.lastname').on('keypress', lastnameEdit);
$('input.password').on('keypress', passwordEdit);
$('.table__userid').on('click', selectRow);
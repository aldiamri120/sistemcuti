function getNotif() {
    // ajax to get notif
    var html = "";
    $.ajax({
        url: '/api/notif',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.length > 0) {
                $('#tanda').show();
                for (var i = 0; i < data.length; i++) {
                    console.log(data[i].link);
                    html += '<a href="'+data[i].link+'" class="dropdown-item notify-item">    <div class="notify-icon bg-primary">    <i class="mdi mdi-comment-account-outline"></i></div><p class="class="notify-details">Permintaan Cuti Baru !! '+data[i].nama+'</p></a>';
                    
                }
                $('#my-notif').html(html);
            } else {
                $('#tanda').hide();
            }
        },
        error: function (data) {
            console.log(data.responseText);
        }
    });
}
getNotif();
setInterval(getNotif, 3000);
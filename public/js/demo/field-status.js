setInterval(function() {
    if (new Date().getMinutes() === 0) {
        //alert("new minute !");
    }
}, 600000)

function test_field() {
    var field_last = $("#jml").val();
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":00";
    //alert(field_last);
    for (var i = 1; i <= field_last; i++) {
        var Field = $('#f-' + i).val();
        let img = i;
        // alert('#img-' + i);
        $.ajax({
            type: "POST",
            url: "field_status",
            data: {
                BookingDate: date,
                Field: Field,
                time_start: time,
                // _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(response) {
                //alert(response.total);
                if ((response.total) > 0) {
                    //alert(img);
                    $('#img-' + img).attr("src", "img/field-red.png");
                } else {
                    img.attr("src", "img/field-green.png");
                }

            },
            error: function(xhr) {
                console.log(xhr.responseJSON);
            },
        });
    }

}

$(document).ready(function() {
    // run the first time; all subsequent calls will take care of themselves
    // test_field();
    setTimeout(test_field, 1000);
});
$( document ).ready(function() {
    $('#emailExist').hide();

    $("#emailValue").mouseout(function () {
        let emailValue = $("#emailValue").val();

        if (emailValue.length > 0) {

            // console.log('***************');
            // console.log(email);
            // console.log('***************');
            $.ajax({
                type: "POST",
                url: 'app_verify_email',
                data: {'email': emailValue},
                success: function (response) {
                    if (response === 'exist') {
                        $("#emailExist").show();
                    } else {
                        $("#emailExist").hide();
                    }
                },
                error: function (response) {
                    //console.log( response );
                }
            })


        }
    });


});
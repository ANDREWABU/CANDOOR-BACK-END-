// {{-- Custom Work --}}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
    $(".according-menu.other").css("display", "none");
    $(".sidebar-submenu").css("display", "block");
}

$('body').on("click", '#experienceedit', function () {
    var experienceId = $(this).data('id');
    console.log(experienceId)
    var action = $(this).attr('data-url');
    $('#experienceform').attr('action', action);

    $.ajax({
        url: $(this).attr('data-get-url'),
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $('#experienceModal').modal('show');
            $('.progress .progress-bar').css({
                width: "0%",
            })
        },
        success: function (data) {
            $('#experienceModal #experiencetitle').val(data.title);
            $('.progress .progress-bar').css({
                width: "100%",
            })
        }
    })
    // $.get( $(this).attr('data-get-url'), function (data){
    //     console.log(data)
    //     $('#experienceModal').modal('show');
    //      if(!data){
    //          $('.progress .progress-bar').css({
    //              width: "0%",
    //          })
    //      }else{
    //          $('.progress .progress-bar').css({
    //              width: "100%",
    //          })
    //          $('#experienceModal #experiencetitle').val(data.title);
    //      }
    // });
})
$('body').on("click", '#userroleedit', function () {
    var userroleId = $(this).data('id');
    console.log(userroleId)
    var action = $(this).attr('data-url');
    $('#userroleform').attr('action', action);

    $.ajax({
        url: $(this).attr('data-get-url'),
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $('#userroleModal').modal('show');
            $('.progress .progress-bar').css({
                width: "0%",
            })
        },
        success: function (data) {
            console.log(data);
            $('#userroleModal #userroletitle').val(data.name);

            if (data.name === 'Super Admin') {
                $('#userroleModal #userroletitle').attr('readonly', true);
            } else {
                $('#userroleModal #userroletitle').attr('readonly', false);
            }
            $('.progress .progress-bar').css({
                width: "100%",
            })
        },
        complete: function (data) {
            setTimeout(

                $('.progress .progress-bar').css({
                    display: "none",
                }), 3000
            )
        }
    })
    // $.get( $(this).attr('data-get-url'), function (data){
    //
    //     console.log(data)
    //     $('#userroleModal').modal('show');
    //     setTimeout(function() {
    //         $('.progress .progress-bar').css({
    //             width: "100%",
    //         })
    //         $('#userroleModal #userroletitle').val(data.title);
    //     },200)
    //
    // });
})
$('body').on("click", '#userEdit', function () {
    var userId = $(this).data('id');
    console.log(userId)
    var action = $(this).attr('data-url');
    $('#userform').attr('action', action);

    $.ajax({
        url: $(this).attr('data-get-url'),
        type: 'GET',
        dataType: 'json',
        beforeSend: function () {
            $('#userModal').modal('show');
            $('.progress .progress-bar').css({
                width: "0%",
            })
        },
        success: function (data) {
            console.log(data);
            $('#userModal #userfirstname').val(data[0].first_name);
            $('#userModal #userlastname').val(data[0].last_name);
            $('#userModal #status select').val(data[0].status);
            if (data[0].roles.length !== 0) {
                $('#userModal #userrole').val(data[0].roles[0].id);
            }
            if (data[0].roles[0].id == 1) {
                $('#userModal #status').css('display', 'none')
            } else {
                $('#userModal #status').css('display', 'block')
            }
            $('.progress .progress-bar').css({
                width: "100%",
            })
        }

    })

    // $.get( $(this).attr('data-get-url'), function(data){
    //         console.log(data)
    //         $('#userModal').modal('show');
    //         setTimeout(function(){
    //             $('.progress .progress-bar').css({
    //                 width:"100%",
    //             })
    //             $('#userModal #userfirstname').val(data.first_name);
    //             $('#userModal #userlastname').val(data.last_name);
    //             $('#userModal #userrole').val(data.user_role_id);
    //         },200)
    //
    // });
})

// $('.modal').on('hidden.bs.modal', function () {
//     console.log('modal hidden')
//     $('.modal').trigger('reset.bs.modal');
//     $('.progress .progress-bar').css({
//         width: "0%",
//     })
// });

setTimeout(function () {
    // Closing the alert
    $('#alert').alert('close');
}, 3000);
$('.customizer-links').addClass('d-none')
// $(document).ready(function () {
// })

// User Status Update

function statusUpdate(val, userId, baseURl) {
    if (val) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        swal({
            title: 'Are you sure?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(function (isConfirm) {
            if(isConfirm){
                $.ajax({
                    url: baseURl + "/updateUserStatus",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        status: val,
                        userId: userId,
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        $(".loader-wrapper").fadeIn("slow");
                    },
                    success: function (data) {
                        location.reload();
                    },
                    complete: function (response) {
                        $(".loader-wrapper").fadeOut("slow");
                    }

                })
            }
        })
    }
}

$(document).on('click', '.delete__link', function() {
    const room_id = $(this).data('id');
    const row = $(this).closest('tr');
    const rows = $('.table__body tr');

    $.ajax({
        type: 'DELETE',
        url: 'room/' + room_id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {

            row.fadeOut('slow', function() {
                $(this).remove();
                rows.removeClass('blur');
            });

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'ოთახი წარმატებით წაიშალა'
            })

        },
        error: function(response) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'warning',
                title: 'ოთახი ვერ წაიშალა'
            })
        }
    });
});


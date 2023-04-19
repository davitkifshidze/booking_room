$(document).on('click', '.delete__link', function() {
    const booking_id = $(this).data('id');
    const row = $(this).closest('tr');
    const rows = $('.table__body tr');

    $.ajax({
        type: 'DELETE',
        url: 'booking/' + booking_id,
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
                title: 'ჯავშანი წარმატებით წაიშალა'
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
                title: 'ჯავშანი ვერ წაიშალა'
            })
        }
    });
});


// ფილტრაციის ინფუთზე მიმდინარე თარიღ
const date__filter = document.querySelector('input[name="date__filter"]');
if (date__filter.value.trim() === '') {
    const currentDate = new Date();
    const dateString = currentDate.toISOString().slice(0, 10);
    date__filter.value = dateString;
}


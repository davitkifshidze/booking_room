// Modal Close
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = "none";
}

const modal = document.getElementById("modal");
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}

// Clear Modal Input
function clearModal(){
    const form = modal.querySelector('form');
    const formInputs = form.querySelectorAll('input:not(.modal__btn):not([name="_token"]), textarea');
    formInputs.forEach(input => input.value = '');
}

// Clear Modal Error
function clearError(){
    const form = modal.querySelector('form');
    const input_error = form.querySelectorAll('.input__error');
    input_error.forEach(errorDiv => errorDiv.innerHTML = '');
}

// Create Room Ajax Request
function createRoom() {
    $('#room_create_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'ოთახი წარმატებით დაემატა'
                    }).then(function() {
                        closeModal('modal');
                        $('#room_create_form input:not([type="submit"], textarea)').not('[name="_token"]').val('');
                    });
                }
            },
            error: function(response) {
                $('.input__error').remove();
                $.each(response.responseJSON.errors, function(field, errors) {
                    const input = $('[name="' + field + '"]');
                    $.each(errors, function(index, error) {
                        input.after('<div class="input__error">' + error + '</div>');
                    });
                });
            }
        });
    });
}


// Edit Room Ajax Request
function editRoom() {
    $('#room_edit_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'ოთახი წარმატებით განახლდა'
                    }).then(function() {
                        closeModal('modal');
                    });
                }
            },
            error: function(response) {
                $('.input__error').remove();
                $.each(response.responseJSON.errors, function(field, errors) {
                    const input = $('[name="' + field + '"]');
                    $.each(errors, function(index, error) {
                        input.after('<div class="input__error">' + error + '</div>');
                    });
                });
            }
        });
    });
}

// Open Appropriate Modal
function openModal(modalId, action, roomId = null) {
    const modal = document.getElementById(modalId);
    const form = modal.querySelector('form');

    if (action === 'create') {

        clearModal();

        form.action = 'room/create';
        form.method = 'post';
        form.setAttribute('name', 'create');
        form.setAttribute('id', 'room_create_form');

        modal.querySelector('.modal__title').textContent = 'ოთახის დამატება';
        modal.querySelector('.modal__btn').value = 'დამატება';

        createRoom();

    } else if (action === 'edit') {

        clearError();

        form.action = 'room/' + roomId;
        form.method = 'PUT';
        form.setAttribute('name', 'edit');
        form.setAttribute('id', 'room_edit_form');

        modal.querySelector('.modal__title').textContent = 'ოთახის რედაქტირება';
        modal.querySelector('.modal__btn').value = 'რედაქტირება';

        $.ajax({
            url: 'room/' + roomId + '/edit',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response) {

                    form.querySelector(`input[name='name']`).value = response.name;
                    form.querySelector(`input[name='start_date']`).value = response.start_date;
                    form.querySelector(`input[name='end_date']`).value = response.end_date;

                }
            },
            error: function (response) {

            }
        });

        editRoom();

    }
    modal.style.display = "flex";
}

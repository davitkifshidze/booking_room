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

// Create User Ajax Request
function createUser() {
    $('#user_create_form').submit(function(event) {
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
                        title: 'მომხმარებელი წარმატებით დაემატა'
                    }).then(function() {
                        closeModal('modal');
                        $('#user_create_form input:not([type="submit"], textarea)').not('[name="_token"]').val('');
                        location.reload();
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


// Edit User Ajax Request
function editUser() {
    $('#user_edit_form').submit(function(event) {
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
                        title: 'მომხმარებელი წარმატებით განახლდა'
                    }).then(function() {
                        closeModal('modal');
                        location.reload();
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
function openModal(modalId, action, userId = null) {
    const modal = document.getElementById(modalId);
    const form = modal.querySelector('form');

    if (action === 'create') {

        clearModal();

        form.action = 'user/create';
        form.method = 'post';
        form.setAttribute('name', 'create');
        form.setAttribute('id', 'user_create_form');

        modal.querySelector('.modal__title').textContent = 'მომხმარებლის დამატება';
        modal.querySelector('.modal__btn').value = 'დამატება';

        createUser();

    } else if (action === 'edit') {

        clearError();

        form.action = 'user/' + userId;
        form.method = 'PUT';
        form.setAttribute('name', 'edit');
        form.setAttribute('id', 'user_edit_form');

        modal.querySelector('.modal__title').textContent = 'მომხმარებლის რედაქტირება';
        modal.querySelector('.modal__btn').value = 'რედაქტირება';

        $.ajax({
            url: 'user/' + userId + '/edit',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response) {

                    form.querySelector(`input[name='name']`).value = response.name;
                    form.querySelector(`input[name='surname']`).value = response.surname;
                    form.querySelector(`input[name='personal_number']`).value = response.personal_number;

                }
            },
            error: function (response) {

            }
        });

        editUser();

    }
    modal.style.display = "flex";
}

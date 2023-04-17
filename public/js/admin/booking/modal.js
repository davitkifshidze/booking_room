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
    const formInputs = form.querySelectorAll('input:not(.modal__btn):not([name="_token"]), textarea, select');
    formInputs.forEach(input => input.value = '');

    formInputs.forEach(input => {
        if (input.tagName === 'SELECT') {
            const firstOption = input.querySelector('option:first-of-type');
            input.value = '';
            if (firstOption) {
                firstOption.selected = true;
            }
        } else {
            input.value = '';
        }
    });
}

// Clear Modal Error
function clearError(){
    const form = modal.querySelector('form');
    const input_error = form.querySelectorAll('.input__error');
    input_error.forEach(errorDiv => errorDiv.innerHTML = '');
}

// Create Booking Ajax Request
function createBooking() {
    $('#booking_create_form').submit(function(event) {
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
                        title: 'ჯავშანი წარმატებით დაემატა'
                    }).then(function() {
                        closeModal('modal');
                        $('#booking_create_form input:not([type="submit"], textarea)').not('[name="_token"]').val('');
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
function openModal(modalId, action, bookingId = null) {
    const modal = document.getElementById(modalId);
    const form = modal.querySelector('form');

    if (action === 'create') {

        clearModal();

        form.action = 'booking/create';
        form.method = 'post';
        form.setAttribute('name', 'create');
        form.setAttribute('id', 'booking_create_form');

        modal.querySelector('.modal__title').textContent = 'ჯავშნის დამატება';
        modal.querySelector('.modal__btn').value = 'დამატება';


        const room_select = document.getElementById("room_id");

        room_select.addEventListener("change", function() {

            let start_date, end_date;

            const room_option = room_select.options[room_select.selectedIndex];
            const room_id = room_option.value;

            $.ajax({
                url: 'booking/room/' + room_id,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response) {

                        calendar_start_date = response.room.start_date;
                        calendar_end_date = response.room.end_date;

                        let invalid_date = response.booking;

                        let change_value;
                        let active_value;
                        let start_date;
                        let end_date;
                        let date_end;

                        const invalidDates = [];

                        // არა ვალიდური დროები
                        invalid_date.forEach(date => {
                            invalidDates.push({
                                "start": date.start_date,
                                "end": date.end_date
                            });
                        });

                        console.log(invalidDates);

                        // შაბათ კვირის გაღიშვა
                        invalidDates.push(
                            {
                                recurring: {
                                    repeat: 'weekly',
                                    weekDays: 'SA,SU'
                                }
                            }
                        );

                        // დიაპაზონი რომელშიც აქტიური იქნება კალენდარი
                        const currentTime = new Date().getTime();
                        const currentYear = new Date().getFullYear();
                        const lastDayOfYear = new Date(currentYear, 11, 31);


                        const now = new Date();
                        now.setHours(now.getHours() + 1);
                        now.setMinutes(0);
                        now.setSeconds(0);
                        const current__date = now.getFullYear() + "-" + ("0" + (now.getMonth() + 1)).slice(-2) + "-" + ("0" + now.getDate()).slice(-2) + " " + ("0" + now.getHours()).slice(-2) + ":" + ("0" + now.getMinutes()).slice(-2) + ":" + ("0" + now.getSeconds()).slice(-2);

                        const calendar = mobiscroll.datepicker('#booking__calendar', {
                            display: 'inline',
                            controls: ['calendar', 'timegrid'],

                            // აქტიური თარიღები
                            min: currentTime,
                            max: lastDayOfYear,

                            // გრაფიკის დასაწყისი და დასასრული
                            minTime: calendar_start_date,
                            maxTime: calendar_end_date,

                            // კონკრეტული თარიღის მონიშვნა რედაქტირებისთვის
                            defaultSelection: current__date,

                            stepMinute: 60,


                            onChange: function (event, inst) {

                                let inputDateStr = event.valueText;

                                let inputDate = new Date(inputDateStr);

                                let year = inputDate.getFullYear();
                                let month = inputDate.getMonth() + 1;
                                let day = inputDate.getDate();
                                let hours = inputDate.getHours();
                                let minutes = inputDate.getMinutes();

                                month = month < 10 ? '0' + month : month;
                                day = day < 10 ? '0' + day : day;
                                hours = hours < 10 ? '0' + hours : hours;
                                minutes = minutes < 10 ? '0' + minutes : minutes;

                                // შეცვლის მომენტში თარიღის დაჭერა და კოვერტაცია
                                change_value = `${year}-${month}-${day} ${hours}:${minutes}:00`;

                                // დაწყების და დასრულების თარიღების ინპუთების შექმნა და მინიშვნელობის მინიჭება
                                start_date = change_value;

                                // დასასრულის თარიღის გენერირება და ფორმატირება
                                const start_date_fr = new Date(start_date);
                                const end_date = new Date(start_date_fr.getTime() + (59 * 60 * 1000));
                                const end_date_str = end_date.getFullYear() + "-" + ("0" + (end_date.getMonth() + 1)).slice(-2) + "-" + ("0" + end_date.getDate()).slice(-2) + " " + ("0" + end_date.getHours()).slice(-2) + ":" + ("0" + end_date.getMinutes()).slice(-2) + ":" + ("0" + end_date.getSeconds()).slice(-2);


                                // შესაბამისი ინფუთის მიმაგრება ფორმაზე
                                const form = document.getElementById('booking_create_form');
                                const input = document.getElementById('start_date');

                                if (input) {
                                    input.value = start_date;
                                } else {
                                    const newInput = document.createElement('input');
                                    newInput.type = 'hidden';
                                    newInput.name = 'start_date';
                                    newInput.id = 'start_date';
                                    newInput.value = start_date;
                                    form.appendChild(newInput);
                                }

                                const input_end_date = document.getElementById('end_date');

                                if (input_end_date) {
                                    input_end_date.value = end_date_str;
                                } else {
                                    const new_end_date_input = document.createElement('input');
                                    new_end_date_input.type = 'hidden';
                                    new_end_date_input.name = 'end_date';
                                    new_end_date_input.id = 'end_date';
                                    new_end_date_input.value = end_date_str;
                                    form.appendChild(new_end_date_input);
                                }

                                console.log(start_date)
                                console.log(end_date_str)


                            },

                            invalid: invalidDates

                        });

                        calendar.setOptions({
                            locale: mobiscroll.localeEn,
                            theme: 'ios',
                            themeVariant: 'light',
                        });

                        let dateString = calendar.getVal();
                        let dateObj = new Date(dateString);

                        let year = dateObj.getFullYear();
                        let month = ("0" + (dateObj.getMonth() + 1)).slice(-2);
                        let day = ("0" + dateObj.getDate()).slice(-2);
                        let hours = ("0" + dateObj.getHours()).slice(-2);
                        let minutes = ("0" + dateObj.getMinutes()).slice(-2);
                        let seconds = ("0" + dateObj.getSeconds()).slice(-2);

                        // ოთახების გადართვის მომენტში თარიღის დაჭერა და კოვერტაცია
                        active_value = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;

                    }
                },
                error: function (response) {

                }
            });

        });

        createBooking();

    }

    modal.style.display = "flex";
}

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
                        location.reload();
                    });
                }
            },
            error: function(response) {

                const form = modal.querySelector('form');
                let booking_error = form.querySelector('#booking__error');
                let errors = response.responseJSON.errors;

                if (errors) {
                    let errorMsg = '';
                    for (const key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMsg += `${errors[key][0]}<br>`;
                        }
                    }
                    booking_error.innerHTML = errorMsg;
                } else {
                    booking_error.innerHTML = response.responseJSON.message;
                }

                $('.input__error').remove();

            }
        });
    });
}


// ჯავშნის გაკეთება შესაძლებელი იყოს დასასრულამდე 1 საათითი ადრე
function subtractOneHour(end_date) {
    let [hours, minutes] = end_date.split(":").map(Number);
    hours = (hours - 1 + 24) % 24;
    return `${hours.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}`;
}

// დასაწყისის თარიღის გენერირება და ფორმატირება
function formatStartDate(start_date) {
    const inputDate = new Date(start_date);
    const year = inputDate.getFullYear();
    const month = (inputDate.getMonth() + 1).toString().padStart(2, '0');
    const day = inputDate.getDate().toString().padStart(2, '0');
    const hours = inputDate.getHours().toString().padStart(2, '0');
    const minutes = inputDate.getMinutes().toString().padStart(2, '0');
    return `${year}-${month}-${day} ${hours}:${minutes}:00`;
}

// დასასრულის თარიღის გენერირება და ფორმატირება
function calculateEndDate(end_date) {
    const date_end = new Date(end_date);
    const date = new Date(date_end.getTime() + (59 * 60 * 1000));
    return date.getFullYear() + "-" + ("0" + (date.getMonth() + 1)).slice(-2) + "-" + ("0" + date.getDate()).slice(-2) + " " + ("0" + date.getHours()).slice(-2) + ":" + ("0" + date.getMinutes()).slice(-2) + ":" + ("0" + date.getSeconds()).slice(-2);
}

// დასასწყისის და დასსასრულის ინფუთის გენერირება
function createHiddenInput(name) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.id = name;
    return input;
}

// მიმდინარე გრაფიკის აღება საათის დამრგვალება ქვედა თანრიგამდე
function roundDownMinutes(date) {
    const now = new Date();
    now.setHours(now.getHours());
    now.setMinutes(0);
    now.setSeconds(0);
    return now.getFullYear() + "-" + ("0" + (now.getMonth() + 1)).slice(-2) + "-" + ("0" + now.getDate()).slice(-2) + " " + ("0" + now.getHours()).slice(-2) + ":" + ("0" + now.getMinutes()).slice(-2) + ":" + ("0" + now.getSeconds()).slice(-2);
}

// მიმდინარე თარიღის აღება სათის დამრგვალებით მეტობით
function getCurrentDateTimeRoundUp(){
    const now = new Date();
    now.setHours(now.getHours() + 1);
    now.setMinutes(0);
    now.setSeconds(0);
    return now.getFullYear() + "-" + ("0" + (now.getMonth() + 1)).slice(-2) + "-" + ("0" + now.getDate()).slice(-2) + " " + ("0" + now.getHours()).slice(-2) + ":" + ("0" + now.getMinutes()).slice(-2) + ":" + ("0" + now.getSeconds()).slice(-2);
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


            const room_option = room_select.options[room_select.selectedIndex];
            const room_id = room_option.value;

            $.ajax({
                url: 'booking/room/' + room_id,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response) {

                        let calendar_start_date = response.room.start_date;
                        let calendar_end_date = subtractOneHour(response.room.end_date);
                        let invalid_date = response.booking;
                        let invalidDates = [];
                        let roundedDown = roundDownMinutes(new Date());
                        let current_date = getCurrentDateTimeRoundUp();

                        // არა ვალიდური დროები
                        invalid_date.forEach(date => {
                            invalidDates.push({
                                "start": date.start_date,
                                "end": date.end_date
                            });
                        });
                        // შაბათ კვირის ჩათიშვა
                        invalidDates.push(
                            {
                                recurring: {
                                    repeat: 'weekly',
                                    weekDays: 'SA,SU'
                                }
                            }
                        );
                        // განვლილი თარიღების ჩათიშვა
                        invalidDates.push({
                            "start": "2000-01-01 00:00:00",
                            "end": roundedDown
                        });

                        const calendar = mobiscroll.datepicker('#booking__calendar', {
                            display: 'inline',
                            controls: ['calendar', 'timegrid'],
                            minTime: calendar_start_date,
                            maxTime: calendar_end_date,
                            defaultSelection: current_date,
                            stepMinute: 60,

                            onChange: function (event, inst) {

                                let inputDateStr = event.valueText;
                                let start_date = formatStartDate(inputDateStr);
                                let end_date = calculateEndDate(start_date)

                                const form = document.getElementById('booking_create_form');
                                const inputStartDate = document.getElementById('start_date') || createHiddenInput('start_date');
                                const inputEndDate = document.getElementById('end_date') || createHiddenInput('end_date');

                                inputStartDate.value = start_date;
                                inputEndDate.value = end_date;

                                if (!document.getElementById('start_date')) {
                                    form.appendChild(inputStartDate);
                                }

                                if (!document.getElementById('end_date')) {
                                    form.appendChild(inputEndDate);
                                }

                            },

                            invalid: invalidDates

                        });

                        calendar.setOptions({
                            locale: mobiscroll.localeEn,
                            theme: 'ios',
                            themeVariant: 'light',
                        });


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

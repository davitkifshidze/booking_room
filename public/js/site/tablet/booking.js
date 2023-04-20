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
function getCurrentDateTimeRoundUp() {
    const now = new Date();
    now.setHours(now.getHours() + 1);
    now.setMinutes(0);
    now.setSeconds(0);
    return now.getFullYear() + "-" + ("0" + (now.getMonth() + 1)).slice(-2) + "-" + ("0" + now.getDate()).slice(-2) + " " + ("0" + now.getHours()).slice(-2) + ":" + ("0" + now.getMinutes()).slice(-2) + ":" + ("0" + now.getSeconds()).slice(-2);
}

// Create Booking Ajax Request
function createBooking() {
    // $( "#room_booking_form" ).submit();
    $('#room_booking_form').submit(function(event) {
        console.log(this, '111');
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
                        // location.reload();
                    });
                }
            },
            error: function(response) {


            }
        });
    });
}


const room_id = document.getElementById("room_id").value;
$.ajax({
    url: room_id + '/booking',
    method: 'GET',
    dataType: 'json',
    success: function (response) {
        if (response) {

            const personal_number_input = document.getElementById('personal_number');
            const booking__btn = document.getElementById('booking__btn');

            booking__btn.addEventListener('click', function(event) {
                event.preventDefault();

                console.log(personal_number_input);

                if (!personal_number_input.value) {

                    console.log('222');


                    const hidden__modal = document.getElementById('hidden__modal');
                    hidden__modal.style.display = 'block';

                    const close = document.getElementById('close');

                    close.addEventListener('click', function(event) {
                        hidden__modal.style.display = 'none';
                    });

                    const user__form = document.getElementById('user__form');

                    user__form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        $.ajax({
                            url:'user',
                            method: 'POST',
                            dataType: 'json',
                            data: $(this).serialize(),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.success) {

                                    const user = response.user;
                                    const user_personal_number = document.getElementById('personal_number');
                                    user_personal_number.value = user.personal_number;

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
                                        title: 'მომხმარებელი იდენტიფიცირებულია'
                                    }).then(function() {
                                        hidden__modal.style.display = 'none';
                                        // $( "#room_booking_form" ).submit();
                                        createBooking();
                                    });


                                } else {

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
                                        icon: 'warning',
                                        title: 'მსგავსი მომხმარებელი არ არსებობს'
                                    })

                                }
                            },
                            error: function (response) {

                                const form = document.getElementById('user__form');
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

                            }

                        });

                    });

                }else{
                    // PErsnoal number no

                }

            });

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

                    const form = document.getElementById('room_booking_form');
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




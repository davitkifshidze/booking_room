const room_id = document.getElementById("room_id").value;
const start__booking = document.getElementById("start__booking");

start__booking.addEventListener("click", function () {

    $.ajax({
        url: room_id + '/booking',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response) {

                calendar_start_date = response.room.start_date;
                calendar_end_date_one = response.room.end_date;

                // ერთი საათის გამოკლება დასასრულის დროს რომ არ მოხდეს დაჯავშა
                let timeStr_one = calendar_end_date_one;
                let [hours_one, minutes_one] = timeStr_one.split(":").map(Number);
                hours_one = (hours_one - 1 + 24) % 24;
                let result = `${hours_one.toString().padStart(2, "0")}:${minutes_one.toString().padStart(2, "0")}`;
                calendar_end_date = result;

                let invalid_date = response.booking;

                let change_value;
                let start_date;

                const invalidDates = [];

                // არა ვალიდური დროები
                invalid_date.forEach(date => {
                    invalidDates.push({
                        "start": date.start_date,
                        "end": date.end_date
                    });
                });

                // შაბათ კვირის გაღიშვა
                invalidDates.push(
                    {
                        recurring: {
                            repeat: 'weekly',
                            weekDays: 'SA,SU'
                        }
                    }
                );

                // გრაფიკის დროის დასრულების შემდეგ მთელი საათების ჩათიშვა
                now_date = new Date();
                curent_now_date = now_date.getFullYear() + "-" + ("0" + (now_date.getMonth() + 1)).slice(-2) + "-" + ("0" + now_date.getDate()).slice(-2);
                currentHourMinutes = now_date.getHours() + ":" + now_date.getMinutes();

                if (currentHourMinutes > calendar_end_date) {
                    invalidDates.push({
                        "start": curent_now_date + " 00:00:00",
                        "end": curent_now_date + " 23:59:59"
                    });
                }

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
                        const form = document.getElementById('room_booking_form');
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

                    },

                    invalid: invalidDates

                });

                calendar.setOptions({
                    locale: mobiscroll.localeEn,
                    // theme: 'ios',
                    // themeVariant: 'light',
                });


            }
        },
        error: function (response) {

        }

    });


});


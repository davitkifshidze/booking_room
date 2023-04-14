<div id="modal" class="room__modal">

    <div class="modal__content">
        <div class="modal__header">
            <p class="modal__title"></p>
            <span class="close" onclick="closeModal('modal')">&times;</span>
        </div>
        <div class="modal__body">

            <form>
                @csrf

                <div class="form__group">
                    <div class="input__group">
                        <label for="name" class="label">
                            <p>ოთახი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>
                        <input type="text" id="name" name="name">
                    </div>
                </div>

                <div class="form__group">
                    <div class="input__group">
                        <label for="start_date" class="label">
                            <p>დაწყების თარიღი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>

                        <input type="time" id="start_date" name="start_date">
                    </div>
                    <div class="input__group">
                        <label for="end_date" class="label">
                            <p>დასრულების თარიღი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>
                        <input type="time" id="end_date" name="end_date">
                    </div>
                </div>

                <div class="form__buttons">
                    <input class="modal__btn" type="submit">
                </div>

            </form>

        </div>
    </div>

</div>


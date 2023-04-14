<div id="modal" class="user__modal">

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
                            <p>სახელი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>

                        <input type="text" id="name" name="name">
                    </div>
                    <div class="input__group">
                        <label for="surname" class="label">
                            <p>გვარი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>
                        <input type="text" id="surname" name="surname">
                    </div>
                </div>

                <div class="form__group">
                    <div class="input__group">
                        <label for="personal_number" class="label">
                            <p>პირადი ნომერი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>

                        <input type="text" id="personal_number" name="personal_number">
                    </div>
                    <div class="input__group">
                        <label for="password" class="label">
                            <p>პაროლი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>
                        <input type="password" id="password" name="password">
                    </div>
                </div>

                <div class="form__buttons">
                    <input class="modal__btn" type="submit">
                </div>

            </form>

        </div>
    </div>

</div>


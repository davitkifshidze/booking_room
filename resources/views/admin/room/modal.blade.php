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

                        <input type="time" id="start_date" name="start_date" list="start_date_list" >
                        <datalist id="start_date_list">
                            @for ($i = 0; $i <= 24; $i++)
                                @if($i < 10)
                                    <option value="0{{ $i + 1 }}:00">
                                @else
                                    <option value="{{ $i + 1 }}:00">
                                @endif
                            @endfor
                        </datalist>
                    </div>
                    <div class="input__group">
                        <label for="end_date" class="label">
                            <p>დასრულების თარიღი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>
                        <input type="time" id="end_date" name="end_date" list="end_date_list" >
                        <datalist id="end_date_list">
                            @for ($i = 0; $i <= 24; $i++)
                                @if($i < 10)
                                    <option value="0{{ $i + 1 }}:00">
                                @else
                                    <option value="{{ $i + 1 }}:00">
                                @endif
                            @endfor
                        </datalist>
                    </div>
                </div>

                <div class="form__buttons">
                    <input class="modal__btn" type="submit">
                </div>

            </form>

        </div>
    </div>

</div>


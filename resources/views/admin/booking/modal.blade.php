<div id="modal" class="booking__modal">

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
                        <label for="select__room" class="label">
                            <p>ოთახი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>

                        <select class="select__input" name="room_id" id="room_id" placeholder="აირჩიე ოთახი">
                            <option value="">აირჩიე ოთახი</option>
                            @foreach($rooms as $key => $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input__group">
                        <label for="select__user" class="label">
                            <p>მომხმარებელი</p>
                            <span><i class="fa-solid fa-snowflake"></i></span>
                        </label>

                        <select class="select__input" name="user_id" id="user_id" placeholder="აირჩიე მომხმარებელი">
                            <option value="">აირჩიე მომხმარებელი</option>
                            @foreach($users as $key => $user)
                                <option value="{{ $user->id }}">{{ $user->personal_number }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <div id="booking__calendar" class="booking-datetime"></div>
                </div>

                <div class="form__buttons">
                    <input class="modal__btn" type="submit">
                </div>

            </form>

        </div>
    </div>

</div>

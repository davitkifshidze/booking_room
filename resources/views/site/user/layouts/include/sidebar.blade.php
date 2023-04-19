<nav class="sidebar__navigation__container">

    <div class="sidebar__header">
        <div class="shrink__btn">
            <i id="shrink" class="fa-solid fa-bars"></i>
        </div>
        <a href="{{ route('user_dashboard') }}">
            <h3 class="header__title sidebar__logo__title">{{ $user->name . ' ' . $user->surname }}</h3>
        </a>
    </div>

    <div class="sidebar__main__content">
        <ul>
            <li class="sidebar__menu__item">
                <a href="{{ route('user_dashboard') }}" class="sidebar__menu__link">
                    <i class="sidebar__menu__link__icon fa-solid fa-cubes-stacked"></i>
                    <span class="sidebar__menu__title">დაფა</span>
                </a>
            </li>
            <li class="sidebar__menu__item">
                <a href="{{ route('user_booking') }}" class="sidebar__menu__link">
                    <i class="sidebar__menu__link__icon fa-solid fa-shield-halved"></i>
                    <span class="sidebar__menu__title">ჯავშნები</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

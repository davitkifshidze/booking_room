<nav class="sidebar__navigation__container">

    <div class="sidebar__header">
        <div class="shrink__btn">
            <i id="shrink" class="fa-solid fa-bars"></i>
        </div>
        <a href="{{ route('dashboard') }}">
            <h3 class="header__title sidebar__logo__title">თოდუას კლინიკა</h3>
        </a>

    </div>

    <div class="sidebar__main__content">
        <ul>
            <li class="sidebar__menu__item">
                <a href="{{ route('dashboard') }}" class="sidebar__menu__link">
                    <i class="sidebar__menu__link__icon fa-solid fa-cubes-stacked"></i>
                    <span class="sidebar__menu__title">დაფა</span>
                </a>
            </li>
            <li class="sidebar__menu__item sidebar__menu__item__parent">
                <a href="javascript:void(0)" class="sidebar__menu__link sidebar__menu__link__parent">
                    <i class="sidebar__menu__link__icon fa-solid fa-plus"></i>
                    <span class="sidebar__menu__title">დამატება</span>
                    <i class="fa fa-angle-down sidebar__menu__item__parent__arrow"></i>
                </a>
                <ul class="sidebar__submenu">
                    <li class="sidebar__submenu__item">
                        <a href="{{ route('user_list') }}" class="sidebar__submenu__link ">
                            <i class="sidebar__submenu__link__icon fa-solid fa-user-plus"></i>
                            <span class="sidebar__submenu__title">მომხმარებლები</span>
                        </a>
                    </li>
                    <li class="sidebar__submenu__item">
                        <a href="{{ route('room_list') }}" class="sidebar__submenu__link">
                            <i class="sidebar__submenu__link__icon fa-solid fa-house-medical"></i>
                            <span class="sidebar__submenu__title">ოთახები</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar__menu__item">
                <a href="{{ route('booking') }}" class="sidebar__menu__link">
                    <i class="sidebar__menu__link__icon fa-solid fa-shield-halved"></i>
                    <span class="sidebar__menu__title">ჯავშნები</span>
                </a>
            </li>
        </ul>

        <div class="logout__container">
            <a href="{{ route('admin_logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="sidebar__menu__title__logout">გასვლა</span>
            </a>
        </div>

    </div>
</nav>

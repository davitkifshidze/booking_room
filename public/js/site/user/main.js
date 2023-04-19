// საიდბარის შეკეცვა | გამოშლა
const shrink__btn = document.querySelector('.shrink__btn')
shrink__btn.addEventListener('click', () => {
    const template = document.querySelector('.user__interface__template')
    template.classList.toggle('shrink')

    const shrink_icon = document.querySelector('#shrink')

    if (shrink_icon.classList.contains('fa-bars')) {
        shrink_icon.classList.remove('fa-bars')
        shrink_icon.classList.add('fa-chart-simple')
    } else {
        shrink_icon.classList.remove('fa-chart-simple')
        shrink_icon.classList.add('fa-bars')
    }

    if (window.innerWidth < 776) {
        const style = (node, styles) => Object.keys(styles).forEach((key) => (node.style[key] = styles[key]))

        const templateElement = document.getElementById('page__template')
        const templateClasses = templateElement.classList
        let main__container = document.querySelector('.main__container')

        if (templateClasses.contains('shrink')) {
            style(main__container, {
                // transform: 'scaleX(0)',
                display: 'none',
            })
        } else {
            style(main__container, {
                // transform: 'scaleX(1)',
                display: 'flex',

            })
        }
    }

    const header = document.querySelector('.header')
    header.classList.toggle('header__shrink')

    const main__content = document.querySelector('.main__content')
    main__content.classList.toggle('main__content__shrink')

})



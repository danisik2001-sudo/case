<template>
    <div>
        <div
            id="kt_header_mobile"
            class="kt-header-mobile kt-header-mobile--fixed"
        >
            <div class="kt-header-mobile__logo">
                <router-link :to="{ name: 'index' }">
                    <img alt="Logo" src="/dash/img/logo-light.png" />
                </router-link>
            </div>
            <div class="kt-header-mobile__toolbar">
                <button
                    class="kt-header-mobile__toggler kt-header-mobile__toggler--left"
                    id="kt_aside_mobile_toggler"
                >
                    <span></span>
                </button>
                <button
                    class="kt-header-mobile__topbar-toggler"
                    id="kt_header_mobile_topbar_toggler"
                >
                    <i class="flaticon-more"></i>
                </button>
            </div>
        </div>
        <div class="kt-grid kt-grid--hor kt-grid--root">
            <div
                class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page"
            >
                <button class="kt-aside-close" id="kt_aside_close_btn">
                    <i class="la la-close"></i>
                </button>

                <div
                    class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
                    id="kt_aside"
                >
                    <div
                        class="kt-aside__brand kt-grid__item"
                        id="kt_aside_brand"
                    >
                        <div class="kt-aside__brand-logo">
                            <router-link tag="a" :to="{ name: 'index' }">
                                <img
                                    alt="Logo"
                                    src="/dash/img/logo-light.png"
                                />
                            </router-link>
                        </div>
                    </div>

                    <div
                        class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid"
                        id="kt_aside_menu_wrapper"
                    >
                        <div
                            id="kt_aside_menu"
                            class="kt-aside-menu"
                            data-ktmenu-vertical="1"
                            data-ktmenu-scroll="1"
                            data-ktmenu-dropdown-timeout="500"
                        >
                            <ul class="kt-menu__nav">
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'index',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'index' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-dashboard"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Статистика</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'logs',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'logs' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <span class="kt-menu__link-icon"
                                                ><i class="flaticon-list-2"></i
                                            ></span>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Логи</span
                                        >
                                    </router-link>
                                </li>
                                <li class="kt-menu__section">
                                    <h4 class="kt-menu__section-text">
                                        Управление кейсами
                                    </h4>
                                    <i
                                        class="kt-menu__section-icon flaticon-more-v2"
                                    ></i>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'cases',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'cases' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-open-box"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Кейсы</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'all_items',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'all_items' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-list-2"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Предметы</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'categories',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'categories' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-list"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Категории</span
                                        >
                                    </router-link>
                                </li>
                                <li class="kt-menu__section">
                                    <h4 class="kt-menu__section-text">
                                        Управление сайтом
                                    </h4>
                                    <i
                                        class="kt-menu__section-icon flaticon-more-v2"
                                    ></i>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'users',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'users' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-users"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Пользователи</span
                                        >
                                    </router-link>
                                </li>
                                <li class="kt-menu__section">
                                    <h4 class="kt-menu__section-text">
                                        Управление календарем
                                    </h4>
                                    <i
                                        class="kt-menu__section-icon flaticon-more-v2"
                                    ></i>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'calendar',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'calendar' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-calendar"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Призы</span
                                        >
                                    </router-link>
                                </li>
                                <li class="kt-menu__section">
                                    <h4 class="kt-menu__section-text">
                                        Управление барабаном
                                    </h4>
                                    <i
                                        class="kt-menu__section-icon flaticon-more-v2"
                                    ></i>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'wheelItems',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'wheelItems' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-cogwheel-1"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Призы</span
                                        >
                                    </router-link>
                                </li>
                                <li class="kt-menu__section">
                                    <h4 class="kt-menu__section-text">
                                        Управление методами
                                    </h4>
                                    <i
                                        class="kt-menu__section-icon flaticon-more-v2"
                                    ></i>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'paymentMethods',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'paymentMethods' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-cogwheel-1"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Методы</span
                                        >
                                    </router-link>
                                </li>
                                <li class="kt-menu__section">
                                    <h4 class="kt-menu__section-text">
                                        Управление розыгрышами
                                    </h4>
                                    <i
                                        class="kt-menu__section-icon flaticon-more-v2"
                                    ></i>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'raffleHour',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'raffleHour' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-list"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Каждый час</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'raffleDay',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'raffleDay' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-list"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Каждый день</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'raffleWeek',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'raffleWeek' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-list"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Каждую неделю</span
                                        >
                                    </router-link>
                                </li>
                                <li class="kt-menu__section">
                                    <h4 class="kt-menu__section-text">
                                        СИСТЕМА
                                    </h4>
                                    <i
                                        class="kt-menu__section-icon flaticon-more-v2"
                                    ></i>
                                </li>

                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'notification',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'notification' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-up-arrow"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Уведомления</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'promocodes',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'promocodes' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-up-arrow"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Промокоды</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'payments',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'payments' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-up-arrow"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Пополнения</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'withdraws',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'withdraws' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <i class="flaticon-download"></i>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Выводы</span
                                        >
                                    </router-link>
                                </li>
                                <li
                                    class="kt-menu__item"
                                    :class="{
                                        'kt-menu__item--active':
                                            $route.name === 'settings',
                                    }"
                                    aria-haspopup="true"
                                >
                                    <router-link
                                        tag="a"
                                        :to="{ name: 'settings' }"
                                        class="kt-menu__link"
                                    >
                                        <span class="kt-menu__link-icon">
                                            <span class="kt-menu__link-icon"
                                                ><i
                                                    class="flaticon-cogwheel-2"
                                                ></i
                                            ></span>
                                        </span>
                                        <span class="kt-menu__link-text"
                                            >Настройки</span
                                        >
                                    </router-link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div
                    class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper"
                    id="kt_wrapper"
                >
                    <div
                        id="kt_header"
                        class="kt-header kt-grid__item kt-header--fixed"
                    >
                        <button
                            class="kt-header-menu-wrapper-close"
                            id="kt_header_menu_mobile_close_btn"
                        >
                            <i class="la la-close"></i>
                        </button>

                        <div class="kt-header__topbar">
                            <div
                                class="kt-header__topbar-item kt-header__topbar-item--user"
                            >
                                <div
                                    class="kt-header__topbar-wrapper"
                                    data-toggle="dropdown"
                                    data-offset="0px,0px"
                                >
                                    <div class="kt-header__topbar-user">
                                        <span
                                            class="kt-header__topbar-welcome kt-hidden-mobile"
                                            >Привет,</span
                                        >
                                        <span
                                            class="kt-header__topbar-username kt-hidden-mobile"
                                            >{{ $root.user.username }}</span
                                        >
                                        <img
                                            alt="Pic"
                                            :src="$root.user.avatar"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl"
                                >
                                    <div
                                        class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                                        style="
                                            background-image: url(/dash/img/bg-1.jpg);
                                        "
                                    >
                                        <div class="kt-user-card__avatar">
                                            <img
                                                alt="Pic"
                                                :src="$root.user.avatar"
                                            />
                                        </div>
                                        <div class="kt-user-card__name">
                                            {{ $root.user.username }}
                                        </div>
                                    </div>
                                    <div class="kt-notification">
                                        <a
                                            href="/admin/user/"
                                            class="kt-notification__item"
                                        >
                                            <div
                                                class="kt-notification__item-icon"
                                            >
                                                <i
                                                    class="flaticon2-calendar-3 kt-font-success"
                                                ></i>
                                            </div>
                                            <div
                                                class="kt-notification__item-details"
                                            >
                                                <div
                                                    class="kt-notification__item-title kt-font-bold"
                                                >
                                                    Мой профиль
                                                </div>
                                                <div
                                                    class="kt-notification__item-time"
                                                >
                                                    Настройки Вашего аккаунта
                                                </div>
                                            </div>
                                        </a>
                                        <div class="kt-notification__custom">
                                            <a
                                                href="/"
                                                class="btn btn-label-brand btn-sm btn-bold"
                                                >Вернуться на сайт</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
                    >
                        <router-view></router-view>
                    </div>

                    <div
                        class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop"
                    >
                        <div class="kt-footer__copyright">2024 htmlpixel</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="kt_scrolltop" class="kt-scrolltop">
            <i class="fa fa-arrow-up"></i>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style scoped>
.kt-grid.kt-grid--hor:not(.kt-grid--desktop):not(
        .kt-grid--desktop-and-tablet
    ):not(.kt-grid--tablet):not(.kt-grid--tablet-and-mobile):not(
        .kt-grid--mobile
    )
    > .kt-grid__item {
    justify-content: end;
}
</style>

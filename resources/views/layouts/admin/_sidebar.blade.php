<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{ route('participant.dashboard') }}" class="header-logo">
            <img src="../assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
            <img src="../assets/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
            <img src="../assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
            <img src="../assets/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
            <img src="../assets/images/brand-logos/desktop-white.png" alt="logo" class="desktop-white">
            <img src="../assets/images/brand-logos/toggle-white.png" alt="logo" class="toggle-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Principal</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.dashboard') }}" class="side-menu__item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Tableau de bord</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Utilisateurs</span></li>
                <!-- End::slide__category -->

                @if (Auth::user()->role == 'admin')
                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.admin.index') }}" class="side-menu__item {{ request()->routeIs('admin.admin.*') ? 'active' : '' }}">
                        <i class="bx bx-user-check side-menu__icon"></i>
                        <span class="side-menu__label">Admins</span>
                    </a>
                </li>

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.organizer.index') }}" class="side-menu__item {{ request()->routeIs('admin.organizer.*') ? 'active' : '' }}">
                        <i class="bx bx-user-voice side-menu__icon"></i>
                        <span class="side-menu__label">Organisateurs</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.guest.printedList') }}" class="side-menu__item">
                        <i class="bx bx-user-voice side-menu__icon"></i>
                        <span class="side-menu__label">Liste à imprimer</span>
                    </a>
                </li>
                <!-- End::slide -->
                @endif

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.guest.index') }}" class="side-menu__item {{ request()->routeIs('admin.guest.*') ? 'active' : '' }}">
                        <i class="bx bx-user side-menu__icon"></i>
                        <span class="side-menu__label">Participants</span>
                    </a>
                </li>
                <!-- End::slide -->

                @if (Auth::user()->role == 'admin')
                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Paramètres</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.setting.index') }}" class="side-menu__item {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                        <i class="bx bx-wrench side-menu__icon"></i>
                        <span class="side-menu__label">Généraux</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item {{ request()->routeIs('admin.page.*') ? 'active' : '' }}">
                        <i class="bx bx-code side-menu__icon"></i>
                        <span class="side-menu__label">Pages</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Pages</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.page.home.index') }}" class="side-menu__item {{ request()->routeIs('admin.page.home.*') ? 'active' : '' }}">Accueil</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.page.about.index') }}" class="side-menu__item {{ request()->routeIs('admin.page.about.*') ? 'active' : '' }}">A propos</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.page.contact.index') }}" class="side-menu__item {{ request()->routeIs('admin.page.contact.*') ? 'active' : '' }}">Contact</a>
                        </li>
                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.slide.index') }}" class="side-menu__item {{ request()->routeIs('admin.slide.*') ? 'active' : '' }}">
                        <i class="bx bx-images side-menu__icon"></i>
                        <span class="side-menu__label">Slides</span>
                    </a>
                </li>
                <!-- End::slide -->
                @endif

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Finance</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.payment.index') }}" class="side-menu__item {{ request()->routeIs('admin.payment.*') ? 'active' : '' }}">
                        <i class="bx bx-coin side-menu__icon"></i>
                        <span class="side-menu__label">Cotisations</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.income.index') }}" class="side-menu__item {{ request()->routeIs('admin.income.*') ? 'active' : '' }}">
                        <i class="bx bx-wallet side-menu__icon"></i>
                        <span class="side-menu__label">Entrées</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.expense.index') }}" class="side-menu__item {{ request()->routeIs('admin.expense.*') ? 'active' : '' }}">
                        <i class="bx bx-money side-menu__icon"></i>
                        <span class="side-menu__label">Dépenses</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Préparatifs</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.task.index') }}" class="side-menu__item {{ request()->routeIs('admin.task.*') ? 'active' : '' }}">
                        <i class="bx bx-task side-menu__icon"></i>
                        <span class="side-menu__label">Tâches</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.special.guest.index') }}" class="side-menu__item {{ request()->routeIs('admin.special.guest.*') ? 'active' : '' }}">
                        <i class="bx bx-user-minus side-menu__icon"></i>
                        <span class="side-menu__label">Invités</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.testimony.index') }}" class="side-menu__item {{ request()->routeIs('admin.testimony.*') ? 'active' : '' }}">
                        <i class="bx bx-user-voice side-menu__icon"></i>
                        <span class="side-menu__label">Témoignages</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.sponsor.index') }}" class="side-menu__item {{ request()->routeIs('admin.sponsor.*') ? 'active' : '' }}">
                        <i class="bx bx-store-alt side-menu__icon"></i>
                        <span class="side-menu__label">Sponsors</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.event.index') }}" class="side-menu__item {{ request()->routeIs('admin.event.*') ? 'active' : '' }}">
                        <i class="bx bx-calendar-event side-menu__icon"></i>
                        <span class="side-menu__label">Evénements</span>
                    </a>
                </li>
                <!-- End::slide -->

                <li class="slide">
                    <a href="{{ route('admin.system.notification.index') }}" class="side-menu__item {{ request()->routeIs('admin.system.notification.*') ? 'active' : '' }}">
                        <i class="bx bx-send side-menu__icon"></i>
                        <span class="side-menu__label">Notifications Système</span>
                    </a>
                </li>

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.invitation.index') }}" class="side-menu__item {{ request()->routeIs('admin.invitation.*') ? 'active' : '' }}">
                        <i class="bx bx-party side-menu__icon"></i>
                        <span class="side-menu__label">Invitations</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Interactions</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.vote.category.index') }}" class="side-menu__item {{ request()->routeIs('admin.vote.category.*') ? 'active' : '' }}">
                        <i class="bx bx-tag-alt side-menu__icon"></i>
                        <span class="side-menu__label">Vote</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.interaction.index') }}" class="side-menu__item {{ request()->routeIs('admin.interaction.*') ? 'active' : '' }}">
                        <i class="bx bx-slider-alt side-menu__icon"></i>
                        <span class="side-menu__label">Interactions</span>
                    </a>
                </li>
                <!-- End::slide -->

                <!-- Start::slide__category -->
                <li class="slide__category"><span class="category-name">Courriers</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{ route('admin.message.index') }}" class="side-menu__item {{ request()->routeIs('admin.message.*') ? 'active' : '' }}">
                        <i class="bx bx-envelope side-menu__icon"></i>
                        <span class="side-menu__label">Messages</span>
                    </a>
                </li>
                <!-- End::slide -->

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Abs Events Management</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        <li class="menu-label">Manage Site</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Les Utilisateurs</div>
            </a>
            <ul>
                <li> <a href="{{ route('user.all') }}"><i class="bx bx-right-arrow-alt"></i>Liste des Utilisateurs</a>
                </li>
                <li> <a href="{{ route('user.add') }}"><i class="bx bx-right-arrow-alt"></i>Créer Un Utilisateur</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Evènement</div>
            </a>
            <ul>
                <li> <a href="{{ route('event.all') }}"><i class="bx bx-right-arrow-alt"></i>Tout Les Evènements</a>
                </li>
                <li> <a href="{{ route('event.add') }}"><i class="bx bx-right-arrow-alt"></i>Ajouter Un Evènement</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Categorie Evènement</div>
            </a>
            <ul>
                <li> <a href="{{ route('category.all') }}"><i class="bx bx-right-arrow-alt"></i>Toutes Les Categories Evènement</a>
                </li>
                <li> <a href="{{ route('category.add') }}"><i class="bx bx-right-arrow-alt"></i>Ajouter Une Categorie Evènement</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Slider</div>
            </a>
            <ul>
                <li> <a href=""><i class="bx bx-right-arrow-alt"></i>All Slider</a>
                </li>
                <li> <a href=""><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>

            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Nomine</div>
            </a>
            <ul>
                <li> <a href="{{ route('nomine.all') }}"><i class="bx bx-right-arrow-alt"></i>Tous Les Nomines </a>
                </li>
                <li> <a href="{{ route('nomine.add') }}"><i class="bx bx-right-arrow-alt"></i>Ajouter Un Nomine</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="">
                <div class="parent-icon"><i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Contact Message</div>
            </a>
        </li>

        <li>
            <a href="">
                <div class="parent-icon"><i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">All Review</div>
            </a>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Site Info</div>
            </a>
            <ul>
                <li> <a href=""><i class="bx bx-right-arrow-alt"></i>Get Site Info</a>
                </li>

            </ul>
        </li>
        <li class="menu-label">Customer Order</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
                </div>
                <div class="menu-title">Manage Order</div>
            </a>
            <ul>
                <li> <a href=""><i class="bx bx-right-arrow-alt"></i>Pending Order</a>
                </li>
                <li> <a href=""><i class="bx bx-right-arrow-alt"></i>Processing Order</a>
                </li>
                <li> <a href=""><i class="bx bx-right-arrow-alt"></i>Complete Order</a>
                </li>

            </ul>
        </li>


        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
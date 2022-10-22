@guest
    <li class="scroll-to-section  "><a class="{{ Request::is('home') ? '' : 'active' }}"
            href="{{ route('home') }}">Home</a>
    </li>
    <li class="scroll-to-section  "><a class="{{ Request::is('products/products-all') ? '' : 'active' }}"
            href="{{ url('producst/products-all') }}">All Books</a>
    </li>

    <li class="scroll-to-section  "><a class="active" href="{{ route('login') }}">Login</a>
    </li>

    <li class="scroll-to-section  "><a class="active" href="{{ route('register') }}">Register</a>
    </li>

    <a class='menu-trigger'>
        <span>Menu</span>
    </a>
@endguest


@auth

    @if (Auth()->user()->profile == 'ADMIN')
        <li class="scroll-to-section  "><a class="{{ Request::is('home') ? '' : 'active' }}"
                href="{{ route('home') }}">Home</a>
        </li>


        <li class="submenu"><a
                class="{{ (((Request::is('products/crud-products')? 'active': '' || Request::is('products/crud-categories'))? '': 'active' || Request::is('authors/crud-authors'))? '': 'active' || Request::is('users/crud-users'))? '': 'active' }} "
                href="{{ url('products/crud-products') }}">Cruds</a>

            <ul>

                <li class="scroll-to-section  ">
                    <a class=" {{ Request::is('products/crud-products') ? '' : 'active' }}"
                        href="{{ url('products/crud-products') }}">Products</a>
                </li>
                <li class="scroll-to-section  ">
                    <a class="{{ Request::is('products/crud-categories') ? '' : 'active' }}"
                        href="{{ url('products/crud-categories') }}">Categories</a>
                </li>
                <li class="scroll-to-section  ">
                    <a class="{{ Request::is('authors/crud-authors') ? '' : 'active' }}"
                        href="{{ url('authors/crud-authors') }}">Authors</a>
                </li>
                <li class="scroll-to-section ">
                    <a class="{{ Request::is('users/crud-users') ? '' : 'active' }}"
                        href="{{ url('users/crud-users') }}">Users</a>
                </li>

            </ul>

        </li>

        <li class="submenu "><a
                class="{{ (Request::is('reports/users-cashout')? 'active': '' || Request::is('reports/general-cashout'))? '': 'active' }} "
                href="{{ url('reports/users-cashout') }}">CashOut</a>
            <ul>
                <li>
                    <a class="{{ Request::is('reports/general-cashout') ? 'bg-secondary' : '' }}"
                        href="{{ url('reports/general-cashout') }}">General</a>
                </li>
            </ul>
        </li>


        <li class="submenu "><a
                class="{{ ((Request::is('graphics/users-graphics-report')? '': 'active' || Request::is('graphics/products-graphics-report'))? '': 'active' || Request::is('graphics/sales-graphics-report'))? '': 'active' }}  "
                href="#">Graphics</a>
            <ul>
                <li>
                    <a class="{{ Request::is('graphics/users-graphics-report') ? 'bg-secondary' : '' }}"
                        href="{{ url('graphics/users-graphics-report') }}">Users</a>
                </li>
                <li>
                    <a class="{{ Request::is('graphics/products-graphics-report') ? 'bg-secondary' : '' }}"
                        href="{{ url('graphics/products-graphics-report') }}">Products</a>
                </li>
                <li>
                    <a class="{{ Request::is('graphics/sales-graphics-report') ? 'bg-secondary text-white' : '' }}"
                        href="{{ url('graphics/sales-graphics-report') }}">Sales</a>
                </li>
            </ul>
        </li>
        <li class="submenu"><a
                class="{{ (Request::is('users/profile-settings')? '': 'active' || Request::is('users/user-historial'))? '': 'active' }}"
                href="{{ url('users/profile-settings') }}"> <span><img
                        src="{{ asset('storage/users/' . Auth()->user()->imagen) }}" alt="" height="35" width="35"
                        class="rounded-circle">
                </span>Profile</a>

            <ul>
                <li>
                    <a class="{{ Request::is('users/user-historial') ? 'bg-secondary ' : '' }}"
                        href={{ url('users/user-historial') }}>Historial</a>

                </li>
                <li>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                        href={{ route('logout') }}>Logout</a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                    </form>
                </li>

            </ul>

        </li>
    @else
        <li class="scroll-to-section  "><a class="{{ Request::is('home') ? '' : 'active' }}"
                href="{{ route('home') }}">Home</a>
        </li>
        <li class="scroll-to-section  "><a class="{{ Request::is('products/products-all') ? '' : 'active' }}"
                href="{{ url('products/products-all') }}">All Books</a>
        </li>

        <li class="submenu"><a
                class="{{ (Request::is('users/profile-settings')? '': 'active' || Request::is('users/user-historial'))? '': 'active' }}"
                href="{{ url('users/profile-settings') }}"> <span><img
                        src="{{ asset('storage/users/' . Auth()->user()->imagen) }}" alt="" height="35" width="35"
                        class="rounded-circle">
                </span>Profile</a>

            <ul>
                <li>
                    <a class="{{ Request::is('users/user-historial') ? 'bg-secondary ' : '' }}"
                        href={{ url('users/user-historial') }}>Historial</a>

                </li>

                <li>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                        href={{ route('logout') }}>Logout</a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                    </form>
                </li>
            </ul>

        </li>
    @endif
    @if (count(Cart::getContent()))
        <li> <a href="{{ route('users.cart-items') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="blue"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>

                <span>{{ $cartTotalQuantity = Cart::getTotalQuantity() }}</span>
            </a>
        </li>
    @endif
@endauth

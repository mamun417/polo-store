@push('style')
    <style>
        .list-group-item.active {
            background-color: rgba(0, 42, 92, 0.2);
            border-color: rgba(0, 42, 92, 0.2);
        }
    </style>
@endpush

<div class="card shadow mb-3 mt-3 topBorder">
    <div class="card-body">
        <table>
            <tr>
                <td class="pr-3">
                    <img src="{{ isset(auth()->user()->image) && auth()->user()->image->url ? auth()->user()->image->url : asset('frontend/assets/images/user.svg') }}" class="rounded-circle" alt="Cinque Terre" width="48" height="48">
                </td>
                <td>
                    {{ @$user->name }}
                </td>
            </tr>
        </table>
    </div>
</div>

<ul class="list-group shadow mb-3">
    <li class="list-group-item {{ getActiveClassByController('UserProfileController') }}"><a href="{{ route('user.profile') }}">My Profile</a></li>
    <li class="list-group-item {{ getActiveClassByController('UserOrderController') }}"><a href="{{ route('user.orders.index') }}">My Orders</a></li>
    <li class="list-group-item {{ getActiveClassByController('UserOfferController') }}"><a href="{{ route('user.offers.index') }}">My Offers</a></li>
    <li class="list-group-item "><a href="{{ route('cart.index') }}">My Cart</a></li>
    <li class="list-group-item">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span>LOGOUT</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>

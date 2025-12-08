<div class="list-group">

    <a href="{{ route('accounts.index') }}"
       class="list-group-item list-group-item-action 
       {{ request()->routeIs('accounts.index') ? 'active' : '' }}">
        Thông tin khách hàng
    </a>

    <a href="{{ route('accounts.edit') }}"
       class="list-group-item list-group-item-action
       {{ request()->routeIs('accounts.edit') ? 'active' : '' }}">
        Cập nhật thông tin
    </a>

    <a href="{{ route('accounts.orders') }}"
       class="list-group-item list-group-item-action
       {{ request()->routeIs('accounts.orders') ? 'active' : '' }}">
        Đơn hàng của bạn
    </a>

</div>

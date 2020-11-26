<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('static/images/logo.png') }}" alt="logo" class="img-fluid">
        </div>
        <div class="user">
            <span class="subtitle">Hola:</span>
            <div class="name">
                {{ \Illuminate\Support\Facades\Auth::user()->name }} {{ \Illuminate\Support\Facades\Auth::user()->lastname }}
                <a href="{{ url('/logout') }}" data-toggle="tooltip" data-placement="top" title="Cerrar Sesión">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
            <div class="email">{{ \Illuminate\Support\Facades\Auth::user()->email }}</div>
        </div>
    </div>
    <div class="main">
        <ul>
            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'dashboard'))
                <li><a href="{{ url('/admin') }}"><i class="fas fa-home"></i>Dashboard</a></li>
            @endif
            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'products'))
                <li><a href="{{ url('/admin/products/1') }}"><i class="fas fa-boxes"></i>Productos</a></li>
            @endif
            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'categories'))
                <li><a href="{{ url('/admin/categories/0') }}"><i class="fas fa-folder-open"></i>Categorias</a></li>
            @endif
            @if(kvfj(\Illuminate\Support\Facades\Auth::user()->permissions, 'users_list'))
                 <li><a href="{{ url('/admin/users/all') }}"><i class="fas fa-users"></i>Usuarios</a></li>
            @endif
        </ul>
    </div>
</div>

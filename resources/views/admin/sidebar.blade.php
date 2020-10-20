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
            <li><a href="{{ url('/admin') }}"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i>Productos</a></li>
            <li><a href="{{ url('/admin/categories') }}"><i class="fas fa-folder-open"></i>Categorias</a></li>
            <li><a href="{{ url('/admin/users') }}"><i class="fas fa-users"></i>Usuarios</a></li>
        </ul>
    </div>
</div>

<div class="sidebar shadow">
  <div class="section-top">
    <!-- <img src="{{ url('static/images/logo.jpg') }}" alt="Sublime Logo"> -->
    <h1 class="logo">S</h1>

    <div class="user">
      <span class="subtitle">Bienvenido:</span>
      <div class="name">
          {{ Auth::user()->name }} {{ Auth::user()->lastname }}
        <a href="{{url('/logout')}}" data-toggle="tooltip" data-placement="top" title="Salir">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </div>
      <div class="email">
        {{ Auth::user()->email }}

      </div>
    </div>

  </div>

  <div class="main">
      <ul>
        @if(kvfj(Auth::user()->permissions, 'dashboard'))
        <li><a href="{{url('/admin')}}" class="lk-dashboard"><i class="fas fa-home"></i>Dashboard</a></li>
        @endif
        
        @if(kvfj(Auth::user()->permissions, 'user_list'))
        <li><a href="{{url('admin/users/all')}}" class="lk-user_list lk-user_edit lk-user_permissions"><i class="fas fa-user-friends"></i>Usuarios</a></li>
        @endif

        @if(kvfj(Auth::user()->permissions, 'products'))
        <li><a href="{{url('admin/products/1')}}" class="lk-products lk-products_add lk-products_edit"><i class="fas fa-boxes"></i>Productos</a></li>
        @endif
        
        @if(kvfj(Auth::user()->permissions, 'categories'))
        <li><a href="{{url('admin/categories/0')}}" class="lk-categories lk-categories_add lk-categories_edit lk-categories_delete"><i class="fas fa-folders"></i>Categorias</a></li>
        @endif

        @if(kvfj(Auth::user()->permissions, 'settings'))
        <li><a href="{{url('admin/settings')}}" class="lk-settings"><i class="fas fa-cogs"></i>Configuraciones</a></li>
        @endif

        @if(kvfj(Auth::user()->permissions, 'orders_list'))
        <li><a href="{{url('admin/orders')}}" class="lk-orders_list"><i class="fas fa-clipboard"></i>Ordenes</a></li>
        @endif

        @if(kvfj(Auth::user()->permissions, 'messages_list'))
        <li><a href="{{url('admin/messages')}}" class="lk-messages_list"><i class="fas fa-envelope"></i>Mensajes</a></li>
        @endif

        @if(kvfj(Auth::user()->permissions, 'sliders_list'))
        <li><a href="{{url('admin/sliders')}}" class="lk-sliders_list"><i class="fas fa-images"></i>Sliders</a></li>
        @endif

        {{-- <li><a href="{{url('/admin')}}"><i class="fas fa-images"></i>Sliders</a></li> --}}
      </ul>
  </div>
</div>

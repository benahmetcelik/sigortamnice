<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="index.html" class="logo-dark">
            <img src="{{asset('backend')}}/assets/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="{{asset('backend')}}/assets/images/logo-dark.png" class="logo-lg" alt="logo dark">
        </a>

        <a href="index.html" class="logo-light">
            <img src="{{asset('backend')}}/assets/images/logo-sm.png" class="logo-sm" alt="logo sm">
            <img src="{{asset('backend')}}/assets/images/logo-light.png" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:hamburger-menu-broken" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar>

        <ul class="navbar-nav" id="navbar-nav">

            <li class="menu-title">Menu</li>

            <li class="nav-item {{ isActiveRoute('admin.dashboard') }}">
                <a class="nav-link {{ isActiveRoute('admin.dashboard') }}" href="{{route('admin.dashboard')}}">
                                   <span class="nav-icon">
                                        <iconify-icon icon="fluent-color:home-32"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Anasayfa </span>
                </a>
            </li>

            <li class="nav-item {{ isActiveRoute('admin.allowed-domains.index') }}">
                <a class="nav-link {{ isActiveRoute('admin.allowed-domains.index') }}" href="{{route('admin.allowed-domains.index')}}">
                                   <span class="nav-icon">
                                 <iconify-icon icon="logos:google-domains-icon"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Domain Yönetimi </span>
                </a>
            </li>
            <li class="nav-item {{ isActiveRoute('admin.themes.index') }}">
                <a class="nav-link {{ isActiveRoute('admin.themes.index') }}" href="{{route('admin.themes.index')}}">
                                   <span class="nav-icon">
                                 <iconify-icon icon="unjs:theme-colors"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Tema Yönetimi </span>
                </a>
            </li>

            <li class="nav-item {{ isActiveRoute('admin.users.index') }}">
                <a class="nav-link {{ isActiveRoute('admin.users.index') }}" href="{{route('admin.users.index')}}">
                                   <span class="nav-icon">
                                 <iconify-icon icon="fluent-color:people-24"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Kullanıcı Yönetimi </span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ isActiveRoute('admin.blog.index') }}" href="#blogs" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="blogs">
                                   <span class="nav-icon">
                                        <iconify-icon icon="vscode-icons:file-type-libreoffice-writer"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Blog Yönetimi </span>
                </a>
                <div class="collapse" id="blogs">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.blog.create') }}" href="{{route('admin.blog.create')}}">Ekle</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.blog.index') }}" href="{{route('admin.blog.index')}}">Listele</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ isActiveRoute('admin.blogcategory.index') }}" href="#blog-category" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="blog-category">
                                   <span class="nav-icon">
                                        <iconify-icon icon="icon-park:color-filter"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Kategori Yönetimi </span>
                </a>
                <div class="collapse" id="blog-category">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.blogcategory.create') }}" href="{{route('admin.blogcategory.create')}}">Ekle</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.blogcategory.index') }}" href="{{route('admin.blogcategory.index')}}">Listele</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ isActiveRoute('admin.blogcomment.index') }}" href="#blogcomment" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="blogcomment">
                                   <span class="nav-icon">
                                        <iconify-icon icon="fluent-color:chat-more-24"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Yorum Yönetimi </span>
                </a>
                <div class="collapse" id="blogcomment">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.blogcomment.create') }}" href="{{route('admin.blogcomment.create')}}">Ekle</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.blogcomment.index') }}" href="{{route('admin.blogcomment.index')}}">Listele</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ isActiveRoute('admin.teklif-al.index') }}" href="#teklif-al" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="teklif-al">
                                   <span class="nav-icon">
                                        <iconify-icon icon="fluent-color:chat-more-24"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Teklifler </span>
                </a>
                <div class="collapse" id="teklif-al">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.teklif-al.create') }}" href="{{route('admin.teklif-al.create')}}">Teklif Al</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.teklif-al.index') }}" href="{{route('admin.teklif-al.index')}}">Tekliflerim</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ isActiveRoute('admin.customers.index') }}" href="#customers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="customers">
                                   <span class="nav-icon">
                                        <iconify-icon icon="fluent-color:people-24"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Müşteri Yönetimi </span>
                </a>
                <div class="collapse" id="customers">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.customers.create') }}" href="{{route('admin.customers.create')}}">Yeni Müşteri</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.customers.index') }}" href="{{route('admin.customers.index')}}">Müşteri Listesi</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow {{ isActiveRoute('admin.dealers.index') }}" href="#dealers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="dealers">
                                   <span class="nav-icon">
                                        <iconify-icon icon="fluent-color:building-store-16"></iconify-icon>
                                   </span>
                    <span class="nav-text"> Bayi Yönetimi </span>
                </a>
                <div class="collapse" id="dealers">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.dealers.create') }}" href="{{route('admin.dealers.create')}}">Yeni Bayi</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link {{ isActiveRoute('admin.dealers.index') }}" href="{{route('admin.dealers.index')}}">Bayi Listesi</a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>

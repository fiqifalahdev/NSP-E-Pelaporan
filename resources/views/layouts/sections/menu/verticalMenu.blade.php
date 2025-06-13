<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
                @include('_partials.macros', ['height' => 20])
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">{{ config('variables.templateName') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="menu-toggle-icon d-xl-block align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @php
            $userRole = Auth::user()->role ?? 'guest';
        @endphp

        @foreach ($menuData[0]->menu as $menu)
            @php
                $user = Auth::user();
                $userRole = $user->role ?? null; // Sesuaikan field role kamu
                $menuRoles = $menu->roles ?? null;

                // Jika menu memiliki batasan role dan role user tidak ada dalam daftar, skip menu ini
                if ($menuRoles && !in_array($userRole, $menuRoles)) {
                    continue;
                }
            @endphp

            {{-- Menu Header --}}
            @if (isset($menu->menuHeader))
                <li class="menu-header mt-7">
                    <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
                </li>
                @continue
            @endif

            @php
                $activeClass = null;
                $currentRouteName = Route::currentRouteName();

                if ($currentRouteName === $menu->slug) {
                    $activeClass = 'active';
                } elseif (isset($menu->slug) && is_array($menu->slug)) {
                    foreach ($menu->slug as $slug) {
                        if ($currentRouteName === $slug) {
                            $activeClass = 'active';
                        }
                    }
                } elseif (isset($menu->submenu)) {
                    if (is_array($menu->slug ?? null)) {
                        foreach ($menu->slug as $slug) {
                            if (str_starts_with($currentRouteName, $slug)) {
                                $activeClass = 'active open';
                                break;
                            }
                        }
                    } elseif (str_starts_with($currentRouteName, $menu->slug ?? '')) {
                        $activeClass = 'active open';
                    }
                }
            @endphp

            {{-- Menu Item --}}
            <li class="menu-item {{ $activeClass }}">
                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                    class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                    @if (isset($menu->target)) target="{{ $menu->target }}" @endif>
                    @isset($menu->icon)
                        <i class="{{ $menu->icon }}"></i>
                    @endisset
                    <div>{{ __($menu->name ?? '') }}</div>
                    @isset($menu->badge)
                        <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>
                    @endisset
                </a>

                {{-- Submenu --}}
                @isset($menu->submenu)
                    @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
                @endisset
            </li>
        @endforeach
    </ul>

</aside>

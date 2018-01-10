<div class="page-sidebar-wrapper">
<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
    <!-- BEGIN SIDEBAR MENU -->
    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        @foreach($hMenu as $menu)
            <?php

            // Intrecetta se il menu principale  è aperto
            $open = false;
            $actualRouteName = $activeRoute;
            $menuRouteName = $menu['routeName'];
            if(strpos($activeRoute,".") !== false) {
                $actualRouteName = substr($activeRoute,0,strpos($activeRoute,"."));
                $menuRouteName = substr($menu['routeName'],0,strpos($menu['routeName'],"."));
            }

            if($actualRouteName == $menuRouteName) $open = true;

            if(!$open) {
                foreach($menu['childs'] as $child) {
                    if(strpos($activeRoute,".") !== false) {
                        $actualRouteName = substr($activeRoute,0,strpos($activeRoute,"."));
                        $menuRouteName = substr($child['routeName'],0,strpos($child['routeName'],"."));
                    }

                    if($actualRouteName == $menuRouteName) $open = true;
                }
            }
            ?>
            <li class="nav-item @if($open) open @endif ">
                <?php
                ?>
                <a href="@if($menu['routeName'] !== null) {{ route($menu['routeName']) }} @endif" class="nav-link nav-toggle">
                    @if($menu['icon'] !== null)
                        <i class="{{ $menu['icon'] }}"></i>
                    @endif
                    <span class="title">{{ $menu['label'] }}</span>
                    @if(count($menu['childs']) != 0)
                        <span class="selected"></span>
                        <span class="arrow @if($open) open @endif"></span>
                    @endif
                </a>
                @if(count($menu['childs']) != 0)
                    <ul class="sub-menu" @if($open) style="display: block;" @endif>
                        @foreach($menu['childs'] as $child)
                            <?php
                            $open = false;
                            $actualRouteName = $activeRoute;
                            $menuRouteName = $child['routeName'];

                            if(strpos($activeRoute,".") !== false && $menu['openFull'] == false) {
                            $actualRouteName = substr($activeRoute,0,strpos($activeRoute,"."));
                            $menuRouteName = substr($child['routeName'],0,strpos($child['routeName'],"."));
                            }

                            if($actualRouteName == $menuRouteName) $open = true;
                            ?>
                            <li class="nav-item @if($open) open @endif">
                                <a href="@if($child['routeName']) {{route($child['routeName'], $child['routeParam'])}} @else # @endif" class="nav-link ">
                                    @if($child['icon'] !== null)
                                        <i class="{{ $child['icon'] }}"></i>
                                    @endif
                                    <span class="title">{{ $child['label'] }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
    <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->
</div>
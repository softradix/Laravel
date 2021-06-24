<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ URL::to('admin/users-list') }}" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Users</span></a></li>
                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ URL::to('admin/amenities-list') }}" aria-expanded="false"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Amenities</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ URL::to('admin/rules-list') }}" aria-expanded="false"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Rules</span></a></li> -->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ URL::to('admin/shelters-list') }}" aria-expanded="false"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Shelters</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ URL::to('admin/reported-shelters') }}" aria-expanded="false"><i class="mdi mdi-note-outline"></i><span class="hide-menu">Reported Shelters</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

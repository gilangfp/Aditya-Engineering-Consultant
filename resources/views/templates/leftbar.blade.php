<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        {{-- <div class="image">
            <img src="vendor/adminbsb/images/user.png" width="48" height="48" alt="User" />
        </div> --}}
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }}
            </div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    {{-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li> --}}
                    {{-- <li role="separator" class="divider"></li> --}}
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="/home">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">widgets</i>
                    <span>Data Master</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="/laporankegiatan">
                            <i class="material-icons">work</i>
                            <span>Laporan-Kegiatan</span>
                        </a>
                    </li>
                    @if (Auth::user()->id_level == 1)
                   
                    <li>
                        <a href="/proyek">
                            <i class="material-icons">gavel</i>
                            <span>Proyek</span>
                        </a>
                    </li>
                    <li>
                        <a href="/departemen">
                            <i class="material-icons">people</i>
                            <span>Departemen</span>
                        </a>
                    </li>
                    <li>
                        <a href="/sub">
                            <i class="material-icons">people</i>
                            <span>Sub Departemen</span>
                        </a>
                    </li>
                    <li>
                        <a href="/jenis">
                            <i class="material-icons">schedule</i>
                            <span>Jenis Kegiatan</span>
                        </a>
                    </li>
                    
                    @endif
                </ul>
            </li>
            @if (Auth::user()->id_level == 1)
                <li>
                    <a href="/karyawan">
                        <i class="material-icons">assignment_ind</i>
                        <span>Users</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; @2023 <a href="javascript:void(0);">PT. Aditya Engineering Consultant</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0 
            <!-- <a href="https://github.com/maman-heryanto" target="_blank"
                rel="noopener noreferrer">By : Mnifa</a></p> -->
        </div>
    </div>
    <!-- #Footer -->
</aside>

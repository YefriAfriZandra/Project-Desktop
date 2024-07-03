<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse" style="height: 100vh">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">
            <span data-feather="home" class="align-text-bottom"></span>
            Home
          </a>
        </li>
        @can('sistem')
        <li class="nav-item">
          <a class="nav-link" href="{{url('usersSistem')}}">
            <span data-feather="users" class="align-text-bottom"></span>
            Pegawai Sistem
          </a>
        </li>
        @endcan
        @can('pembayaran')
        <li class="nav-item">
          <a class="nav-link" href="{{url('usersPembayaran')}}">
            <span data-feather="users" class="align-text-bottom"></span>
            Pegawai Komite
          </a>
        </li>
        @endcan
        @can('sistem')
        <li class="nav-item">
          <a class="nav-link" href="{{url('usersSiswa')}}">
            <span data-feather="user" class="align-text-bottom"></span>
            Siswa
          </a>
        </li>
        @endcan
        @can('sistem')
        <li class="nav-item">
          <a class="nav-link" href="{{url('usersGuru')}}">
            <span data-feather="user" class="align-text-bottom"></span>
            Guru
          </a>
        </li>
        @endcan
        @can('sistem')
        <li class="nav-item">
          <a class="nav-link" href="{{url('routeKelas')}}">
            <span data-feather="user" class="align-text-bottom"></span>
            Kelas
          </a>
        </li>
        @endcan
        @can('sistem')
        <li class="nav-item">
          <a class="nav-link" href="{{url('pelajaran')}}">
            <span data-feather="book" class="align-text-bottom"></span>
            Pelajaran
          </a>
        </li>
        @endcan
        @can('sistem')
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span data-feather="book-open" class="align-text-bottom"></span>
              Mata Pelajaran
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="{{ url('jadwalpelajaran') }}">Jadwal Pelajaran</a></li>
              <li><a class="dropdown-item" href="{{ url('inputjadwalpelajaran') }}">Input Jadwal Pelajaran</a></li>
          </ul>
        </li>
        @endcan
        @can('sistem')
        <li class="nav-item">
          <a class="nav-link" href="{{url('nilai')}}">
            <span data-feather="credit-card" class="align-text-bottom"></span>
            Nilai
          </a>
        </li>
        @endcan
        @can('pembayaran')
        <li class="nav-item">
          <a class="nav-link" href="{{url('jenisKomite')}}">
            <span data-feather="credit-card" class="align-text-bottom"></span>
            Jenis Komite
          </a>
        </li>
        @endcan
        @can('pembayaran')
        <li class="nav-item">
          <a class="nav-link" href="{{url('pembayaranKomite')}}">
            <span data-feather="credit-card" class="align-text-bottom"></span>
            Pembayaran
          </a>
        </li>
        @endcan
        @can('sistem')
        <li class="nav-item">
          <a class="nav-link" href="{{url('pengumuman')}}">
            <span data-feather="send" class="align-text-bottom"></span>
            Pengumuman
          </a>
        </li>
        @endcan
      </ul>
    </div>
  </nav>
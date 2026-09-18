<header class="admin-header">

    <div>

        <h5>
            Dashboard
        </h5>

        <span>
            Selamat datang di halaman administrator
        </span>

    </div>


    <div class="admin-user">

        <div class="admin-user-icon">
            <i class="bi bi-person-fill"></i>
        </div>

        <div>

            <strong>
                {{ Auth::user()->name }}
            </strong>

            <small>
                {{ Auth::user()->level->nama_level ?? '-' }}
            </small>

        </div>

    </div>

</header>

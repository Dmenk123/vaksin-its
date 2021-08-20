
    <div class="content-header align-items-center justify-content-start pos-fixed wd-100p z-index-10">
        <div>
            <a href="../../index.html" class="tx-montserrat tx-semibold tx-18 d-lg-none">myITS Vaksin</a>
        </div>

        <nav class="nav r-25 pos-fixed z-index-10">
            <div class="dropdown dropdown-profile allow-focus">
                <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static" aria-expanded="false">
                    <div class="avatar avatar-sm"><img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle" alt=""></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right allow-focus">
                    <h5 class="tx-medium tx-montserrat mg-b-5">{{\Session::get('logged_in')['nama']}}</h5>
                    <p class="mg-b-25 tx-13 tx-color-03">{{\Session::get('logged_in')['nip']}}</p>
                    <a href="../dashboard/login-mhs.html" class="dropdown-item ht-30"><i data-feather="log-out"></i>Keluar</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="modal fade effect-scale" id="chgRoleUser" tabindex="-1" role="dialog" aria-labelledby="chgRoleUserLabel" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-white">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    <h5 class="tx-montserrat tx-medium" id="chgRoleUserLabel">Hak Akses</h5>
                    <p class="tx-color-02">Hak akses Anda saat ini: <b>User </b>.</p>
                    <select class="form-control" id="menu">
                        <option selected="selected">Select One</option>
                        <option value="../beranda/index.html">Pegawai</option>
                        <option value="../beranda/index-admin.html">Admin</option>
                    </select>
                    <div class="mg-t-20 d-flex justify-content-end">
                        <button type="button" class="btn btn-white tx-montserrat tx-semibold" data-dismiss="modal">Batal</button>
                        <input class="btn btn-its tx-montserrat tx-semibold mg-l-5 mg-lg-l-10" type="button" id="goBtn" value="Ganti">
                    </div>
                </div>
            </div>
        </div>
    </div>

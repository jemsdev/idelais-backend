@extends('layout.master')
@section('title', 'Users')
@section('content')
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/user"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Katalog</a></li>
            <li class="breadcrumb-item active" aria-current="page">List</li>
        </ol>
    </nav>
</div>
<div class="row" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12 layout-top-spacing layout-spacing">
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
            {{ session('error') }}
        </div>        
        @endif
        @if(session('success'))        
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
            {{ session('success') }}
        </div>
        @endif
        <div class="widget-content widget-content-area br-8">
            <table id="invoice-list" class="table dt-table-hover" style="width:100%">
                <thead>
                    <tr>                        
                        <th>Nama</th>
                        <th>Username</th>                        
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="santriModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="background-color: #ffff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{route('user.store')}}" method="POST" id="editForm" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="col-md-12">
                        <label class="form-label">Nama</label>
                        <input name="full_name" id="full_name" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Jabatan</label>
                        <input name="jabatan" id="jabatan" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input autocomplete="off" name="username" id="username" type="text" class="form-control" placeholder="username">
                    </div>                                       
                    <div class="col-6">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-control" autocomplete="off" id="role">
                            <option>- Pilih -</option>
                            <option value="Admin">Admin</option>
                            <option value="Sales">Sales</option>
                            <option value="Manager">Manager</option>
                            <option value="Consultant">Consultant</option>
                            <option value="Operation">Operation</option>
                        </select>
                    </div>
                    <div class="col-6" id="f-password">
                        <label class="form-label">Password</label>
                        <input name="password" id="password" type="password" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-6" id="f-con-password">
                        <label class="form-label">Confirm Password</label>
                        <input name="con-password" id="con-password" type="password" class="form-control" autocomplete="off">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change Password -->
<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="background-color: #ffff;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="" method="POST" id="changeForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />                    
                    <div class="col-12" id="f-password">
                        <label class="form-label">Password Baru</label>
                        <input name="new_password" id="new_password" type="password" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-12" id="f-con-password">
                        <label class="form-label">Confirm Password</label>
                        <input name="new_confirm_password" id="new_confirm_password" type="password" class="form-control" autocomplete="off">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('custom-scripts')
<script src="{{'/template'}}/src/assets/js/apps/user-list.js"></script>
@endpush
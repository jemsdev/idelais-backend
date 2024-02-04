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
                        <th>Nama Villa</th>
                        <th>Blok</th>
                        <th>Harga</th>                        
                        <th>Kode</th>
                        <th>No Telp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>                        
                        <td>{{$item->thumbnail}}</td>
                        <td>{{$item->subCategory->title}}</td>
                        <td>{{$item->price}}</td>                        
                        <td>{{$item->code}}</td>
                        <td>{{$item->whatsapp_number}}</td>
                        <td>
                            <a href="" class="btn btn-primary">edit</a>
                            <a href="" class="btn btn-danger">hapus</a>
                        </td>
                    </tr>
                    @endforeach
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Katalog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg> ... </svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="{{route('katalog.store')}}" method="POST" id="editForm" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="col-md-6">
                        <label class="form-label">Nama Villa</label>
                        <input name="thumbnail" id="thumbnail" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Blok</label>
                        <select name="sub_category_id" class="form-control" autocomplete="off" id="sub_category_id">
                            <option>- Pilih -</option>
                            <option value="1">Mawar</option>
                            <option value="2">Tulip</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Harga</label>
                        <input name="price" id="price" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kode</label>
                        <input autocomplete="off" name="code" id="code" type="text" class="form-control" placeholder="">
                    </div>                                       
                    <div class="col-6">
                        <label class="form-label">No Telp</label>
                        <input name="whatsapp_number" id="whatsapp_number" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-6" id="f-password">
                        <label class="form-label">Rekomendasi</label>
                        <input name="is_recommendation" id="is_recommendation" type="text" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Gambar</label>
                        <div class="table-responsive">            
                            <table class="table table-no-space table-bordered">
                                <thead>
                                <tr style="background-color: #AFE1AF;">
                                    <th scope="col">Gambar</th>                                         
                                    <th scope="col" class="text-center">
                                        <span class="badge badge-success" onclick="create_tr('table_body_timeline')"><i class="fa fa-plus"></i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>
                                    </th>
                                </tr>            
                                </thead>
                                <tbody id="table_body_timeline">
                                    <tr>
                                        <td>
                                            <input type="file" required name="gambar[]" autocomplete="off" value="" class="form-control  form-control-sm" placeholder="Bulan">
                                        </td>                                             
                                        <td class="text-center">
                                            <span class="badge badge-danger" onclick="remove_tr(this)"><i class="fa fa-close"></i>-</span>                    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                    <div class="col-12">
                        <label class="form-label">Fasilitas</label>
                        <div class="table-responsive">            
                            <table class="table table-no-space table-bordered">
                                <thead>
                                <tr style="background-color: #AFE1AF;">
                                    <th scope="col">Fasilitas</th>                                         
                                    <th scope="col">Jumlah</th>                                         
                                    <th scope="col" class="text-center">
                                        <span class="badge badge-success" onclick="create_tr('table_body_fasilitas')"><i class="fa fa-plus"></i><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></span>
                                    </th>
                                </tr>            
                                </thead>
                                <tbody id="table_body_fasilitas">
                                    <tr>
                                        <td>
                                            <select name="fasilitas_id[]" class="form-control" autocomplete="off" id="fasilitas_id">
                                                <option>- Pilih -</option>
                                                @foreach ($fasilitas as $item)
                                                <option value="{{$item->id}}">{{$item->title}}</option>                           
                                                @endforeach
                                            </select>
                                        </td>   
                                        <td>
                                            <input name="value[]" id="value" type="text" class="form-control" autocomplete="off">
                                        </td>                                          
                                        <td class="text-center">
                                            <span class="badge badge-danger" onclick="remove_tr(this)"><i class="fa fa-close"></i>-</span>                    
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
<script src="{{'/template'}}/src/assets/js/apps/katalog-list.js"></script>
@endpush
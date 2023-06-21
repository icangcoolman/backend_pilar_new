@if(Request::segment(2) != "")
<h3>Edit Biaya</h3>
<form action="{{ route('backend.biaya.actionedit') }}" method="post" class="mt-4">
  <input type="hidden" name="id" value="{{ $id }}">
@else
<h3>Tambah Biaya</h3>
<form action="{{ route('backend.biaya.add') }}" method="post" class="mt-4">
@endif


  @csrf
  @if(session()->has('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session()->has('loginError'))
      <div class="alert alert-danger">{{ session('loginError') }}</div>
  @endif
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Kota</label>
    <select name="kotaasal" class="form-control" id="kotaasal" aria-describedby="emailHelp" required>
      <option value="">- Pilih Kota Asal -</option>
      @if(Request::segment(2) != "")  

      @foreach ($datakota as $rowkota)
        <option value="{{ $rowkota->id }}" @if($datagetinfo[0]->city_id_1 == $rowkota->id) selected @endif>{{ $rowkota->city }}</option>  
      @endforeach  

      @else

      @foreach ($datakota as $rowkota)
        <option value="{{ $rowkota->id }}">{{ $rowkota->city }}</option>  
      @endforeach  

      @endif
      
    </select>
    
    <div id="emailHelp" class="form-text">Tambahkan kota asal</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Kota Tujuan</label>
    <select name="kotatujuan" class="form-control" id="kotatujuan" aria-describedby="emailHelp" required>
      <option value="">- Pilih Kota Tujuan -</option>
      @if(Request::segment(2) != "")  
      
      @foreach ($datakota as $rowkota)
        <option value="{{ $rowkota->id }}" @if($datagetinfo[0]->city_id_2 == $rowkota->id) selected @endif>{{ $rowkota->city }}</option>  
      @endforeach

      @else

      @foreach ($datakota as $rowkota)
        <option value="{{ $rowkota->id }}">{{ $rowkota->city }}</option>  
      @endforeach

      @endif
        
    </select>
    
    <div id="emailHelp" class="form-text">Tambahkan kota tujuan</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Kendaraan</label>
    
    <select name="kendaraan" class="form-control" id="kendaraan" aria-describedby="emailHelp" required>
      <option value="">- Pilih Kendaraan -</option>
      @if(Request::segment(2) != "")

      @foreach ($datamobil as $rowmobil)
        <option value="{{ $rowmobil->id }}" @if($datagetinfo[0]->car_id == $rowmobil->id) selected @endif>{{ $rowmobil->car }}</option>  
      @endforeach  
      
      @else
      
      @foreach ($datamobil as $rowmobil)
        <option value="{{ $rowmobil->id }}">{{ $rowmobil->car }}</option>  
      @endforeach  

      @endif
      
    </select>
    
    <div id="emailHelp" class="form-text">Tambahkan kendaraan</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Harga</label>

    <input type="text" class="form-control" id="harga" name="harga" @if(Request::segment(2) != "") value="{{ $datagetinfo[0]->price }}" @endif aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Tambahkan harga</div>
  </div>
  @if(Request::segment(2) != "")
  <button type="submit" class="btn btn-primary">Edit Data</button>
  <a class="btn btn-warning" href="{{ route('backend.biaya.browse') }}">Tambah Data</a>
  @else
  <button type="submit" class="btn btn-primary">Simpan Data</button>
  @endif
  
</form>

<hr />


<div class="col-lg-12 mt-4">
  <h3>Cari Biaya</h3>
  <form action="{{ route('backend.biaya.browse') }}" method="get" class="mt-4">
  <div class="row">
    <div class="col-lg-3">
      <select name="q_kotaasal" class="form-control" id="q_kotaasal" aria-describedby="emailHelp">
        <option value="">- Pilih Kota Asal -</option>

        @foreach ($datakota as $rowkota)
          <option value="{{ $rowkota->id }}" @if(request('q_kotaasal') == $rowkota->id) selected @endif>{{ $rowkota->city }}</option>  
        @endforeach  

      </select>
    </div>
    <div class="col-lg-3">
      <select name="q_kotatujuan" class="form-control" id="q_kotatujuan" aria-describedby="emailHelp">
        <option value="">- Pilih Kota Tujuan -</option>
      
        @foreach ($datakota as $rowkota)
          <option value="{{ $rowkota->id }}" @if(request('q_kotatujuan') == $rowkota->id) selected @endif>{{ $rowkota->city }}</option>  
        @endforeach

      </select>
    </div>
    <div class="col-lg-3">
      <select name="q_kendaraan" class="form-control" id="q_kendaraan" aria-describedby="emailHelp">
        <option value="">- Pilih Kendaraan -</option>
        
        @foreach ($datamobil as $rowmobil)
          <option value="{{ $rowmobil->id }}" @if(request('q_kendaraan') == $rowmobil->id) selected @endif>{{ $rowmobil->car }}</option>  
        @endforeach  
        
      </select>
    </div>
    <div class="col-lg-3">
      <input type="submit" class="btn btn-primary" value="Cari">
    </div>
  </div>
</form>
</div>

<hr />


<div class="col-lg-12 mt-4">
  <h3>Data Biaya</h3>
  
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="100" class="text-center">No</th>
        <th class="text-center">Kota Asal</th>
        <th class="text-center">Kota Tujuan</th>
        <th class="text-center">Kendaraan</th>
        <th class="text-center">Harga</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
      @foreach($datainfo as $row)
      <tr>
        <td class="text-center">{{ $i }}</td>
        <td class="text-center">
          @php
          $gokotaasal = App\Models\City::where('id', $row->city_id_1)->get();
          echo $gokotaasal[0]->city;
          @endphp
        </td>
        <td class="text-center">
          @php
          $gokotatujuan = App\Models\City::where('id', $row->city_id_2)->get();
          echo $gokotatujuan[0]->city;
          @endphp
        </td>
        <td class="text-center">
          {{ $row->car->car }}
        </td>
        <td class="text-center">{{ number_format($row->price,0,',','.') }}</td>
        <td class="text-center">
          <div class="d-flex justify-content-center">
            <a href="/browsebiaya/{{ $row->id }}" title="Ubah Data"><i class="fa fa-pencil text-success"></i></a>&nbsp;
            <form action="{{ route('backend.biaya.actiondelete') }}" class="form-inline" method="post" class="mt-4">
              @csrf
              <input type="hidden" name="id" value="{{ $row->id }}">
              <button type="submit" class="border-0" title="Hapus Data"><i class="fa fa-close text-danger"></i></button>
            </form>
          </div>
          
          {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#myModalDelete" data-id="{{ $row->id }}" class="btn-sm btnDelete"><i class="fa fa-close text-danger"></i></a> --}}
        </td>
      </tr>
      @php $i++ @endphp
      @endforeach
    </tbody>
  </table>
</div>

<h3>Tambah Mobil</h3>
<form action="{{ route('backend.mobil.add') }}" method="post" class="mt-4">
  @csrf
  @if(session()->has('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session()->has('loginError'))
      <div class="alert alert-danger">{{ session('loginError') }}</div>
  @endif
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Mobil</label>
    <input type="text" class="form-control" id="mobil" name="mobil" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Tambahkan mobil</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<hr />

<div class="col-lg-12 mt-4">
  <h3>Data Mobil</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="100" class="text-center">No</th>
        <th class="text-center">Mobil</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
      @foreach($datamobil as $row)
      <tr>
        <td class="text-center">{{ $i }}</td>
        <td>{{ $row->car }}</td>
      </tr>
      @php $i++ @endphp
      @endforeach
    </tbody>
  </table>
</div>
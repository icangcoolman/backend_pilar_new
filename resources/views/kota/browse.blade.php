
<h3>Tambah Kota</h3>
<form action="{{ route('backend.kota.add') }}" method="post" class="mt-4">
  @csrf
  @if(session()->has('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session()->has('loginError'))
      <div class="alert alert-danger">{{ session('loginError') }}</div>
  @endif
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Kota</label>
    <input type="text" class="form-control" id="kota" name="kota" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">Tambahkan kota</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<hr />

<div class="col-lg-12 mt-4">
  <h3>Data Kota</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th width="100" class="text-center">No</th>
        <th class="text-center">Kota</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
      @foreach($datakota as $row)
      <tr>
        <td class="text-center">{{ $i }}</td>
        <td>{{ $row->city }}</td>
      </tr>
      @php $i++ @endphp
      @endforeach
    </tbody>
  </table>
</div>
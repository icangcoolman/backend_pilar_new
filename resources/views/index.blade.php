@extends('layouts.master')
@section('container')

<div class="container">

  <div class="row">
    <div class="col-lg-3" style="background: #e2f3f0;">
      <ul class="list-group my-4">
        <li class="list-group-item"><a href="{{ route('backend.kota.browse') }}">Data Kota</a></li>
        <li class="list-group-item"><a href="{{ route('backend.mobil.browse') }}">Data Mobil</a></li>
        <li class="list-group-item"><a href="{{ route('backend.biaya.browse') }}">Info Biaya</a></li>
        <li class="list-group-item" style="background: #cc181824"><a href="{{ route('logout') }}">Logout</a></li>
      </ul>

    </div>
    <div class="col-lg-9">
      @if(Request::segment(1) == "browsekota")
        @include('kota.browse')  
      @elseif(Request::segment(1) == "browsemobil")
        @include('mobil.browse')      
      @elseif(Request::segment(1) == "browsebiaya")
        @include('biaya.browsebiaya')        
      @else
        Selamat Datang di Dashboard Admin
      @endif
    </div>
  </div>

</div>

@endsection
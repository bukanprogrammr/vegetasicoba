@extends('layouts.backend')

@section('content')
<div class="col-lg-3 col-6">

    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $kecamatan }}</h3>
            <p>Kecamatan</p>
        </div>
        <div class="icon">
            <i class="ion ion-map"></i>
        </div>
        <a href="/kecamatan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">

    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $vegetasi }}<sup style="font-size: 20px">%</sup></h3>
            <p>Vegetasi</p>
        </div>
        <div class="icon">
            <i class="ion ion-leaf"></i>
        </div>
        <a href="/sawah" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">

    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $level }}</h3>
            <p>Level</p>
        </div>
        <div class="icon">
            <i class="ion ion-aperture"></i>
        </div>
        <a href="/level" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

@endsection
{{-- @extends('layouts.admin')
@section('content')
<a href="{{route('admin.formaccessory')}}" class="btn btn-secondary">เพิ่มเครื่องประดับใหม่</a>
    @foreach ($accessoryTypes as $accessoryType)
        <div id="carousel-container">
            <div id="carousel-{{ $accessoryType }}" class="carousel slide" data-ride="carousel" data-interval="false">
                <h2>{{ $accessoryType }}</h2>
                <div class="carousel-inner">
                    @foreach ($accessories->where('accessory_name', $accessoryType)->chunk(4) as $key => $chunk)
                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $accessory)
                                    <div class="col-md-3">
                                        <div class="card" style="width: 22rem;">
                                            <div class="card-body">
                                                <a href="{{route('admin.accessdetail', ['id' => $accessory->id])}}">
                                                    <p class="card-text">แบบที่ {{ $accessory->accessory_code_new }}</p>
                                                    <p>ID: {{ $accessory->id }}</p>
                                                    <img src="{{ asset('storage/' . $accessory->accessory_image) }}"
                                                        alt="" width="200" height="260">
                                                    <p class="card-text">{{ $accessory->accessory_description }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel-{{ $accessoryType }}" role="button" data-slide="prev"  >
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-{{ $accessoryType }}" role="button" data-slide="next" >
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    @endforeach
@endsection --}}
@extends('layouts.admin')
@section('content')
<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-center py-4 ">เครื่องประดับทั้งหมด</h2>
        <div class=”grid-container”>
            <div style="display: flex; justify-content: end;">
                <a href="{{route('admin.formaccessory')}}" class="btn btn-success">เพิ่มเครื่องประดับใหม่</a>
            </div>
            @foreach ($accessoryTypes as $accessoryType)
            <div id="carousel-container">
                <div id="carousel-{{ $accessoryType }}" class="carousel slide" data-ride="carousel" data-interval="false">
                    <h2 class="py-3">{{ $accessoryType }}</h2>
                    <div class="carousel-inner">
                        @foreach ($accessories->where('accessory_name', $accessoryType)->chunk(4) as $key => $chunk)
                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                            <div class="row ">
                                @foreach ($chunk as $accessory)
                                <div class="col-md-3">
                                    <div class="card border-0" style="width: 22rem;">
                                        <div class="card-body">
                                            <a href="{{route('admin.accessdetail', ['id' => $accessory->id])}}">
                                                <p class="card-text py-3"style="color: black; ">แบบที่ {{ $accessory->accessory_code_new }}</p>
                                                <!-- <p>ID: {{ $accessory->id }}</p> -->
                                                <img src="{{ asset('storage/' . $accessory->accessory_image) }}" alt="" width="200" height="260">
                                                <p class="card-text py-3"style="color: black; ">{{ $accessory->accessory_description }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carousel-{{ $accessoryType }}" role="button" data-slide="prev"style="width: 3%;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-{{ $accessoryType }}" role="button" data-slide="next"style="width: 2%;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            @endforeach
            @endsection
        </div>
    </div>
</div>
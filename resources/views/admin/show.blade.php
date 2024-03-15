{{-- @extends('layouts.admin')
@section('content')
<a href="{{route('admin.getdresstype')}}" class="btn btn-secondary">+เพิ่มชุดใหม่</a>
    @foreach ($dressTypes as $dressType)
    <div id="carousel-{{ $dressType }}" class="carousel slide" data-ride="carousel" data-interval="false">
        <h2>{{$dressType}}</h2>
        <div class="carousel-inner">
            @foreach ($dress->where('dress_type', $dressType)->chunk(5) as $key => $chunk)
                <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                    <div class="row">
                        @foreach ($chunk as $show)
                            <div class="col-md-2">
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <a href="{{route('admin.showdressdetail',['id' => $show->id])}}">
                                        <p class="card-text">แบบที่ {{ $show->dress_code }}</p>
                                        <p>ID : {{$show->id}}</p>
                                        <img src="{{ asset('storage/' . $show->dress_image) }}" alt=""
                                            width="200" height="260">
                                        <p class="card-text">Some quiontent.</p>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel-{{ $dressType }}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="text-color"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-{{ $dressType }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endforeach
@endsection --}}


@extends('layouts.admin')
@section('content')


<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-center py-4 ">ชุดทั้งหมด</h2>
        <div class=”grid-container”>
        <div style="display: flex; justify-content: end;">
            <a href="{{route('admin.getdresstype')}}" class="btn btn-success ">+ เพิ่มชุดใหม่</a>
        </div>
            {{-- ทำใหม่ --}}
            @foreach ($dressTypes as $dressType)
            <div id="carousel-{{ $dressType }}" class="carousel slide" data-ride="carousel" data-interval="false">
                <h2 class="py-3"> {{$dressType}} </h2>
                <div class="carousel-inner">
                    @foreach ($dress->where('dress_type', $dressType)->chunk(4) as $key => $chunk)
                    <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                        <div class="row">
                            @foreach ($chunk as $show)
                            <div class="col-md-3 ">
                                <div class="card border-0" style="width: 18rem;">
                                    <div class="card-body">
                                        <a href="{{route('admin.showdressdetail',['id' => $show->id])}}">
                                            <p class="card-text " style="color: black;">แบบที่ {{ $show->dress_code }}</p>
                                            <!-- <p>ID : {{$show->id}}</p> -->
                                            <img src="{{ asset('storage/' . $show->dress_image) }}" alt="" width="200" height="260">
                                            <p class="card-text py-3"style="color: black; ">{{ $show->dress_description }}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carousel-{{ $dressType }}" role="button" data-slide="prev" style="width: 3%;">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-{{ $dressType }}" role="button" data-slide="next"style="width: 2%;">
                    <span class="carousel-control-next-icon " aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            @endforeach
            @endsection
        </div>
        
    </div>
</div>
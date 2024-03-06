@extends('layouts.admin')
@section('content')
    {{-- <div class="container">
        <h1>แสดงรูปภาพนะ</h1>
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/logo2.png') }}" alt="รูปจร้า" width="70" height="70">
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">efrdhtgmjgfrhdfnm</p>
                        <a href="#">go</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">efrdhtgmjgfrhdfnm</p>
                        <a href="#">go</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">efrdhtgmjgfrhdfnm</p>
                        <a href="#">go</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">efrdhtgmjgfrhdfnm</p>
                        <a href="#">go</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">efrdhtgmjgfrhdfnm</p>
                        <a href="#">go</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">efrdhtgmjgfrhdfnm</p>
                        <a href="#">go</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">efrdhtgmjgfrhdfnm</p>
                        <a href="#">go</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <div class="card" style="width: 18rem;">
                    <img src="" alt="">
                    <div class="card-body">
                        <h5 class="card-title">card title</h5>
                        <p class="card-text">efrdhtgmjgfrhdfnm</p>
                        <a href="#">go</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h2 class="h4 fw-bolder">ชุดแต่งงาน</h2>
                    <p>
                        <img src="{{ asset('images/testt.jpg') }}" alt="รูปจร้า" width="150" height="250">
                    </p>
                   
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>


        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>


        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-4">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                    <h2 class="h4 fw-bolder">Featured title</h2>
                    <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                    <a class="text-decoration-none" href="#!">
                        Call to action
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div> --}}


    {{-- <div class="container">
            <div id="thaiCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $dummyData = [
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 1', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 2', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 3', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 4', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 5', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 6', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 7', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 8', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 9', 'content' => 'Lorem ipsum...'],
                            ['image' => 'https://via.placeholder.com/150', 'title' => 'Card 10', 'content' => 'Lorem ipsum...'],


                        ];
                    @endphp
            
                    @foreach (collect($dummyData)->chunk(3) as $key => $chunk)
                        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}">
                            <div class="row">
                                @foreach ($chunk as $card)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ $card['image'] }}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $card['title'] }}</h5>
                                                <p class="card-text">{{ $card['content'] }}</p>
                                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#thaiCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#thaiCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
                    </div> --}}


<a href="{{route('admin.getdresstype')}}" class="btn btn-secondary">+เพิ่มชุดใหม่</a>
    {{-- ทำใหม่ --}}
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
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-{{ $dressType }}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endforeach
@endsection

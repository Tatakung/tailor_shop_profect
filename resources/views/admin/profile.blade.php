 {{-- @extends('layouts.admin')
@section('content')

<div class="container d-flex justify-content-start">
    <div class="table-responsive text-start" style="width: 100%;">
        <h2 class="text text-start py-4">จัดการโปรไฟล์แอดมิน</h2>



            <h1>Edit Profile</h1>
            @if ($adm->image)
            <img src="{{asset('storage/' .$adm->image)}}" alt="รูปภาพ" style="width: 300px; height: 300px;">

            
            @else
            <p>ไม่มีรูปภาพ</p>
        @endif
        
            <form method="POST" action="{{route('admin.updateprofile',['user' => $adm->id])}}" enctype="multipart/form-data">


                @csrf
                @method('POST')
    
    
                    
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ $adm->name }}" required>
    
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" value="{{ $adm->lname }}" required>
    
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $adm->email }}" required>
    
                <label for="phone">Phone:</label>
                <input type="text" name="phone" value="{{ $adm->phone }}">
    
                <label for="address">Address:</label>
                <textarea name="address" >{{ $adm->address }}</textarea>
    
                <label for="birthday">Birthday:</label>
                <input type="date" name="birthday" value="{{ $adm->birthday }}" required>
    
                <label for="image">Profile Image:</label>
                <input type="file" name="image">
    
                <button type="submit">save changes</button>
    
            </form>
    





    </div>
</div>

@endsection   --}}


<style>
body{
    margin-top:20px;
    background:#f8f8f8
    width: 100%;
}
    </style>
    @extends('layouts.admin')
    @section('content')
    
    <div class="container d-flex justify-content-start">
        <div class="table-responsive text-start" style="width: 100%;">
            <h2 class="text text-start py-3">จัดการโปรไฟล์แอดมิน</h2>
    
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            
              <div class="col">
                <div class="row">
                  <div class="col mb-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="e-profile">
                          <div class="row">
                            <div class="col-12 col-sm-auto mb-3">
                              <div class="mx-auto" style="width: 140px;">
                                <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                  {{-- <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span> --}}
                                  <span>    <img src="{{ asset('storage/' . $adm->image) }}" alt="รูปภาพ" style="width: 140px; height: 140px;">
                                  </span>
                                </div>
                              </div>
                            </div>
                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                              <div class="text-center text-sm-left mb-2 mb-sm-0">
                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{$adm->name . ' ' . $adm->lname}}</h4>
                                <p class="mb-0">{{$adm->email}}</p>
                                <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                                {{-- <div class="mt-2">
                                  <button class="btn btn-primary" type="button">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>Change Photo</span>
                                  </button>
                                </div> --}}
                              </div>
                              <div class="text-center text-sm-right">
                                <span class="badge badge-secondary">administrator</span>
                                {{-- <div class="text-muted"><small>Joined 09 Dec 2017</small></div> --}}
                                <div class="text-muted"><small>{{ now()->format('d M Y') }}</small></div>
                              </div>
                            </div>
                          </div>
                          <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                          </ul>
                          <div class="tab-content pt-3">
                            <div class="tab-pane active">


                                {{-- แบบฟอร์มนะ --}}
                              <form class="form"  method="POST" action="{{route('admin.updateprofile',['user' => $adm->id])}}" enctype="multipart/form-data" >
                                @csrf
                                @method('POST')
                
                                <div class="row">
                                  <div class="col">
                                    <div class="row">
                                      <div class="col">
                                        <div class="form-group">
                                          <label  for="name">Full Name</label>
                                          <input class="form-control" type="text" name="name" value="{{ $adm->name }}" required>
                                        </div>
                                      </div>

                                      <div class="col">
                                        <div class="form-group">
                                          <label for="lname">Last Name</label>
                                          <input class="form-control" type="text" name="lname" value="{{ $adm->lname }}" required>
                                        </div>
                                      </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                
                                                <label for="phone">Phone</label>
                                                <input class="form-control" type="text" name="phone" value="{{ $adm->phone }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                
                                                <label for="birthday">Birthdate</label>
                                                <input class="form-control" type="date" name="birthday" value="{{ $adm->birthday }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                      <div class="col">
                                        <div class="form-group">
                                          <label for="email">Email</label>
                                          <input class="form-control" type="email" name="email" value="{{ $adm->email }}" required>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col mb-3">
                                        <div class="form-group">
                                          <label for="address">Address</label>
                                          <textarea class="form-control" rows="5" name="address">{{ $adm->address }}</textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                 
                
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="image">Change Photo:</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                </div>





                                <div class="row">
                                  <div class="col d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            </div>    
        </div>
    </div>
    
    
    
    @endsection
    
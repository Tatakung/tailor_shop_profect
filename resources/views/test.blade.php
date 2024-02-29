{{-- @extends('layouts.employee')
@section('content')
    <button type="button" class="btn btn-success" data-toggle="modal"data-target="#confirmModal">+เพิ่มวันนัดลองชุด</button>


    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmModaltwo">+ปักเพิ่ม</button>


    <form action="" method="POST">
        @csrf
        <div class="modal fade" id="confirmModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">เพิ่มวันนัดลองชุด</h5>
                    </div>

                    <div class="modal-body" id="areafitting">
                        กลาง
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-danger">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>


    <form action="" method="POST">
        @csrf
        <div class="modal fade" id="confirmModaltwo">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">ปักเพิ่ม</h5>
                    </div>

                    <div class="modal-body" id="areafitting">
                        กลาง

                        <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">ยกเลิก</button>
                            <button type="submit" class="btn btn-danger">ยืนยัน</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>

@endsection --}}


@extends('layouts.employee')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Modal Example</h1>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch modal
                </button>


                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal222">
                    Launch modal222
                </button>





                <div class="modal fade" id="exampleModal" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ส่วนหัว</h5>

                            </div>
                            <div class="modal-body">
                                ส่วนเนื้อหา
                            </div>
                            <div class="modal-footer">
                                ส่วนท้าย
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="exampleModal222" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">22222</h5>

                            </div>

                            <div class="modal-body">
                                ...
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>
@endsection

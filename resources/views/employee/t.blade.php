<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Barlow&display=swap');

body{
  font-family: 'Barlow', sans-serif;
}

a:hover{
  text-decoration: none;
}

.border-left{
  border-left: 2px solid var(--primary) !important;
}


.sidebar{
  top: 0;
  left : 0;
  z-index : 100;
  overflow-y: auto;
}

.overlay{
  background-color: rgb(0 0 0 / 45%);
  z-index: 99;
}

/* sidebar for small screens */
@media screen and (max-width: 767px){
  
  .sidebar{
    max-width: 18rem;
    transform : translateX(-100%);
    transition : transform 0.4s ease-out;
  }
  
  .sidebar.active{
    transform : translateX(0);
  }
  
}
    </style>




</head>

<body>

    <div id="sidebar-overlay" class="overlay w-100 vh-100 position-fixed d-none"></div>

    <!-- sidebar -->
    <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
        <h1 class="bi bi-bootstrap text-primary d-flex my-4 justify-content-center"></h1>
        <div class="list-group rounded-0">
            <a href="#" class="list-group-item list-group-item-action active border-0 d-flex align-items-center">
                <span class="bi bi-border-all"></span>
                <span class="ml-2">Today</span>
            </a>
            


            <button
                class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center"
                data-toggle="collapse" data-target="#sale-collapse">
                <div>
                    <span class="bi bi-cart-dash"></span>
                    <span class="ml-2">Dashboard</span>
                </div>
                <span class="bi bi-chevron-down small"></span>
            </button>
            <div class="collapse" id="sale-collapse" data-parent="#sidebar">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action border-0 pl-5">สำหรับตัดชุด</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 pl-5">สำหรับเช่าชุด</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 pl-5">สำหรับเช่าเครื่องประดับ</a>
                    <a href="#" class="list-group-item list-group-item-action border-0 pl-5">สำหรับเช่าตัดชุด</a>
                </div>
            </div>


            <a href="" class="list-group-item list-group-item-action border-0 align-items-center">
              <span class="bi bi-box"></span>
              <span class="ml-2">จัดการชุด</span>
          </a>


          <a href="" class="list-group-item list-group-item-action border-0 align-items-center">
            <span class="bi bi-box"></span>
            <span class="ml-2">จัดการเครื่องประดับ</span>
        </a>

        <a href="" class="list-group-item list-group-item-action border-0 align-items-center">

          <span class="bi bi-box"></span>
          <span class="ml-2">จัดการพนักงาน</span>
      </a>



      <a href="#" class="list-group-item list-group-item-action border-0 align-items-center">
        <span class="bi bi-box"></span>
        <span class="ml-2">จัดการบัญชี</span>
    </a>

            
        </div>
    </div>



    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        <nav class="w-100 d-flex px-4 py-2 mb-4 shadow-sm">
            <!-- close sidebar -->
            <button class="btn py-0 d-lg-none" id="open-sidebar">
                <span class="bi bi-list text-primary h3"></span>
            </button>
            <div class="dropdown ml-auto">
                <button class="btn py-0 d-flex align-items-center" id="logout-dropdown" data-toggle="dropdown"
                    aria-expanded="false">
                    <span class="bi bi-person text-primary h4"></span>
                    <span class="bi bi-chevron-down ml-1 mb-2 small"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="logout-dropdown">
                  <a class="dropdown-item" href="">profile</a>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </div>
        </nav>

        <!-- main content -->
        {{-- <main class="p-4 min-vh-100"> --}}


            @yield('content')

        



        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
<script>
    $(document).ready(()=>{
  
  $('#open-sidebar').click(()=>{
     
      // add class active on #sidebar
      $('#sidebar').addClass('active');
      
      // show sidebar overlay
      $('#sidebar-overlay').removeClass('d-none');
    
   });
  
  
   $('#sidebar-overlay').click(function(){
     
      // add class active on #sidebar
      $('#sidebar').removeClass('active');
      
      // show sidebar overlay
      $(this).addClass('d-none');
    
   });
  
});
</script>
</body>

</html>
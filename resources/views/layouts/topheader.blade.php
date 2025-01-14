<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>







<div class="header" style=" height: 70px;">
    <div class="header-left active">
        <a href="index.html" class="logo mx-4 my-2">
            <img src="{{ URL::asset('assets/img/logo/logo.png') }}" alt="Main Logo" class="img-fluid"
                style="max-height: 50px;">
        </a>
        <a href="index.html" class="logo-small">
            <img src="{{ URL::asset('assets/img/logo/logo.png') }}" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>
    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">

        <!-- <li class="nav-item">
     <div class="top-nav-search">
      <a href="javascript:void(0);" class="responsive-search">
       <i class="fa fa-search"></i>
      </a>
      <form action="#">
       <div class="searchinputs">
        <input type="text" placeholder="Search Here ...">
        <div class="search-addon">
         <span><img src="{{ URL::asset('assets/img/icons/closes.svg') }}" alt="img"></span>
        </div>
       </div>
       <a class="btn" id="searchdiv"><img src="{{ URL::asset('assets/img/icons/search.svg') }}" alt="img"></a>
      </form>
     </div>
    </li>
    <li class="nav-item dropdown">
     <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
      <img src="{{ URL::asset('assets/img/icons/notification-bing.svg') }}" alt="img"> <span class="badge rounded-pill">4</span>
     </a>
     <div class="dropdown-menu notifications">
      <div class="topnav-dropdown-header">
       <span class="notification-title">Notifications</span>
       <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
      </div>
      <div class="noti-content">
       <ul class="notification-list">
        <li class="notification-message">
         <a href="activities.html">
          <div class="media d-flex">
           <span class="avatar flex-shrink-0">
            <img alt="" src="{{ URL::asset('assets/img/profiles/avatar-02.jpg') }}">
           </span>
           <div class="media-body flex-grow-1">
            <p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
            <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
           </div>
          </div>
         </a>
        </li>
        <li class="notification-message">
         <a href="activities.html">
          <div class="media d-flex">
           <span class="avatar flex-shrink-0">
            <img alt="" src="{{ URL::asset('assets/img/profiles/avatar-03.jpg') }}">
           </span>
           <div class="media-body flex-grow-1">
            <p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
            <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
           </div>
          </div>
         </a>
        </li>
        <li class="notification-message">
         <a href="activities.html">
          <div class="media d-flex">
           <span class="avatar flex-shrink-0">
            <img alt="" src="{{ URL::asset('assets/img/profiles/avatar-06.jpg') }}">
           </span>
           <div class="media-body flex-grow-1">
            <p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
            <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
           </div>
          </div>
         </a>
        </li>
        <li class="notification-message">
         <a href="activities.html">
          <div class="media d-flex">
           <span class="avatar flex-shrink-0">
            <img alt="" src="{{ URL::asset('assets/img/profiles/avatar-17.jpg') }}">
           </span>
           <div class="media-body flex-grow-1">
            <p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
            <p class="noti-time"><span class="notification-time">12 mins ago</span></p>
           </div>
          </div>
         </a>
        </li>
        <li class="notification-message">
         <a href="activities.html">
          <div class="media d-flex">
           <span class="avatar flex-shrink-0">
            <img alt="" src="{{ URL::asset('assets/img/profiles/avatar-13.jpg') }}">
           </span>
           <div class="media-body flex-grow-1">
            <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
            <p class="noti-time"><span class="notification-time">2 days ago</span></p>
           </div>
          </div>
         </a>
        </li>
       </ul>
      </div>
      <div class="topnav-dropdown-footer">
       <a href="activities.html">View all Notifications</a>
      </div>
     </div>
    </li> -->
        {{-- <li class="nav-item">
            <div class="mt-4 mx-2">
                @php
                    use App\Models\WalletTransaction;
                    $totalAmount = WalletTransaction::sum('amount');
                    $data = WalletTransaction::select('wallet_transactions.*', 'users.name as user_name')
                        ->join('users', 'wallet_transactions.user_id', '=', 'users.id')
                        ->get();
                    $user = Auth::user();
                    $role_id = $user->role_id;
                @endphp

                @if ($role_id == 1)
                    <a id="wallet-icon" data-bs-toggle="modal" data-bs-target="#walletModal">
                        <i class="fa fa-wallet"></i> Rs {{ number_format($totalAmount, 2) }}
                    </a>
                @endif

                <!-- Modal -->
                <div class="modal" id="walletModal" tabindex="-1" aria-labelledby="walletModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="walletModalLabel">Admin Wallet Details</h5>
                                <!-- Use the correct button for closing the modal -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if ($data->isEmpty())
                                    <p>No transactions available.</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Admin</th>
                                                    <th>User ID</th>
                                                    <th>Amount</th>
                                                    <th>Recharge</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $transaction)
                                                    <tr>
                                                        <td>{{ $transaction->id }}</td>
                                                        <td>{{ $transaction->user_name }}</td>
                                                        <td>{{ $transaction->user_id }}</td>
                                                        <td>Rs {{ number_format($transaction->amount, 2) }}</td>
                                                        <td><button class="btn btn-primary">Recharge</button></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li> --}}

        {{-- <li class="nav-item">
            <div class="mt-4 mx-2">
                @if ($role_id == 1)
               <i class="icon-wallet"><img src="{{ asset('assets/img/icons/wallet.svg') }}" alt="Wallet Icon"></i>           
                @endif
            </div>
        </li> --}}

      


    
         
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(5);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img">
                    @php
                        $imageURI = Auth::user()->image;
                    @endphp

                    @if (isset($imageURI))
                        <img src="{{ URL::asset($imageURI) }}" alt="image-user" style="height: 50px;width:50px;">
                    @else
                        <img src="{{ URL::asset('assets/img/logo/no_image.png') }}" alt="image-user"
                            style="height: 50px;width:50px;">
                    @endif
                    <span class="status online"></span>
                </span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img">
                            <img src="{{ URL::asset($imageURI) }}" alt="image-user"
                                style="height: 50px;width:50px;margin-bottom: 5px;">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            @php
                                $roleName = DB::table('roles')
                                    ->where('id', Auth::user()->role_id)
                                    ->value('role');
                            @endphp
                            <h6>{{ Auth::user()->name }}</h6>
                            <h5>{{ $roleName }}</h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <a class="dropdown-item" href="{{route('my.profile')}}"> <i class="me-2" data-feather="user"></i> My
                        Profile</a>
                    {{-- <a class="dropdown-item" href="#"><i class="me-2"
                            data-feather="settings"></i>Settings</a> --}}
                    <hr class="m-0">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item logout pb-0"><img
                                src="{{ URL::asset('assets/img/icons/log-out.svg') }}" class="me-2"
                                alt="img">Logout</button>

                        <!-- <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
           {{ __('Log Out') }}
          </button> -->
                    </form>
                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('my.profile')}}">My Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Logout</a>
        </div>
    </div>

</div>
<script>
    // jQuery for modal functionality
    $(document).ready(function() {
        // Open modal on button click
        $('#openModal_001').click(function() {
            $('#modalOverlay_001').fadeIn(); // Show the modal
        });

        // Close modal on button click
        $('#closeModal').click(function() {
            $('#modalOverlay_001').fadeOut(); // Hide the modal
        });
        $('#closeModal_1').click(function() {
            $('#modalOverlay_001').fadeOut(); // Hide the modal
        });

        // Close modal on clicking outside of modal content
        $('#modalOverlay_001').click(function(e) {
            if (e.target === this) {
                $(this).fadeOut();
            }
        });
    });
</script>

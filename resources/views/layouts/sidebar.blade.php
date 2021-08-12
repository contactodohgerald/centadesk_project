@php
$user_type = auth()->user()->user_type;
 $condition = [
    ['status', 'pending'],
    ['ignore_status', 'no'],
 ];
$complain = new \App\Model\AccountResolve();
$complains = $complain->getAllOfComplain($condition);

$conditions = [
    ['status', 'pending'],
];
$verifications = new \App\Model\KycVerification();
$verifications_count = $verifications->getAllKycVerification($conditions);
@endphp
<nav class="vertical_nav">
    <div class="left_section menu_left" id="js-menu" >
        <div class="left_section">
            <ul>
                <li class="menu--item">
                    <a href="{{route('home')}}" class="menu--link <?php print @$home;?>" title="Home">
                        <i class='uil uil-home-alt menu--icon'></i>
                        <span class="menu--label">Home</span>
                    </a>
                </li>
                <li class="menu--item">
                    <a href="{{route('profile')}}" class="menu--link <?php print @$profile;?>" title="Profile">
                        <i class='uil uil-user-circle menu--icon'></i>
                        <span class="menu--label">Profile</span>
                    </a>
                </li>
                @if(auth()->user()->privilegeChecker('teachers_view'))
                    <li class="menu--item">
                        <a href="{{route('kyc_verification')}}" class="menu--link <?php print @$KYC;?>" title="KYC Verification">
                            <i class='uil uil-comment-verify menu--icon'></i>
                            <span class="menu--label">KYC Verification</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                <li class="menu--item menu--item__has_sub_menu text-dark night-text">

                    <label class="menu--link <?php print @$Price;?> text-dark night-text" title="Price">

                        <i class='uil uil-money-bill menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Course Price</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('create_price')}}" class="sub_menu--link">Create Price</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('view_price')}}" class="sub_menu--link">View Prices</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Categories;?> text-dark night-text" title="Categories">
                        <i class='uil uil-layers menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Course Categories</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('create_category')}}" class="sub_menu--link">Create Categories</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('view_category')}}" class="sub_menu--link">View Categories</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="menu--item menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Course;?> text-dark night-text" title="Categories">
                        <i class='uil uil-plus-circle menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Courses</span>
                    </label>
                    <ul class="sub_menu">
                        {{-- for_teacher_and_admin --}}
                        @if(auth()->user()->privilegeChecker('view_add_courses'))
                        <li class="sub_menu--item">
                            <a href="/create-course" class="sub_menu--link">Create new</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="/view-courses" class="sub_menu--link">View created</a>
                        </li>
                        @endif
                        <li class="sub_menu--item">
                            <a href="{{route('enrolled_course')}}" class="sub_menu--link">Enrolled</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('saved-course')}}" class="sub_menu--link">Saved</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item">
                    <a href="{{route('explore')}}" class="menu--link <?php print @$explore;?>" title="Explore">
                        <i class='uil uil-search menu--icon'></i>
                        <span class="menu--label">Explore</span>
                    </a>
                </li>
                <li class="menu--item menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$live_stream;?> text-dark night-text" title="Live Stream">
                        <i class='uil uil-kayak menu--icon text-dark night-text'></i>
                        <span class="menu--label  text-dark night-text">Live Streams</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('create_live')}}" class="sub_menu--link">Create</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('show_live_stream')}}" class="sub_menu--link">View All</a>
                        </li>
                    </ul>
                <li class="menu--item">
                    <a href="{{route('browse_instructor')}}" class="menu--link <?php print @$instructor?>" title="Browse Instructors">
                        <i class='uil uil-asterisk menu--icon'></i>
                        <span class="menu--label">Browse Instructors</span>
                    </a>
                </li>
                @if(auth()->user()->privilegeChecker('teachers_view'))
                <li class="menu--item">
                    <a href="{{route('browse_subscribers')}}" class="menu--link <?php print @$subscribers?>" title="Subscribers">
                        <i class='uil uil-anchor menu--icon'></i>
                        <span class="menu--label">View Subscribers</span>
                    </a>
                </li>
                @endif
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Wallet;?> text-dark night-text" title="Wallet">
                        <i class='uil uil-wallet menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Wallet</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('my_balance')}}" class="sub_menu--link">My Wallet</a>
                        </li>
                    </ul>
                </li>
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Withdrawal;?> text-dark night-text" title="Wallet">
                        <i class='uil uil-money-withdraw menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Withdrawal</span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('withdrawals')}}" class="sub_menu--link">Funds Withdrawal</a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->privilegeChecker('view_restricted_roles'))

                <li class="menu--item  menu--item__has_sub_menu text-dark night-text">
                    <label class="menu--link <?php print @$Users;?> text-dark night-text" title="Users">
                        <i class='uil uil-user menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Users</span>

                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('all_users')}}" class="sub_menu--link">All</a>
                        </li>
                        {{-- <li class="sub_menu--item">
                            <a href="{{route('all_students')}}" class="sub_menu--link">Students</a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('all_instructor')}}" class="sub_menu--link">Teachers / Instructors</a>
                        </li> --}}
                    </ul>
                </li>
                @endif

                @if(auth()->user()->privilegeChecker('view_ticket_in_sidebar'))
                <li class="menu--item">
                    <a href="/ticket/create" class="menu--link <?php print @$ticket;?>" title="Ticket">
                        <i class='uil uil-comment-alt-exclamation menu--icon'></i>
                        <span class="menu--label">Ticket</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                <li class="menu--item">
                    <a href="/ticket/all" class="menu--link <?php print @$ticket;?>" title="Ticket">
                        <i class='uil uil-comment-alt-exclamation menu--icon'></i>
                        <span class="menu--label">Ticket</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
        <div class="left_section pt-2">
            <ul>
                @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                    <li class="menu--item  menu--item__has_sub_menu text-dark night-text">
                        <label class="menu--link <?php print @$gallery;?> text-dark night-text" title="Gallery/Event Area">
                            <i class='uil uil-newspaper menu--icon text-dark night-text'></i>
                            <span class="menu--label text-dark night-text">Gallery/Event Area</span>
                        </label>
                        <ul class="sub_menu">
                            <li class="sub_menu--item">
                                <a href="{{route('create-gallery')}}" class="sub_menu--link">Add Gallery/Event</a>
                            </li>
                            <li class="sub_menu--item">
                                <a href="{{route('gallery-list')}}" class="sub_menu--link">Gallery/Event List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu--item  menu--item__has_sub_menu text-dark night-text">
                        <label class="menu--link <?php print @$blogs;?> text-dark night-text" title="Blog Area">
                            <i class='uil uil-newspaper menu--icon text-dark night-text'></i>
                            <span class="menu--label text-dark night-text">Blog Area</span>
                        </label>
                        <ul class="sub_menu">
                            <li class="sub_menu--item">
                                <a href="{{route('create-blog-tag')}}" class="sub_menu--link">Create Blog Tag</a>
                            </li>
                            <li class="sub_menu--item">
                                <a href="{{route('create-blog')}}" class="sub_menu--link">Add New Blog</a>
                            </li>
                            <li class="sub_menu--item">
                                <a href="{{route('blog-list')}}" class="sub_menu--link">Blog List</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu--item">
                        <a href="{{route('complain_list')}}" class="menu--link <?php print @$Complain;?>" title="Complains">
                            <i class='uil uil-auto-flash menu--icon'></i>
                            <span class="menu--label">Complains <span class="noti_count">{{$complains->count()}}</span></span>
                        </a>
                    </li>
                    <li class="menu--item">
                        <a href="{{route('verify_kyc')}}" class="menu--link <?php print @$KYC;?>" title="KYC Verification">
                            <i class='uil uil-comment-alt-verify menu--icon'></i>
                            <span class="menu--label">KYC Verifications <span class="noti_count">{{$verifications_count->count()}}</span></span>
                        </a>
                    </li>
                @endif


                <li class="menu--item">
                    @if(auth()->user()->privilegeChecker('view_referral_for_user'))
                    <a href="{{route('referral_earnings', [auth()->user()->unique_id])}}" class="menu--link <?php print @$referral;?>" title="Ticket">
                        <i class='uil uil-comment-alt-exclamation menu--icon'></i>
                        <span class="menu--label">Referal Earnings</span>
                    </a>
                    @endif
                </li>

                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link <?php print @$Setting;?> text-dark night-text" title="Setting">
                        <i class='uil uil-cog menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Setting </span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('main_settings_page')}}" class="sub_menu--link">Account </a>
                        </li>
                        @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                            <li class="sub_menu--item">
                                <a href="{{route('app_settings_page')}}" class="sub_menu--link">System </a>
                            </li>
                            <li class="sub_menu--item">
                            <a href="{{route('add-testimonies')}}" class="sub_menu--link">Add Testimonies </a>
                             </li>
                        @endif
                    </ul>
                </li>

                @if(auth()->user()->privilegeChecker('view_roles'))
                <li class="menu--item  menu--item__has_sub_menu">
                    <label class="menu--link text-dark night-text" title="Roles">
                        <i class='uil uil-cog menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Roles Management </span>
                    </label>
                    <ul class="sub_menu">
                        <li class="sub_menu--item">
                            <a href="{{route('add_roles')}}" class="sub_menu--link">Add New Roles </a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('add_user_type')}}" class="sub_menu--link">Add User type </a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('view_all_roles')}}" class="sub_menu--link">View Roles </a>
                        </li>
                        <li class="sub_menu--item">
                            <a href="{{route('all_user_type')}}" class="sub_menu--link">View User Types </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="menu--item  menu--item__has_sub_menu text-dark night-text">
                    <label class="menu--link text-dark night-text" title="Setting">
                        <i class='uil uil-cog menu--icon text-dark night-text'></i>
                        <span class="menu--label text-dark night-text">Roles Management </span>
                    </label>
                    <ul class="sub_menu">

                        <li class="sub_menu--item"><a href="{{route('add_roles')}}"><span class="mini-sub-pro">Add New Roles</span></a></li>
                        <li class="sub_menu--item"><a href="{{route('add_user_type')}}"><span class="mini-sub-pro">Add User type</span></a></li>
                        <li class="sub_menu--item"><a href="{{route('view_all_roles')}}"><span class="mini-sub-pro">View Roles</span></a></li>
                        <li class="sub_menu--item"><a href="{{route('all_user_type')}}"><span class="mini-sub-pro">View User Types</span></a></li>
                    </ul>
                </li> --}}
                @endif
                <li class="menu--item">
                    <a href="javascript:void(0)" onclick="bringOutModalMain('.logout')" class="menu--link" title="Sign Out">
                        <i class='uil uil-sign-out-alt menu--icon'></i>
                        <span class="menu--label">Sign Out </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="left_footer">
            <div class="left_footer_content">
                <p class="font-poppins">© @php $d=date('Y'); print $d;@endphp <strong>{{env('APP_NAME')}}</strong>. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</nav>

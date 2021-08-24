@php $pageTitle = 'All Users Area'; $Users = 'active'; @endphp
@include('layouts.head')

<body>
    <!-- Header Start -->
    @include('layouts.header')
    <!-- Header End -->

    <!-- Left Sidebar Start -->
    @include('layouts.sidebar')
    <!-- Left Sidebar End -->

    <!-- Body Start -->
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title">
                            <i class="uil uil-book-alt"></i>All Users
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        
						@if(Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <i class="fa fa-envelope-o mr-2"></i>
                                {{ Session::get('success_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @elseif(Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <i class="fa fa-envelope-o mr-2"></i>
                                {{ Session::get('error_message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        
                        <div class="my_courses_tabs">
                            <ul class="nav nav-pills my_crse_nav" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-all-students-tab" data-toggle="pill" href="#pills-all-students" role="tab" aria-controls="pills-all-students" aria-selected="true"><i class="uil uil-user"></i>All
                                        Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-active-students-tab" data-toggle="pill" href="#pills-active-students" role="tab" aria-controls="pills-active-students" aria-selected="false"><i class="uil uil-user-check"></i>Teachers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-inactive-students-tab" data-toggle="pill" href="#pills-inactive-students" role="tab" aria-controls="pills-active-students" aria-selected="false"><i class="uil uil-user-circle"></i>Students</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-inactive-students-tab" data-toggle="pill" href="#pills-admin" role="tab" aria-controls="pills-active-students" aria-selected="false"><i class="uil uil-user-circle"></i>Admin</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-inactive-students-tab" data-toggle="pill" href="#pills-resolve" role="tab" aria-controls="pills-active-students" aria-selected="false"><i class="uil uil-user-circle"></i>Resolve Complain</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-all-students" role="tabpanel">
                                    <div class="table-responsive mt-30">
                                        <table class="table ucp-table">
                                            <thead class="thead-s">
                                                <tr>
                                                    <th class="text-center" scope="col">
                                                        S / No
                                                    </th>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <th class="text-center">
                                                        <input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
                                                    </th>
                                                    @endif
                                                    <th class="text-center" scope="col">
                                                        Name
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Email
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        User Type
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Balance ({{auth()->user()->getBalanceForView()['data']['currency'] }})
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Status
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Verification Badge
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($all) > 0) @php $count
                                                = 1; @endphp @foreach($all as $k
                                                => $e)
                                                <tr>
                                                    <td class="text-center" scope="col">
                                                        {{ $count }}
                                                    </td>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <td class="
                                                            text-center
                                                            sorting_1
                                                        ">
                                                        <input type="checkbox" class="
                                                                smallCheckBox
                                                            " value="{{$e->unique_id}}" />
                                                    </td>
                                                    @endif
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                            text-capitalize
                                                        ">
                                                        {{$e->name}}
                                                        {{$e->last_name}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{$e->email}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                            text-capitalize
                                                        ">
                                                        {{$e->user_type}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{number_format($e->balance)}}
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-{{($e->status === 'active')?'success':'primary'}}">
                                                            {{$e->status}}
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($e->verified_badge
                                                        == 'yes')
                                                        <p class="text-success">
                                                            Yes
                                                        </p>
                                                        @else
                                                        <p class="text-danger">
                                                            No
                                                        </p>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{route('view_profile', $e->unique_id )}}" title="Profile" class="gray-s"><i class="
                                                                    uil
                                                                    uil-adjust
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Delete" class="
                                                                cursor-pointer
                                                                gray-s
                                                                deleteCourseModal
                                                            "><i class="
                                                                    uil
                                                                    uil-trash-alt
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Set Verification Badge" class="
                                                                gray-s
                                                                cursor-pointer
                                                                verify_badge_modal
                                                            "><i class="
                                                                    uil
                                                                    uil-thumbs-up
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Change User Role" class="
                                                                gray-s
                                                                cursor-pointer
                                                                switch_role_modal
                                                            "><i class="
                                                                    uil
                                                                    uil-adjust-circle
                                                                "></i></a>
                                                    </td>
                                                </tr>
                                                @php $count++ @endphp
                                                @endforeach @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $all->links() !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-active-students" role="tabpanel">
                                    <div class="table-responsive mt-30">
                                        <table class="table ucp-table">
                                            <thead class="thead-s">
                                                <tr>
                                                    <th class="text-center" scope="col">
                                                        S / No
                                                    </th>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <th class="text-center">
                                                        <input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
                                                    </th>
                                                    @endif
                                                    <th class="text-center" scope="col">
                                                        Instructor's Name
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Instructor's Email
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Instructor's Balance ({{auth()->user()->getBalanceForView()['data']['currency'] }})
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Status
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Verification Badge
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($teacher) > 0) @php
                                                $count = 1; @endphp
                                                @foreach($teacher as $k => $e)
                                                <tr>
                                                    <td class="text-center" scope="col">
                                                        {{ $count }}
                                                    </td>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <td class="
                                                            text-center
                                                            sorting_1
                                                        ">
                                                        <input type="checkbox" class="
                                                                smallCheckBox
                                                            " value="{{$e->unique_id}}" />
                                                    </td>
                                                    @endif
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{$e->name}}
                                                        {{$e->last_name}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{$e->email}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{number_format($e->balance)}}
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-{{($e->status === 'active')?'success':'primary'}}">
                                                            {{$e->status}}
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($e->verified_badge
                                                        == 'yes')
                                                        <p class="text-success">
                                                            Yes
                                                        </p>
                                                        @else
                                                        <p class="text-danger">
                                                            No
                                                        </p>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{route('view_profile', $e->unique_id )}}" title="Profile" class="gray-s"><i class="
                                                                    uil
                                                                    uil-adjust
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Delete" class="
                                                                cursor-pointer
                                                                gray-s
                                                                deleteCourseModal
                                                            "><i class="
                                                                    uil
                                                                    uil-trash-alt
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Set Verification Badge" class="
                                                                gray-s
                                                                cursor-pointer
                                                                verify_badge_modal
                                                            "><i class="
                                                                    uil
                                                                    uil-thumbs-up
                                                                "></i></a>
                                                                <a id="{{ $e->unique_id }}" title="Change User Role" class="
                                                                        gray-s
                                                                        cursor-pointer
                                                                        switch_role_modal
                                                                    "><i class="
                                                                            uil
                                                                            uil-adjust-circle
                                                                        "></i></a>
                                                    </td>
                                                </tr>
                                                @php $count++ @endphp
                                                @endforeach @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $teacher->links() !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-inactive-students" role="tabpanel">
                                    <div class="table-responsive mt-30">
                                        <table class="table ucp-table">
                                            <thead class="thead-s">
                                                <tr>
                                                    <th class="text-center" scope="col">
                                                        S / No
                                                    </th>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <th class="text-center">
                                                        <input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
                                                    </th>
                                                    @endif
                                                    <th class="text-center" scope="col">
                                                        Student's Name
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Student's Email
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Student's Balance ({{auth()->user()->getBalanceForView()['data']['currency'] }})
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Status
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Verification Badge
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($student) > 0) @php
                                                $count = 1; @endphp
                                                @foreach($student as $k => $e)
                                                <tr>
                                                    <td class="text-center" scope="col">
                                                        {{ $count }}
                                                    </td>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <td class="
                                                            text-center
                                                            sorting_1
                                                        ">
                                                        <input type="checkbox" class="
                                                                smallCheckBox
                                                            " value="{{$e->unique_id}}" />
                                                    </td>
                                                    @endif
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{$e->name}}
                                                        {{$e->last_name}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{$e->email}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{number_format($e->balance)}}
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-{{($e->status === 'active')?'success':'primary'}}">
                                                            {{$e->status}}
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($e->verified_badge
                                                        == 'yes')
                                                        <p class="text-success">
                                                            Yes
                                                        </p>
                                                        @else
                                                        <p class="text-danger">
                                                            No
                                                        </p>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{route('view_profile', $e->unique_id )}}" title="Profile" class="gray-s"><i class="
                                                                    uil
                                                                    uil-adjust
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Delete" class="
                                                                cursor-pointer
                                                                gray-s
                                                                deleteCourseModal
                                                            "><i class="
                                                                    uil
                                                                    uil-trash-alt
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Set Verification Badge" class="
                                                                gray-s
                                                                cursor-pointer
                                                                verify_badge_modal
                                                            "><i class="
                                                                    uil
                                                                    uil-thumbs-up
                                                                "></i></a>
                                                                <a id="{{ $e->unique_id }}" title="Change User Role" class="
                                                                        gray-s
                                                                        cursor-pointer
                                                                        switch_role_modal
                                                                    "><i class="
                                                                            uil
                                                                            uil-adjust-circle
                                                                        "></i></a>
                                                    </td>
                                                </tr>
                                                @php $count++ @endphp
                                                @endforeach @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $student->links() !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-admin" role="tabpanel">
                                    <div class="table-responsive mt-30">
                                        <table class="table ucp-table">
                                            <thead class="thead-s">
                                                <tr>
                                                    <th class="text-center" scope="col">
                                                        S / No
                                                    </th>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <th class="text-center">
                                                        <input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
                                                    </th>
                                                    @endif
                                                    <th class="text-center" scope="col">
                                                        The Admin's Name
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Admin's Email
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Admin's Balance ({{auth()->user()->getBalanceForView()['data']['currency'] }})
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Status
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Verification Badge
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($admin) > 0) @php
                                                $count = 1; @endphp
                                                @foreach($admin as $k => $e)
                                                <tr>
                                                    <td class="text-center" scope="col">
                                                        {{ $count }}
                                                    </td>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <td class="
                                                            text-center
                                                            sorting_1
                                                        ">
                                                        <input type="checkbox" class="
                                                                smallCheckBox
                                                            " value="{{$e->unique_id}}" />
                                                    </td>
                                                    @endif
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{$e->name}}
                                                        {{$e->last_name}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{$e->email}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{number_format($e->balance)}}
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-{{($e->status === 'active')?'success':'primary'}}">
                                                            {{$e->status}}
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($e->verified_badge
                                                        == 'yes')
                                                        <p class="text-success">
                                                            Yes
                                                        </p>
                                                        @else
                                                        <p class="text-danger">
                                                            No
                                                        </p>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{route('view_profile', $e->unique_id )}}" title="Profile" class="gray-s"><i class="
                                                                    uil
                                                                    uil-adjust
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Delete" class="
                                                                cursor-pointer
                                                                gray-s
                                                                deleteCourseModal
                                                            "><i class="
                                                                    uil
                                                                    uil-trash-alt
                                                                "></i></a>
                                                        <a id="{{ $e->unique_id }}" title="Set Verification Badge" class="
                                                                gray-s
                                                                cursor-pointer
                                                                verify_badge_modal
                                                            "><i class="
                                                                    uil
                                                                    uil-thumbs-up
                                                                "></i></a>
                                                        <a href="{{route('referral_earnings', [$e->unique_id])}}" title="View Referrals" class="gray-s">Referrals</a>
                                                    </td>
                                                </tr>
                                                @php $count++ @endphp
                                                @endforeach @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $admin->links() !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-resolve" role="tabpanel">
                                    <div class="table-responsive mt-30">
                                        <table class="table ucp-table">
                                            <thead class="thead-s">
                                                <tr>
                                                    <th class="text-center" scope="col">
                                                        S / No
                                                    </th>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <th class="text-center">
                                                        <input onclick="checkAll()" type="checkbox" class="mainCheckBox" />
                                                    </th>
                                                    @endif
                                                    <th class="text-center" scope="col">
                                                        Name
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Email
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        User Type
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Status
                                                    </th>
                                                    <th class="text-center" scope="col">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($all) > 0) @php $count
                                                = 1; @endphp @foreach($all as $k
                                                => $e)
                                                <tr>
                                                    <td class="text-center" scope="col">
                                                        {{ $count }}
                                                    </td>
                                                    @if(auth()->user()->privilegeChecker('view_restricted_roles'))
                                                    <td class="
                                                            text-center
                                                            sorting_1
                                                        ">
                                                        <input type="checkbox" class="
                                                                smallCheckBox
                                                            " value="{{$e->unique_id}}" />
                                                    </td>
                                                    @endif
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                            text-capitalize
                                                        ">
                                                        {{$e->name}}
                                                        {{$e->last_name}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                        ">
                                                        {{$e->email}}
                                                    </td>
                                                    <td class="
                                                            text-center
                                                            cell-ta
                                                            text-capitalize
                                                        ">
                                                        {{$e->user_type}}
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-{{($e->status === 'active')?'success':'primary'}}">
                                                            {{$e->status}}
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" item_id="{{$e->email}}" onclick="bringOutModalMain('.activate_account'); addUniqueIdToInputField(this)" title="Activate Account" class="gray-s"><i class="uil uil-thumbs-up"></i></a>
                                                    </td>
                                                </tr>
                                                @php $count++ @endphp
                                                @endforeach @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        {!! $all->links() !!}
                                    </div>
                                </div>
                            </div>
                            <div style="position: fixed; bottom: 20px; right: 30px; z-index: 200;">
                                <button type="button" class="btn btn-danger" id="comfirmUser" title="Select User(s) to be comfirmed by ticking the checkbox on each row and then click this button to delete">
                                    Confirm User(s)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
        <div class="modal zoomInUp" id="verify_badge_modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Set Badge?</h4>
                    </div>
                    <form class="verify_badge_form">
                        @csrf
                        <div class="modal-body">
                            <p class="text-danger">
                                By clicking continue, this user verification
                                badge will be changed!
                            </p>
                        </div>
                    </form>
                    <div class="modal-footer no-border">
                        <div class="text-right">
                            <button class="btn btn-default btn-sm" data-dismiss="modal">
                                Cancel
                            </button>
                            <button class="btn btn-primary btn-sm verify_badge_btn" data-dismiss="modal">
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Body End -->

        <!-- The Modal -->
        <div class="modal zoomInUp activate_account" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="text-dark night-text">Activate Account</h4>
                        <button type="button" class="close" data-dismiss="modal" onclick="removeModalMains('.activate_account')">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="text-center">Are You Sure You Want To Activate This Account?</h3>
                            </div>
                            <input type="hidden" name="unique_id" class="delete_id form-control">
                        </div>
                    </div>
                    <div class="modal-footer no-border">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="removeModalMains('.activate_account')">Close</button>
                        <form method="POST" action="{{ route('activate_account', 'user_email') }}">
                            @csrf
                            <input type="hidden" name="unique_id" class="delete_id">
                            <button type="submit" class="btn btn-primary">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="switch_role_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Switch Role</h4>
                        <button type="button" class="close" data-dismiss="modal" onclick="removeModalMains('#switch_role_modal')">
                            &times;
                        </button>
                    </div>

                    <form class="switch_role_form">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{--
                                    <h4 class="text-dark night-text"></h4>
                                    --}}
                                    <form class="switch_role_form">
                                        <label class="
                                                text-dark
                                                night-text
                                                float-left
                                            " for="">Switch Role*</label>
                                        <select name="role" id="" class="form-control">
                                            <option value="">
                                                --Select New Role--
                                            </option>
                                            <option value="teacher">
                                                Teacher
                                            </option>
                                            <option value="student">
                                                Student
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" onclick="removeModalMains('#switch_role_modal')">
                            Close
                        </button>
                        <button class="btn btn-primary switch_role_btn">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal delete_course_modal" id="delete_course_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Delete User</h4>
                        <button type="button" class="close" data-dismiss="modal" onclick="removeModalMains('.delete_course_modal')">
                            &times;
                        </button>
                    </div>

                    <form class="delete_course_form">
                        @csrf
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="night-text text-danger">
                                        By clicking continue, this User will be
                                        deleted permanently. <br />
                                        Every course & live stream created by
                                        this user will also be deleted.
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-danger" onclick="removeModalMains('.delete_course_modal')">
                            Close
                        </button>
                        <button class="btn btn-primary delete_course_btn">
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Body End -->

        @include('layouts.e_script')

        <script>
            $(document).ready(function() {
                // prevent modal from closing when clicking any part of the element
                // $('#switch_role_modal').modal({ backdrop: 'static', keyboard: false })

                $(".verify_badge_modal").click(function(e) {
                    e.preventDefault();
                    append_id(
                        "verify_badge_id",
                        ".verify_badge_form",
                        "#verify_badge_modal",
                        this
                    );
                    $("#verify_badge_modal").modal("toggle");
                });
                $(".switch_role_modal").click(function(e) {
                    e.preventDefault();
                    append_id(
                        "switch_role_id",
                        ".switch_role_form",
                        "#switch_role_modal",
                        this
                    );
                    bringOutModalMain("#switch_role_modal");
                    // $('#switch_role_modal').modal('toggle');
                });

                $(".verify_badge_btn").click(async function(e) {
                    e.preventDefault();
                    let verify_badge_form =
                        $(".verify_badge_form").serializeArray();
                    let form_data = set_form_data(verify_badge_form);
                    let returned = await ajaxRequest(
                        "/set_badge/" + verify_badge_form[1].value,
                        form_data
                    );
                    // console.log(returned);
                    // return;
                    validator(returned, "/all_users");
                });


                $(".switch_role_btn").click(async function(e) {
                    e.preventDefault();
                    let data = $(".switch_role_form").serializeArray();
                    let form_data = set_form_data(data);
                    let returned = await ajaxRequest("/switch_role", form_data);
                    removeModalMains('#switch_role_modal')
                    // console.log(returned);
                    // return;
                    validator(returned, "/all_users");
                });

                $(".remove_all").click(async function(e) {
                    e.preventDefault();
                    let students_to_promote_batch = [];
                    let csrf_form = $(".csrf").serializeArray();

                    let form_check_box = $(".batch_delete");
                    for (let i = 0; i < form_check_box.length; i++) {
                        students_to_promote_batch.push(form_check_box[i].value);
                    }
                    csrf_form.push({
                        name: "students_to_promote_batch",
                        value: students_to_promote_batch,
                    });

                    let form_data = set_form_data(csrf_form);
                    // console.log(students_to_promote_batch);return;

                    let returned = await ajaxRequest(
                        "/delete-batch",
                        form_data
                    );
                    // console.log(response);return;
                    validator(returned, "/courses/enrolled");
                });

                $(".deleteCourseModal").click(function(e) {
                    e.preventDefault();
                    append_id(
                        "delete_course_id",
                        ".delete_course_form",
                        "#delete_course_modal",
                        this
                    );
                    bringOutModalMain(".delete_course_modal");
                });

                $(".delete_course_btn").click(async function(e) {
                    e.preventDefault();
                    let data = $(".delete_course_form").serializeArray();
                    // console.log(data);
                    // return;
                    let form_data = set_form_data(data);
                    let returned = await ajaxRequest(
                        "/delete_user/" + data[1].value,
                        form_data
                    );
                    // return;
                    validator(returned, "/all_users");
                });
            });
        </script>
    </div>
</body>

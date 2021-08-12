@php
$users = auth()->user();
$pageTitle = 'Create Ticket';
$ticket = 'active';
@endphp
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
						<h2 class="st_title"><i class="uil uil-comment-info-alt text-capitalize"></i> Send a Ticket</h2>
                        <div class="row" id="errorHold"></div>
						<div class="row mt-20">
							<div class="col-lg-8 col-md-8">
                                <form action="" class="create_ticket_form">
                                    @csrf
								<div class="ui search focus">
									<div class="ui left icon input swdh11 swdh19">
										<input class="prompt srch_explore" type="text" name="title" value=""  placeholder="Title of your ticket">
									</div>
								</div>
								<div class="ui search focus mt-30">
									<div class="ui form swdh30">
										<div class="field">
											<textarea rows="10" name="message" placeholder="Describe your issue or share your ideas..."></textarea>
										</div>
									</div>
								</div>
                                <button class="save_btn create_ticket_btn" type="submit">Send Ticket</button>

                                </form>
                            </div>
                            <div class="col-lg-4 col-md-8">
                                <div class="table-responsive">
                                    <table class="table ucp-table">
                                        <thead class="thead-s">
                                            <tr>
                                                <th class="" scope="col"><h4>Previous Tickets</h4></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!$tickets->isEmpty())
                                                @foreach ($tickets as $e)
                                                    <tr>
                                                        <td class="text-capitalize">
                                                            <a href="/ticket/reply/{{ $e->unique_id}}">{{ $e->title }}</a>
                                                            <p style="font-size: 14px" class="lead text-warning">{{ $e->created_at }}</p>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>No Records Found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>

            @include('layouts.footer')
        </div>
        <!-- Body End -->

        @include('layouts.e_script')
        <script>
            $(document).ready(function() {
                // process form for creating live stream
                $('.create_ticket_btn').click(async function(e) {
                    e.preventDefault();
                    let data = [];
                    // basic info
                    let create_ticket = $('.create_ticket_form').serializeArray();
                    // console.log(create_ticket);
                    // return;

                    // append to form data object
                    let form_data = set_form_data(create_ticket);
                    let returned = await ajaxRequest('/ticket/create', form_data);
                    // console.log(returned);return;
                    validator(returned, '/ticket/create');
                });
            });
        </script>

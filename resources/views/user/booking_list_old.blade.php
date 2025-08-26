@extends('layouts.user.app')
@section('title')
    {{ $title }}
@endsection
@section('content')

    <div class="dashboard__content hover-bgc-color">
        <div class="row pb40">
            @include('layouts.user.side_menu')

            <div class="col-lg-12">
                <div class="dashboard_title_area">
                    <h2>{{ $title }}</h2>
                    <p class="text">Your Booking list</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb30 overflow-hidden position-relative">
                    <div class="packages_table table-responsive">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle mb-0">
                                <thead class="table" style="background:#dff6f2">
                                    <tr>
                                        <th>#</th>
                                        <th>SOW Name</th>
                                        <th>Initial Payment %</th>
                                        <th>Initial Paid Amount</th>
                                        <th>Total Amount</th>
                                        <th>Booking Status</th>
                                        <th>Payment Status</th>
                                        {{-- <th>Booking Type</th> --}}
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($booking) && count($booking) > 0)
                                        @php $i = 1; @endphp
                                        @foreach ($booking as $val)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        {{-- <img src="{{ asset('images/team/client-1.png') }}"
                                                            class="rounded-circle me-3" width="50" height="50"
                                                            alt="Client"> --}}
                                                        <div>
                                                            <a href="{{route('user.booking.details',['id' => encrypt($val->id)])}}">
                                                                <h6 class="mb-1">{{ $val->statementOfWork->title ?? 'N/A' }}
                                                                </h6>
                                                                <small class="text-muted d-block"><i
                                                                    class="flaticon-30-days me-1 text-primary"></i>{{formatDateReadable($val->created_at)}}</small>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>{{ $val->statementOfWork->initial_payment_percentage ?? 'N/A' }}%</td>
                                                <td>{{ $val->initial_paid_amount ?? 'N/A' }}</td>
                                                <td><span class="badge bg-success">{{ $val->total_amount ?? 'N/A' }} </span></td>
                                                <td>
                                                    @if($val->status=='pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                    @else
                                                    <span class="badge bg-success">Success</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($val->payment_status=='pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                        @else
                                                            <span class="badge bg-success">Success</span>
                                                        @endif
                                                </td>
                                                {{-- <td>
                                                    @if($val->booking_type=='custom_gig')
                                                        <span class="badge bg-info">Custom Gig</span>
                                                        @else
                                                            <span class="badge bg-info">Predefined Gig</span>
                                                        @endif
                                                    </td> --}}

                                                {{-- <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="#" class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="tooltip" title="Edit"><i
                                                                class="flaticon-pencil"></i></a>
                                                        <a href="#" class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="tooltip" title="Delete"><i
                                                                class="flaticon-delete"></i></a>
                                                    </div>
                                                </td> --}}

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">No bookings found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if ($booking->hasPages())
                            <div class="mbp_pagination text-center mt30">
                                <ul class="page_navigation">

                                    {{-- Previous Page Link --}}
                                    @if ($booking->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><span class="fas fa-angle-left"></span></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $booking->previousPageUrl() }}"><span class="fas fa-angle-left"></span></a>
                                        </li>
                                    @endif

                                    {{-- Pagination Elements --}}
                                    @foreach ($booking->links()->elements[0] as $page => $url)
                                        @if ($page == $booking->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <a class="page-link" href="#">{{ $page }} <span class="sr-only">(current)</span></a>
                                            </li>
                                        @else
                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($booking->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $booking->nextPageUrl() }}"><span class="fas fa-angle-right"></span></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><span class="fas fa-angle-right"></span></span>
                                        </li>
                                    @endif
                                </ul>

                                <p class="mt10 mb-0 pagination_page_count text-center">
                                    {{ ($booking->currentPage() - 1) * $booking->perPage() + 1 }}
                                    –
                                    {{ min($booking->currentPage() * $booking->perPage(), $booking->total()) }}
                                    of {{ $booking->total() }} bookings available
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

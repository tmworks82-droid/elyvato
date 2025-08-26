@php
   
    $robotsMeta = 'noindex, nofollow';
@endphp


@extends('layouts.front.user-app')

@section('pageContent')
<style>
    th{
            font-weight: 600;
    }
</style>
{{-- header --}}
<div class="mb-3 mb-lg-4">
    <div class="d-flex gap-3 flex-wrap">
        <button class="btn d-inline d-lg-none p-0 fs-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="ri-menu-2-line"></i>
        </button>
        <h1 class="fw-bold mb-0">Subscription Bookings</h1>
    </div>
</div>

{{-- bookings list --}}
<div class="overflow-x-hidden">
    <div class="row gap-3 align-items-center justify-content-between mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('user.booking.list') }}" class="rounded position-relative mb-3">
                <input 
                    class="form-control pe-5 bg-transparent focus-shadow-none" 
                    type="search" 
                    name="search" 
                    placeholder="Search by booking or SOW" 
                    value="{{ request('search') }}">
                <button class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset" type="submit">
                    <i class="ri-search-2-line"></i>
                </button>
            </form>

        </div>
        <div class="col-md-3">
            <form method="GET" action="{{ url('/booking-list') }}">
                <select name="sort_by" class="form-select focus-shadow-none bg-transparent" onchange="this.form.submit()">
                    <option value="">Sort by</option>
                    <option value="new">New (Last 1 Week)</option>
                    <option value="old">Old (Before 1 Week)</option>
                </select>
            </form>

        </div>

        <div class="col-md-2">
            <a href="{{url('booking-list')}}" class="btn btn-main float-right">Reset Filter </a>
        </div>
    </div>
    <div class="border rounded-2 p-3">
        <div class="table-responsive">
            <table class="table table-bordered text-sm mb-0">
                <thead>
                    <tr>
                    <th scope="col" class="bg-light">#</th>
                    <th scope="col" class="bg-light">Gig Name</th>
                    <th scope="col" class="bg-light">Initial Paid Amount</th>
                    <th scope="col" class="bg-light">Total Amount</th>
                    <th scope="col" class="bg-light">Booking Status</th>
                    <th scope="col" class="bg-light">Payment Status</th>
                    <th scope="col" class="bg-light">Subscription Duration</th>
                    <th scope="col" class="bg-light">Subscription Status</th>
                    <th scope="col" class="bg-light">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    @if (!empty($subscription) && count($subscription) > 0)
                        @php $i = 1; @endphp
                        @foreach ($subscription as $val)
                    <tr>
                        
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                            <a href="{{route('user.booking.details',['id' => encrypt($val->booking->id)])}}">
                                {{ $val->booking->statementOfWork->title ?? 'N/A' }}
                            </a>
                           
                            <p class="mb-0 text-sm text-secondary">
                                
                                {{formatDateReadable($val->created_on)}}
                            </p>
                        </td>
                        <td>₹ {{ $val->booking->initial_paid_amount ?? 'N/A' }} </td>
                        <td>₹ {{ $val->booking->total_price ?? 'N/A' }}</td>
                        <td>
                            @if($val->booking->status=='pending')
                                <span class="badge text-bg-warning">Pending</span>
                            @else
                                <span class="badge text-bg-success">Success</span>
                            @endif
                        </td>
                        <td>
                           @if($val->booking->payment_status=='pending')
                                <span class="badge text-bg-warning">Pending</span>
                            @else
                                <span class="badge text-bg-success">Success</span>
                            @endif
                        </td>
                        <td> <span class="badge text-bg-primary text-light">{{ ucfirst($val->subscription)}}</span> </td>
                        <td> 
                        @if($val->status=='live')
                        <span class="badge text-bg-success text-light">{{ ucfirst($val->status)}}</span> 
                        @else
                         <span class="badge text-bg-danger text-light">{{ ucfirst($val->status)}}</span>
                        @endif
                        </td>
                        <td> 
                        @if($val->status=='live')
                        <button class="btn btn-sm btn-danger action_subscription"
                                data-id="{{ $val->id }}"  data-booking="{{ $val->booking->id }}"
                                data-type="cancel" data-assign="{{$val->booking->assign_to}}"
                                title="Cancel Subscription">
                            Cancel
                        </button>
 
                        @else
                        
                        <button class="btn btn-sm btn-info action_subscription" data-id="{{ $val->id }}" data-booking="{{ $val->booking->id }}"
                                data-type="live" data-assign="{{$val->booking->assign_to}}" title="Activate Subscription">Activate</button> 
                        @endif
                        </td>
                        
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
    </div>
    
    <!-- Pagination Section -->
    <div class="mt-3 d-flex gap-3 flex-wrap justify-content-between align-items-center">
        @if($subscription->hasMorePages())
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0">
                {{-- Previous Page Link --}}
                <li class="page-item {{ $subscription->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link text-sm focus-shadow-none" href="{{ $subscription->previousPageUrl() ?? '#' }}">Previous</a>
                </li>

                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $booking->lastPage(); $i++)
                    <li class="page-item {{ $subscription->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link text-sm focus-shadow-none" href="{{ $subscription->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page Link --}}
                <li class="page-item {{ !$subscription->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link text-sm focus-shadow-none" href="{{ $subscription->nextPageUrl() ?? '#' }}">Next</a>
                </li>
            </ul>
        </nav>
        

        <p class="mb-0 text-sm">
            Showing 
            <span class="text-muted">{{ $subscription->firstItem() }} - {{ $subscription->lastItem() }}</span> 
            of 
            <span class="text-muted">{{ $subscription->total() }}</span>.
        </p>
        @endif
    </div>
</div>

@endsection
@section('scripts')
<script>
$(document).ready(function () {
    
    $('.action_subscription').on('click', function () {
          $btn=$(this);
         $btn.prop('disabled', true).html('Processing...');
        const id = $(this).data('id');
        const assign = $(this).data('assign');
        const type = $(this).data('type');
        const booking = $(this).data('booking');

        if (confirm('Are you sure you want to cancel this subscription?')) {
            $.ajax({
                url: '{{ route("subscription.cancel") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    type: type,
                    assign:assign,
                    booking:booking
                },
                success: function (response) {
                    if (response.success) {
                       
                        Swal.fire("Success", response.message, "success").then(() => {
                                window.location.reload();
                            });
                       $btn.prop('disabled', false).html(type);
                    } else {
                        alert('Something went wrong!');
                         Swal.fire("Error", "Something went wrong", "error");
                         $btn.prop('disabled', false).html(type);
                    }
                },
                error: function () {
                    alert('Server error.');
                    $btn.prop('disabled', false).html(type);
                }
            });
        }
    });
});
</script>

@endsection
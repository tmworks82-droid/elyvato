@php
    $title = 'Payments - Elyvato';
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
            <button class="btn d-inline d-lg-none p-0 fs-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="ri-menu-2-line"></i>
            </button>
            <h1 class="fw-bold mb-0">Payments</h1>
        </div>
    </div>

    {{-- payments list --}}
    <div class="overflow-x-hidden">
        <div class="row gap-3 align-items-center justify-content-between mb-4">
            <div class="col-md-7">
                <form class="rounded position-relative">
                    <input class="form-control pe-5 bg-transparent focus-shadow-none" type="search" placeholder="Search"
                        aria-label="Search">
                    <button
                        class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                        type="submit">
                        <i class="ri-search-2-line"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-3">
                <form>
                    <select class="form-select focus-shadow-none bg-transparent">
                        <option value="">Sort by</option>
                        <option>Newest</option>
                        <option>Oldest</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="border rounded-2 p-3">
            <div class="table-responsive">
                <table class="table table-bordered text-sm overflow-x-scroll mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="bg-light">#</th>
                            <th scope="col" class="bg-light">Amount</th>
                            <th scope="col" class="bg-light">Date</th>
                            <th scope="col" class="bg-light">Payment Method</th>
                            <th scope="col" class="bg-light">Payment Status</th>
                            <th scope="col" class="bg-light">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (!empty($payments) && count($payments) > 0)
                            @php $i = 1; @endphp
                            @foreach ($payments as $payment)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>₹ {{ $payment->amount }}</td>
                                    <td>{{ formatDateReadable($payment->payment_date) }}</td>
                                    <td>Online</td>
                                    <td>
                                        @if($payment->status == 'pending')
                                            <span class="badge text-bg-warning">Pending</span>
                                        @elseif($payment->status == 'success')
                                            <span class="badge text-bg-success">Completed</span>
                                        @elseif($payment->status == 'faild')
                                            <span class="badge text-bg-danger">Faild</span>
                                        @endif
                                    </td>
                                    <td>
                                     @php
                                     $invoice=App\Models\Invoice::where('booking_id',$payment->booking_id)->first();
                                     @endphp

                                    @if(!empty($invoice))
                                    @if($invoice->status=='rejected')
                                        <button class="btn btn-sm btn-main request_invoice" data-booking-id="{{ $payment->booking_id }}">
                                            Request for invoice
                                        </button>
                                        
                                        @else

                                        <button class="btn btn-sm btn-success" disable>
                                            Requested
                                        </button>
                                        @endif
                                        @else
                                        <button class="btn btn-sm btn-main request_invoice" data-booking-id="{{ $payment->booking_id }}">
                                            Request for invoice
                                        </button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No Data Found!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3 d-flex gap-3 flex-wrap justify-content-between align-items-center">
            @if($payments->hasMorePages())
                <nav aria-label="Page navigation">
                    <ul class="pagination mb-0">
                        <!-- Previous Button -->
                        <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link text-sm focus-shadow-none" href="{{ $payments->previousPageUrl() }}"
                                aria-label="Previous">Previous</a>
                        </li>

                        <!-- Page Numbers -->
                        @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                            <li class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link text-sm focus-shadow-none" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Next Button -->
                        <li class="page-item {{ $payments->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link text-sm focus-shadow-none" href="{{ $payments->nextPageUrl() }}"
                                aria-label="Next">Next</a>
                        </li>
                    </ul>
                </nav>
            @endif

            <!-- Pagination Summary -->
            <p class="mb-0 text-sm">
                Showing <span class="text-muted">{{ $payments->count() }}</span> of {{ $payments->total() }}.
            </p>
        </div>
    </div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('.request_invoice').click(function () {
    let $btn = $(this); // Store button reference
    let bookingId = $btn.data('booking-id');

    // Change button text and disable it
    $btn.prop('disabled', true).html('Processing...');

    $.ajax({
        url: '{{ route("request.invoice") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            booking_id: bookingId
        },
        success: function (response) {
            Swal.fire("Success", response.message, "success").then(() => {
                window.location.reload();
            });
        },
        error: function (xhr) {
            Swal.fire("Error", "Something went wrong", "error");
            console.log(xhr.responseText);

            // Re-enable the button and restore text if needed
            $btn.prop('disabled', false).html('Request for invoice');
        }
    });
});

});
</script>

@endsection
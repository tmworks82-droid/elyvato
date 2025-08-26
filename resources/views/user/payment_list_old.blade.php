@extends('layouts.user.app')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="dashboard__content hover-bgc-color">
        <div class="row pb40">
            @include('layouts.user.side_menu')
        </div>
        <div class="row align-items-center justify-content-between pb40">
            <div class="col-lg-6">
                <div class="dashboard_title_area">
                    <h2>Payments</h2>
                    {{-- <p class="text">Lorem ipsum dolor sit amet, consectetur.</p> --}}
                </div>
            </div>
            {{-- <div class="col-lg-6">
                <div class="text-lg-end">
                    <a href="page-freelancer-v1.html" class="ud-btn btn-dark default-box-shadow2">Create Payout<i
                            class="fal fa-arrow-right-long"></i></a>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs4 p30 mb60 overflow-hidden position-relative">
                    <div class="packages_table table-responsive">
                        <table class="table-style3 table at-savesearch">
                            <thead class="t-head">
                                <tr>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Payment Status</th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                @if (!empty($payments) && count($payments) > 0)
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <th scope="row">$ {{ $payment->amount }}</th>
                                            <td class="vam">{{ formatDateReadable($payment->payment_date) }}</td>
                                            <td class="vam">Online</td>
                                            <td class="vam">
                                                @if ($payment->status == 'pending')
                                                    <span class="pending-style style1">Pending</span>
                                                @elseif($payment->status == 'success')
                                                    <span class="pending-style style2">Completed</span>
                                                @elseif($payment->status == 'faild')
                                                    <span class="pending-style style3">Faild</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                        @if ($payments->hasPages())
                            <div class="mbp_pagination text-center mt30">
                                <ul class="page_navigation">

                                    {{-- Previous Page Link --}}
                                    @if ($payments->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><span class="fas fa-angle-left"></span></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $payments->previousPageUrl() }}"><span
                                                    class="fas fa-angle-left"></span></a>
                                        </li>
                                    @endif

                                    {{-- Pagination Links --}}
                                    @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $payments->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($payments->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $payments->nextPageUrl() }}"><span
                                                    class="fas fa-angle-right"></span></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><span class="fas fa-angle-right"></span></span>
                                        </li>
                                    @endif
                                </ul>

                                {{-- Entry Count --}}
                                <p class="mt10 mb-0 pagination_page_count text-center">
                                    {{ ($payments->currentPage() - 1) * $payments->perPage() + 1 }} –
                                    {{ min($payments->currentPage() * $payments->perPage(), $payments->total()) }}
                                    of {{ $payments->total() }} payments
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
                {{-- <div class="ps-widget bgc-white bdrs4 p30 mb30 position-relative">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="bdrb1 pb15">
                                <h5 class="list-title">Payout Methods</h5>
                            </div>
                            <div class="widget-wrapper mt35">
                                <h6 class="list-title mb10">Select default payout method</h6>
                                <div class="bootselect-multiselect">
                                    <select class="selectpicker">
                                        <option>Paypal</option>
                                        <option data-tokens="BankTransfer">Bank Transfer</option>
                                        <option data-tokens="Chicago">Payoneer</option>
                                    </select>
                                </div>
                            </div>
                            <h5 class="mb15">Payout Details</h5>
                            <div class="navpill-style1 payout-style">
                                <ul class="nav nav-pills align-items-center justify-content-center mb30" id="pills-tab"
                                    role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw500 dark-color" id="pills-home-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-home" type="button"
                                            role="tab" aria-controls="pills-home"
                                            aria-selected="true">Paypal</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active fw500 dark-color" id="pills-profile-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                            role="tab" aria-controls="pills-profile" aria-selected="false">Bank
                                            Transfer</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link fw500 dark-color" id="pills-contact-tab"
                                            data-bs-toggle="pill" data-bs-target="#pills-contact" type="button"
                                            role="tab" aria-controls="pills-contact"
                                            aria-selected="false">Payoneer</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <form class="form-style1">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank
                                                            Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Account
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Account
                                                            Holder Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Routing
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank
                                                            IBAN</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Swift
                                                            Code</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="text-start">
                                                        <a class="ud-btn btn-thm" href="page-contact.html">Save Detail<i
                                                                class="fal fa-arrow-right-long"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        <form class="form-style1">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank
                                                            Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Account
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Account
                                                            Holder Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Routing
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank
                                                            IBAN</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Swift
                                                            Code</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="text-start">
                                                        <a class="ud-btn btn-thm" href="page-contact.html">Save Detail<i
                                                                class="fal fa-arrow-right-long"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                        aria-labelledby="pills-contact-tab">
                                        <form class="form-style1">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank
                                                            Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Account
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Account
                                                            Holder Name</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank Routing
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Bank
                                                            IBAN</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw500 mb-1">Swift
                                                            Code</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="creativelayers088@gmail.com">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="text-start">
                                                        <a class="ud-btn btn-thm" href="page-contact.html">Save Detail<i
                                                                class="fal fa-arrow-right-long"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

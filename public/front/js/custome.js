



// Main Button Click Event

$(document).on('click', '.proceed-booking-btn', function (e) {
    e.preventDefault();

    let isLoggedIn = $('#isLoggedIn').val();
    let sow_id = $(this).data('id');
    let price = $(this).data('price');

    if (isLoggedIn == 0) {
        Swal.fire({
            title: "Authentication!",
            text: "Please log in first.",
            icon: "warning",
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            window.location.href = "{{ url('/user-login') }}";
        });
        return;
    }

    createRazorpayOrder(sow_id, price); // Call the order function
});

//  STEP 1: Call this to begin the Razorpay process
function createRazorpayOrder(sow_id, price) {
    PleaseWait();

    $.ajax({
        url: "{{ route('razorpay.order.create') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            price: price
        },
        success: function (orderData) {
            Swal.close();

            let options = {
                key: orderData.razorpay_key,
                amount: orderData.amount,
                currency: orderData.currency,
                name: "Elyvato",
                description: "Booking Payment",
                order_id: orderData.order_id,
                handler: function (response) {
                    storeBooking(response, sow_id, price); // 🔁 Call after payment success
                },
                theme: {
                    color: "#528FF0"
                }
            };

            let rzp = new Razorpay(options);
            rzp.open();
        },
        error: function () {
            Swal.close();
            Swal.fire("Error", "Failed to create order.", "error");
        }
    });
}



// 🔁 STEP 2: Call this after Razorpay success
function storeBooking(response, sow_id, price) {
    PleaseWait();

    $.ajax({
        url: "{{ route('user.proceed.booking') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            sow_id: sow_id,
            price: price,
            razorpay_payment_id: response.razorpay_payment_id,
            razorpay_order_id: response.razorpay_order_id,
            razorpay_signature: response.razorpay_signature
        },
        success: function (res) {
            Swal.close();
            Swal.fire("Success", res.message, "success").then(() => {
                window.location.href = "{{ url('/booking-list') }}";
            });
        },
        error: function () {
            Swal.close();
            Swal.fire("Error", "Something went wrong!", "error");
        }
    });
}

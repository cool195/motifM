<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/scripts/vendor/fastclick.js"></script>
</head>
<body>
<form id="checkout" method="post" action="/testcheck">
    <div id="payment-form"></div>
    <input type="submit" value="Pay $10">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
{{--<script src="https://js.braintreegateway.com/js/braintree-2.24.1.min.js"></script>--}}
<script src="/scripts/braintree-2.24.1.min.js"></script>
<script>
    // We generated a client token for you so you can test out this code
    // immediately. In a production-ready integration, you will need to
    // generate a client token on your server (see section below).
    var clientToken = "{{$token}}";

    braintree.setup(clientToken, "dropin", {
        container: "payment-form"
    });
</script>

</body>
</html>
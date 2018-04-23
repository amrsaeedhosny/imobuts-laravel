<html>
<head>

</head>
<body>
<form action="{{route('charge')}}" method="POST">
    {{csrf_field()}}
    <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ env('STRIPE_PUB_KEY') }}"
            data-amount="999"
            data-name="Imobuts"
            data-description="Example charge"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-zip-code="true">
    </script>
</form>
<script>
    (function () {
        document.getElementsByClassName('stripe-button-el')[0].click();
        document.getElementsByClassName('stripe-button-el')[0].style.display = "none";
        // your page initialization code here
        // the DOM will be available here

    })();
</script>
</body>
</html>
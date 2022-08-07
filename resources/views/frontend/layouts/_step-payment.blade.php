<div class="checkout-steps pixel-corners">
    <ul>
        <li class="account-info bg-account {{ \Request::is('checkout1')? 'checkout-active' : '' }}">Billing Details</li>
        <li class="account-info bg-account {{ \Request::is('checkout-first')? 'checkout-active' : '' }}">Payment</li>
        <li class="account-info bg-account {{ \Request::is('checkout-two')? 'checkout-active' : '' }}">Confirmation</li>
    </ul>
</div>
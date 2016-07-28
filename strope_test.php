require_once('./config.php');

<form class="" action="" method="POST">
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key="<?php echo $stripe['publishable_key']; ?>"
                          data-description="Access for a year"
                          data-amount="5000"
                          data-locale="auto"></script>
</form>
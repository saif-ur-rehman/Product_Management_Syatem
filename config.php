<?php
require_once('vendor/stripe/lib/stripe.php');

$stripe = array(
  "secret_key"      => "sk_test_SjEOXZja91MJ6cFvSjFHFgGV",
  "publishable_key" => "pk_test_kU7BO94STximG6M8ThnPd3cg"
);

Stripe::setApiKey($stripe['secret_key']);

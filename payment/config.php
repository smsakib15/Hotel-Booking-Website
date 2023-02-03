<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51JX9CdIBCH1CFRSNIWgddNUSZzrMeBnsyqwgPtewN78vz5ZBOySAsVBhrOIjqidrK77FdjE6hpTYrHw7E1HyRcRe00LmSM4YQg";

$secretKey="sk_test_51JX9CdIBCH1CFRSNZC2PVySE0tSZx46wLgSNzxJhpurlhcDKQOcnUREsqo7pfB8ldeNo6cJLgquDvWVwQrLnV4GQ00oJtarJPG";


\Stripe\Stripe::setApiKey($secretKey);

?>
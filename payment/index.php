<?php
require('config.php');
?>
<form action="submit.php" method="post">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="50"
		data-name="Osean Sunrise"
		data-description="Booking Hotel"
		data-image="https://www.logostack.com/wp-content/uploads/designers/eclipse42/small-panda-01-600x420.jpg"
		data-currency="usd"
		data-email="greencommercial18@gmail.com"
	>
	</script>

</form>


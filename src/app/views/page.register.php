<?php $this->extend('layout')->block('block.content') ?>

<div class="form">
	<p class='header'>Login Form</p> 
		<?= isset($error) ? $error : false ?>

	<form method="post">
		<p><input type="text" name="username" value="" placeholder="Username"></p>
		<p><input type="email" name="email" value="" placeholder="Email"> </p>
		<p><input type="password" name="password" value="" placeholder="Password"></p>
			<p class="remember_me">
				<small>Forgot your password?  <a href="/password/forgot">Click here to reset it </a> </small>
			</p> 
		<p class="submit"><input type="submit" name="commit" value="Sign Up"></p>
	</form>

</div>

<?php $this->endBlock('block.content'); ?>


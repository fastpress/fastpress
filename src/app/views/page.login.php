<?php $this->extend('layout')->block('block.content') ?>


    
    <div class="form">
      <p class='header'>Login Form</p> 
	    <?= isset($error) ? $error : false ?>
      
      <form method="post">
       <input type="text" name="email" value="" placeholder="Username or Email">
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="remember_me">
          <small>Forgot your password? <a href="/password/forgot"> Click here to reset it </a></small></p>
        </p>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    
    </div>

 
    
<?php $this->endBlock('block.content'); ?>


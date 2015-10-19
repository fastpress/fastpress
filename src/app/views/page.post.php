<?php $this->extend('layout')->block('block.content') ?>



<div class="form post-article-form">
    <p class='header'>Add New Blog</p> 
        <?= isset($error) ? $error : false ?>

    <form method="post">
        <p><input type="text" name="title" value="" placeholder="Blog Title"></p>
        <p><input type="text" name="tags" value="" placeholder="Blog Tags"> </p>
        <div class='text-formating'> 

<pre>
```php 
   // your code here
```
</pre>
        </div>
        <p><textarea name='content' id='input-about' /></textarea></p>
            <p class="remember_me">
                <small> It is recommended you 'save' your article, prior to publishing it. </small>
            </p> 
        <p class="submit"><input type="submit" name="commit" value="Save Article"></p>
    </form>

</div>

<?php $this->endBlock('block.content'); ?>


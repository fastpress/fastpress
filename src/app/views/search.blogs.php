<?php $this->extend('layout')->block('block.content') ?>

<?php 

foreach ($searchResult as $row) {  ?>
    
 
   <div class="article-index">
      <h1 class="title">
        <a href='/blog/<?= $row['slug'] ?> '> <?= $row['title'] ?> </a> 
      </h1>
      <p class="content">
         ...<?= $row['content'] ?> ...
      </p>
    </div>
  <?php } ?>

  
    
<?php $this->endBlock('block.content'); ?>


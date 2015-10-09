<?php $this->extend("layout")->block("block.content") ?>
 

 <?php extract($blog, EXTR_SKIP); ?>

 <div class='single-blog'>
    <div class='block'>
        <h2> <a href='/blog/<?= $slug ?> '> <?= ucwords($title) ?> </a>  </h2>

        <div class='details'> 
          <span class='date fa fa-clock-o'> <?=  $day_name ?> </span>
          <span class='tags  fa fa-tags'> <?=  $tags ?>     </span>
          <span class='user fa fa-user'> </span>
        </div> 

        <div class='content'>
            <?php 
              $content = str_replace(
                  ['[php]', '[/php]', '[css]', '[/css]', '[js]', '[/js]'], 
                  [
                    "<pre><code class='language-php'>", "</code></pre>",
                    "<pre><code class='language-css'>", "</code></pre>",
                    "<pre><code class='language-javascript'>", "</code></pre>"
                  ], 
                  $content); 
              echo $content; 
            ?>
        </div>
    </div>
</div>
<?php $this->endBlock("block.content"); ?>



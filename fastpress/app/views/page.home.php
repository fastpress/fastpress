<?php $this->extend('layout')->block('block.content') ?>

<article>

	<?php  foreach ($blogs as $key => $row) {  ?>
	<div class='block'>
		<h2> <a href='/blog/<?= $row['slug'] ?> '> <?= ucwords($row['title']) ?> </a>  </h2>

		<div class='details'> 
			<span class='date fa fa-clock-o'> <?=  $row['day_name'] ?> </span>
			<?php 
				foreach (explode(',', $row['tags']) as $key => $value) { ?>
					<span class='tags  fa fa-tags'> <a href="/blogs/?tag=<?= $value ?>"><?=  $value ?></a>     </span>
				<?php } ?>
			<span class='user fa fa-user'>  fa-user</span>
		</div> 

		<div class='content'>
			<p> <?= substr(ucfirst($row['content']), 0, rand(250, 350)) ?> ...</p>
		</div>

		<div class='continue'><a href='/blog/<?= $row['slug'] ?>'> Continue reading… </a></div>
	</div>
	<?php } ?>
	
</article>  

<?php $this->endBlock('block.content'); ?>


<?php $images = get_image(); ?>
<?php $tags = get_the_tags(); ?>

<?php for($i = 0, $l = count($images[1]); $i < $l; $i++): ?>
<div id="<?php echo $post -> post_name; ?>" class="item">
  <h1><?php echo $post -> post_title; ?></h1>
  <a href="/<?php echo $post -> post_name; ?>/" data-pjax><?php echo $images[0][$i] ?></a>
</div>
<?php endfor; ?>

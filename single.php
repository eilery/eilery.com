<?php
/*
Template Name: single
*/
?>

<?php $pjax = !($_GET['_pjax']); ?>

<?php if($pjax): ?>
<?php get_header(); ?>
<div id="canvas"></div>
<header id="header" class="hidden">
  <h1><a href="/" id="title" data-pjax>eilery.com</a></h1>
</header>
<?php endif; ?>

<main id="main" class="hidden">
  <?php the_post(); ?>
  <h1><?php echo $post -> post_title; ?></h1>
  <ul>
    <li><?php the_time('Y'); ?></li>
    <?php $tags = get_the_tags(); ?>
    <?php if($tags): ?>
    <?php foreach($tags as $tag): ?>
      <li><?php echo $tag -> name; ?></li>
    <?php endforeach; ?>
    <?php endif; ?>
  </ul>
  <?php the_content(); ?>
</main>

<?php $pjax = !($_GET['_pjax']); ?>
<?php if($pjax): ?>
<nav id="nav" class="hidden">
  <ul>
    <li><a href="/cv/" data-pjax>CV</a></li>
    <li><a href="mailto:info@eilery.com">Contact</a></li>
  </ul>
</nav>

<footer id="footer" class="hidden">
  <p>© 2017 Eilery All Rights Reserved.</p>
</footer>
<?php get_footer(); ?>
<?php endif; ?>

<?php
/*
Template Name: page
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

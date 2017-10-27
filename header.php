<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="Content-Type" content="text/html">
  <meta http-equiv="Content-Style-Type" content="text/css">
  <meta http-equiv="Content-Script-Type" content="text/javascript">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <meta name="description" content="Hello, I'm Eilery.">
  <meta name="keywords" content="Eilery, 永良リイ">
  <?php if(!is_home() && !is_front_page()): ?>
    <meta name="robots" content="noindex, nofollow">
  <?php endif; ?>
  <meta property="og:locale" content="ja">
  <meta property="og:site_name" content="eilery.com">
  <meta property="og:title" content="eilery.com">
  <meta property="twitter:title" content="eilery.com">
  <meta property="og:url" content="http://www.eilery.com/">
  <meta property="twitter:url" content="http://www.eilery.com/">
  <meta property="og:type" content="website">
  <meta property="og:description" content="Hello, I'm Eilery.">
  <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri()); ?>/img/ogi.png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <title><?php bloginfo('name'); ?></title>
  <link rel="icon" type="image/x-icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/favicon.ico"></script>
  <?php wp_head(); ?>
</head>
<body>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php
        $page_title    = isset($this->page)&&$this->page!=''?$this->page:'';
        $article_title = isset($article->article_title)&&$article->article_title!=''?$article->article_title:'';
        $meta_title    = get_name_app('configuration_meta_title');
        if($page_title != ''){ $meta_title = $page_title.' | '.get_name_app('configuration_name'); }
        if($article_title != ''){ $meta_title = $article_title.' | '.get_name_app('configuration_name'); }
    ?>

    <title><?php echo $meta_title ?></title>

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <meta name="author" content="Butik Sasha"/>
    <meta name="title" content="<?php echo $meta_title ?>" />
    <meta name="description" content="<?php echo isset($article->article_meta_description)&&$article->article_meta_description!=""?$article->article_meta_description:get_name_app('configuration_meta_desc');?>" />
    <meta name="keywords" content="<?php echo isset($article->article_meta_keywords)&&$article->article_meta_keywords!=""?$article->article_meta_keywords:get_name_app('configuration_meta_keyword');?>" />
    <meta name="Resource-type" content="Document" />

    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/collections/images/favicon.ico">
    <link rel="icon" type="img/png" href="<?php echo base_url();?>assets/collections/images/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/collections/images/favicon.png">

    <!-- JAVASCRIPT -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/front/js/jquery.min.js"></script>

    <script type="text/javascript">
       var MOD_URL   = '<?php echo base_url();?>';
    </script>

    <?php // if($this->isMobile){ echo 'Mobile'; } else { echo 'Desktop'; } ?>

    <?php $configuration = get_configuration(); ?>

</head>
<body class="<?php echo ($this->isMobile?"mobile":"desktop") ?>">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

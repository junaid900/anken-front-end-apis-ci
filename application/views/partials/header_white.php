<?php

header("X-XSS-Protection: 1");

header("X-Content-Type-Options: nosniff");

header("X-Frame-Options: SAMEORIGIN");//(1) DENY 表示该页面不允许在 frame 中展示，即便是在相同域名的页面中嵌套也不允许。SAMEORIGIN 表示该页面可以在相同域名页面的 frame 中展示。ALLOW-FROM uri 表示该页面可以在指定来源的 frame 中展示。

header("Referrer-Policy: same-origin");

header("X-Permitted-Cross-Domain-Policies: same-origin");

header("X-Download-Options: same-origin");

// if($this->langtype == '_ch'){

//     header("content-language: zh-CN");

// }else{

//     header("content-language: en");

// }

header("Cache-Control: max-age=300");

// header("Content-type: text/html; charset=utf-8");

// header("Server: close");

// header("Technology: close");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= base_url() . "themes/default/fav-icon.png"?>">



<title>ANKEN Group | <?= isset($page_title) ? $page_title: "ANKEN" ?></title>

<?php 

if(isset($newsinfo)){

    $is_share = 1;

    $og_description = $newsinfo['news_description'.$this->langtype];

    $og_description = strip_tags($og_description);

    $og_description = mb_substr($og_description, 0, 300, 'UTF-8');

    $og_description = str_replace('&lt;p&gt;', '', $og_description);

    $og_description = str_replace('&lt;/p&gt;', '', $og_description);

    $og_description = str_replace(array("/r/n", "/r", "/n"), '', $og_description);

    // 	$og_description = str_replace('<p>', '', $og_description);

    // 	$og_description = str_replace('</p>', '', $og_description);

    

    $filename_show = '';

    $filename_800x800 = '';

    $filename = $newsinfo['news_pic_1_path'];

    if($filename != ''){

        $filename_arr = explode('.', $filename);

        $file_type = end($filename_arr);

        $filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $filename);

        $filename_show = $filename;

    }

}else if(isset($eventinfo)){

    $is_share = 1;

    $og_description = $eventinfo['event_description'.$this->langtype];

    $og_description = strip_tags($og_description);

    $og_description = mb_substr($og_description, 0, 300, 'UTF-8');

    $og_description = str_replace('&lt;p&gt;', '', $og_description);

    $og_description = str_replace('&lt;/p&gt;', '', $og_description);

    $og_description = str_replace(array("/r/n", "/r", "/n"), '', $og_description);

    // 	$og_description = str_replace('<p>', '', $og_description);

    // 	$og_description = str_replace('</p>', '', $og_description);

    

    $filename_show = '';

    $filename_800x800 = '';

    $filename = $eventinfo['event_pic_1_path'];

    if($filename != ''){

        $filename_arr = explode('.', $filename);

        $file_type = end($filename_arr);

        $filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $filename);

        $filename_show = $filename;

    }

}else if(isset($cmsinfo)){

    $is_share = 1;

    $og_description = $cmsinfo['cms_description'.$this->langtype];

    $og_description = strip_tags($og_description);

    $og_description = mb_substr($og_description, 0, 200, 'UTF-8');

    $og_description = str_replace('&lt;p&gt;', '', $og_description);

    $og_description = str_replace('&lt;/p&gt;', '', $og_description);

    $og_description = str_replace(array("/r/n", "/r", "/n"), '', $og_description);

    // 	$og_description = str_replace('<p>', '', $og_description);

    // 	$og_description = str_replace('</p>', '', $og_description);

    

    $filename_show = '';

    $filename_800x800 = '';

    $filename = $cmsinfo['cms_pic_1_path'];

    if($filename != ''){

        $filename_arr = explode('.', $filename);

        $file_type = end($filename_arr);

        $filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $filename);

        $filename_show = $filename;

    }

}else{

    $is_share = 0;

}

?>

<?php if($is_share == 1){?>

<!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->

<meta property="og:type" content="website" />

<meta property='og:title' content="<?php echo $website_title?>" />

<meta property='og:image' itemprop="image" content="<?php if($filename_show != ''){echo base_url().$filename_show;}?>" />

<meta property='og:description' content="<?php echo $og_description?>" />

<?php }?>

<meta name="keywords" content="<?php if(isset($website_keyword)){echo $website_keyword;}?>" />

<meta name="description" content="<?php if(isset($website_description)){echo $website_description;}?>" />

<script language="JavaScript" type="text/javascript">

	var baseurl = '<?php echo base_url()?>';

	var currenturl = '<?php echo current_url()?>';

	var cdnurl = "<?php echo CDN_URL()?>";

</script>

<link href="<?= base_url() ?>themes/default/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo CDN_URL().'themes/default/js/jquery-3.6.0.min.js?date='.CACHE_USETIME()?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo CDN_URL().'themes/default/base.css?date='.CACHE_USETIME()?>" />
<style>
    .custom-group br {
        display: block;
        margin-bottom: 2px;
        font-size:2px;
        line-height: 13px;
    }
    .custom-group br:before {
        display: block;
        margin-top: 2px;
        content: "";
    }
    .custom-group br:after {
        content: ".";
        visibility: hidden;
        display: block;
    }
</style>
</head>

<body>

<noscript>您的浏览器不支持 JavaScript!</noscript>

<?php 

    $this->load->view('partials/header_white_menu_pc');

?>
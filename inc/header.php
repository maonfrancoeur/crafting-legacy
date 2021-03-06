<?php
function setHeader($match, $param = null)
{
 global $configurations;

 $views = array();
 
 $data_configs = $configurations -> findConfigs();
 $meta_tags = $data_configs['results'];
 
 foreach ($meta_tags as $meta_tag => $m) {
   $views['meta_title'] = htmlspecialchars($m['site_name']); 
   $views['meta_description'] = htmlspecialchars($m['meta_description']);
   $views['meta_keywords'] = htmlspecialchars($m['meta_keywords']);
   $views['tagline'] = htmlspecialchars($m['tagline']);
   $views['phone'] = htmlspecialchars($m['phone']);
 }
 
?>
<!DOCTYPE html>
<html lang="id">

  <head>

    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $views['meta_description']; ?>">
    <meta name="keywords" content="<?php echo $views['meta_keywords']; ?>">
    
    <meta itemprop="name" content="<?php echo $views['meta_title']; ?>">
    <meta itemprop="description" content="<?php echo strip_tags_content($views['meta_description']); ?>">
    <meta itemprop="image" content="<?php echo APP_DIR . 'home/img/kartatopia.png' ?>"> 

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="<?php echo $views['meta_title']; ?>">
    <meta name="twitter:title" content="<?php echo $views['meta_keywords'] ?>">
    <meta name="twitter:description" content="<?php echo strip_tags_content($views['meta_description']); ?>">
    <meta name="twitter:creator" content="<?php echo $views['phone']; ?>">
    <meta name="twitter:image:src" content="<?php echo APP_DIR . 'home/img/kartatopia.png'; ?>">
     

    <title><?php echo "{$views['meta_title']} | {$views['tagline']} | Call Us: {$views['phone']}";  ?></title>
    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <link href="<?php echo APP_PUBLIC; ?>home/css/freelancer.min.css" rel="stylesheet">
   
    <link href="<?php echo APP_PUBLIC; ?>home/img/favicon.ico" rel="Shortcut Icon" />
    
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115374904-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115374904-1');
</script>
    

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a href="<?php echo APP_DIR; ?>" class="navbar-brand js-scroll-trigger" href="#page-top">
        <img class="img-fluid" alt="kartatopia" src="<?php echo APP_PUBLIC; ?>home/img/kartatopia.png">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#product" title="Our products" >Products</a>
            </li>
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#blog" title="Blog" >Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact" title="Contact Us" >Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about" title="About Us" >About</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
 <?php 
 if (!$match) :
 
 ?>
  
    <header class="masthead">
      <div class="container">
        <img class="img-fluid" src="<?php echo APP_PUBLIC; ?>home/img/error404.png" alt="Error Page Not Found">
        <div class="intro-text">
          <span class="name">Page not Found</span>
          <hr class="star-light">
           <span class="skills">Error - Page not Found !</span>
        </div>
      </div>
    </header>
   
<?php 
else :
?>
   <header class="masthead">
      <div class="container">
        <img class="img-fluid" src="<?php echo APP_PUBLIC; ?>home/img/piluscart.png" alt="powering online shop">
        <div class="intro-text">
          <span class="name"><?php echo "{$views['tagline']}"; ?></span>
          <hr class="star-light">
           <span class="skills">Free - Open Source - eCommerce Software - Online Shop</span>
        </div>
      </div>
    </header>
<?php 
endif; 
?>
   
<?php     
}

function blogHeader($match, $param = null)
{
    global $configurations, $posts, $post_cats, $categories, $widgets, $frontContent, $frontPaginator, $sanitize;
    global $imageGraphProtocol, $ogp;
    
    $views = array();
    $views['errorMessage'] = false;
    
    $data_configs = $configurations -> findConfigs();
    $configs = $data_configs['results'];
    
    foreach ($configs as $config => $c) {
        $meta_title = htmlspecialchars($c['site_name']);
        $meta_desc = htmlspecialchars($c['meta_description']);
        $meta_key = htmlspecialchars($c['meta_keywords']);
        $tagline = htmlspecialchars($c['tagline']);
        $phone = htmlspecialchars($c['phone']);
    }
    
   // get all post published
   $postPublished = $frontContent -> grabAllPosts($posts, $frontPaginator, $sanitize);
   $totalPostPublished = $postPublished['totalRows'];
    
   // get post categories
   $postCategories = $widgets -> setSidebarCategories();
   $navcats = $postCategories['categories'];
     
   // get detail post
   if (($match == 'post') && (!is_null($param))) {
    
      $r = $frontContent -> readPost($posts, $param, $sanitize);
      
      if (!$r) {
          
          $views['errorMessage'] = true;
      
      } 
      
      $post_image = isset($r['post_image']) ? $r['post_image'] : '';
      $postId = (int)$r['postID'];
      $post_title = isset($r['post_title']) ? htmlspecialchars($r['post_title']) : '';
      $date_published = isset($r['date_created']) ? makeDate($r['date_created'], 'id') : '';
      $author = isset($r['volunteer_login']) ? htmlspecialchars($r['volunteer_login']) : '';
      $post_slug = isset($r['post_slug']) ? htmlspecialchars($r['post_slug']) : '';
      
      $post_content = strip_tags($r['post_content']);
      $description = substr($post_content, 0, 150);
      $description = substr($post_content, 0, strrpos($description, " "));
      
      // Core Open Graph Protocol
      $imageGraphProtocol -> setURL(APP_PICTURE .$post_image);
      $imageGraphProtocol -> setSecureURL(APP_PICTURE .$post_image);
      $imageGraphProtocol -> setType('image/jpeg');
      $imageGraphProtocol -> setWidth(400);
      $imageGraphProtocol -> setHeight(300);
      
      $ogp -> setLocale('id_ID');
      $ogp -> setSiteName($meta_title);
      $ogp -> setTitle($post_title);
      $ogp -> setDescription(strip_tags_content($description));
      $ogp -> setType('article');
      $ogp -> setURL(APP_DIR . 'post' . '/'. $postId . '/' . $post_slug);
      $ogp -> setDeterminer("");
      $ogp -> addImage($imageGraphProtocol);
      
      
   } elseif (($match == 'category') && (!empty($param))) {
     
       // get detail category
      $getCat = $categories -> findCategoryBySlug($param, $sanitize);
      $category_title = htmlspecialchars($getCat['category_title']);
      
   }
   

?>
<!DOCTYPE html>
<html lang="id">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <?php 
    if (($match == 'post') && (!empty($param))):
    ?> 
    <base href="<?php echo APP_DIR; ?>" >
    <meta name="description" content="<?php echo strip_tags_content($description); ?>">
    <meta name="keywords" content="<?php echo $meta_key; ?>" >
    
    <meta itemprop="name" content="<?php echo $post_title; ?>">
    <meta itemprop="description" content="<?php echo strip_tags_content($description); ?>">
    <meta itemprop="image" content="<?php echo APP_PICTURE . $post_image ?>"> 

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="<?php echo $meta_title; ?>">
    <meta name="twitter:title" content="<?php echo $post_title ?>">
    <meta name="twitter:description" content="<?php echo strip_tags_content($description); ?>">
    <meta name="twitter:creator" content="<?php echo $author; ?>">
    <meta name="twitter:image:src" content="<?php echo APP_PICTURE . 'thumb/thumb_'.$post_image; ?>">
     
    <?php 
      // fb opengraph data
      echo $ogp -> toHTML();
    ?>
    <meta property="og:image:alt" content="<?php echo $post_title; ?>" />
    <meta property="article:published_time" content="<?php echo $date_published; ?>" />
    <meta property="article:modified_time" content="<?php new DateTime('now', new DateTimeZone('Asia/Jakarta')); ?>" />
    <meta property="article:section" content="<?php echo $post_cats -> setLinkCategories($postId); ?>" />
    <meta property="article:tag" content="<?php echo $meta_key; ?>" />
    <meta property="fb:admins" content="100001563066320" />
    <meta property="fb:app_id" content="237205856821206" />
   
    
    <?php 
    elseif (($match == 'category') && (!empty($param))) :
    ?>
    <meta name="description" content="<?php echo $match . " | " . $category_title; ?>">
    <meta name="keywords" content="<?php echo $meta_key; ?>">
    <?php 
    else :
    ?>
    <meta name="description" content="<?php echo "$meta_desc"; ?>">
    <meta name="keywords" content="<?php echo "$meta_key"; ?>">
   <?php 
   endif; 
   ?>
  
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115374904-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115374904-1');
</script>
  
  <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5a72ddf710fe560012c5e7a4&product=social-ab' async='async'></script> 
  <script id="dsq-count-scr" src="//kartatopia-studio.disqus.com/count.js" async></script>
  <title>
    <?php 
     if (($match == 'post') && (!empty($param))) : 
        if (isset($views['errorMessage']) && $views['errorMessage'] == true) :
         
          echo  $_SERVER['SERVER_PROTOCOL'] . " - 404 Not Found" . PHP_EOL;
        
        else :
           
            echo $post_title;
         
        endif;
        
     elseif (($match == 'category') && (!empty($param))) :
         echo $category_title;
     else :
         
       echo "$match | $meta_title";
     
      endif;    
    ?> 
    </title>

  
    <link href="<?php echo APP_PUBLIC; ?>home/img/favicon.ico" rel="Shortcut Icon" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    
    <link href="<?php echo APP_PUBLIC; ?>blog/css/clean-blog.min.css" rel="stylesheet">
    <link href="<?php echo APP_PUBLIC; ?>blog/css/pagination.css" rel="stylesheet">
    <link rel="alternate" type="application/rss+xml" title="RSS Feeds" href="<?php echo APP_DIR . 'rss.xml'; ?>" />
    
  </head>

  <body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="<?php echo APP_DIR; ?>"><i class="fa fa-arrow-left"></i> Home</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          
         <?php 
         if (isset($totalPostPublished) && $totalPostPublished > 0) :
         ?>
         <li class="nav-item">
          <a class="nav-link" href="<?php echo APP_DIR . 'posts'; ?>" title="All Posts">
           Posts
          </a>
         </li>
         <?php 
         endif;
         ?>
         <?php 
         if (isset($navcats)) :
         ?>  
        
          <?php 
           
           foreach ($navcats as $navcat) :
            
          ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo APP_DIR .'category/'.htmlspecialchars($navcat['category_slug']); ?>" title="<?= $navcat['category_title']; ?>">
              <?php echo htmlspecialchars($navcat['category_title']); ?>
              </a>
            </li>
          <?php 
          endforeach;
          endif;
          ?>
          </ul>
        </div>
      </div>
    </nav>

    <?php 
    if (($match == 'post') && (!empty($param))) :
       
       if (isset($views['errorMessage']) && $views['errorMessage'] == true) :
    ?>
   
     <header class="masthead" style="background-image: url('<?php echo APP_DIR; ?>public/blog/img/250087_40percent.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>404</h1>
              <span class="subheading">
               Error Page Not Found
             </span>
            </div>
          </div>
        </div>
      </div>
    </header>
     <?php
      
     else:
       
        if ($post_image != '') :
     ?>
     <header class="masthead" style="background-image: url('<?php echo APP_PICTURE . $post_image; ?>')">
     <?php 
       else :
     ?> 
     <header class="masthead" style="background-image: url('<?php echo APP_DIR; ?>public/blog/img/250087_40percent.jpg')">
     <?php 
       endif;
     ?>
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1>
              <?php
              echo htmlspecialchars($post_title);
              ?>
              </h1>
            
              <span class="meta"><i class="fa fa-user"></i>
              <a href="#">
              <?php 
              echo htmlspecialchars($author);
              ?>
              </a>
              <i class="fa fa-calendar"></i>
              <?php 
              echo $date_published; 
              ?>
              <i class="fa fa-folder"></i>
              <?php 
              echo $linkCategories = $post_cats -> setLinkCategories($postId, 'header');
              ?>
              </span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <?php 
    endif;
    elseif (($match == 'category') && (!empty($param))) :
    ?>
    
    <header class="masthead" style="background-image: url('<?php echo APP_DIR; ?>public/blog/img/250087_40percent.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1><?php echo $category_title; ?></h1>
              <span class="subheading">
               <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px;" href="https://unsplash.com/@rawpixel?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from rawpixel.com"><span style="display:inline-block;padding:2px 3px;"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white;" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px;">rawpixel.com</span></a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </header>
    
 
    <?php
     else :
    ?>
      <header class="masthead" style="background-image: url('<?php echo APP_DIR; ?>public/blog/img/teamwork.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1><?php echo $meta_title; ?></h1>
              <span class="subheading"><?php echo "$tagline | $phone"; ?></span>
            </div>
          </div>
        </div>
      </div>
    </header>
    <?php 
    endif;
    ?>
 
<?php 
}

function contactHeader() 
{
    
  global $configurations;
    
  $views = array();
    
  $data_configs = $configurations -> findConfigs();
  $meta_tags = $data_configs['results'];
    
  foreach ($meta_tags as $meta_tag => $m) {
     $views['meta_title'] = htmlspecialchars($m['site_name']);
     $views['meta_description'] = htmlspecialchars($m['meta_description']);
     $views['meta_keywords'] = htmlspecialchars($m['meta_keywords']);
     $views['tagline'] = htmlspecialchars($m['tagline']);
     $views['phone'] = htmlspecialchars($m['phone']);
  }
  
?>
<!DOCTYPE html>
<html lang="id">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $views['meta_description']; ?>">
    <meta name="keywords" content="<?php echo $views['meta_keywords']; ?>">

    <title><?php echo "{$views['tagline']} | {$views['meta_title']} | Call Us: {$views['phone']}";  ?></title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <link href="<?php echo APP_PUBLIC; ?>home/css/freelancer.min.css" rel="stylesheet">
    
    <link href="<?php echo APP_PUBLIC; ?>home/img/favicon.ico" rel="Shortcut Icon" />
    

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a href="<?php echo APP_DIR; ?>" class="navbar-brand js-scroll-trigger" href="#page-top">
        <img class="img-fluid" alt="kartatopia" src="public/home/img/kartatopia.png">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo APP_DIR; ?>#product" title="Our products" >Products</a>
            </li>
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo APP_DIR; ?>#blog" title="Blog" >Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo APP_DIR; ?>#contact" title="Contact Us" >Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo APP_DIR; ?>#about" title="About Us" >About</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

 <header class="masthead">
      <div class="container">
        <img class="img-fluid" src="<?php echo APP_PUBLIC; ?>home/img/sendMail.png" alt="powering your online store">
        <div class="intro-text">
          <span class="name">Contact Us</span>
          <hr class="star-light">
           <span class="skills">Please feel free to contact us if you need any further information</span>
        </div>
      </div>
    </header>
<?php
}
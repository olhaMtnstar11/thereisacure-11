<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://indestructibletype.com/fonts/Bodoni/Bodoni.css" type="text/css" charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); 
    if (get_post_type() === 'post') {
        get_template_part('template-parts/header/header', 'seo-post');
    }

    if (get_post_type() === 'page') {
        get_template_part('template-parts/header/header', 'seo-page');
    }
    ?>
</head>
<body <?php body_class();?>>
    <?php
    global $post;
    $page_slug = $post->post_name;
    ?>
    <div class="container-fluid <?php echo $page_slug?>-page" id="all-content-wrapper">
        <header>
            <?php get_template_part('template-parts/header/header', 'nav');?>
        </header>
        <!--


                 <script async src="https://www.googletagmanager.com/gtag/js?id=G-75EJ7VDLR8"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}

            gtag('js', new Date());
            gtag('config', 'G-75EJ7VDLR8');

            gtag('get', 'G-75EJ7VDLR8', 'client_id', function(clientId) {
                console.log('Client ID:', clientId);

                gtag('event', 'client_id_capture', {
                    client_id: clientId
                });

            });
        </script>

         -->




<!DOCTYPE html>
<html lang="id">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="Cache-control" content="public">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
        <?php
	        if ($this->pagename != ""){
	            if ($this->pagename == $this->webconfig['pagename-home']){
	                echo $site_title;
	            
	            } else if (isset($meta_title) && $meta_title !='') {
	                echo stripslashes(htmlentities($meta_title)).' - '.$site_title;
	            } else {
	                echo stripslashes(htmlentities($this->pagename)).' - '.$site_title;
	            }
	        } 
        ?>
        </title>
         <?php 
         error_reporting(0);
        ?>
        <?php if ($this->pagename == $this->webconfig['pagename-home']){ ?>
            <meta name="twitter:title" content=" Home">
            <meta property="og:title" content="Home>">
        <?php } else { ?>
            <meta name="twitter:title" content="<?php echo isset($meta_title)?stripslashes(htmlentities($meta_title, ENT_COMPAT, "UTF-8")):''; ?> <?php echo isset($this->configuration['meta_title'])?' - '.stripslashes(htmlentities($this->configuration['meta_title'])):' - Meta Title'?>">
            <meta property="og:title" content="<?php echo isset($meta_title)?stripslashes(htmlentities($meta_title, ENT_COMPAT, "UTF-8")):''; ?> <?php echo isset($this->configuration['meta_title'])?' - '.stripslashes(htmlentities($this->configuration['meta_title'])):' - Meta Title'?>">
        <?php } ?>

        <?php if(isset($meta_desc) && $meta_desc != ''){ ?>
            <meta name="description" content="<?php echo stripslashes(htmlentities($meta_desc, ENT_COMPAT, "UTF-8")); ?>">
            <meta name="twitter:description" content="<?php echo stripslashes(htmlentities($meta_desc, ENT_COMPAT, "UTF-8")); ?>">
            <meta property="og:description" content="<?php echo stripslashes(htmlentities($meta_desc, ENT_COMPAT, "UTF-8")); ?>">
        <?php } ?>
        <?php if(isset($meta_url) && $meta_url != ''){ ?>
            <meta property="og:url" content="<?php echo $meta_url; ?>">
        <?php } else { ?>
            <meta property="og:url" content="<?php echo base_url(); ?>" >
        <?php } ?>
        
        <?php if(isset($meta_image) && $meta_image != "") { ?>
            <?php $meta_image = preg_replace('/\s+/', '%20', $meta_image); ?>
            <meta name="twitter:image" content="<?php echo $meta_image; ?>">
            <meta property="og:image" content="<?php echo $meta_image; ?>">
        <?php } ?>

        <?php if(isset($meta_keyword) && $meta_keyword != ''){ ?>
            <meta name="keywords" content="<?php echo $meta_keyword; ?>">
        <?php } else { ?>
            <meta name="keywords" content="<?php if($this->pagename != "") { echo stripslashes(htmlentities($this->pagename)).', '; } ?><?php echo $this->configuration['meta_keyword']; ?>">
        <?php } ?>

        <?php if(isset($fbauthor) && $fbauthor != ''){ ?>
            <meta property="article:author" content="<?php echo base_url()."profil/".$fbauthor; ?>">
            <meta name="author" content="<?php echo $author; ?>">
        <?php } ?>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->webconfig['lokapala_template']; ?>images/favicon.png"/>

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webconfig['lokapala_template']; ?>plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webconfig['lokapala_template']; ?>plugins/bootstrap/css/bootstrap-theme.min.css">

        <!-- Fontawesome -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webconfig['lokapala_template']; ?>plugins/font-awesome/css/font-awesome.min.css">

        <!-- Animate -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webconfig['lokapala_template']; ?>plugins/animate.css">

        <!-- Swiper -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webconfig['lokapala_template']; ?>plugins/swiper/css/swiper.min.css">

        <!-- Magnific-popup -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webconfig['lokapala_template']; ?>plugins/magnific-popup/magnific-popup.css">

        <!-- Base MasterSlider style sheet -->
        <link rel="stylesheet" href="<?php echo $this->webconfig['lokapala_template']; ?>plugins/masterslider/style/masterslider.css" />
        
        <!-- Master Slider Skin -->
        <link href="<?php echo $this->webconfig['lokapala_template']; ?>plugins/masterslider/skins/default/style.css" rel='stylesheet' type='text/css'>
        
        <!-- Stylesheet -->
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webconfig['lokapala_template']; ?>css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->webconfig['lokapala_template']; ?>css/jquery.datetimepicker.css">
        <script type="text/javascript">
            function filternews(){
                var keywords = $('#keywords').val();
                window.location = '<?php echo base_url() ?>search?q='+keywords;
                return false;
            }

        </script>    
    </head>
    <body >
        <div class="tana-loader">
            <div class="loader-content">
                <div class="loader-circle"></div>
                <div class="loader-line-mask">
                    <div class="loader-line"></div>
                </div>
            </div>
        </div>
        <div class="wrapper">            
            <?php echo isset($content_block)?$content_block:''; ?>         
        	<footer id="footer" class="light footer-blog">

                    <div class="container footer-container mv8">
                        <div class="row">
                            <div class="col-sm-4">
                                
                            </div>
                            <div class="col-sm-4">
                               
                            </div>
                            <div class="col-sm-4 text-right">
                                <div class="widget">
                                    <h5 class="widget-title">Social</h5>
                                    <div class="social-links">
                                        <a href="<?php echo $this->webconfig['fb_lokapala'];?>l"><i class="fa fa-facebook"></i></a>
                                        <a href="<?php echo $this->webconfig['google_lokapala'];?>"><i class="fa fa-twitter"></i></a>
                                        
                                        <a href="<?php echo $this->webconfig['google_lokapala'];?>"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .footer-container -->


                    <div class="sub-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-inline pull-left">
                                        <li><a href="<?php echo base_url();?>">Home</a></li>
                                        <?php if(isset($menu) && count($menu)>0){ ?>
                                            <?php foreach ($menu as $key => $value) { ?>
                                                <li><a href="<?php echo base_url();?><?php echo $value['slug'];?>"><?php echo $value['name'];?></a></li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                    <div class="copyright-text pull-right">Copyight &copy; 2016 Designed by ThemeTon</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end .sub-footer -->


            </footer>  
    	</div>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/typed.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/theia-sticky-sidebar.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/circles.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/jquery.parallax.columns.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/svg-morpheus.js"></script>
    <script src="<?php echo $this->webconfig['lokapala_template']; ?>js/jquery.datetimepicker.js"></script>
    <!-- Swiper -->
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/swiper/js/swiper.min.js"></script>

    <!-- Magnific-popup -->
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/magnific-popup/jquery.magnific-popup.min.js"></script>    
    <!-- Master Slider -->
    <script src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/masterslider/jquery.easing.min.js"></script>
    <script src="<?php echo $this->webconfig['lokapala_template']; ?>plugins/masterslider/masterslider.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->webconfig['lokapala_template']; ?>js/scripts.js"></script>
     <script>

        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://lokapala.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <script id="dsq-count-scr" src="//lokapala.disqus.com/count.js" async></script>
</body>
</html>
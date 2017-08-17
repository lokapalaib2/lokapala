<header id="header" class="header-mini fixed">
        
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="header-wrapper">

                            <div class="site-branding">
                                <!-- image logo -->
                                <a href="index.html" rel="home" class="custom-logo-link">
                                    <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/logo-single.png" alt="logo image">
                                </a>
                                <!-- text logo -->
                                <!--
                                <a href="index.html" rel="home" class="logo-text-link">Development Fruit</a>
                                <p class="site-description">The Awesome WordPress Theme</p>
                                -->
                                <span class="post-title"><?php echo isset($detail['title'])?$detail['title']:'';?></span>
                            </div>

                            <div class="right-content">
                                <div class="search-panel">
                                    <form method="get" onsubmit="return false;">
                                        <input type="text" name="s" id="keywords" placeholder="Search...">
                                        <button type="submit" onclick="filternews()"></button>
                                    </form>
                                </div>

                                
                                <div class="right-content">
                                    <a href="javascript:;" id="search_handler">
                                        <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/search.png" alt="search icon">
                                    </a>
                                    <a href="javascript:;" id="burger_menu" class="burger-menu pm-right">
                                        <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/burger.png" alt="menu icon">
                                    </a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            
            <div class="scroll-window-indicator">
                <div class="width"></div>
            </div>
            <div class="push-menu">
                    <div class="pm-overlay"></div>
                    <div class="pm-container">
                        <div class="pm-wrap">
                            <a href="javascript:;" class="close-menu"></a>
                            <nav class="big-menu">
                                <ul>
                                     <li><a href="<?php echo base_url();?>">Home</a></li>
                                      <?php if(isset($menu) && count($menu)>0){ ?>
                                        <?php foreach ($menu as $key => $value) { ?>
                                            <li><a href="<?php echo base_url();?><?php echo $value['slug'];?>"><?php echo $value['name'];?></a></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>        
</header>
<div class="fullwidth-section image height-tall mb5" data-src="<?php echo thumb_image_original($detail['imagecover']['path']) ?>" data-section-type="parallax"></div>

<section class="section-content single">

    <div class="container">
        <div class="row">
            

            <div class="col-md-2 col-md-push-1 entry-details">

                <div class="entry-date"><?php echo isset($detail['created_at'])?date_min_format($detail['created_at']):'';?></div>
                <div class="entry-author">
                    by
                    <h5>

                        <?php if(isset($detail['penulis'])&& count($detail['penulis'])>0){ ?>
                            <?php foreach ($detail['penulis'] as $key => $value) { ?>
                                <a href="javascript:;"><?php echo isset($value['fullname'])?$value['fullname']:'';?></a><br>
                            <?php } ?>
                        
                        <?php } ?>
                    </h5>
                    <span>24 likes, 6 comment</span>
                </div>
                <div class="entry-views">5000 views</div>
                <div class="entry-social">
                    <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                    <a href="javascript:;"><i class="fa fa-youtube"></i></a>
                    <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                    <a href="javascript:;"><i class="fa fa-linkedin"></i></a>
                </div>

            </div>
            <!-- end .entry-details -->

            <div class="col-sm-7 col-md-push-1 entry-content">
                <article class="blog-item blog-single">

                 <h2 class="post-title"> <?php echo isset($detail['title'])?$detail['title']:'';?></h2>
                 <?php echo isset($detail['body'])?$detail['body']:'';?>
                
                 <?php if(isset($detail['tagsarray']) && count($detail['tagsarray'])>0){ ?>
                      
                        <div class="widget">
                          
                            <div class="widget-tags">
                                <?php foreach ($detail['tagsarray'] as $key => $value) { ?>
                                    <a href="javascript:;"><?php echo isset($value['detail']['name'])?$value['detail']['name']:'';?></a>
                                <?php } ?>
                            </div>
                        </div>
                    
                <?php } ?>

            </div>               
        </div>
        <div class="row">
                <div class="col-xs-12">
                     <div id="disqus_thread"></div>
                </div>
            </div>
    </div>
   
    
                            
    <?php if(isset($listberitaterkait)&& count($listberitaterkait)>0){ ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="related-news">

                            <div class="border-line mv5"></div>
                            <h2 class="block-title mv8" data-title="Terkait">
                                Issue terkait
                            </h2>
                            <?php foreach ($listberitaterkait as $key => $value) { ?>
                                <?php if($key == 0){ ?>
                                    <div class="row">
                                <?php } ?>
                                    <div class="col-md-4">
                                        <div class="category-block articles">
                                            <div class="post first">
                                                <div class="meta">
                                                    
                                                    <span class="date"><?php echo isset($value['created_at'])?date_min_format($value['created_at']):'';?></span>
                                                </div>
                                                <h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
                                                <p><?php echo isset($value['summary'])?$value['summary']:'';?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php if($key == 2){ ?>
                                    </div>
                                    <div class="row">
                                <?php } ?>
                                <?php if($key == 5){ ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?> 
</section>
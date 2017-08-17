<header id="header" class="header-entertainment">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                
                <div class="header-wrapper">

                    <div class="left-content">
                        <div class="tools">
                            <a href="javascript:;" id="search_handler">
                                <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/search-dark.png" alt="search icon">
                            </a>
                            <a href="javascript:;" id="burger_menu" class="burger-menu">
                                <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/burger-dark.png" alt="menu icon">
                            </a>
                            <div class="search-panel">
                                <form method="get" onsubmit="return false;">
                                    <input type="text" name="s" id="keywords" placeholder="Search...">
                                    <button type="submit" onclick="filternews()"></button>
                                </form>
                            </div>

                        </div>

                        <div class="site-branding">
                            <!-- image logo -->
                            <a href="index.html" rel="home" class="custom-logo-link">
                                <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/logo-entertainment.png" alt="logo image">
                            </a>
                        </div>
                    </div>

                    

                </div>

            </div>
        </div>
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

<div class="entertainment-slider news-slider-hover">
<!-- masterslider -->
<?php if (isset($listcategory) && count($listcategory)>0){ ?>
	<div class="master-slider ms-skin-default" id="masterslider3">	
	<?php foreach ($listcategory as $key => $value) { ?>
			<?php if($key <= 4){ ?>
		    <div class="ms-slide">
		    	<div class="slide-pattern tint"></div>
		        <img src="vendors/masterslider/style/blank.gif" data-src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" alt="Image"/>
		        <div class="ms-thumb post">
		        	<div class="thumb-meta">
						<h4><?php echo isset($value['title'])?$value['title']:'';?></h4>
						
					</div>
		        </div>

		        <div class="ms-layer" data-effect="bottom(45)" data-duration="300" data-ease="easeInOut" data-origin="bl">

			       
					<a href="single.html"><h2 class="animate-element" data-anim="fadeInUp"><?php echo isset($value['title'])?$value['title']:'';?></h2></a>
			        <p class="animate-element" data-anim="fadeInUp"><?php echo isset($value['summary'])?$value['summary']:'';?></p>
					<div class="animate-element" data-anim="fadeInUp">
				       
				        <a href="<?php echo url_reformat($value);?>" class="button beauty-hover"><i class="fa fa-ellipsis-h"></i> Read more</a>

						
					</div>

		        </div>

		    </div>
		    <?php } ?>
	<?php } ?>
	</div>
<?php } ?>
<!-- end of masterslider -->
</div>
<div class="content-area pvt0">
	<div class="container">
    	<div class="section-full pv9 pvb0">
                <div class="container">
                    <?php if(isset($listcategory)&& count($listcategory)>0){ ?>
                        <div class="row sticky-parent fs-with-sidebar">
                            <div class="col-sm-12 sticky-column fs-content">
                                <div class="theiaStickySidebar">
                                    <div class="fs-grid-posts">
                                        <div class="fs-post-filter big-title">
                                            <h4 data-title="Analisa">Analisa</h4>
                                        </div>
                                        <div class="fs-grid-viewport">
                                            
                                                <?php foreach ($listcategory as $key => $value) { ?>
                                                    <?php if($key > 4){ ?>
                                                    	<?php if($key == 5){ ?>
                                                    		<div class="row">
                                                    	<?php } ?>
                                                        <div class="col-sm-4">
                                                            <div class="fs-grid-item fs-large">
                                                                <a href="<?php echo url_reformat($value);?>" class="fs-entry-image">
                                                                    <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/blog/news-01.jpg" alt="portfolio image">
                                                                </a>
                                                            
                                                                <h3>
                                                                    <a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a>
                                                                </h3>
                                                                <p class="read-more">
                                                                    <a href="<?php echo url_reformat($value);?>">read the article</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <?php if($key == 7){ ?>
                                                        		</div>
                                                        		<div class="row">
                                                        <?php } ?>
                                                        <?php if($key == 10){ ?>
                                                        		</div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    
                                                <?php } ?>
                                           
                                        </div>
                                    </div>
                                </div>
                                <!-- //theiaStickySidebar -->
                            </div>
                        </div>
                    <?php }else{ ?>
                            <center>No Data</center>
                    <?php } ?>
                </div>
        </div>
	</div>
</div>
<!-- end of entertainment-slider -->
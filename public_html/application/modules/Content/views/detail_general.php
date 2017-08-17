   <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-line mvt0"></div>
                </div>
            </div>
            <!-- end .row -->
        </div>
    <!-- end .container -->

    <section class="section-content single">

        <div class="container">
            <div class="row">
                
                <div class="col-sm-12 with-sidebar">

                    <h2 class="block-title mv5" data-title="<?php echo isset($detail['topics']['name'])?$detail['topics']['name']:'';?>">
                        <?php echo isset($detail['category']['name'])?$detail['category']['name']:'';?>
                    </h2>
                  
                    <article class="blog-item blog-single">
                        <?php if(isset ($detail['tipe']) && $detail['tipe'] == 2){;?>
                            <div class="post first text-bigger hover-dark entry-media">
                                <div class="image video-frame" data-src="<?php echo thumb_image_original($detail['imagecover']['path']) ?>">
									<img src="<?php echo $this->webconfig['lokapala_template']; ?>images/5x3.png" alt="Proportion"/>
									<a class="video-player video-player-center video-player-large" href="<?php echo isset($detail['video_url'])?$detail['video_url']:'';?>"></a>
								</div>
                            </div>
                        <?php }else{ ?>
                            <div class="post first text-bigger hover-dark entry-media">
                                <div class="image video-frame">
                                    <img src="<?php echo thumb_image_original($detail['imagecover']['path']) ?>" alt="Post image"/>
                                    
                                </div>
                            </div>
                        <?php } ?>

                        <h2 class="post-title"><?php echo isset($detail['title'])?$detail['title']:'';?></h2>

                     

                        <div class="row">

                            <div class="col-md-2 entry-details hidden-xs">

                                <div class="entry-date"><?php echo isset($detail['created_at'])?date_min_format($detail['created_at']):'';?></div>
                                <div class="entry-author">
                                    by
                                    <h5>
                                        <?php if(isset($detail['penulis'])&& count($detail['penulis'])>0){ ?>
                                            <?php foreach ($detail['penulis'] as $key => $value) { ?>
                                                <a href="javascript:;"><?php echo isset($value['name'])?$value['name']:'';?></a><br>
                                            <?php } ?>
                                        
                                        <?php } ?>
                                    </h5>
                                   
                                </div>
                                <div class="entry-views">views</div>
                                <div class="entry-social">
                                    <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                                   
                                    <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                                  
                                </div>

                            </div>
                            <!-- end .entry-details -->

                            <div class="col-md-10 col-xs-12 entry-content">
                                <?php echo isset($detail['body'])?$detail['body']:'';?>

                                <?php if(isset($detail['tagsarray']) && count($detail['tagsarray'])>0){ ?>
                      
                                        <div class="widget">
                                          
                                            <div class="widget-tags">
                                                <?php foreach ($detail['tagsarray'] as $key => $value) { ?>
                                                    <a href="<?php echo base_url();?>tags/<?php echo isset($value['detail']['slug'])?$value['detail']['slug']:'';?>"><?php echo isset($value['detail']['name'])?$value['detail']['name']:'';?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    
                                <?php } ?>
                            </div>
                            <!-- end .entry-details -->

                        </div>
                        
                    </article>
                </div>

            </div>
            <div class="row">
                <div class="col-xs-12">
                     <div id="disqus_thread"></div>
                </div>
            </div>
            <!-- end .row -->
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
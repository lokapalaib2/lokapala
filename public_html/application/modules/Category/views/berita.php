<div class="content-area pvt0">
	<div class="container">
        <h2 class="block-title mv5" data-title="News">
            Warta 
            <a href="<?php echo base_url();?>indeks/search/-/<?php echo $this->webconfig['category-id-berita'];?>" class="category-more text-right hidden-xs">Indeks<img src="<?php echo $this->webconfig['lokapala_template']; ?>images/arrow-right.png" alt="Arrow"></a>
        </h2>		
		<div class="row">
			<div class="col-md-12">
				<!-- template -->
				<?php if(isset($headline_berita)&& count($headline_berita)>0){ ?>
					<div class="news-slider news-block mv5 mvt0 hidden-xs">
							<div class="master-slider ms-skin-default" id="masterslider1">  
								<?php foreach ($headline_berita as $key => $value) { ?>      
							    <div class="ms-slide" data-delay="0">
							        <img src="vendors/masterslider/style/blank.gif" data-src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" alt="Image"/>
							        <div class="ms-thumb post hover-zoom">
							        	<div class="image" data-src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>"></div>
							        	<div class="thumb-meta">
								        	
											<h4><?php echo isset($value['title'])?$value['title']:'';?></h4>
										</div>
							        </div>							        
							        <div class="ms-layer box" data-delay="0" data-effect="bottom(45)" data-duration="300" data-ease="easeInOut">
					        
										<h4 class="animate-element" data-anim="fadeInUp"><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
								        <p class="animate-element" data-anim="fadeInUp"><?php echo isset($value['summary'])?$value['summary']:'';?></p>

							        </div>

							    </div>
							    <?php } ?>
							</div>
					</div>
				<?php } ?>
				<?php if(isset($headline_berita) && count($headline_berita)>0){ ?>
					<div class="section-full pv9 nopadding-bottom headline-home visible-xs">
						<div class="fn-fullslide">
							<div class="swiper-container">
						    	<div class="swiper-wrapper">
						    		<?php foreach ($headline_berita as $key => $value) { ?>		
							    		<div class="swiper-slide">
							    			<div class="row">
												<div class="col-sm-12">
													<div class="fn-item" data-bg-image="<?php echo thumb_image($value['imagecover']['path'],"1000x667") ?>">
														<a href="<?php echo url_reformat($value);?>"><img src="<?php echo thumb_image($value['imagecover']['path'],"1000x667") ?>" class="full-size img-responsive" alt="sizer"></a>
														<div class="fn-entry">
															
															<h4><?php echo isset($value['title'])?$value['title']:'';?></h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>		    	
								</div>
							</div>

							<div class="fn-arrows">
								<div class="container">
									<a href="javascript:;" class="fn-arrow-prev"><i class="fa fa-angle-left"></i></a>
									<a href="javascript:;" class="fn-arrow-next"><i class="fa fa-angle-right"></i></a>
								</div>
							</div>
						</div>
					</div>
		<?php }  ?>
				<!-- end of template -->
			</div>
			<!-- end col-md-12 -->
		</div>
		<!-- end .row -->
		
    	<div class="row">
            <div class="col-md-12">
            	<?php if(isset($listcategory)&& count($listcategory)>0){ ?>
	                <div class="row">
                        		<?php foreach ($listcategory as $key => $value) { ?>
		                           <div class="col-sm-4 col-xs-12 ">
											<div class="fs-blog-item boxed-title">
								        		<a href="<?php echo url_reformat($value);?>">
								        			<img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" alt="portfolio image" class="img-responsive">
								        		</a>
								        		<div class="entry-title">
								        			<h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
								        		
								        		</div>
								        	</div>
										</div>
                                <?php } ?>	
                    </div>
	                   
                <?php }else{ ?>
                		<center>No Data</center>
                <?php } ?>
                <!-- end .m-dimension-carousel -->
            </div>
           
        </div>		
	</div>
	<!-- end .container -->
</div>
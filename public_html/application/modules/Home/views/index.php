<div class="content-area pvt0">
		<?php if(isset($headline) && count($headline)>0){ ?>
			<div class="section-full pv9 nopadding-bottom headline-home">
				<div class="fn-fullslide">
					<div class="swiper-container">
				    	<div class="swiper-wrapper">
				    		<?php foreach ($headline as $key => $value) { ?>		
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
		<div class="section-full pv9 pvb0 nopadding-top">
			<div class="container">
				<div class="row sticky-parent fs-with-sidebar">
					<div class="col-sm-9 sticky-column fs-content">

						<h2 class="block-title mv5" data-title="News">
							Warta
								<a href="<?php echo base_url();?>berita" class="category-more text-right hidden-xs">Next <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/arrow-right.png" alt="Arrow"></a>
						</h2>
						<?php if(isset($listberita) && count($listberita)>0){ ?>
									<!-- end .fs-post-filter -->
								<?php foreach ($listberita as $key => $value) { ?>	
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
								
						<?php }else{ ?>
							<center>No Data</center>
						<?php } ?>
						<!-- //theiaStickySidebar -->

					</div>
					<div class="col-sm-3 sticky-column fs-sidebar">
						<div class="theiaStickySidebar ">
							<div class="widget widget_search" style="display:none;">
								<h5 class="widget-title">Search</h5>
								<form action="./" class="search_form" method="get">
									<input type="text" placeholder="Type your keyword" required="" name="s">
									<input type="submit" value="Search">
								</form>
							</div>
							<div class="widget hidden-xs">
								<h5 class="widget-title">Terpopuler</h5>
								<?php if(isset($berita_terpopuler) && count($berita_terpopuler)>0){ ?>
									<?php foreach ($berita_terpopuler as $key => $value) { ?>
									<div class="fs-recent-post">
										<div class="fs-rp-item">
				    						<div class="category-block articles trending row">
												<div class="col-xs-6 col-sm-12">
														<span class="fancy-number"><?php echo $key +1;?></span>
														<a href="<?php echo url_reformat($value);?>">
															<div class="image" >
																<img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" alt="Proportion"/>
															</div>
														</a>
														<h4 class="sidebar-title"><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
												</div>								
											</div>	
										</div>
									</div>
									<?php } ?>
								<?php } ?>
							</div>
						</div>
						<!-- //theiaStickySidebar -->

					</div>
				</div>
			</div>
		</div>
		<div class="section-full pv9 ">
			<div class="container">
				<div class="row sticky-parent fs-with-sidebar">
					<div class="col-sm-12 sticky-column fs-content">
						<div class="theiaStickySidebar">
							<div class="fs-grid-posts">
								<div class="fs-post-filter big-title">
									<h4 data-title="Grafik">Loka Grafik</h4>
									<a href="<?php echo base_url();?>lokagrafik" class="category-more text-right hidden-xs">Next <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/arrow-right.png" alt="Arrow"></a>
								</div>
								<?php if(isset($listgrafik)&& count($listgrafik)>0) { ?>
										<div class="fs-grid-viewport">
											<?php foreach ($listgrafik as $key => $value) { ?>
												<?php if($key == 0){ ?>
													<div class="row">
												<div class="category-block articles">
													<div class="col-md-12">
														<div class="post first text-bigger hover-dark">
															<div class="row">
															    <div class="col-md-4 hidden-xs">
																	<h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
																	<p><?php echo isset($value['summary'])?$value['summary']:'';?></p>
																</div>
																<div class="col-md-8 col-xs-12">
																    <a href="<?php echo url_reformat($value);?>">
																		<img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" class="img-responsive">
					                                                </a>
																</div>
																<div class="col-xs-12 visible-xs">
																	<h3>
																		<a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a>
																	</h3>
																</div>

																
															</div>
															
															
														</div>
													</div>
												</div>
											</div>
												<?php }else{ ?>
													<?php if($key == 1){ ?>
														<div class="row">
													<?php } ?>
														<div class="col-sm-4">
															<div class="fs-grid-item fs-large">
																<a href="<?php echo url_reformat($value);?>" class="fs-entry-image">
																	<img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" alt="portfolio image">
																</a>
																
																<h3>
																	<a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a>
																</h3>
															
															</div>
														</div>
														
														
													<?php if($key == 3){ ?>	
															</div>
															<div class="row">
														<?php } ?>
														<?php if($key == 6){ ?>	
															</div>
														
														<?php } ?>
												<?php } ?>
											<?php } ?>
										</div>
								<?php }else{ ?>
										<center>No Data</center>
								<?php } ?>
							</div>
						</div>
						<!-- //theiaStickySidebar -->
					</div>
				</div>
			</div>
		</div>
		<div class="section-full pv9">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<h2 class="block-title mv5" data-title="Multimedia">
									Video & Foto
									<a href="<?php echo base_url();?>video" class="category-more text-right hidden-xs">Next <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/arrow-right.png" alt="Arrow"></a>
								</h2>
								<?php if(isset($listvideo) && count($listvideo)>0){ ?>
									<?php foreach ($listvideo as $key => $value) { ?>
										<?php if($key == 0){ ?>
											<div class="row hidden-xs">
												<div class="category-block articles">
													<div class="col-md-12">
														<div class="post first text-bigger hover-dark">
															<div class="row">
															     <a href="<?php echo url_reformat($value);?>">
																<div class="col-md-8 col-xs-12">
																	<div class="video-wrap">
																	    <a href="<?php echo url_reformat($value);?>">
																			<img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" class="img-responsive">
						                                                	
						                                                </a>
						                                                 <a href="<?php echo url_reformat($value);?>" class="img-video-big hidden-xs">
						                                                 	<img src="<?php echo $this->webconfig['lokapala_template']; ?>images/videoicon-big.png" >
						                                                 </a>
					                                            	</div>
					                                            	<h4 class="visible-xs"><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
																	<p class="visible-xs"><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['summary'])?$value['summary']:'';?></a></p>
																</div>
																</a>
																<div class="col-md-4 hidden-xs">
																	<h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
																	<p><?php echo isset($value['summary'])?$value['summary']:'';?></p>
																</div>
															</div>
															
															
														</div>
													</div>
												</div>
											</div>
											<div class="row visible-xs">
												<div class="col-sm-4 col-xs-12 nopadding">
												<div class="video-wrap">
													 <a href="<?php echo url_reformat($value);?>">
														<img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" class="img-responsive">
				                                      </a>
				                                       <a href="<?php echo url_reformat($value);?>" class="img-video-small hidden-xs">
		                                                 	<img src="<?php echo $this->webconfig['lokapala_template']; ?>images/videoicon-small.png" >
		                                                 </a>
	                                        	</div>
												<h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
												<p><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['summary'])?$value['summary']:'';?></a></p>
													
											</div>

											</div>
										<?php } ?>
									<?php } ?>

							</div>
							<?php foreach ($listvideo as $key => $value) { ?>
								<?php if($key >0){ ?>
									<?php if($key == 1){ ?>
										<div class="row">
									<?php } ?>
										<div class="col-sm-4 col-xs-12">
											<div class="video-wrap">
												 <a href="<?php echo url_reformat($value);?>">
													<img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" class="img-responsive">
			                                      </a>
			                                       <a href="<?php echo url_reformat($value);?>" class="img-video-small hidden-xs">
	                                                 	<img src="<?php echo $this->webconfig['lokapala_template']; ?>images/videoicon-small.png" >
	                                                 </a>
                                        	</div>
											<h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
											<p><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['summary'])?$value['summary']:'';?></a></p>
												
										</div>
									<?php if($key == 3){ ?>	
										</div>
										<div class="row">
									<?php } ?>
									<?php if($key == 6){ ?>	
										</div>
									
									<?php } ?>
								<?php } ?>	
							<?php } ?>
							<?php }else{ ?>
									<center>No Data</center>
							<?php } ?>
								<!-- end article-carousel -->
				 		</div>
					</div>
				</div>
		</div>		
		
</div>
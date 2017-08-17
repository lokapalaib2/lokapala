	<div class="section-full pv9">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-12">
								<h2 class="block-title mv5" data-title="Multimedia">
									Video & Foto
									<a href="<?php echo base_url();?>video" class="category-more text-right hidden-xs">Indeks <img src="<?php echo $this->webconfig['lokapala_template']; ?>images/arrow-right.png" alt="Arrow"></a>
								</h2>
								<?php if(isset($listcategory) && count($listcategory)>0){ ?>
									<?php foreach ($listcategory as $key => $value) { ?>
										<?php if($key == 0){ ?>
											<div class="row">
												<div class="category-block articles">
													<div class="col-md-12 col-xs-12 nopadding">
														<div class="post first text-bigger hover-dark">
															<div class="row">
																<div class="col-md-8 col-xs-12">
																	<div class="video-wrap">
																	    <a href="<?php echo url_reformat($value);?>">
																			<img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" class="img-responsive">
						                                                	
						                                                </a>
						                                                 <a href="<?php echo url_reformat($value);?>" class="img-video-big hidden-xs">
						                                                 	<img src="<?php echo $this->webconfig['lokapala_template']; ?>images/videoicon-big.png" >
						                                                 </a>
					                                            	</div>
																</div>
																<div class="col-md-4 col-xs-12">
																	<h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
																	<p><?php echo isset($value['summary'])?$value['summary']:'';?></p>
																</div>
															</div>
															
															
														</div>
													</div>
												</div>
											</div>
										<?php } ?>
									<?php } ?>

							</div>
							<?php foreach ($listcategory as $key => $value) { ?>
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
                                        	<h3 class="visible-xs"><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h3>
											<p class="visible-xs"><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['summary'])?$value['summary']:'';?></a></p>
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
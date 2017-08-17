<div class="content-area pvt0">
	<div class="container">
    	
                    <?php if(isset($listcategory)&& count($listcategory)>0){ ?>
                        <div class="row sticky-parent fs-with-sidebar">
                            <div class="col-sm-12 sticky-column fs-content">

                                <div class="theiaStickySidebar">

                                    <div class="fs-grid-posts">
                                        <div class="fs-post-filter big-title">
                                            <h4 data-title="Grafik">Loka Grafik</h4>
                                             <a href="<?php echo base_url();?>indeks/search/-/<?php echo $this->webconfig['category-id-grafik'];?>" class="category-more text-right hidden-xs">Indeks<img src="<?php echo $this->webconfig['lokapala_template']; ?>images/arrow-right.png" alt="Arrow"></a>
                                        </div>
                                        <div class="fs-grid-viewport">

                                            <div class="row">
                                                <?php foreach ($listcategory as $key => $value) { ?>
                                                   <?php if($key ==0){ ?>
                                                        <div class="col-sm-12">
                                                            <div class="fs-grid-item fs-large">
                                                                <div class="row">
                                                                     <div class="col-sm-4 hidden-xs">
                                                                        <h3>
                                                                            <a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a>
                                                                        </h3>
                                                                        	<p><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['summary'])?$value['summary']:'';?></a></p>
                                                                    </div>
                                                                    <div class="col-sm-8 col-xs-12">
                                                                        <a href="<?php echo url_reformat($value);?>" class="fs-entry-image">
                                                                            <img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" alt="portfolio image">
                                                                        </a>
                                                                        <h3 class="visible-xs">
                                                                            <a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a>
                                                                        </h3>
                                                                        <p class="visible-xs"><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['summary'])?$value['summary']:'';?></a></p>
                                                                    </div>
                                                                   
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if($key > 0){ ?>
                                                        <div class="col-sm-4">
                                                            <div class="fs-grid-item fs-large">
                                                                <a href="<?php echo url_reformat($value);?>" class="fs-entry-image">
                                                                            <img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" alt="portfolio image">
                                                                </a>
                                                            
                                                                <h3>
                                                                    <a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a>
                                                                </h3>
                                                                	<p><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['summary'])?$value['summary']:'';?></a></p>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    
                                                <?php } ?>
                                            </div>
                                            
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
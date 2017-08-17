<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="index-panel">
               
            </div> 
        </div>
            
    </div>

            <div id="result-list">
                <?php if (isset($lists) && count($lists)>0) { ?>
                    <div class="fs-post-table fn-post-table">
                    <?php foreach ($lists as $key => $value) { ?>
                        <?php if($key == 0){ ?>
                             <div class="col-sm-12 col-xs-12 nopadding">
                                <div class="fs-table-item">
                                    <div class="row">
                                         <div class="col-sm-6 col-xs-12">
                                             
                                            <img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" class="img-responsive" alt="spacer">
                                        </div>                                    
                                        <div class="col-sm-6 col-xs-12">
                                                  <div class="fs-table-meta">
                                                    <span class="pull-left"><a><?php echo isset($value['category']['name'])?$value['category']['name']:'';?></a></span>
                                                    <span class="pull-right"><a><?php echo isset($value['created_at'])?date_min_format($value['created_at']):'';?></a></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="fs-table-content">
                                                     <h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
                                                </div>
                                              
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <div class="col-sm-4 col-xs-12">
                                <div class="row">
                                     <div class="col-sm-12 col-xs-12">
                                        <img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" class="img-responsive" alt="spacer">
                                    </div>                                    
                                    <div class="col-sm-12">
                                            <span class="pull-left"><a><?php echo isset($value['category']['name'])?$value['category']['name']:'';?></a></span>
                                            <span class="pull-right"><a><?php echo isset($value['created_at'])?date_min_format($value['created_at']):'';?></a></span>
                                            <div class="clearfix"></div>
                                       
                                            
                                             
                                                        <h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
                                                   
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                <?php } else { ?>
                    <center><?php echo $this->lang->line('no_data') ?></center>
                <?php } ?>
            </div> <!-- #result-list -->
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="col-sm-12 col-xs-12">
                        <ul class="pagination">
                            <?php echo isset($pagination)?$pagination:''; ?>
                        </ul>
                    </div>
                </div>
            </div>
       
</div>

<script type="text/javascript">
function filterindex(){
    var tanggal = $('#tanggal').val();
    var id_category_indeks = $('#id_category_indeks').val();


    if(tanggal == ''){ tanggal = '-'; }
    if(id_category_indeks == ''){ id_category_indeks = '-'; }
    window.location = '<?php echo base_url() ?>indeks/search/'+tanggal.replace(/\s/g,'%20')+'/'+id_category_indeks;
    return false;
}
 $( document ).ready(function() {
   $('#tanggal').datetimepicker({
            lang: 'id',
            i18n:{
                id:{
                    months:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
                    dayOfWeek:["Ming.", "Sen", "Sel", "Rab","Kam", "Jum", "Sab",]
                }
            },
            timepicker: false,
            mask: false,
            closeOnDateSelect:true,
            scrollInput:false,
            format:'d-m-Y',
                      
        });
});
</script>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="index-panel">
                <form class="form-search" onsubmit="return false;">
                    <div class="row">
                        <div class="col-sm-4">
                               <input type="text" readonly="readonly" name="tanggal" id="tanggal" placeholder="Tanggal" class="form-control" value="<?php echo isset($tanggal)?$tanggal:''; ?>" />
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="id_category_indeks" id="id_category_indeks">
                                <option value=""><?php echo $this->lang->line('semua_kategori') ?></option>
                                <?php if (isset($category) && count($category)>0) { ?>
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option value="<?php echo $value['id'] ?>" <?php if(isset($id_category_indeks) && $id_category_indeks == $value['id']){echo "selected='selected'";} ?> ><?php echo $value['name'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                             <button class="btn btn-default " onclick="filterindex()">Submit</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
            
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div id="result-list">
                <?php if (isset($lists) && count($lists)>0) { ?>
                    <div class="fs-post-table fn-post-table">
                    <?php foreach ($lists as $key => $value) { ?>
                        <div class="fs-table-item">
                            <div class="row">
                                 <div class="col-sm-6">
                                    <img src="<?php echo thumb_image($value['imagecover']['path'],"620x413") ?>" class="img-responsive" alt="spacer">
                                </div>                                    
                                <div class="col-sm-6">
                                          <div class="fs-table-meta">
                                            <span class="pull-left"><a><?php echo isset($value['category']['name'])?$value['category']['name']:'';?></a></span>
                                            <span class="pull-right"><a><?php echo isset($value['created_at'])?date_min_format($value['created_at']):'';?></a></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="fs-table-content">
                                            
                                            <h4><a href="<?php echo url_reformat($value);?>"><?php echo isset($value['title'])?$value['title']:'';?></a></h4>
                                            <h5 class="summary-indeks">
                                                <a href="<?php echo url_reformat($value);?>"><?php echo isset($value['summary'])?$value['summary']:'';?></a>
                                           <h5>
                                        </div>
                                      
                                    </div>
                                </div>
                        </div>
                        
                        
                    <?php } ?>
                    </div>
                <?php } else { ?>
                    <center><?php echo $this->lang->line('no_data') ?></center>
                <?php } ?>
            </div> <!-- #result-list -->

            <ul class="pagination">
                <?php echo isset($pagination)?$pagination:''; ?>
            </ul>
        </div>
    </div>
</div>

<div class="the-box no-border">
    <div class="btn-toolbar">
        <?php isset($links)?getLinksBtn($links):'';?>
    </div>

    <form action="<?php echo $own_links;?>/save" method="post" enctype="multipart/form-data">
        <div class="panel panel-dark panel-block-color">
            <div class="panel-heading">
                <h3 class="panel-title text-uppercase">INFORMASI MENU</h3>
            </div>
            <div class="panel-body">
                <div class="form-horizontal formValidation">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nama Menu</label>
                        <div class="col-md-9">
                            <input type="text" name="menus_title" value="<?php echo isset($val->menus_title)?$val->menus_title:'';?>" class="form-control" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Link</label>
                        <div class="col-md-9">
                            <select name="menus_type" class="form-control">
                                <option value="0" <?php echo ((! empty($val)) && ($val->menus_type == 0)) ? " selected='selected' " : ""; ?> data-type="">Tidak Ada Link</option>
                                <option value="1" <?php echo ((! empty($val)) && ($val->menus_type == 1)) ? " selected='selected' " : ""; ?> data-type="article_select">Artikel</option>
                                <option value="2" <?php echo ((! empty($val)) && ($val->menus_type == 2)) ? " selected='selected' " : ""; ?> data-type="article_category_select">Article Category</option>
                                <option value="3" <?php echo ((! empty($val)) && ($val->menus_type == 3)) ? " selected='selected' " : ""; ?> data-type="product_select">Produk</option>
                                <option value="4" <?php echo ((! empty($val)) && ($val->menus_type == 4)) ? " selected='selected' " : ""; ?> data-type="product_category_select">Product Category</option>
                                <option value="5" <?php echo ((! empty($val)) && ($val->menus_type == 5)) ? " selected='selected' " : ""; ?> data-type="gallery_select">Gallery</option>
                                <option value="9" <?php echo ((! empty($val)) && ($val->menus_type == 9)) ? " selected='selected' " : ""; ?> data-type="link_select">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group menus_type_item" id="link_select">
                        <label class="col-md-3 control-label">Link</label>
                        <div class="col-md-9">
                            <?php 
                            if(!empty($val->menus_link)){
                                $articleSelected = isset($val->menus_link)?$val->menus_link:'';
                            } else {
                                $articleSelected = "";
                            }
                            ?>
                            <input type="text" name="menus_link" value="<?php echo $articleSelected;?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group menus_type_item" id="article_select">
                        <label class="col-md-3 control-label">Artikel</label>
                        <div class="col-md-9">
                            <?php 
                            if(!empty($val->menus_article_id)){
                                $artId = isset($val->menus_article_id)?$val->menus_article_id:'';
                                $artTitle = get_title_article($val->menus_article_id);
                                $articleSelected = $artId.'. '.$artTitle;
                            } else {
                                $articleSelected = "";
                            }
                            ?>
                            <div class="input-group">
                                <input type="text" name="menus_article_id" value="<?php echo $articleSelected;?>" class="form-control" readonly>
                                <span class="input-group-btn magnific-popup-ajax">
                                    <a href="#form-article" class="btn btn-primary" data-effect="mfp-zoom-in" data-ajax-url="<?php echo $own_links.'/ajax_link/1'?>">Pilih Artikel</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group menus_type_item" id="article_category_select">
                        <label class="col-md-3 control-label">Artikel Category</label>
                        <div class="col-md-9">
                            <select name="menus_category_article_id" class="form-control">
                                <option value="0" selected>No Category Parent</option>
                                <?php 
                                    $parentId = isset($val)?$val->menus_category_article_id:'';
                                    echo get_category_parent($parentId);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group menus_type_item" id="product_select">
                        <label class="col-md-3 control-label">Produk</label>
                        <div class="col-md-9">
                            <?php 
                            if(!empty($val->menus_product_id)){
                                $prodId = isset($val->menus_product_id)?$val->menus_product_id:'';
                                $prodTitle = get_title_product($val->menus_product_id);
                                $productSelected = $prodId.'. '.$prodTitle;
                            } else {
                                $productSelected = "";
                            }
                            ?>
                            <div class="input-group">
                                <input type="text" name="menus_product_id" value="<?php echo $productSelected;?>" class="form-control" readonly>
                                <span class="input-group-btn magnific-popup-ajax">
                                    <a href="#form-produk" class="btn btn-primary" data-effect="mfp-zoom-in" data-ajax-url="<?php echo $own_links.'/ajax_link/3'?>">Pilih Produk</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group menus_type_item" id="product_category_select">
                        <label class="col-md-3 control-label">Produk Category</label>
                        <div class="col-md-9">
                            <?php 
                            if(!empty($val->menus_category_product_id)){
                                $prodId = isset($val->menus_category_product_id)?$val->menus_category_product_id:'';
                                $prodTitle = get_product_category_name($val->menus_category_product_id);
                                $categoryproductSelected = $prodId.'. '.$prodTitle;
                            } else {
                                $categoryproductSelected = "";
                            }
                            ?>
                            <div class="input-group">
                                <input type="text" name="menus_category_product_id" value="<?php echo $categoryproductSelected;?>" class="form-control" readonly>
                                <span class="input-group-btn magnific-popup-ajax">
                                    <a href="#form-category-produk" class="btn btn-primary" data-effect="mfp-zoom-in" data-ajax-url="<?php echo $own_links.'/ajax_link/4'?>">Pilih Category Produk</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group menus_type_item" id="gallery_select">
                        <label class="col-md-3 control-label">Gallery</label>
                        <div class="col-md-9">
                            <?php 
                            if(!empty($val->menus_gallery_id)){
                                $galleryId = isset($val->menus_gallery_id)?$val->menus_gallery_id:'';
                                $galleryTitle = get_gallery_name($val->menus_gallery_id);
                                $gallerySelected = $galleryId.'. '.$galleryTitle;
                            } else {
                                $gallerySelected = "";
                            }
                            ?>
                            <div class="input-group">
                                <input type="text" name="menus_gallery_id" value="<?php echo $gallerySelected;?>" class="form-control" readonly>
                                <span class="input-group-btn magnific-popup-ajax">
                                    <a href="#form-gallery" class="btn btn-primary" data-effect="mfp-zoom-in" data-ajax-url="<?php echo $own_links.'/ajax_link/5'?>">Pilih Gallery</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Sub Menu</label>
                        <div class="col-md-9">
                            <select name="menus_parent_id" class="form-control">
                                <option value="0" selected>No Menu Parent</option>
                                <?php 
                                    $parentId = isset($val)?$val->menus_id:'';
                                    echo get_menus_parent($parentId);
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status</label>
                        <div class="col-md-9">
                            <div class="onoffswitch">
                                <input type="checkbox" name="menus_status" class="onoffswitch-checkbox" id="menus_status" <?php echo isset($val->menus_id)?'onclick="changeStatus(this,'."'".$own_links."/change_status/".$val->menus_id."'".')"':''?> value="1" <?php echo (isset($val->menus_status) && $val->menus_status=="0")?'':'checked';?> >
                                <label class="onoffswitch-label" for="menus_status">
                                    <span class="onoffswitch-inner"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-action clearfix">
                        <div class="col-md-9 col-md-offset-3">
                            <input type="hidden" name="menus_id" value="<?php echo isset($val->menus_id)?$val->menus_id:'';?>" />
                            <input type="submit" name="simpan" class="btn btn-danger" value="Save" />
                            <input type="reset" name="btn_reset" class="btn btn-default" value="Reset">
                            <a href="<?php echo $own_links.($val->menus_id!=''?'/view/'.$val->menus_id.'-'.changeEnUrl($val->menus_title):'');?>"><div class="btn btn-default pull-right">Back</div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div id="form-article" class="white-popup wide mfp-with-anim mfp-hide">
        <legend><strong>Pilih Artikel</strong></legend>
        <div class="table-responsive">
            <table class="table table-th-block table-dark">
                <colgroup>
                    <col width="1">
                    <col>
                    <col width="1">
                    <col width="1">
                    <col width="1">
                </colgroup>
                <thead>
                    <tr>
                        <th class="nobr">No</th>
                        <th class="nobr">Judul</th>
                        <th class="nobr">Kategori</th>
                        <th class="nobr">Status</th>
                        <th class="nobr text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="popup-ajax-result">

                </tbody>
            </table>
        </div>
    </div>

    <div id="form-produk" class="white-popup wide mfp-with-anim mfp-hide">
        <legend><strong>Pilih Produk</strong></legend>
        <div class="table-responsive">
            <table class="table table-th-block table-dark">
                <colgroup>
                    <col width="1">
                    <col>
                    <col width="1">
                    <col width="1">
                    <col width="1">
                </colgroup>
                <thead>
                    <tr>
                        <th class="nobr">No</th>
                        <th class="nobr">Judul</th>
                        <th class="nobr">Kategori</th>
                        <th class="nobr">Status</th>
                        <th class="nobr text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="popup-ajax-result">

                </tbody>
            </table>
        </div>
    </div>

    <div id="form-category-produk" class="white-popup wide mfp-with-anim mfp-hide">
        <legend><strong>Pilih Category Produk</strong></legend>
        <div class="table-responsive">
            <table class="table table-th-block table-dark">
                <colgroup>
                    <col width="1">
                    <col>
                    <col width="1">
                    <col width="1">
                </colgroup>
                <thead>
                    <tr>
                        <th class="nobr">No</th>
                        <th class="nobr">Judul</th>
                        <th class="nobr">Status</th>
                        <th class="nobr text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="popup-ajax-result">

                </tbody>
            </table>
        </div>
    </div>

    <div id="form-gallery" class="white-popup wide mfp-with-anim mfp-hide">
        <legend><strong>Pilih Gallery</strong></legend>
        <div class="table-responsive">
            <table class="table table-th-block table-dark">
                <colgroup>
                    <col width="1">
                    <col width="1">
                    <col>
                    <col width="1">
                    <col width="1">
                </colgroup>
                <thead>
                    <tr>
                        <th class="nobr">No</th>
                        <th class="nobr">Images</th>
                        <th>Judul</th>
                        <th class="nobr">Status</th>
                        <th class="nobr text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="popup-ajax-result">

                </tbody>
            </table>
        </div>
    </div>

    <style type="text/css">
        .menus_type_item { display: none; }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('change', 'select[name="menus_type"]', function(e){
                e.preventDefault();
                var $this = $(this);
                var val = $this.find(':selected').val();
                var type = $this.find(':selected').data('type');

                $('.menus_type_item').hide();
                $('#'+type).show();
            });
            $('select[name="menus_type"]').change();

        });

        function setArticle1(val){
            $('input[name="menus_article_id"]').attr('value',val);
            $('#form-article .mfp-close').trigger('click');
        };
        function setArticle3(val){
            $('input[name="menus_product_id"]').attr('value',val);
            $('#form-produk .mfp-close').trigger('click');
        };
        function setArticle4(val){
            $('input[name="menus_category_product_id"]').attr('value',val);
            $('#form-category-produk .mfp-close').trigger('click');
        };
        function setArticle5(val){
            $('input[name="menus_gallery_id"]').attr('value',val);
            $('#form-gallery .mfp-close').trigger('click');
        };
    </script>

    <!-- datatable -->
    <?php get_data_table();?>

    <?php js_validate() ?>

</div>
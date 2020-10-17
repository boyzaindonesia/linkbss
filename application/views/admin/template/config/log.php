<div class="the-box no-border">
	<div class="btn-toolbar">
        <?php isset($links)?getLinksBtn($links):'';?>
    </div>

	 <link rel="stylesheet" type="text/css" href="<?php echo themeUrl();?>lib/datepicker/datepicker.css" />  
	  <form action="" method="post" >
		  <div class="well div_search">
		  		<div class="item_search">
		  			<img src="<?php echo themeUrl();?>img/gCons/search.png" />
		  			<select name="colum" id="colum">
		  				<?php cat_search($this->cat_search);?>
		  			</select>
		  			<input type="text" id="keyword" name="keyword" value="<?php echo $this->jCfg['search']['keyword'];?>" class="input-large" />

		  			Date : 
		  			<input type="text" id="date_start" value="<?php echo $this->jCfg['search']['date_start'];?>" name="date_start" class="input-small picker" />
		  			<input type="text" id="date_end" value="<?php echo $this->jCfg['search']['date_end'];?>" name="date_end" class="input-small picker" />
		  			 
		  			<input type="submit" value="Search!" name="btn_search" id="btn_search" class="btn btn-primary" style="margin-top:-10px;" />
		  			<input type="submit" value="Reset!" name="btn_reset" id="btn_reset" class="btn" style="margin-top:-10px;" />

					<?php cat_perpage($this->arr_perpage);?>

		  		</div>
		  	
		  </div>

	  </form>

	   <div class="well" style="background-color:#fff;">
	  <table class="table table-striped table-bordered dTableR table-data" id="dt_a">
	   <thead>
		<tr>
			<th width="10px">No</th>
			<?php echo get_header_table($this->cat_search);?>
		</tr>
		</thead>
	   <tbody> 
		<?php 
		if(count($data) > 0){
			foreach($data as $r){?>
				<tr>
					<td><?php echo ++$no;?></td>
					<td><?php echo myDate($r->log_date,"d/m/Y H:i:s");?></td>
					<td><?php echo $r->log_user_name;?></td>
					<td><?php echo $r->log_class;?></td>
					<td><?php echo $r->log_function;?></td>
					<td><?php echo $r->log_ip;?></td>
					<td><?php echo $r->log_user_agent;?></td>
				</tr>
		<?php } 
		}
		?>
		</tbody>
	</table>
	
    <?php if(isset($paging) && $paging!=''){ ?>
    <div class="btn-toolbar mt-20 mb-20" role="toolbar">
        <div class="btn-group pull-right">
            <?php echo $paging ?>
        </div>
    </div>
    <?php } ?>
	</div>

	<script type="text/javascript" src="<?php echo themeUrl();?>lib/datepicker/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
	  $('.picker').each(function(){
	    $(this).attr("readonly","true");
	    $(this).datepicker({format: "yyyy-mm-dd"});
	  });  
	});
	</script>
</div>
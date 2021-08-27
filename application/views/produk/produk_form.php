
        <h2 style="margin-top:0px">Produk <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Produk <?php echo form_error('nama_produk') ?></label>
            <input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>" />
        </div>
	    <div class="form-group">
            <label for="bigint">Harga Beli <?php echo form_error('harga_beli') ?></label>
            <input type="text" class="form-control numeric" name="harga_beli" id="harga_beli" placeholder="Harga Beli" value="<?php echo $harga_beli; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Vendor <?php echo form_error('vendor') ?></label>
            <?=form_dropdown('vendor',$data_vendor,$vendor,"class='form-control' id='vendor'");?>
        </div>
	    <div class="form-group">
            <label for="int">Status <?php echo form_error('status') ?></label>
            <?=form_dropdown('status',array(
                ''=>">> Pilih Status",
                1=>"Baru",
                2=>"Bekas"),
                $status,
                "class='form-control' id='status'");?>
        </div>
	    <div class="form-group hide">
            <label for="datetime">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a>
	</form>

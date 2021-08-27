<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/bootstrap.min.css') ?>"/>
        <style>
            
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Produk List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('produk/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('produk/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('produk'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode Produk</th>
        <th>Nama Produk</th>
		<th>Harga Beli</th>
		<th>Vendor</th>
		<th>Status</th>
		<th>Created At</th>
		<th>Action</th>
            </tr><?php
            foreach ($produk_data as $produk)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $produk->id ?></td>
            <td><?php echo $produk->nama_produk ?></td>
			<td><?php echo format_rupiah($produk->harga_beli) ?></td>
			<td><?php echo $produk->nama_vendor ?></td>
			<!-- <td><?php //echo ($produk->status==1?"Baru":"Second") ?></td> -->
            <td><?php 
            echo form_dropdown(
                'status'.$produk->id, 
                array(""=>">> Pilih",1=>"Baru",2=>"Bekas"), 
                $produk->status,
                array('class'=>"form-control",
                        'onchange'=>"changeStat($produk->id)"
                )); ?>
                
            </td>
			<td><?php echo tanggal_indo(date_format(date_create($produk->created_at),"Y-m-d")) ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('produk/read/'.$produk->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('produk/update/'.$produk->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('produk/delete/'.$produk->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('produk/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        <!-- jQuery 3 -->
<script src="<?=site_url()?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
       <script type="text/javascript">
           function changeStat(idprod){
            $.ajax({
                url:"<?=base_url()?>produk/changestat",
                type:"POST",
                dataType:"json",//html, text
                data:{idprod:idprod},
                success:function(data){
                    alert(data.msg);
                }
            })
           }
       </script>
    </body>
</html>
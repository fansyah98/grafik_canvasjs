<?php 

 public function changestat(){
        $idprod = $this->input->post('idprod',TRUE);
        $cekstat = $this->Produk_model->get_by_id($idprod);
        $newstat = $cekstat->status==1?2:1;
        $data = array(
        'status' => $newstat
        );

            $this->Produk_model->update($idprod, $data);
            $res['msg']="Berhasil terupdate";
            echo json_encode($res);
    }


    ?>
<!-- ========================= -->

    <?php echo form_dropdown('stat_'.$produk->id, array(""=>">> Pilih",1=>"Baru",2=>"Second"), $produk->status,array('class'=>'form-control','id'=>"stat_".$produk->id,'onchange'=>"changeStat($produk->id)")); ?>
<!-- =================== -->

    <script src="<?=site_url()?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript">
            $('document').ready(function(){
            });

            function changeStat(idprod){
               $.ajax({
                url:"<?=base_url()?>produk/changestat",
                type:"POST",
                dataType:"json",
                data:{idprod:idprod},
                success:function(data){
                    alert(data.msg);
                }
               }) 
            }
        </script>

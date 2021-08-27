<?php
$this->db->select('nama_produk,harga_beli');
$dataProdukChart = $this->db->get("produk")->result();
foreach ($dataProdukChart as $k => $v) {
    $arrProd[] = ['label' => $v->nama_produk, 'y' => $v->harga_beli];
}
// print_r(json_encode($arrProd, JSON_NUMERIC_CHECK));die();
?>

<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    theme: "light1", // "light2", "dark1", "dark2"
    animationEnabled: false, // change to true
    title:{
        text: "Basic Column Chart"
    },
    data: [
    {
        // Change type to "bar", "area", "spline", "pie",etc.
        type: "column",
        /*dataPoints: [
            { label: "apple",  y: 10  },
            { label: "orange", y: 15  },
            { label: "banana", y: 25  },
            { label: "mango",  y: 30  },
            { label: "grape",  y: 28  }
        ]*/
        dataPoints:
            <?=json_encode($arrProd, JSON_NUMERIC_CHECK);?>

    }
    ]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
</body>
</html>
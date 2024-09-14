<?php
/**
 * Created by PhpStorm
 * User: KYLLLAX
 * Date: 20/05/2021
 * Time: 18:25
 */
?>
<div class="row" style="display: none">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <button class="btn btn-secondary btn-xs" type="button" style="width: 100%" data-toggle="modal" data-target="#largeModal"><i class="fa fa-plus"></i> Agregar Producto</button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <table class="table table-bordered table-hover" style="border-color: black">
            <thead>
            <tr style="background-color: #ebebeb">
                <th>COD.</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $totales = count($_SESSION['productos']);
            $monto = 0;

            if($totales != 0){
                foreach ($_SESSION['productos'] as $p){
                    if($p[5] == 1){
                        $ver = "Por Menor";
                    }else{
                        $ver = "Por Mayor";
                    }
                    $subtotal = round($p[4] * $p[3],2);
                    $monto = round($monto + $subtotal, 2);
                ?>
                <tr> <!--De esta tapla se jala los valores por la posicion de los arrays-->
                    <td><?php echo $p[0];?></td>
                    <td><?php echo $ver;?></td>
                    <td><?php echo $p[1];?></td>
                    <td>s/. <?php echo $p[3];?></td>
                    <td><?php echo $p[4];?></td>
                    <td>s/. <?php echo $subtotal;?></td>
                    <td><a type="button" class="btn btn-xs btn-warning btne" onclick="quitarProducto(<?php echo $p[0];?>)" ><i class="fa fa-times"></i> Quitar</a></td>
                </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>
        <div class="row">
            <div id="espacio" class="col-lg-8"></div>

            <div class="col-lg-4">
                <!--<h5>OP. GRATUITA: s/. <?php echo number_format($gratuita ,2);?></h5>
                <input type="hidden" value="<?php echo $gratuita;?>" id="gratuita">
                <h5>OP. EXONERADA: s/. <?php echo number_format($exonerada ,2);?></h5>
                <input type="hidden" value="<?php echo $exonerada;?>" id="exonerada">
                <h5>OP. INAFECTA: s/. <?php echo number_format($inafecta , 2);?></h5>
                <input type="hidden" value="<?php echo $inafecta;?>" id="inafecta">
                <h5>OP. GRAVADA: s/. <?php echo number_format($gravada , 2);?></h5>
                <input type="hidden" value="<?php echo $gravada;?>" id="gravada">
                <h5>IGV: s/. <?php echo number_format($igv , 2);?></h5>
                <input type="hidden" value="<?php echo $igv;?>" id="igv">
                <?php
                if ($ICBPER > 0){ ?>
                    <h5>ICBPER: s/. <?php echo number_format($ICBPER , 2);?></h5>
                <?php }
                ?>
                <input type="hidden" value="<?php echo $ICBPER;?>" id="icbper">-->
                <h4>PRECIO TOTAL: s/. <?php echo number_format($monto , 2);?></h4>
                <input type="hidden" value="<?php echo $monto;?>" id="montototal">
                <!--<h5>Pagó con: s/. <span id="pago_con">0.00</span></h5>
                <input type="hidden" id="pago_con_">
                <h5>Vuelto: s/. <span id="vuelto">0.00</span></h5>
                <input type="hidden" id="vuelto_">-->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
</script>
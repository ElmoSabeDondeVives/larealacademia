<?php
/**
 * Created by PhpStorm
 * User: LuisSalazar
 * Date: 04/06/2021
 * Time: 02:30 p. m.
 */
?>
<img src="<?= _SERVER_?>/media/logo/logo_empresa.png" alt="" style="margin-right: 50px">
<br><br><br><br><br><br><br><br><br>
<div class="row">

    <div class="col-lg-12">
        <!-- DataTales Example -->

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0" border="1">

                        <h2 style="">HISTORIAL DE VENTAS ENVIADAS A LA SUNAT // TIPO DE VENTA : <?= utf8_decode($tipo_comprobante); ?> // FECHA : <strong><?= $fecha_vacio; ?></strong></h2>

                        <thead class="text-capitalize">
                        <br><br>
                        <tr style="background: deepskyblue;">
                            <th>#</th>
                            <th>COMPROBANTE</th>
                            <th>SERIE</th>
                            <th>CORRELATIVO</th>
                            <th>CLIENTE DOC</th>
                            <th>CLIENTE NOMBRE</th>
                            <th>FECHA DE EMISION</th>
                            <th>FECHA DE VENCIMIENTO</th>
                            <th>FECHA DE CREACION</th>
                            <th>USUARIO</th>
                            <th>MONEDA</th>
                            <th>DESCUENTO</th>
                            <th>GRAVADO</th>
                            <th>EXONERADO</th>
                            <th>INAFECTO</th>
                            <th>GRATUITO</th>
                            <th>IGV</th>
                            <th>ICBPER</th>
                            <th>TOTAL</th>
                            <th>ANULADO</th>
                            <th>ESTADO SUNAT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $a = 1;
                        $total = 0;
                        foreach ($ventas as $m){

                            if($m->id_tipodocumento == 4){
                                $cliente = $m->cliente_razonsocial;
                            }else{
                                $cliente = $m->cliente_nombre;
                            }
                            if($m->venta_tipo == "03"){
                                $venta_tipo = "BOLETA";
                                if($m->anulado_sunat == 0){
                                    $total = round($total + $m->venta_total, 2);
                                }
                            }elseif ($m->venta_tipo == "01"){
                                $venta_tipo = "FACTURA";
                                if($m->anulado_sunat == 0){
                                    $total = round($total + $m->venta_total, 2);
                                }
                            }elseif($m->venta_tipo == "07"){
                                $venta_tipo = "NOTA DE CRÉDITO";
                            }elseif($m->venta_tipo == "08"){
                                $venta_tipo= "NOTA DE DÉBITO";
                                if($m->anulado_sunat == 0){
                                    $total = round($total + $m->venta_total, 2);
                                }
                            }else{
                                $venta_tipo = "TODOS";
                            }
                            $stylee= "style='text-align: center;'";
                            if($m->anulado_sunat == 1){
                                $stylee="style= 'text-align: center; background-color: #FF6B70'";
                                //$total = $total;
                                $anulado = "SI";
                            }else{
                                $total = $total + $m->venta_total;
                                $anulado = "NO";
                            }
                            if($m->venta_tipo_envio == 1){
                                $tipo_envio = "ENVIO DIRECTO";
                            }else{
                                $tipo_envio = "ENVIO EN RESUMEN DIARIO";
                            }
                            $nombre_usuario = $m->persona_nombre. ' ' .$m->persona_apellido_paterno. ' ' .$m->persona_apellido_materno;
                            ?>
                            <tr <?=$stylee?>>
                                <td><?= $a;?></td>
                                <td><?= utf8_decode($venta_tipo);?></td>
                                <td><?= $m->venta_serie;?></td>
                                <td><?= $m->venta_correlativo;?></td>
                                <td><?= utf8_decode($m->cliente_numero);?></td>
                                <td><?= utf8_decode($cliente);?></td>
                                <td><?= date('d-m-Y h:i:s', strtotime($m->venta_fecha_envio));?></td>
                                <td>-</td>
                                <td><?= date('d-m-Y h:i:s', strtotime($m->venta_fecha));?></td>
                                <td><?= utf8_decode($nombre_usuario);?></td>
                                <td><?= utf8_decode($m->abrstandar);?></td>
                                <td><?= $m->venta_totaldescuento;?></td>
                                <td><?= $m->venta_totalgravada;?></td>
                                <td><?= $m->venta_totalexonerada;?></td>
                                <td><?= $m->venta_totalinafecta;?></td>
                                <td><?= $m->venta_totalgratuita;?></td>
                                <td><?= $m->venta_totaligv;?></td>
                                <td><?= $m->venta_icbper;?></td>
                                <td><?= number_format($m->venta_total,2);?></td>
                                <td><?= $anulado;?></td>
                                <td><?= $tipo_envio;?></td>
                            </tr>

                            <?php
                            $a++;
                        }
                        ?>
                        </tbody>
                        <tfooter>
                            <tr>
                                <td></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;">TOTAL:</td>
                                <td style="text-align: center;"><?= number_format($total,2);?></td>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

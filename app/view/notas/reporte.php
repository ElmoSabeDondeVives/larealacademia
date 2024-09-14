<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 02/11/2018
 * Time: 0:36
 */
?>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
    <!-- Content Header (Page header) -->
    <section class="content-header text-left">
        <hr>
        <h2 class="concss" style="text-align: left !important;">
            <a href="<?= _SERVER_?>"><i class="fa fa-fire"></i> INICIO</a> >
            <a href="<?= _SERVER_?>Clientes"><i class="<?php echo $_SESSION['icono'];?>"></i> <?php echo $_SESSION['controlador'];?></a> >
            <i class="<?php echo $_SESSION['icono'];?>" ></i> <?php echo $_SESSION['accion'];?>
        </h2>

        <hr>
    </section>

    <section class="container-fluid">

        <!-- /.row -->

        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Busqueda:
                    </div>
                    <div class="card-body shadow">
                        <div class="row">
                        <?php
                        $fechas = array();
                        $notas = array();
                        foreach ($list as $l){
                            $name = $this->notas->notas_clase($l->id_curso,$_GET['id']);
                            foreach ($name as $n){
                                $fechas[]='\''.$n->fecha_nota.'\'';
                                $notas[]='\''.$n->notita.'\'';
                            }
                            $fechas_p = implode(',',$fechas);
                            $notas_p = implode(',',$notas);

                            ?>
                            <div class="col-lg-12">
                                <label for=""><?= $l->descripcion ?></label>
                            </div>
                            <div class="col-lg-12">
                                <canvas id="line-chart<?= $l->id_curso?>"></canvas>
                                <script>

                                    new Chart(document.getElementById("line-chart<?= $l->id_curso ?>"), {
                                        type: 'line',
                                        data: {
                                            labels: [<?= $fechas_p ?>],
                                            datasets: [{
                                                data: [<?= $notas_p ?>],
                                                label: "<?= $l->descripcion ?>",
                                                borderColor: "#6a0c0d",
                                                fill: false
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: '<?= $l->descripcion ?>'
                                            }
                                        }
                                    });

                                </script>
                            </div>


                        <?php  $notas = array();
                            $fechas  = array();  } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>

</div>

<script src="<?php echo _SERVER_ . _JS_;?>domain.js"></script>
<script src="<?php echo _SERVER_ . _JS_;?>aula.js"></script>

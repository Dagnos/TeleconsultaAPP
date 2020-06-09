<section class="content">
<?php
$data["posts"]=CitaData::getAll();
?>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Cita
                        </h1>
                        <ol class="breadcrumb">
                            <li class="">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                            <li class="active">
                                <i class="fa fa-users"></i> Cita
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="box box-primary">
                            <div class="box-body">
                                    <table class="table datatable table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>FECHACITA</th>
                                                <th>IDPACIENTE_NOMBRE</th>
                                                <th>MEDICO_NOMBRE</th>
                                                <th>IDORDENATENCION</th>
                                                <th>ESPECIALIDAD_NOMBRE</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($data["posts"] as $post):?>
                                            <tr>
                                                <td><?=$post->FECHACITA;?></td>
                                                <td><?=$post->IDPACIENTE_NOMBRE;?></td>
                                                <td><?=$post->MEDICO_NOMBRE;?></td>
                                                <td><?=$post->IDORDENATENCION;?></td>
                                                <td><?=$post->ESPECIALIDAD_NOMBRE;?></td>
                                                                                            
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                </section>
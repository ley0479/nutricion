<!-- END HEADER-->
<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="./assets/img/admin-avatar.png" width="45px" />
            </div>
           
            <div class="admin-info">
                <div class="font-strong"><?= session()->get('nombre'); ?></div><small><?= session()->get('apellidos'); ?></small>
            </div>
        </div>
        <ul class="side-menu metismenu">
        
            <li class="heading">MÓDULOS</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                    <span class="nav-label">Perfil de Usuario</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?php echo base_url(); ?>perfil">Gestión de Perfil</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>seguimiento">Seguimiento de Progreso</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-calendar"></i>
                    <span class="nav-label">Planificación</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?php echo base_url();?>planificar-comidas">Planificador de Comidas</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>recetas-recomendaciones">Sugerencias de Recetas</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>recetas-recomendaciones-objetivos">Objetivos/Requerimientos</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>sugerencias-ia">Recomendaciones IA</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-cutlery"></i>
                    <span class="nav-label">Recetas</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="recetas-basadas-a-la-planificacion">Gestión de Recetas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-info-circle"></i>
                    <span class="nav-label">Infor-Nutricional</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?php echo base_url() ;?>informacion-nutricional">Información de Alimentos</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>calculadora-nutricional">Calculadora Nutricional</a>
                    </li>
                    
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-line-chart"></i>
                    <span class="nav-label">Grafico</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="<?php echo base_url(); ?>progreso">Visualización de Progreso</a>
                    </li>
                </ul>
            </li>
           
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->

<?php
session_start();
require_once '../controller/controller.php';
    if (!isset($_SESSION['id_usu'])) {
        header('Location: ../index.php');
    }

    $c = new Controller();
?>


<!DOCTYPE html>
<html lang="es">
<head>
   <!-----------Configuration------------------->
    <meta charset="UTF-8">
    <meta name="author" content="Wilkens Mompoint">
    <meta name="application-name" content="Colegio Graneros - Sistema de Inventario">
    <title>Sistema de  Inventario - Colegio Graneros</title>
    
    
    <!-------------Stylesheets---------------------->
    <link rel="icon" type="icon" href="../img/logo/logo.jpg">
    <link rel="stylesheet" href="../css/animate.min.css">
    <link rel="stylesheet" href="../css/jquery.animatedheadline.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/Datables_bootstap.css">
    <link rel="stylesheet" href="css/inventario_main_styles.css">
</head>
<body>
    <div class="border__left">
    <div class="border__left-content">
        <div class="logo__picture">
            <img src="../img/logo/log.png" alt="" class="logo__img animate__animated animate__zoomInLeft">
        </div>

        <nav class="menu__left">
            <ul class="menu__items">
                <li class="menu__item"><a href="" class="menu__link"><img src="../img/svg__icon/dashboard.svg" alt="" class="item__img">Dashboard</a></li>

                <li class="menu__item"><a href="#" class="menu__link"><img src="../img/svg__icon/component.svg" alt="" class="item__img">Componentes</a>
                    <ul class="submenu__items">
                        <li class="submenu__item"><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#addcomponent" class="submenu__link">Agregar Componente</a></li>
                        <li class="submenu__item"><a href="#" class="submenu__link" type="button" data-bs-toggle="modal" data-bs-target="#componentlist">Lista de componentes</a></li>
                    </ul>
                </li>

                <li class="menu__item"><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#registrarubicacion"  class="menu__link"><img src="../img/svg__icon/location.svg" alt="" class="item__img" >Ubicacion</a>

                </li>

                <li class="menu__item"><a href="#" class="menu__link"><img src="../img/svg__icon/docente.svg" alt="" class="item__img">Docentes</a>
                    <ul class="submenu__items">
                        <li class="submenu__item"><a href="#"  type="button" data-bs-toggle="modal" data-bs-target="#registrardocente"  class="submenu__link">Registrar Docentes</a></li>
                        <li class="submenu__item"><a href="" class="submenu__link"  type="button" data-bs-toggle="modal" data-bs-target="#listardocente" >Lista de Docentes</a></li>
                    </ul>
                </li>

                <li class="menu__item"><a href="#" class="menu__link"><img src="../img/svg__icon/ubicacion.svg" alt="" class="item__img">Ajustes</a>
                    <ul class="submenu__items">
                        <li class="submenu__item"><a href="#"  type="button" data-bs-toggle="modal" data-bs-target="#miperfil"  class="submenu__link">Perfil de Usuario</a></li>
                    </ul>
                </li>
                
                <li class="menu__item"><a href="#" class="menu__link"><img src="../img/svg__icon/credit.svg" alt="" class="item__img"> Prestamos</a>
                    <ul class="submenu__items">
                        <li class="submenu__item"><a href="#" class="submenu__link">Nuevo Prestamo</a></li>
                        <li class="submenu__item"><a href="#" class="submenu__link">Listado de Prestamos</a></li>
                    </ul>
                </li>
                
                
                <li class="menu__item"><a href="#" class="menu__link"><img src="../img/svg__icon/categorias.svg" alt="" class="item__img"> Categorias</a>
                    <ul class="submenu__items">
                        <li class="submenu__item"><a href="#" class="submenu__link">Nuevo Estado</a></li>
                        <li class="submenu__item"><a href="#" class="submenu__link">Nuevo Tipo</a></li>
                        <li class="submenu__item"><a href="#" class="submenu__link">Nuevo Status</a></li>
                        <li class="submenu__item"><a href="#" class="submenu__link">Nueva Ubicacion</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
        </div>
    </div>
    
    <div class="border__right">
        <!----------------MENU HEADER-------------->
        <header class="border__rigth--header">
            <button class="menu__button">
                <img src="../img/svg__icon/menu.svg" alt="" class="menu__button--img">
            </button>
            
            <div class="header__menu">
               <div class="search">
                  <form action="">
                   <input type="text" placeholder="Buscar...." class="form-control">
                  </form>
               </div>
                <ul class="header__menu--items">
                    <li class="header__menu--item"><a onclick="kaishi()" href="#" class="header__menu--link"><img src="../img/svg__icon/fullscreen.svg" alt="" class="header__menu--img" title="Pantalla Completa"></a></li>
                    
                    <li class="header__menu--item"><a href="#" title="Reporte" class="header__menu--link"><img src="../img/svg__icon/report.svg" alt="" class="header__menu--img"></a></li>
                    
                    <li class="header__menu--item"><a href="#" class="header__menu--link"><img src="../img/svg__icon/user1.svg" alt="" class="header__menu--img"> <?php echo $_SESSION['nombre']?> <img src="../img/svg__icon/arrowbottom.svg" alt=""></a>
                    <ul class="submenu__items">
                        <li class="submenu__item"><a href="" class="submenu__link">Cerrar Sesion</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </header>
        
        <main class="containr">
            <p class="welcome">Bienvenido <span class="user__name"><?php echo $_SESSION['nombre']?></span></p>
            
            <div class="componentes">
               
                <div class="recientes container__bg card w-100">
                    <h3 class="card__title text-white">Componentes</h3>
                    <table id="recent-component" class="table table-dark table-striped text-center">
                       <thead>
                        <tr>
                            <th>ID</th>
                            <th>Componente</th>
                            <th>Estado</th>
                            <th>Ubicacion</th>
                            <th>Detalles</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                     </thead>
                    <tbody>
                        <?php
                        $lista = $c->ListarComponentes1();
                        
                        if (count($lista)>0) {
                            for ($i=0; $i < count($lista); $i++) { 
                                $CGC = $lista[$i];
                                echo "<tr>";
                                echo "<td>".$CGC->getId()."</td>";
                                echo "<td>".$CGC->getNombre()."</td>";
                                echo "<td>".$CGC->getEstado()."</td>";
                                echo "<td>".$CGC->getUbicacion()."</td>";
                                echo "<td><span class='badge bg-success'><a href='#' type='button' data-bs-toggle='modal' data-bs-target='#modaldetails' onclick(detalles(".$CGC->getId()."))><img src='../img/svg__icon/details.svg' alt=''></a></span></td>";
                                echo "<td><span class='badge bg-warning'><a href='#' type='button' data-bs-toggle='modal' data-bs-target='#modalmodify' onclick(modificar(".$CGC->getId()."))><img src='../img/svg__icon/edit.svg' alt=''></a></span></td>";
                                echo "<td><span class='badge bg-danger'><a href='#' onclick(eliminar(".$CGC->getId()."))><img src='../img/svg__icon/delete.svg' alt=''></a></span></td>";
                                echo "</tr>";

                                
                            }
                        }
                        ?>


                    </tbody>
                    </table>
                </div>
            </div>
            
            <div class="componentes">
                <div class="card w-50 container__bg content">
                   <h3 class="card__title text-white">Componentes en Prestamos</h3>
                    <table class="table table-dark table-striped">
                        <thead>
                           <tr>
                            <th>ID</th>
                            <th>Componente</th>
                            <th>Prestatario</th>
                            <th>Fecha</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                
                
                <div class="bodega container__bg">
                    <h3 class="card__title text-white">Componentes en bodega</h3>
                    <table class="table table-dark table-striped table-responsive text-center">
                        <thead >
                            <tr>
                                <th>Folio</th>
                                <th>Componente</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td>PC12540001</td>
                                <td>PC HP</td>
                                <td>20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="card w-100 container__bg content">
                   <h3 class="card__title text-white">Componentes dado de baja</h3>
                    <table class="table table-dark table-striped">
                        <thead>
                           <tr>
                            <th>ID</th>
                            <th>Componente</th>
                            <th>Motivo de Baja</th>
                            <th>Fecha</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        
            
                
                    
                        
            <div class="footer">
                <p class="copy animate__animated animate__zoomInRight">&copy ColegioGraneros | Desarrollado por Wilkens Mompoint</p>
            </div>    
        </main>
        
        
        
        
    </div>

    
    

<!-- Modal Registrar componentes -->
<div class="modal fade" id="addcomponent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title animate__animated animate__zoomInDown"><img src="../img/svg__icon/new.svg" alt="">Nuevo Componente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="CGComponentRegister" action="">
      <div class="modal-body">
       
        <div class="row">
            <div class="col-md-6">
                <label for="">Componente:</label>
                <input type="text" id="CGComponente" name="CGComponente" class="form-control" placeholder="Ingrese el componente" required min="2">
            </div>
            
            <div class="col-md-6">
                <label for="">Estado:</label>
                <select id="CGEstadoComponente" name="CGEStadoComponente" class="form-control">
                    <option value="0" selected>Seleccione el estado</option>
                </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <label for="">Ubicacion:</label>
                <select name="CGUbicacion" id="CGUbicacion" class="form-control">
                    <option value="0" selected>Seleccione una unicacion</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="">Tipo de Componente:</label>
                    <select name="CGTipoComponente" id="CGTipoComponente" class="form-control">
                        <option value="0" selected>Seleccione el Tipo</option>
                    </select>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <label for="">Status</label>
                <select name="CGStatus" id="CGStatus" class="form-control">
                    <option value="0" selected>Seleccione el status</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="">Descripcion</label>
                <textarea name="CGDescripcion" id="CGDescripcionComponente" cols="30" rows="10" class="form-control"></textarea>
            </div>
        
            <div class="col-md-6">
                    <label for="">Observacíon</label>
                    <textarea name="CGObservacion" id="CGObservacionComponente" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>
        
      </div>
      <div class="modal-footer">
       <button type="reset" class="btn btn-warning">Restablecer</button>
        <button type="submit" class="btn btn-success">Registrar</button>
      </div>
          
      </form>
      
    </div>
  </div>
</div>

  
     
     <!-- Modal Listar Componente-->
<div class="modal fade" id="componentlist" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><img src="../img/svg__icon/list.svg" alt="">Lista de Componentes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <table class="table table-dark table-striped text-center">
                       <thead>
                        <tr>
                            <th>ID</th>
                            <th>Componente</th>
                            <th>Estado</th>
                            <th>Ubicacion</th>
                            <th>Detalles</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                     </thead>
                    <tbody>
                        <?php
                        $lista = $c->ListarComponentes1();

                        if (count($lista)>0) {
                            for ($i=0; $i < count($lista); $i++) { 
                                $CGC = $lista[$i];
                                echo "<tr>";
                                echo "<td>".$CGC->getId()."</td>";
                                echo "<td>".$CGC->getNombre()."</td>";
                                echo "<td>".$CGC->getEstado()."</td>";
                                echo "<td>".$CGC->getUbicacion()."</td>";
                                echo "<td><span class='badge bg-success'><a href='#' onclick(detalles(".$CGC->getId()."))><img src='../img/svg__icon/details.svg' alt=''></a></span></td>";
                                echo "<td><span class='badge bg-warning'><a href='#' onclick(modificar(".$CGC->getId()."))><img src='../img/svg__icon/edit.svg' alt=''></a></span></td>";
                                echo "<td><span class='badge bg-danger'><a href='#' onclick(eliminar(".$CGC->getId()."))><img src='../img/svg__icon/delete.svg' alt=''></a></span></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                    </table>
        
      </div>
      <div class="modal-footer">
       <button type="reset" class="btn btn-warning">Restablecer</button>
        <button type="submit" class="btn btn-success">Registrar</button>
      </div>
          
      
    </div>
  </div>
</div>
      
      
   <!-- Modal Registrar Docente-->
<div class="modal fade" id="registrardocente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><img src="../img/svg__icon/new.svg" alt="">Registrar Docentes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-md-12">
               <div class="label">Nombre Docente</div>
               <input type="text" class="form-control">
           </div>
           <div class="col-md-12">
               <label for="">Apellido Docente</label>
               <input type="text" class="form-control">
           </div>
       </div>
       
       <div class="row">
           <div class="col-md-12">
               <label >Contacto telefonico:</label>
               <input type="number" placeholder="Ejemplo: 912345678" class="form-control">
           </div>
       </div>
        
      </div>
      <div class="modal-footer">
       <button type="reset" class="btn btn-warning">Restablecer</button>
        <button type="submit" class="btn btn-success">Registrar</button>
      </div>
          
      
    </div>
  </div>
</div>
    
    
    
     <!-- Modal Listar Docente-->
<div class="modal fade" id="listardocente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><img src="../img/svg__icon/list.svg" alt="">Lista de Docentes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col">
           <table class="table table-dark table-striped">
               <thead>
                   <tr>
                       <th>Nombre</th>
                       <th>Apellido</th>
                       <th>Numero de contacto</th>
                       <th>Modificar</th>
                   </tr>
               </thead>
               <tbody>
                   
               </tbody>
           </table>
           </div>
       </div>
       
      </div>
      <div class="modal-footer">
       <button type="reset" class="btn btn-warning">Restablecer</button>
        <button type="submit" class="btn btn-success">Registrar</button>
      </div>
          
      
    </div>
  </div>
</div>
   
   
        <!-- Modal Mi perfil-->
<div class="modal fade" id="miperfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><img src="../img/svg__icon/user.svg" alt="">Mi Perfil</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col text-center">
           <img src="../img/svg__icon/user.svg" width="80" alt="">
           </div>
       </div>
       
       <div class="row justify-content-center">
          <div class="col-md-10">
              <label for="" class="form-control text-center">Administrador</label>
          </div>
           <div class="col-md-5">
               <label for="">Nombre</label>
               <input type="text" value="Nombre" class="form-control">
           </div>
           <div class="col-md-5">
               <label for="">Apellido</label>
               <input type="text" class="form-control" value="Apellido">
           </div>
           
           <div class="col-md-10">
               <label for="">Numero de contacto</label>
               <input type="number" value="912345678" class="form-control">
           </div>
          </div>
      </div>
      
      <div class="modal-footer">
       <button type="button" class="btn btn-warning"><img src="../img/svg__icon/edit.svg" alt="">Modificar</button>
        <button type="button" class="btn btn-success"><img src="../img/svg__icon/new.svg" alt="">Guardar</button>
      </div>
            
    </div>
  </div>
</div>
   
          
               
   <!-- Modal Registrar Ubicacion-->
<div class="modal fade" id="registrarubicacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><img src="../img/svg__icon/new.svg" alt="">Registrar Ubicacion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="row justify-content-center">
           <div class="col-md-4">
               <div class="label">Ubicacion Nueva</div>
               <input type="text" class="form-control">
           </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 text-center ">
               <button type="reset" class="btn btn-warning">Restablecer</button>
                <button type="submit" class="btn btn-success ">Registrar</button>
                
            </div>
        </div>
        
        <hr class="w-100">
      <div class="row">
          <div class="col-md-12">
              <table class="table table-dark table-striped caption-top">
                <caption>Lista de Ubicaciones</caption>
                  <thead>
                      <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                      </tr>
                  </thead>
              </table>
          </div>
      </div>
      </div>
      <div class="modal-footer">
      </div>
          
      
    </div>
  </div>
</div>
    

   <!-- Modal modal Details-->
   <div class="modal fade" id="modaldetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><img src="../img/svg__icon/user.svg" alt="">Detalles Componente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col text-center">
           <img src="../img/svg__icon/user.svg" width="80" alt="">
           </div>
       </div>
       
       <div class="row justify-content-center">
          <div class="col-md-10">
              <label for="" class="form-control text-center">Administrador</label>
          </div>
           <div class="col-md-5">
               <label for="">Nombre</label>
               <input type="text" value="Nombre" class="form-control">
           </div>
           <div class="col-md-5">
               <label for="">Apellido</label>
               <input type="text" class="form-control" value="Apellido">
           </div>
           
           <div class="col-md-10">
               <label for="">Numero de contacto</label>
               <input type="number" value="912345678" class="form-control">
           </div>
          </div>
      </div>
      
      <div class="modal-footer">
       <button type="button" class="btn btn-warning"><img src="../img/svg__icon/edit.svg" alt="">Modificar</button>
        <button type="button" class="btn btn-success"><img src="../img/svg__icon/new.svg" alt="">Guardar</button>
      </div>
            
    </div>
  </div>
</div>

          
    <!-------------JAVASCRIPTS-------------------->
    <script src="../js/jquery-3.6.0.js"></script>
    <script src="../js/anime.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="js/Databales_bootstap5.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/inventario_main_js.js"></script>
    <script src="../js/process/inventario__insert__process.js"></script>
    <script src="../js/process/inventario__list__process.js"></script>
</body>
</html>
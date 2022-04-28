<?php
include '../Model/CGComponentes.php';
include '../Model/CGDocente.php';
include '../Model/CGUbicacion.php';
include '../Model/CGUser.php';
include '../Model/StatusComponentes.php';
include '../Model/TipoUsuario.php';
include '../Model/TipoComponente.php';
include '../Model/EstadoComponente.php';

 class Controller 
 {
     private $mi;

     private function conexion()
     {
         $this->mi = new mysqli("localhost", "root", "", "CGGraneros");
            if ($this->mi->connect_errno) {
                echo "Fallo al conectar a MySQL: (" . $this->mi->connect_errno . ") " . $this->mi->connect_error;
            }
     }

     private function desconexion()
     {
         $this->mi->close();
     }

     /* Login Usuario**/
     public function CGUSer__login($user, $pass)
     {
         $this->conexion();
         $sql = "SELECT id_usu,nom_usu,ape_usu,correo, nom_tip, toten, modified FROM CGUser,CGTipo_usuario WHERE CGUser.id_tip=CGTipo_usuario.id_tip and log_usu = '$user' AND pas_usu = '$pass'";
         $result = $this->mi->query($sql);
         if($rs = mysqli_fetch_array($result))
         {
             $id = $rs['id_usu'];
             $nombre = $rs['nom_usu'];
             $apellido = $rs['ape_usu'];
             $email = $rs['correo'];
            $tipo = $rs['nom_tip'];
            $toten = $rs['toten'];
            $modified = $rs['modified'];
            $usu = new CGUser($id, $nombre, $apellido, $email,$user, $pass, $tipo, $toten, $modified);
            $this->desconexion();
            return $usu;
            }
         $this->desconexion();
         return "Error de Usuario o Contraseña";
     } 
    /******************************************************************************************************* */
    /************************Search************************************* */
    public function BuscarComponentes($id){
        $this->conexion();
        $sql = "SELECT id_comp, folio_comp, nom_comp, nom_ubi, descripcion, observacion, nom_tip_comp, nom_est_comp, nom_sta_comp FROM CGComponentes,CGTipoComponente,EstadoComponentes,CGUbicacion, StatusComponentes where CGComponentes.id_ubi=CGUbicacion.id_ubi and CGComponentes.id_tip_comp=CGTipoComponente.id_tip_comp and CGComponentes.id_est_comp=EstadoComponentes.id_est_comp and CGComponentes.id_sta_comp=StatusComponentes.id_sta_comp and id_comp = $id";
        $resultado = $this->mi->query($sql);
        if($rs = mysqli_fetch_array($resultado)){
            $id = $rs['id_comp'];
            $folio = $rs['folio_comp'];
            $nom = $rs['nom_comp'];
            $ubi = $rs['nom_ubi'];
            $descripcion = $rs['descripcion'];
            $observacion = $rs['observacion'];
            $tip = $rs['nom_tip_comp'];
            $est = $rs['nom_est_comp'];
            $sta = $rs['nom_sta_comp'];
            $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
            $this->desconexion();
            return $comp;
        }
        $this->desconexion();
        return null;
    }
    /***********************Selects***********************************************/
     public function ListarTipoComponente(){
         $this->conexion();
         $sql = "SELECT * FROM CGTipoComponente";
         $resultado = $this->mi->query($sql);
         $lista = array();
         while($rs = mysqli_fetch_array($resultado)){
             $id = $rs['id_tip_comp'];
             $nom = $rs['nom_tip_comp'];
             $tip = new TipoComponente($id, $nom);
             $lista[] = $tip;
         }
         $this->desconexion();
         return $lista;
     }

     public function ListarEstadoComponente(){
            $this->conexion();
            $sql = "SELECT * FROM EstadoComponentes";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_est_comp'];
                $nom = $rs['nom_est_comp'];
                $est = new EstadoComponente($id, $nom);
                $lista[] = $est;
            }
            $this->desconexion();
            return $lista;
     }

     public function ListarUbicacion(){
         $this->conexion();
         $sql = "SELECT * FROM CGUBicacion";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_ubi'];
                $nom = $rs['nom_ubi'];
                $ubi = new CGUbicacion($id, $nom);
                $lista[] = $ubi;
            }
        $this->desconexion();
        return $lista;
     }

     public function ListarStatusComponentes(){
            $this->conexion();
            $sql = "SELECT * FROM StatusComponentes";
                $resultado = $this->mi->query($sql);
                $lista = array();
                while($rs = mysqli_fetch_array($resultado)){
                    $id = $rs['id_sta_comp'];
                    $nom = $rs['nom_sta_comp'];
                    $sta = new StatusComponentes($id, $nom);
                    $lista[] = $sta;
                }
            $this->desconexion();
            return $lista;
     }


     public function ListarDocente(){
         $this->conexion();
         $sql = "SELECT * FROM CGDocente";
         $resultado = $this->mi->query($sql);
         $lista = array();
         while($rs = mysqli_fetch_array($resultado)){
             $id = $rs['id_doc'];
             $nom = $rs['nom_doc'];
             $ape = $rs['ape_doc'];
             $con = $rs['con_doc'];
             $doc = new CGDocente($id, $nom, $ape, $con);
             $lista[] = $doc;
         }
         $this->desconexion();
         return $lista;
     }

        public function ListarComponentes(){
            $this->conexion();
            $sql = "SELECT * FROM CGComponentes";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_comp'];
                $folio = $rs['folio_comp'];
                $nom = $rs['nom_comp'];
                $ubi = $rs['id_ubi'];
                $descripcion = $rs['descripcion'];
                $observacion = $rs['observacion'];
                $tip = $rs['id_tip_comp'];
                $est = $rs['id_est_comp'];
                $sta = $rs['id_sta_comp'];
                $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
                $lista[] = $comp;
            }
            $this->desconexion();
            return $lista;
        }

        public function ListarComponentes1(){
            $this->conexion();
            $sql = "SELECT id_comp, folio_comp, nom_comp, nom_ubi, descripcion, observacion, nom_tip_comp, nom_est_comp, nom_sta_comp FROM CGComponentes,CGUbicacion, CGTipoComponente, EstadoComponentes, StatusComponentes WHERE CGComponentes.id_ubi = CGUbicacion.id_ubi AND CGComponentes.id_tip_comp = CGTipoComponente.id_tip_comp AND CGComponentes.id_est_comp = EstadoComponentes.id_est_comp AND CGComponentes.id_sta_comp = StatusComponentes.id_sta_comp";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_comp'];
                $folio = $rs['folio_comp'];
                $nom = $rs['nom_comp'];
                $ubi = $rs['nom_ubi'];
                $descripcion = $rs['descripcion'];
                $observacion = $rs['observacion'];
                $tip = $rs['nom_tip_comp'];
                $est = $rs['nom_est_comp'];
                $sta = $rs['nom_sta_comp'];
                $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
                $lista[] = $comp;
            }
            $this->desconexion();
            return $lista;
        }





        public function ListarComponentesPorFolio($folio){
            $this->conexion();
            $sql = "SELECT * FROM CGComponentes WHERE folio_comp = '$folio'";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_comp'];
                $folio = $rs['folio_comp'];
                $nom = $rs['nom_comp'];
                $ubi = $rs['id_ubi'];
                $descripcion = $rs['descripcion'];
                $observacion = $rs['observacion'];
                $tip = $rs['id_tip_comp'];
                $est = $rs['id_est_comp'];
                $sta = $rs['id_sta_comp'];
                $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
                $lista[] = $comp;
            }
            $this->desconexion();
            return $lista;
        }

        public function ListarComponentesPorNombre($nom){
            $this->conexion();
            $sql = "SELECT * FROM CGComponentes WHERE nom_comp = '$nom'";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_comp'];
                $folio = $rs['folio_comp'];
                $nom = $rs['nom_comp'];
                $ubi = $rs['id_ubi'];
                $descripcion = $rs['descripcion'];
                $observacion = $rs['observacion'];
                $tip = $rs['id_tip_comp'];
                $est = $rs['id_est_comp'];
                $sta = $rs['id_sta_comp'];
                $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
                $lista[] = $comp;
            }
            $this->desconexion();
            return $lista;
        }

        public function ListarComponentesPorUbicacion($ubi){
            $this->conexion();
            $sql = "SELECT * FROM CGComponentes WHERE id_ubi = '$ubi'";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_comp'];
                $folio = $rs['folio_comp'];
                $nom = $rs['nom_comp'];
                $ubi = $rs['id_ubi'];
                $descripcion = $rs['descripcion'];
                $observacion = $rs['observacion'];
                $tip = $rs['id_tip_comp'];
                $est = $rs['id_est_comp'];
                $sta = $rs['id_sta_comp'];
                $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
                $lista[] = $comp;
            }
            $this->desconexion();
            return $lista;
        }

        public function ListarComponentesPorTipo($tip){
            $this->conexion();
            $sql = "SELECT * FROM CGComponentes WHERE id_tip_com = '$tip'";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_comp'];
                $folio = $rs['folio_comp'];
                $nom = $rs['nom_comp'];
                $ubi = $rs['id_ubi'];
                $descripcion = $rs['descripcion'];
                $observacion = $rs['observacion'];
                $tip = $rs['id_tip_comp'];
                $est = $rs['id_est_comp'];
                $sta = $rs['id_sta_comp'];
                $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
                $lista[] = $comp;
            }
            $this->desconexion();
            return $lista;
        }

        public function ListarComponentesPorEstado($est){
            $this->conexion();
            $sql = "SELECT * FROM CGComponentes WHERE id_est_comp = '$est'";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_comp'];
                $folio = $rs['folio_comp'];
                $nom = $rs['nom_comp'];
                $ubi = $rs['id_ubi'];
                $descripcion = $rs['descripcion'];
                $observacion = $rs['observacion'];
                $tip = $rs['id_tip_comp'];
                $est = $rs['id_est_comp'];
                $sta = $rs['id_sta_comp'];
                $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
                $lista[] = $comp;
            }
            $this->desconexion();
            return $lista;
        }

        public function ListarComponentesPorEstadoYTipo($est, $tip){
            $this->conexion();
            $sql = "SELECT * FROM CGComponentes WHERE id_est_comp = '$est' AND id_tip_com = '$tip'";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_comp'];
                $folio = $rs['folio_comp'];
                $nom = $rs['nom_comp'];
                $ubi = $rs['id_ubi'];
                $descripcion = $rs['descripcion'];
                $observacion = $rs['observacion'];
                $tip = $rs['id_tip_comp'];
                $est = $rs['id_est_comp'];
                $sta = $rs['id_sta_comp'];
                $comp = new CGComponentes($id, $folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta);
                $lista[] = $comp;
            }
            $this->desconexion();
            return $lista;
        }

        public function ListarPrestamos(){
            $this->conexion();
            $sql = "SELECT * FROM CGPrestamos";
            $resultado = $this->mi->query($sql);
            $lista = array();
            while($rs = mysqli_fetch_array($resultado)){
                $id = $rs['id_prest'];
                $id_comp = $rs['id_comp'];
                $id_doc = $rs['id_doc'];
                $id_est = $rs['id_est'];
                $fecha_prest = $rs['fecha_prest'];
                $fecha_dev = $rs['fecha_dev'];
                $observacion = $rs['observacion'];
                $prest = new CGPrestamos($id, $id_comp, $id_doc, $id_est, $fecha_prest, $fecha_dev, $observacion);
                $lista[] = $prest;
            }
        }


        /*Funciones personalizadas */
        public function BuscarUltimoID(){
            $this->conexion();
            $sql = "SELECT MAX(id_comp) AS id FROM CGComponentes";
            $resultado = $this->mi->query($sql);
            $rs = mysqli_fetch_array($resultado);
            $this->desconexion();
            return $rs['id'];
        }
        /*Fin Listar */
        /***********************************************************************************************************************************/
        /*Inicio Insertar*/

        public function InsertarComponente($folio, $nom, $ubi, $descripcion, $observacion, $tip, $est, $sta){
            $this->conexion();
            $sql = "INSERT INTO CGComponentes VALUES (null,'$folio', '$nom', $ubi, '$descripcion', '$observacion', $tip, $est, $sta)";
            $resultado = $this->mi->query($sql);
            $this->desconexion();
            return $resultado;
        }

        public function InsertarUsuario($nom, $ape, $email, $log, $pas, $id_tip, $toten){
            $this->conexion();
            $sql = "INSERT INTO CGUsuarios (nom_usu, ape_usu, correo, log_usu, pas_usu, id_tip, toten) VALUES ('$nom', '$ape', '$email', '$log', '$pas', '$id_tip', '$toten')";
            $resultado = $this->mi->query($sql);
            $this->desconexion();
            return $resultado;
        }

        public function InsertarDocente($nom, $ape, $con){
            $this->conexion();
            $sql = "INSERT INTO CGDocentes (nom_doc, ape_doc, con_doc) VALUES ('$nom', '$ape', '$con')";
            $resultado = $this->mi->query($sql);
            $this->desconexion();
            return $resultado;
        }

        public function InsertarPrestamo($id_com, $id_doc,$id_est, $fecha_prest, $fecha_dev, $observacion){
            $this->conexion();
            $sql = "INSERT INTO CGPrestamos (id_comp, id_doc,id_est, fecha_prest, fecha_dev, observacion) VALUES ('$id_com', '$id_doc',$id_est, '$fecha_prest', '$fecha_dev', '$observacion')";
            $resultado = $this->mi->query($sql);
            $this->desconexion();
            return $resultado;
        }

        /*Fin Insertar*/
        /***********************************************************************************************************************************/
        /*Inicio Actualizar*/



        


     
 }
 
?>
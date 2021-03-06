<?php
class Ap
{
  private $ediNum;
  private $inventario;
  private $mac1;
  private $mac2;
  private $ip;
  private $serie;
  private $canal1;
  private $canal2;
  private $planta;
  private $lugar;

  public function __construct(
    $ediNum = 0, $inventario = 0, $mac1 = 0, $mac2 = 0, $ip = 0, $serie = 0,
    $can1 = 0, $can2 = 0, $planta = 0, $lugar = 0)
  {
    $this-> ediNum = $ediNum;
    $this-> inventario = $inventario;
    $this-> mac1 = $mac1;
    $this-> mac2 = $mac2;
    $this-> ip = $ip;
    $this-> serie = $serie;
    $this-> canal1 = $can1;
    $this-> canal2 = $can2;
    $this-> planta = $planta;
    $this-> lugar = $lugar;
  }

  public function agregar($con)
  {
    if (isset($con)) {
      $ediNum = $this-> ediNum;
      $inventario = $this-> inventario;
      $mac1 = $this-> mac1;
      $mac2 = $this-> mac2;
      $ip = $this-> ip;
      $serie = $this-> serie;
      $canal1 = $this-> canal1;
      $canal2 = $this-> canal2;
      $planta = $this-> planta;
      $lugar = $this-> lugar;

      $query = "INSERT INTO accesspoints (
        EdificioNum, inventario, Mac1,	Mac2,	IP, Serie, Canal1, Canal2, Planta, lugar, fecha
      ) VALUES (
        '$ediNum', '$inventario', '$mac1', '$mac2', '$ip', '$serie', '$canal1',
        '$canal2', '$planta', '$lugar', NOW()
      );";

      $execute = mysqli_query($con, $query);

      if ($execute) {
        return 1;
      } else {
        return 0;
      }
    }
  }

  public function editar($con, $id) {
    $inv = $this -> inventario;
    $mac1 = $this-> mac1;
    $mac2 = $this-> mac2;
    $ip = $this -> ip;
    $serie = $this-> serie;
    $c1 = $this -> canal1;
    $c2 = $this -> canal2;
    $plnt = $this -> planta;
    $edif = $this -> ediNum;
    $lugar = $this-> lugar;

    $query = "UPDATE accesspoints
    SET inventario = '$inv', IP = '$ip', Serie = '$serie', Mac1 = '$mac1', Mac2 = '$mac2',
    Canal1 = '$c1', Canal2 = '$c2', Planta = '$plnt',
    EdificioNum = '$edif', lugar = '$lugar'
    WHERE id_ap = '$id'";

    $execute = mysqli_query($con, $query);
    if ($execute) {
      return 1;
    } else {
      return 0;
    }
  }

  public function eliminar($con, $id)
  {
    $query = "DELETE FROM accesspoints WHERE id_ap = $id;";

    $execute = mysqli_query($con, $query);
    if ($execute) {
      return 1;
    } else {
      return 0;
    }
  }

  public function eliminarImagen($con, $inv)
  {
    $ruta = $_SERVER['DOCUMENT_ROOT'].'/wifi/imagenes/aps/';
    $query = "SELECT imagen FROM propiedades WHERE id_inventario = $inv";

    $old_data = mysqli_query($con, $query);
    $old_file = mysqli_fetch_array($old_data);

    if ($old_file['imagen'] != '') {
      unlink($ruta.$old_file['imagen']);
      return 1;
    } else {
      return 0;
    }
  }
}
 ?>

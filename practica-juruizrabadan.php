<?php

Class Mis_funciones {

  /**
  *   Función que comprueba la validez de un DNI introducido
  *
  *   @author Juan Pedro Ruiz Rabadán
  *   @version 1.1
  *
  *   @internal Etiqueta sólo para desarrolladores
  *
  *   @param mixed $valor El DNI que se va a comprobar
  *   @return bool Validez del DNI introducido
  */
  function comprueba_dni($valor) {

      try {

          // Si la longitud no es de 9 caracteres
          if (strlen($valor) != 9) { throw new exception('La longitud del DNI/NIE no es correcta'); }

          $cadena = strtoupper($valor);
          $letra = substr($cadena, -1, 1);
          $numero = substr($cadena, 0, 8);

          // Si es un NIE hay que cambiar la primera letra por 0, 1 ó 2 dependiendo de si es X, Y o Z.
          $numero = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $numero);

          $modulo = $numero % 23;
          $letras_validas = "TRWAGMYFPDXBNJZSQVHLCKE";
          $letra_correcta = substr($letras_validas, $modulo, 1);

          if ($letra_correcta!=$letra){ throw new Exception('El DNI/NIE no es válido'); }

          return true;

      } catch (Exception $error) {
          return $error->getMessage();
      }

  }

  /**
  *   Función que genera un token alfanumérico aleatorio
  *
  *   @author Juan Pedro Ruiz Rabadán
  *   @version 1.0
  *
  *   @param integer $longitud Especifica el número de caracteres que tendrá el token alfanumérico
  *   @return mixed $token Cadena de token alfanumérico
  */
  function genera_token($longitud = 9) {
      $caracteres = array_merge(range(0,9), range('a', 'z'), range('A', 'Z'));
      for ($i=0; $i < $longitud; $i++) {
        $token .= $caracteres[mt_rand(0, count($caracteres) - 1)];
      }
      return $token;

  }

}

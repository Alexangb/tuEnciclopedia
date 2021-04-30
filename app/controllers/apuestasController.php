<?php
require_once 'interfaces/operaciones.php';
class ApuestasController extends Controller implements Operaciones{
	public function index(){
		$this->renderView('apuestas/index');
	}

	public function EsperanzaMatematica($param = null)
	{
		if ($param == null) {
			$val1 = (float)isset($_POST['val1']) ? $_POST['val1'] : '';
			$val2 = (float)isset($_POST['val2']) ? $_POST['val2'] : '';
			$v2 = (float) $val2 / 100;
			$rpta = (float)$val1 * (float)$v2;
		} else {
			$val1 = isset($param[0]) ? $param[0] : '';
			$val2 = isset($param[1]) ? $param[1] : '';
			$v2 = (float) $val2 / 100;
			$rpta = (float) $val1 * (float) $v2;
		}
		if ($rpta < 1) {
			$mbox = "el juego es desfavorables para el apostador ";
		} else {
			$mbox = "el juego es favorable para el apostador";
		}
		$data = [
			'val1' => $val1,
			'val2' => $v2,
			'v2' => $val2,
			'rpta' => $rpta,
			'mbox' => $mbox


		];
		$this->renderView('apuestas/esperanzaMatematica', $data);
	}

	public function casaApuesta($param = null)
	{
		if ($param == null) {
			$val1 = (float)isset($_POST['val1']) ? $_POST['val1'] : '';
			// $val2 = (float)isset($_POST['val2']) ? $_POST['val2'] : '';
			// $v2 = (float) $val2 / 100;
			$rpta = 1 / (float)$val1 * 100;

			$r = round($rpta, 0);
		} else {
			$val1 = isset($param[0]) ? $param[0] : '';
			// $val2 = isset($param[1]) ? $param[1] : '';
			// $v2 = (float) $val2 / 100;
			$rpta = 1 / (float)$val1 * 100;
			$r = round($rpta, 0);
		}
		$mbox = "hay un {$r}% de probavilidad de la casa de apuesta ";
		$data = [
			'val1' => $val1,

			'rpta' => $r,
			'mbox' => $mbox


		];
		$this->renderView('apuestas/casaApuesta', $data);
	}
	public function gananciaNeta($param = null)
	{
		if ($param == null) {
			$val1 = (float)isset($_POST['val1']) ? $_POST['val1'] : '';
			$val2 = (float)isset($_POST['val2']) ? $_POST['val2'] : '';

			$rpta = (float)$val1 * ((float)$val2 - 1);
		} else {
			$val1 = isset($param[0]) ? $param[0] : '';
			$val2 = isset($param[1]) ? $param[1] : '';
			$rpta = (float)$val1 * (float)($val2 - 1);
		}
		$mbox = "la ganancia neta es de {$rpta} soles";
		$data = [
			'val1' => $val1,
			'val2' => $val2,
			'rpta' => $rpta,
			'mbox' => $mbox
		];
		$this->renderView('apuestas/gananciaNeta', $data);
	}
	public function retornoDeInvercion($param = null)
	{
		if ($param == null) {
			$gnta = (float)isset($_POST['val1']) ? $_POST['val1'] : '';
			$intotal = (float)isset($_POST['val2']) ? $_POST['val2'] : '';

			$rpta = (float) $gnta  / (float) $intotal * 100;
		} else {
			$gnta = isset($param[0]) ? $param[0] : '';
			$intotal = isset($param[1]) ? $param[1] : '';

			$rpta = (float) $intotal / (float) $intotal * 100;
		}
		$res = round($rpta, 0);
		$mbox = "el retorno de inversion es de  {$res} centimos";
		$data = [
			'val1' => $gnta,
			'val2' => $intotal,
			'rpta' => $res,
			'mbox' => $mbox
		];
		$this->renderView('apuestas/retornoDeInvercion', $data);
	}
	
	
}
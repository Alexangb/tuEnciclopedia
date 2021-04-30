<?php
class ApuestasController extends Controller{
	public function index(){
		$this->renderView('apuestas/index');
	}

	public function EsperanzaMatematica($param=null){
		if ($param==null) {
			$val1=(float)isset($_POST['val1'])?$_POST['val1']:'';
			$val2=(float)isset($_POST['val2'])? $_POST['val2']:'';
			$v2 =(float) $val2 / 100;
			$rpta=(float)$val1*(float)$v2;

		}else{
			$val1=isset($param[0])? $param[0]:'';
			$val2=isset($param[1])?$param[1]:'';
			$v2=(float) $val2/100;
			$rpta =(float) $val1 *(float) $v2;
		}
		if ($rpta<1) {
			$mbox="el juego es desfavorables para el apostador ";
		}else{
			$mbox="el juego es favorable para el apostador";
		}
		$data=[
			'val1'=>$val1,
			'val2'=>$v2,
			'v2'=>$val2,
			'rpta'=>$rpta,
			'mbox'=>$mbox
			

		];
		$this->renderView('apuestas/esperanzaMatematica',$data);

	}
	
}
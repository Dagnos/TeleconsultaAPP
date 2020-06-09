<?php
class CitaData {
    public static $tablename = "Usuario";
    public static $consultacita = "SS_CC_CITA.FECHACITA, 
    PERSONAMAST.NOMBRECOMPLETO AS IDPACIENTE_NOMBRE, 
    SS_GE_PACIENTE.CODIGOHC, 
    MEDICO.NOMBRECOMPLETO AS MEDICO_NOMBRE, 
    SS_AD_ORDENATENCION.IDORDENATENCION, 
    SS_AD_ORDENATENCION.ESTADODOCUMENTO, 
    SS_GE_ESPECIALIDAD.NOMBRE AS ESPECIALIDAD_NOMBRE, 
    SS_CE_CONSULTAEXTERNA.IDCONSULTAEXTERNAINICIAL, SS_CE_CONSULTAEXTERNA.IDCONSULTAEXTERNA, 
    SS_CE_CONSULTAEXTERNA.ESTADODOCUMENTO, 
    SS_CE_CONSULTAEXTERNA.FECHACONSULTA, 
    SS_AD_ORDENATENCION.CODIGOOA, SS_AD_ORDENATENCION.FECHAINICIO, 
    SS_AD_ORDENATENCION.UNIDADREPLICACION 
    FROM SS_AD_ORDENATENCIONDETALLE 
    LEFT JOIN SS_CC_CITA ON SS_CC_CITA.IDCITA = SS_AD_ORDENATENCIONDETALLE.IDCITA 
    INNER JOIN SS_AD_ORDENATENCION ON SS_AD_ORDENATENCION.IDORDENATENCION = SS_AD_ORDENATENCIONDETALLE.IDORDENATENCION 
    LEFT JOIN SS_CE_CONSULTAEXTERNA ON ( SS_CE_CONSULTAEXTERNA.IDORDENATENCION = SS_AD_ORDENATENCIONDETALLE.IDORDENATENCION AND 
    SS_CE_CONSULTAEXTERNA.LINEAORDENATENCION = SS_AD_ORDENATENCIONDETALLE.LINEA ) 
    INNER JOIN SS_GE_PACIENTE ON SS_AD_ORDENATENCION.IDPACIENTE = SS_GE_PACIENTE.IDPACIENTE INNER JOIN PERSONAMAST ON 
    SS_GE_PACIENTE.IDPACIENTE = PERSONAMAST.PERSONA 
    LEFT JOIN SS_CC_HORARIO ON SS_CC_HORARIO.IDHORARIO = SS_CC_CITA.IDHORARIO 
    LEFT JOIN PERSONAMAST AS MEDICO ON MEDICO.PERSONA = SS_CC_HORARIO.MEDICO 
    LEFT JOIN SS_GE_GRUPOATENCION ON ( SS_GE_GRUPOATENCION.IDGRUPOATENCION = SS_CC_CITA.IDGRUPOATENCION ) 
    LEFT JOIN SS_GE_ESPECIALIDAD ON ( SS_GE_ESPECIALIDAD.IDESPECIALIDAD = SS_AD_ORDENATENCIONDETALLE.ESPECIALIDAD ) 
    LEFT JOIN EMPLEADOMAST ON ( EMPLEADOMAST.EMPLEADO = MEDICO.PERSONA ) 
    LEFT JOIN CM_CA_TRANSACCIONDETALLE ON ( CM_CA_TRANSACCIONDETALLE.IDOAORIGEN = SS_AD_ORDENATENCIONDETALLE.IDORDENATENCION AND CM_CA_TRANSACCIONDETALLE.IDOALINEAORIGEN = SS_AD_ORDENATENCIONDETALLE.LINEA ) 
    LEFT JOIN CM_CA_TRANSACCION ON ( CM_CA_TRANSACCION.IDTRANSACCION = CM_CA_TRANSACCIONDETALLE.IDTRANSACCION) 
    WHERE MEDICO.NOMBRECOMPLETO like '%ALCA%' 
    AND SS_CC_CITA.FECHACITA BETWEEN CONVERT( DATETIME, '2020-06-09 00:00:00', 120) AND CONVERT( DATETIME2, '2020-06-09 23:59:59.999', 120) 
    AND SS_AD_ORDENATENCIONDETALLE.TIPOORDENATENCION = 1 
    AND SS_AD_ORDENATENCION.TIPOATENCION IN (1,3) 
    AND SS_AD_ORDENATENCIONDETALLE.INDICADORDISPONIBLE = 2 
    AND ISNULL(SS_CE_CONSULTAEXTERNA.ESTADODOCUMENTO, 1) = 1 
    AND SS_AD_ORDENATENCION.SUCURSAL = '0001' 
    AND SS_AD_ORDENATENCION.UNIDADNEGOCIO = '0001' 
    AND SS_CC_CITA.ESTADODOCUMENTO IN ( 3, 8, 4 ) 
    AND (CM_CA_TRANSACCION.IDTRANSACCION IS NOT NULL OR SS_AD_ORDENATENCION.IDORDENATENCION = (SELECT SS_HO_HOSPITALIZACION.IDORDENATENCION FROM SS_HO_HOSPITALIZACION WITH(NOLOCK)  WHERE SS_HO_HOSPITALIZACION.IDORDENATENCION = SS_AD_ORDENATENCION.IDORDENATENCION)) 
    AND ISNULL(SS_AD_ORDENATENCIONDETALLE.INDICADOROCULTARCONSULTA,1) = 1 
    AND ISNULL(SS_AD_ORDENATENCIONDETALLE.INDICADORCOBRADO, 1) = 2";


	public function CitaData(){
		$this->FECHACITA = "";
        $this->IDPACIENTE_NOMBRE = "";
        $this->MEDICO_NOMBRE = "";
        $this->IDORDENATENCION = "";
        $this->ESPECIALIDAD_NOMBRE = "";
	}

	public function add(){
		$sql = "insert into intra_user (name,lastname,email,code,password,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->lastname\",\"$this->email\",\"$this->code\",\"$this->password\",$this->created_at)";
		return Executor::doit($sql);
	}

	public function add2(){
		$sql = "insert into intra_user (image,name,lastname,email,username,password,kind,created_at) ";
		$sql .= "value (\"$this->image\",\"$this->name\",\"$this->lastname\",\"$this->email\",\"$this->username\",\"$this->password\",$this->kind,$this->created_at)";
		return Executor::doit($sql);
	}

	public static function delete($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto CitaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",lastname=\"$this->lastname\",username=\"$this->username\",email=\"$this->email\",kind=\"$this->kind\",status=\"$this->status\" where id=$this->id";
		Executor::doit($sql);
	}


	public function update_profile(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",lastname=\"$this->lastname\",bio=\"$this->bio\",address=\"$this->address\",phone=\"$this->phone\" where id=$this->id";
		Executor::doit($sql);
	}


	public function update_email(){
		$sql = "update ".self::$tablename." set email=\"$this->email\" where id=$this->id";	
		Executor::doit($sql);
	}

	public function update_img(){
		$sql = "update ".self::$tablename." set image=\"$this->image\" where id=$this->id";	
		Executor::doit($sql);
	}

	public function activate(){
		$sql = "update ".self::$tablename." set is_active=1 where id=$this->id";	
	Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CitaData());
	}

	public static function getByEmail($email){
		$sql = "select * from ".self::$tablename." where email=\"$email\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CitaData());
	}


	public static function getLogin($email,$password){
		$sql = "select * from ".self::$tablename." where email=\"$email\" and password=\"$password\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CitaData());
	}


	public static function getAll(){
        $sql = "select ".self::$consultacita;
        echo ($sql);
		$query = Executor::doit($sql);
		return Model::many($query[0],new CitaData());

	}

	public static function getInactives(){
		$sql = "select * from ".self::$tablename." where is_active=0";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CitaData());
	}

	public static function getActives(){
		$sql = "select * from ".self::$tablename." where is_active=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CitaData());
	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CitaData());
	}


}

?>
<?php

class Prontuario {
	/*
	 * Inst�ncia de Logger
	 */
	var $log;
	
	/*
	 * Inst�ncia da conex�o com o Banco
	 */
	var $cnn;
	
	/**
	 * Cria instancia de Logger para gerenciar exce��es.
	 */
	function Prontuario($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	function getGrupos($codGrupoSuperior) {
		
		
		$query = "SELECT Cod_Grupo, Nom_Grupo ";
		$query .= "FROM tb_grupo g ";
		$query .= "WHERE ";
		
		if($codGrupoSuperior == null)
			$query .= "Cod_Grupo_Superior IS NULL ";
		else
			$query .= "Cod_Grupo_Superior = " . $codGrupoSuperior . " ";
		
		$query .= "AND Ind_Status = 1 ";
		$query .= "ORDER BY Num_Ordem_Grupo";
		
		$query = mysqli_query($this->cnn, $query);
	
		$listaGrupos = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaGrupos[] = $list;
		}
	
		return $listaGrupos;
	}
	
	//retornar count com a quantidade de categorias relacionadas à pergunta
	function getPerguntas($codGrupo){
		$query = "SELECT Cod_Pergunta, Des_Pergunta, ";
		$query .= "p.Cod_Tipo_Pergunta, Ind_Pergunta_Aberta, Ind_Pergunta_SimNao, ";
		$query .= "Ind_Pergunta_Qual, Ind_Pergunta_Quando, Ind_Pergunta_Outros, ";
		$query .= "Ind_Pergunta_Cite, Ind_Pergunta_Observacao, Ind_Pergunta_ComboBox, ";
		$query .= "Ind_Pergunta_Radio, Ind_Pergunta_CheckBox, Ind_Pergunta_Multi_Combo, ";
		$query .= "(SELECT COUNT(Cod_Item_Multi_Combo) FROM tb_lista_multi_combo WHERE Cod_Categoria_Combo IS NOT NULL AND Cod_Pergunta = p.Cod_Pergunta) ";
		$query .= "FROM tb_pergunta p ";
		$query .= "INNER JOIN tb_tipo_pergunta t ON (p.Cod_Tipo_Pergunta = t.Cod_Tipo_Pergunta) ";
		$query .= "WHERE Cod_Grupo = $codGrupo ";
		$query .= "ORDER BY Num_Ordem_Pergunta ";
		
		$query = mysqli_query($this->cnn, $query);
		
		$listaPerguntas = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaPerguntas[] = $list;
		}
		
		return $listaPerguntas;
	}
	
	function getOpcoesRadio($codPergunta) {
		$query = "SELECT Cod_Item_Radio, Des_Item_Radio, ";
		$query .= "FROM tb_lista_radio l ";
		$query .= "WHERE Cod_Pergunta = $codPergunta";
		
		$query = mysqli_query($this->cnn, $query);
		
		$listaOpcoes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
		
		return $listaOpcoes;
	}
	
	function getOpcoesCombo($codPergunta) {
		$query = "SELECT Cod_Item_Combo, Des_Item_Combo ";
		$query .= "FROM tb_lista_combo_box l ";
		$query .= "WHERE Cod_Pergunta = $codPergunta";
		
		$query = mysqli_query($this->cnn, $query);
		
		$listaOpcoes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
		
		return $listaOpcoes;		
	}
	
	function getOpcoesCheck($codPergunta) {		
		$query = "SELECT Cod_Item_Check, Des_Item_Check ";
		$query .= "FROM tb_lista_check_box l ";
		$query .= "WHERE Cod_Pergunta = $codPergunta";
				
		$query = mysqli_query($this->cnn, $query);
		
		$listaOpcoes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
		
		return $listaOpcoes;
	}
	
	function getRespostasCheck($numProntuario, $codPergunta) {
		$query = "SELECT Cod_Item_Check ";
		$query .= "FROM tb_resposta_checkbox r ";
		$query .= "WHERE Cod_Pergunta = $codPergunta AND Num_Prontuario = $numProntuario";
		
		$query = mysqli_query($this->cnn, $query);
		
		$listaRespostas = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaRespostas[] = $list;
		}
		
		return $listaRespostas;
	}
	
	function getOpcoesMultiCombo($codPergunta){
		$query = "SELECT Cod_Item_Multi_Combo, Des_Item_Multi_Combo ";
		$query .= "FROM tb_lista_multi_combo ";
		$query .= "WHERE Cod_Pergunta = $codPergunta";
		
		$query = mysqli_query($this->cnn, $query);
		
		$listaOpcoes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
		
		return $listaOpcoes;
	}
	
	function getOpcoesMultiComboByCategoria($codCategoriaCombo){
		$query = "SELECT Cod_Item_Multi_Combo, Des_Item_Multi_Combo ";
		$query .= "FROM tb_lista_multi_combo ";
		$query .= "WHERE Cod_Categoria_Combo = $codCategoriaCombo";
	
		$query = mysqli_query($this->cnn, $query);
	
		$listaOpcoes = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
	
		return $listaOpcoes;
	}
	
	function getRespostasMultiCombo($numProntuario, $codPergunta) {
		$query = "SELECT Cod_Item_Multi_Combo ";
		$query .= "FROM tb_resposta_multi_combo r ";
		$query .= "WHERE Cod_Pergunta = $codPergunta AND Num_Prontuario = $numProntuario";
	
		$query = mysqli_query($this->cnn, $query);
	
		$listaRespostas = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaRespostas[] = $list;
		}
	
		return $listaRespostas;
	}
	
	function getRespostas($numProntuario) {
		$query = "SELECT ";
		$query .= "r.Cod_Resposta_Prontuario, ";
		$query .= "r.Num_Prontuario, ";
		$query .= "r.Cod_Pergunta, ";
		$query .= "r.Des_Resposta_Aberta, ";
		$query .= "r.Ind_Resposta_SimNao, ";
		$query .= "r.Des_Resposta_Qual, ";
		$query .= "r.Des_Resposta_Quando, ";
		$query .= "r.Des_Resposta_Outros, ";
		$query .= "r.Des_Resposta_Cite, ";
		$query .= "r.Des_Resposta_Observacao, ";
		$query .= "r.Cod_Resposta_ComboBox, ";
		$query .= "r.Cod_Resposta_Radio, ";
		$query .= "t.Cod_Tipo_Pergunta, ";
		$query .= "t.Ind_Pergunta_Aberta, ";
		$query .= "t.Ind_Pergunta_SimNao, ";
		$query .= "t.Ind_Pergunta_Qual, ";
		$query .= "t.Ind_Pergunta_Quando, ";
		$query .= "t.Ind_Pergunta_Outros, ";
		$query .= "t.Ind_Pergunta_Cite, ";
		$query .= "t.Ind_Pergunta_Observacao, ";
		$query .= "t.Ind_Pergunta_ComboBox, ";
		$query .= "t.Ind_Pergunta_Radio, ";
		$query .= "t.Ind_Pergunta_CheckBox, ";
		$query .= "t.Ind_Pergunta_Multi_Combo ";
		$query .= "FROM tb_resposta AS r ";
		$query .= "INNER JOIN tb_pergunta AS p ON (r.Cod_Pergunta = p.Cod_Pergunta) ";
		$query .= "INNER JOIN tb_tipo_pergunta AS t ON p.Cod_Tipo_Pergunta = t.Cod_Tipo_Pergunta ";
		$query .= "WHERE r.Num_Prontuario = $numProntuario";
		
		$query = mysqli_query($this->cnn, $query);
		
		$listaRespostas = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			
			if($list['Ind_Pergunta_CheckBox']) {
				$list['Lista_Resposta_CheckBox'] = $this->getRespostasCheck($list['Num_Prontuario'], $list['Cod_Pergunta']);
			}
			else if($list['Ind_Pergunta_Multi_Combo']) {
				$list['Lista_Resposta_Multi_Combo'] = $this->getRespostasMultiCombo($list['Num_Prontuario'], $list['Cod_Pergunta']);
			}
			
			$listaRespostas[] = $list;
		}
		
		return $listaRespostas;		
	}
	
	
	function insertProntuario($codCliente) {
		try {		
			$query = "INSERT INTO tb_prontuario (Dta_Data_Prontuario, Cod_Cliente, Cod_Avaliador, Val_Pontuacao, Val_Tempo_Gasto) ";
			$query .= "VALUES (now(), $codCliente, NULL, NULL, NULL)";			
	
			if (mysqli_query($this->cnn, $query)) {
				return mysqli_insert_id($this->cnn);
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	function insertRespostas($codCliente, $listaRespostas) {		
		$retorno = array();
		
		try {
			
			$numProntuario = $this->insertProntuario($codCliente);
			
			for ($i = 0; $i < sizeof($listaRespostas); $i++) {
				$r = $listaRespostas[$i];
				
				$this->insertResposta($numProntuario, $r['Cod_Pergunta'], $r['Respostas']);
			}			
			
			$retorno['Sucesso'] = true;
			$retorno['Mensagem'] = "Dados inseridos com sucesso";
			$retorno['NumProntuario'] = $numProntuario;
			$retorno['CodCliente'] = $codCliente;
			
		} catch (Exception $e) {
			$msg = "Falha ao inserir respostas. Mensagem de erro: " . mysqli_error($this->cnn);
			$this->log->logError($this,$msg);			
			
			$retorno['Sucesso'] = false;			
			$retorno['Mensagem'] = "Falha ao inserir respostas";
		}
		
		return $retorno;
	}
	
	function insertResposta($numProntuario, $codPergunta, $respostas){
		try {		
			$desRespAberta = "NULL";
			$indRespSimNao = "NULL";
			$desRespQual = "NULL";
			$desRespQuando = "NULL";
			$desRespOutros = "NULL";
			$desRespCite = "NULL";
			$desRespObs = "NULL";
			$CodRespCombo = "NULL";
			$CodRespRadio = "NULL";
			
			for ($i = 0; $i < sizeof($respostas); $i++) {
				$r = $respostas[$i];
				
				if($r['TipoPergunta'] == "Ind_Pergunta_Aberta"){
					$desRespAberta = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_SimNao") {
					$indRespSimNao = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_Qual") {	
					$desRespQual = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_Quando") {
					$desRespQuando = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_Outros") {
					$desRespOutros = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_Cite") {
					$desRespCite = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_Observacao") {
					$desRespObs = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_ComboBox") {
					$CodRespCombo = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_Radio") {
					$CodRespRadio = $r['Valor'];
				} else if($r['TipoPergunta'] == "Ind_Pergunta_CheckBox") {	
					for ($i = 0; $i < sizeof($r['Valor']); $i++) {
						$r = $r['Valor'][$i];
						insertRespostaCheckBox($numProntuario, $codPergunta, $r);
					}
				} else if($r['TipoPergunta'] == "Ind_Pergunta_Multi_Combo") {	
					for ($i = 0; $i < sizeof($r['Valor']); $i++) {
						$r = $r['Valor'][$i];
						insertRespostaMultiCombo($numProntuario, $codPergunta, $r);
					}
				}	
			}
			
			$query = "INSERT INTO tb_resposta ";
			$query .= "(Num_Prontuario,  ";
			$query .= "Cod_Pergunta,  ";
			$query .= "Des_Resposta_Aberta,  ";
			$query .= "Ind_Resposta_SimNao,  ";
			$query .= "Des_Resposta_Qual,  ";
			$query .= "Des_Resposta_Quando,  ";
			$query .= "Des_Resposta_Outros,  ";
			$query .= "Des_Resposta_Cite,  ";
			$query .= "Des_Resposta_Observacao,  ";
			$query .= "Cod_Resposta_ComboBox,  ";
			$query .= "Cod_Resposta_Radio) ";
			$query .= "VALUES ";
			$query .= "('".$numProntuario."', ";
			$query .= "'".$codPergunta."',  ";
			$query .= "'".$desRespAberta."',  ";
			$query .= "'".$indRespSimNao."',  ";
			$query .= "'".$desRespQual."',  ";
			$query .= "'".$desRespQuando."',  ";
			$query .= "'".$desRespOutros."',  ";
			$query .= "'".$desRespCite."',  ";
			$query .= "'".$desRespObs."',  ";
			$query .= "'".$CodRespCombo."',  ";
			$query .= "'".$CodRespRadio."'); ";	
			
			if (!mysqli_query($this->cnn, $query))
				throw new Exception();
			
		} catch (Exception $e) {			
			throw $e;
		}		
	}
	
	function insertRespostaCheckBox($numProntuario, $codPergunta, $Cod_Item_Check){
		try {
			$query = "INSERT INTO tb_resposta_checkbox ";
			$query .= "(Num_Prontuario,  ";
			$query .= "Cod_Pergunta,  ";
			$query .= "Cod_Item_Check,  ";
			$query .= "Ind_CheckBox)  ";
			$query .= "VALUES ";
			$query .= "('".$numProntuario."', ";
			$query .= "'".$codPergunta."',  ";
			$query .= "'".$Cod_Item_Check."',  ";
			$query .= "'".'true'."';  ";
				
			if (!mysqli_query($this->cnn, $query))
				throw new Exception();
		} catch (Exception $e) {			
			throw $e;
		}	
	}
	
	function insertRespostaMultiCombo($numProntuario, $codPergunta, $Cod_Item_Multi_Combo){
		try {
			$query = "INSERT INTO tb_resposta_multi_combo ";
			$query .= "(Num_Prontuario,  ";
			$query .= "Cod_Pergunta,  ";
			$query .= "Cod_Item_Multi_Combo) ";
			$query .= "VALUES ";
			$query .= "('".$numProntuario."', ";
			$query .= "'".$codPergunta."',  ";
			$query .= "'".$Cod_Item_Multi_Combo."',  ";
			$query .= "'".'true'."';  ";
			
			if (!mysqli_query($this->cnn, $query))
				throw new Exception();
			
		} catch (Exception $e) {
			throw $e;
		}
	}
	
}

?>
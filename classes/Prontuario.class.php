<?php

class Prontuario {
	/*
	 * Instância de Logger
	 */
	var $log;
	
	/*
	 * Instância da conexão com o Banco
	 */
	var $cnn;
	
	/**
	 * Cria instancia de Logger para gerenciar exceções.
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
		
		$query .= "ORDER BY Num_Ordem_Grupo";
		
		$query = mysqli_query($this->cnn, $query);
	
		$listaGrupos = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaGrupos[] = $list;
		}
	
		return $listaGrupos;
	}
	
	function getPerguntas($codGrupo){
		$query = "SELECT Cod_Pergunta, Des_Pergunta, ";
		$query .= "p.Cod_Tipo_Pergunta, Ind_Pergunta_Aberta, Ind_Pergunta_SimNao, ";
		$query .= "Ind_Pergunta_Qual, Ind_Pergunta_Quando, Ind_Pergunta_Outros, ";
		$query .= "Ind_Pergunta_Cite, Ind_Pergunta_Observacao, ind_Pergunta_ComboBox, ";
		$query .= "Ind_Pergunta_Radio, Ind_Pergunta_CheckBox ";
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
		$query = "SELECT Cod_Item_Combo, Des_Item_Combo, ";
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
		$query = "SELECT Cod_Item_Check, Des_Item_Check, ";
		$query .= "FROM tb_lista_check_box l ";
		$query .= "WHERE Cod_Pergunta = $codPergunta";
		
		$query = mysqli_query($query);
		
		$listaOpcoes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
		
		return $listaOpcoes;
	}
	
	function getRespostasCheck() {
		
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
		$query .= "t.ind_Pergunta_ComboBox, ";
		$query .= "t.Ind_Pergunta_Radio, ";
		$query .= "t.Ind_Pergunta_CheckBox ";
		$query .= "FROM tb_resposta AS r ";
		$query .= "INNER JOIN tb_pergunta AS p ON (r.Cod_Pergunta = p.Cod_Pergunta) ";
		$query .= "INNER JOIN tb_tipo_pergunta AS t ON p.Cod_Tipo_Pergunta = t.Cod_Tipo_Pergunta ";
		$query .= "WHERE r.Num_Prontuario = $numProntuario";
		
		$query = mysqli_query($this->cnn, $query);
		
		$listaRespostas = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaRespostas[] = $list;
		}
		
		return $listaRespostas;		
	}
	
}

?>
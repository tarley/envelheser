<?php

class Prontuario {
	/*
	 * Instância de Logger
	 */
	var $log;
	
	/**
	 * Cria instancia de Logger para gerenciar exceções.
	 */
	function Prontuario() {
		$this->log = new Logger();
	}
	
	function getGrupos($cnn) {
		$query = "SELECT Cod_Grupo, Nom_Grupo ";
		$query .= "FROM tb_grupo g ORDER BY Num_Ordem_Grupo";
	
		$query = mysqli_query($cnn, $query);
	
		$listaGrupos = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaGrupos[] = $list;
		}
	
		return $listaGrupos;
	}
	
	function getPerguntas($cnn, $codGrupo){
		$query = "SELECT Cod_Pergunta, Des_Pergunta, ";
		$query .= "p.Cod_Tipo_Pergunta, Ind_Pergunta_Aberta, Ind_Pergunta_SimNao, ";
		$query .= "Ind_Pergunta_Qual, Ind_Pergunta_Quando, Ind_Pergunta_Outros, ";
		$query .= "Ind_Pergunta_Cite, Ind_Pergunta_Observacao, ind_Pergunta_ComboBox, ";
		$query .= "Ind_Pergunta_Radio, Ind_Pergunta_CheckBox ";
		$query .= "FROM tb_pergunta p ";
		$query .= "INNER JOIN tb_tipo_pergunta t ON (p.Cod_Tipo_Pergunta = t.Cod_Tipo_Pergunta) ";
		$query .= "WHERE Cod_Grupo = '$codGrupo' ";
		$query .= "ORDER BY Num_Ordem_Pergunta ";
		
		$query = mysqli_query($cnn, $query);
		
		$listaPerguntas = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaPerguntas[] = $list;
		}
		
		return $listaPerguntas;
	}
	
	function getOpcoesRadio($cnn, $codPergunta) {
		$query = "SELECT Cod_Item_Radio, Des_Item_Radio, ";
		$query .= "FROM tb_lista_radio l ";
		$query .= "WHERE Cod_Pergunta = '$codPergunta'";
		
		$query = mysqli_query($cnn, $query);
		
		$listaOpcoes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
		
		return $listaOpcoes;
	}
	
	function getOpcoesCombo($cnn, $codPergunta) {
		$query = "SELECT Cod_Item_Combo, Des_Item_Combo, ";
		$query .= "FROM tb_lista_combo_box l ";
		$query .= "WHERE Cod_Pergunta = '$codPergunta'";
		
		$query = mysqli_query($cnn, $query);
		
		$listaOpcoes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
		
		return $listaOpcoes;		
	}
	
	function getOpcoesCheck($cnn, $codPergunta) {
		$query = "SELECT Cod_Item_Check, Des_Item_Check, ";
		$query .= "FROM tb_lista_check_box l ";
		$query .= "WHERE Cod_Pergunta = '$codPergunta'";
		
		$query = mysqli_query($cnn, $query);
		
		$listaOpcoes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOpcoes[] = $list;
		}
		
		return $listaOpcoes;
	}
	
	
	function getDados($cnn, $numProntuario) {
		
	}
	
}

?>
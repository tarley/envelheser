/*==============================================================*/
/* Inclusão na tabela Escolaridade                              */
/*==============================================================*/
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('Ensino Superior Incompleto');

/*==============================================================*/
/* Inclusão na tabela Naturalidade                              */
/*==============================================================*/
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Belo horizonte');

/*==============================================================*/
/* Inclusão na tabela Ocupação                                  */
/*==============================================================*/
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Estudante');

/*==============================================================*/
/* Inclusão na tabela Estado Civil                              */
/*==============================================================*/
INSERT INTO	tb_estado_civil (Nom_Estado_Civil) VALUES ('Solteiro');

/*==============================================================*/
/* Inclusão na tabela Tipo telefone                             */
/*==============================================================*/
INSERT INTO	tb_tipo_telefone (Des_Tipo_Telefone) VALUES ('92366919');

/*==============================================================*/
/* Inclusão na tabela Cor                                       */
/*==============================================================*/
INSERT INTO	tb_cor (Nom_Cor) VALUES ('Moreno');

/*==============================================================*/
/* Inclusão de um cliente                                      */
/*==============================================================*/
INSERT INTO TB_Cliente (
Nom_Cliente,
Dta_Nascimento,
Num_Rg,
Des_Endereco,
Ind_Sexo,
Num_Filhos,
Cod_Cor,
Cod_Escolaridade,
Cod_Ocupacao,
Cod_Estado_Civil,
Cod_Naturalidade)
VALUES('Carlos', '1992/02/12', '11111111', 'Santa Luzia', 'M', 0, 1, 1, 1, 1, 1);

/*==============================================================*/
/* Inclusão de um prontuario de um cliente                      */
/*==============================================================*/
INSERT INTO TB_Prontuario(
Dta_Data_Prontuario,
Cod_Cliente
)VALUES('2016/04/05', 1);

/*==============================================================*/
/* Inclusão na tabela Questioario                               */
/*==============================================================*/
INSERT INTO TB_Questionario(
Nom_Questionario
)VALUES('Questionário 1');

/*==============================================================*/
/* Inclusão na tabela Grupo                                     */
/*==============================================================*/
INSERT INTO TB_Grupo(
Nom_Grupo,
Cod_Grupo_Superior
)VALUES('Grupo 1', null);

/*==============================================================*/
/* Inclusão na tabela Tipo de Pergunta                          */
/*==============================================================*/
INSERT INTO TB_Tipo_Pergunta (
Ind_Pergunta_Aberta,
Ind_Pergunta_SimNao,
Ind_Pergunta_Qual,
Ind_Pergunta_Quando,
Ind_Pergunta_Outros,
Ind_Pergunta_Cite,
Ind_Pergunta_observacao,
Ind_Pergunta_ComboBox,
Ind_Pergunta_Radio,
Ind_Pergunta_CheckBox
) VALUES (0,1,0,0,0,0,0,0,0,0);


/*==============================================================*/
/* Inclusão na tabela Pergunta                                  */
/*==============================================================*/
INSERT INTO TB_Pergunta (
Des_Pergunta,
Cod_Tipo_Pergunta, 
Cod_Questionario,
Cod_Grupo
) values ('Estuda na Newton?', 1, 1, 1);

/*==============================================================*/
/* Inclusão na tabela TB_Lista_Radio                            */
/*==============================================================*/
INSERT INTO TB_Lista_Radio (
Des_Item_Radio, 
Cod_Pergunta
) values ('Estuda na Newton?', 1);

/*==============================================================*/
/* Inclusão na tabela TB_Resposta                           */
/*==============================================================*/
INSERT INTO TB_resposta (

Cod_Pergunta,
Num_Prontuario,
Ind_Resposta_SimNao
)VALUES (1,1,1);










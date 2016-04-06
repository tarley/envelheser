/*==============================================================*/
/* Inclusão na tabela Escolaridade                              */
/*==============================================================*/

INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('2º Ano Primário');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('6ª Série');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('3ª Gráu');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('3ª Primario');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('Fundamental Completo');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('Fundamental Incompleto');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('Superior Completo');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('Superior Incompleto');

/*==============================================================*/
/* Inclusão na tabela Naturalidade                              */
/*==============================================================*/

INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Itamanandiba');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('São José Jacuri');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Itamuri');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Bom Despacho');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Belo Horizonte');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Divinópolis');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Conselheiro Lafaiete');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Cláudio');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Sabará');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Santa Lúzia');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Carmopolis de Minas');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Alto Rio Doce');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Abaeté');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Brumadinho');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Caeté');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Viçosa');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Virginópolis');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Uberaba');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Uberlândia');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Tiradentes');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Timóteo');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Tiradentes');


/*==============================================================*/
/* Inclusão na tabela Ocupação                                  */
/*==============================================================*/
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Doméstica');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Salgadeiro');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Aposentado');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Análista de Sistemas');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Autônomo');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Desempregado');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Diarista');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Advogado');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Táxista');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Médico');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Estudante');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Programador');

/*==============================================================*/
/* Inclusão na tabela Estado Civil                              */
/*==============================================================*/
INSERT INTO	tb_estado_civil (Nom_Estado_Civil) VALUES ('Casado');
INSERT INTO	tb_estado_civil (Nom_Estado_Civil) VALUES ('Solteiro');
INSERT INTO	tb_estado_civil (Nom_Estado_Civil) VALUES ('Viúvo');
INSERT INTO	tb_estado_civil (Nom_Estado_Civil) VALUES ('Divorciado');

/*==============================================================*/
/* Inclusão na tabela Tipo telefone                             */
/*==============================================================*/
INSERT INTO	tb_tipo_telefone (Des_Tipo_Telefone) VALUES ('Residencial');
INSERT INTO	tb_tipo_telefone (Des_Tipo_Telefone) VALUES ('Comercial');
INSERT INTO	tb_tipo_telefone (Des_Tipo_Telefone) VALUES ('Celular');

/*==============================================================*/
/* Inclusão na tabela Cor                                       */
/*==============================================================*/
INSERT INTO	tb_cor (Nom_Cor) VALUES ('Negro');
INSERT INTO	tb_cor (Nom_Cor) VALUES ('Moreno');
INSERT INTO	tb_cor (Nom_Cor) VALUES ('Branco');
INSERT INTO	tb_cor (Nom_Cor) VALUES ('Pardo');
INSERT INTO	tb_cor (Nom_Cor) VALUES ('Indefinido');

/*==============================================================*/
/* Inclusão na tabela Cliente                                  */
/*==============================================================*/

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(5, 1, 1, 1, 1, 'Luiza Freitas da Silva', 'F', '1946/11/10', 2, 'R. Fernandes , 203, Vila São Jorge');

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(1, 3, 2, 2, 4, 'Carlos Henrique', 'M', '1991/11/10', 0, 'R. Ouro Preto , 400, Londrina');

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(4, 2, 1, 3, 1, 'Bruno Sartori', 'M', '1999/07/28', 10, 'R. dos Apae , 69, Londrina');

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(2, 2, 2, 2, 8, 'Marcos dos Santos', 'M', '1959/07/01', 3, 'R. José , 649, Estoril');

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(1, 2, 2, 2, 5, 'Maria de Oliveira', 'M', '1969/04/12', 5, 'R. José , 49, Ouro Preto');

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(1, 1, 1, 2, 9, 'Iraci Gonçalves da Silva', 'M', '1933/01/30', 6, 'R. Fernandes , 203, Vila São Jorge');

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(2, 2, 3, 1, 3, 'José Benedito Ferreira', 'M', '1943/04/05', 5, 'R. Santa Rosa, 80, São Jorge');

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(3, 3, 3, 3, 4, 'Zeli Aparecida Rodrigues Cerquei', 'F', '1942/08/25', 2, 'R. Marechal Bitencourt, 980');

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(4, 4, 2, 1, 5, 'Eva Gonçalves dos Anjos', 'F', '1947/05/17', 3, 'R. Santa Inês, 125, Morro das Pedras');

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3334-4954',1,1);

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3334-4954',2,1);

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3371-4174',3,1);

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3332-8843',4,1);

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('8307-0770',4,3);

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3371-8804',5,1);

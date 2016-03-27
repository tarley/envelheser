
/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     09/03/2016 07:50:51                          */
/*==============================================================*/

create database BD_ENVELHESER

/*==============================================================*/
/* Table: TB_Cliente                                            */
/*==============================================================*/

create table TB_Cliente
(
   Cod_Cliente          int not null auto_increment PRIMARY KEY,
   Cod_Cor              tinyint not null,
   Cod_Escolaridade     tinyint not null,
   Cod_Ocupacao         smallint not null,
   Cod_Estado_Civil     tinyint not null,
   Cod_Naturalidade     smallint not null,
   Nom_Cliente          varchar(150) not null,
   Ind_Sexo             char(1) not null,
   Dta_Nascimento       datetime not null,
   Num_Filhos           tinyint not null,
   Des_Endereco         varchar(150) not null
);

/*==============================================================*/
/* Table: TB_Cor                                                */
/*==============================================================*/
create table TB_Cor
(
   Cod_Cor              tinyint not null auto_increment PRIMARY KEY,
   Nom_Cor              varchar(15)
);

/*==============================================================*/
/* Table: TB_Escolaridade                                       */
/*==============================================================*/
create table TB_Escolaridade
(
   Cod_Escolaridade     tinyint not null auto_increment PRIMARY KEY,
   Nom_Escolaridade     varchar(100)
);

/*==============================================================*/
/* Table: TB_Estado_Civil                                       */
/*==============================================================*/
create table TB_Estado_Civil
(
   Cod_Estado_Civil     tinyint not null auto_increment PRIMARY KEY,
   Nom_Estado_Civil     varchar(15)
);

/*==============================================================*/
/* Table: TB_Naturalidade                                       */
/*==============================================================*/
create table TB_Naturalidade
(
   Cod_Naturalidade     smallint not null auto_increment PRIMARY KEY,
   Nom_Naturalidade     varchar(50)
);

/*==============================================================*/
/* Table: TB_Ocupacao                                           */
/*==============================================================*/
create table TB_Ocupacao
(
   Cod_Ocupacao         smallint not null auto_increment PRIMARY KEY,
   Nom_Ocupacao         varchar(100)
);

/*==============================================================*/
/* Table: TB_Telefone                                           */
/*==============================================================*/
create table TB_Telefone
(
   Cod_Telefone         int not null auto_increment PRIMARY KEY,
   Num_Telefone         varchar(15) not null,
   Cod_Cliente          int not null,
   Cod_Tipo_Telefone    int not null
);

/*==============================================================*/
/* Table: TB_Tipo_Telefone                                      */
/*==============================================================*/
create table TB_Tipo_Telefone
(
   Cod_Tipo_Telefone    int not null auto_increment PRIMARY KEY,
   Des_Tipo_Telefone    varchar(20)
);


alter table TB_Cliente add constraint FK_FK_Cor_Cliente foreign key (Cod_Cor)
      references TB_Cor (Cod_Cor);

alter table TB_Cliente add constraint FK_FK_Escolaridade_Cliente foreign key (Cod_Escolaridade)
      references TB_Escolaridade (Cod_Escolaridade);

alter table TB_Cliente add constraint FK_FK_Estado_Civil_Cliente foreign key (Cod_Estado_Civil)
      references TB_Estado_Civil (Cod_Estado_Civil);

alter table TB_Cliente add constraint FK_FK_Naturalidade_Cliente foreign key (Cod_Naturalidade)
      references TB_Naturalidade (Cod_Naturalidade);

alter table TB_Cliente add constraint FK_FK_Ocupacao_Cliente foreign key (Cod_Ocupacao)
      references TB_Ocupacao (Cod_Ocupacao);

alter table TB_Telefone add constraint FK_FK_Telefone_Cliente foreign key (Cod_Cliente)
      references TB_Cliente (Cod_Cliente);

alter table TB_Telefone add constraint FK_FK_Tipo_Telefone foreign key (Cod_Tipo_Telefone)
      references TB_Tipo_Telefone (Cod_Tipo_Telefone);
	  
/*==============================================================*/
/* Inclusão na tabela Escolaridade                              */
/*==============================================================*/

INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('2º ano primário');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('6ª série');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('3º grau');
INSERT INTO	tb_escolaridade (Nom_Escolaridade) VALUES ('3º primário');

/*==============================================================*/
/* Inclusão na tabela Naturalidade                              */
/*==============================================================*/

INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Itamanandiba');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('São José Jacuri');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Itamuri');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Bom Despacho');
INSERT INTO	tb_naturalidade (Nom_Naturalidade) VALUES ('Aracui');

/*==============================================================*/
/* Inclusão na tabela Ocupação                                  */
/*==============================================================*/
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Doméstica');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Salgadeiro');
INSERT INTO	tb_ocupacao (Nom_Ocupacao) VALUES ('Aposentado');

/*==============================================================*/
/* Inclusão na tabela Estado Civil                              */
/*==============================================================*/
INSERT INTO	tb_estado_civil (Nom_Estado_Civil) VALUES ('Casado');
INSERT INTO	tb_estado_civil (Nom_Estado_Civil) VALUES ('Solteiro');
INSERT INTO	tb_estado_civil (Nom_Estado_Civil) VALUES ('Viuvo');

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
VALUES(1, 1, 1, 2, 2, 'Iraci Gonçalves da Silva', 'M', '1933/01/30', 6, 'R. Fernandes , 203, Vila São Jorge');

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

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3371-8804',5,3);

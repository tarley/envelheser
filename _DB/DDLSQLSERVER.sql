/*==============================================================*/
/* DBMS name:      Microsoft SQL Server 2008                    */
/* Created on:     09/03/2016 07:49:01                          */
/*==============================================================*/

---------------------------------------------------------------
-- CRIA O BANCO DE DADOS BD_ENVELHESER
---------------------------------------------------------------
use master  
go
IF DB_ID ('BD_ENVELHESER') IS NOT NULL
    drop database BD_ENVELHESER;
go

create database BD_ENVELHESER
go

/*==============================================================*/
/* Table: TB_Cliente                                            */
/*==============================================================*/

use BD_ENVELHESER
go

create table TB_Cliente (
   Cod_Cliente          int                  identity(1,1) not for replication,
   Cod_Cor              tinyint              not null,
   Cod_Escolaridade     tinyint              not null,
   Cod_Ocupacao         smallint             not null,
   Cod_Estado_Civil     tinyint              not null,
   Cod_Naturalidade     smallint             not null,
   Nom_Cliente          varchar(150)         not null,
   Ind_Sexo             char(1)              not null,
   Dta_Nascimento       datetime             not null,
   Num_Filhos           tinyint              not null,
   Des_Endereco         varchar(150)         not null
)
go

alter table TB_Cliente
   add constraint PK_TB_CLIENTE primary key nonclustered (Cod_Cliente)
go

/*==============================================================*/
/* Table: TB_Cor                                                */
/*==============================================================*/
create table TB_Cor (
   Cod_Cor              tinyint              identity(1,1),
   Nom_Cor              varchar(15)          null
)
go

alter table TB_Cor
   add constraint PK_TB_COR primary key nonclustered (Cod_Cor)
go

/*==============================================================*/
/* Table: TB_Escolaridade                                       */
/*==============================================================*/
create table TB_Escolaridade (
   Cod_Escolaridade     tinyint              identity(1,1),
   Nom_Escolaridade     varchar(100)         null
)
go

alter table TB_Escolaridade
   add constraint PK_TB_ESCOLARIDADE primary key nonclustered (Cod_Escolaridade)
go

/*==============================================================*/
/* Table: TB_Estado_Civil                                       */
/*==============================================================*/
create table TB_Estado_Civil (
   Cod_Estado_Civil     tinyint              identity(1,1),
   Nom_Estado_Civil     varchar(15)          null
)
go

alter table TB_Estado_Civil
   add constraint PK_TB_ESTADO_CIVIL primary key nonclustered (Cod_Estado_Civil)
go

/*==============================================================*/
/* Table: TB_Naturalidade                                       */
/*==============================================================*/
create table TB_Naturalidade (
   Cod_Naturalidade     smallint             identity(1,1),
   Nom_Naturalidade     varchar(50)          null
)
go

alter table TB_Naturalidade
   add constraint PK_TB_NATURALIDADE primary key nonclustered (Cod_Naturalidade)
go

/*==============================================================*/
/* Table: TB_Ocupacao                                           */
/*==============================================================*/
create table TB_Ocupacao (
   Cod_Ocupacao         smallint             identity(1,1),
   Nom_Ocupacao         varchar(100)         null
)
go

alter table TB_Ocupacao
   add constraint PK_TB_OCUPACAO primary key nonclustered (Cod_Ocupacao)
go

/*==============================================================*/
/* Table: TB_Telefone                                           */
/*==============================================================*/
create table TB_Telefone (
   Cod_Telefone         int                  identity(1,1),
   Num_Telefone         varchar(15)          not null,
   Cod_Cliente          int                  not null,
   Cod_Tipo_Telefone    int                  not null
)
go

alter table TB_Telefone
   add constraint PK_TB_TELEFONE primary key nonclustered (Cod_Telefone)
go

/*==============================================================*/
/* Table: TB_Tipo_Telefone                                      */
/*==============================================================*/
create table TB_Tipo_Telefone (
   Cod_Tipo_Telefone    int                  identity(1,1),
   Des_Tipo_Telefone    varchar(20)          null
)
go

alter table TB_Tipo_Telefone
   add constraint PK_TB_TIPO_TELEFONE primary key nonclustered (Cod_Tipo_Telefone)
go

alter table TB_Cliente
   add constraint FK_TB_CLIEN_FK_COR_CL_TB_COR foreign key (Cod_Cor)
      references TB_Cor (Cod_Cor)
go

alter table TB_Cliente
   add constraint FK_TB_CLIEN_FK_ESCOLA_TB_ESCOL foreign key (Cod_Escolaridade)
      references TB_Escolaridade (Cod_Escolaridade)
go

alter table TB_Cliente
   add constraint FK_TB_CLIEN_FK_ESTADO_TB_ESTAD foreign key (Cod_Estado_Civil)
      references TB_Estado_Civil (Cod_Estado_Civil)
go

alter table TB_Cliente
   add constraint FK_TB_CLIEN_FK_NATURA_TB_NATUR foreign key (Cod_Naturalidade)
      references TB_Naturalidade (Cod_Naturalidade)
go

alter table TB_Cliente
   add constraint FK_TB_CLIEN_FK_OCUPAC_TB_OCUPA foreign key (Cod_Ocupacao)
      references TB_Ocupacao (Cod_Ocupacao)
go

alter table TB_Telefone
   add constraint FK_TB_TELEF_FK_TELEFO_TB_CLIEN foreign key (Cod_Cliente)
      references TB_Cliente (Cod_Cliente)
go

alter table TB_Telefone
   add constraint FK_TB_TELEF_FK_TIPO_T_TB_TIPO_ foreign key (Cod_Tipo_Telefone)
      references TB_Tipo_Telefone (Cod_Tipo_Telefone)
go

	  
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
/* Inclusão na tabela cLIENTE                                   */
/*==============================================================*/

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(5, 1, 1, 1, 1, 'Luiza Freitas da Silva', 'F', '11/10/1946', 2, 'R. Fernandes , 203, Vila São Jorge')
go

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(1, 1, 1, 2, 2, 'Iraci Gonçalves da Silva', 'M', '01/30/1933', 6, 'R. Fernandes , 203, Vila São Jorge')
go

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(2, 2, 3, 1, 3, 'José Benedito Ferreira', 'M', '04/05/1943', 5, 'R. Santa Rosa, 80, São Jorge')
go

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(3, 3, 3, 3, 4, 'Zeli Aparecida Rodrigues Cerquei', 'F', '08/25/1942', 2, 'R. Marechal Bitencourt, 980')
go

INSERT INTO tb_cliente (Cod_Cor, Cod_Escolaridade, Cod_Ocupacao, Cod_Estado_Civil, Cod_Naturalidade, Nom_Cliente, Ind_Sexo, Dta_Nascimento, Num_Filhos, Des_Endereco)
VALUES(4, 4, 2, 1, 5, 'Eva Gonçalves dos Anjos', 'F', '05/17/1947', 3, 'R. Santa Inês, 125, Morro das Pedras')
go

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3334-4954',1,1)
go

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3334-4954',2,1)
go

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3371-4174',3,1)
go

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3332-8843',4,1)
go

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('8307-0770',4,3)
go

INSERT INTO TB_Telefone (Num_Telefone, Cod_Cliente, Cod_Tipo_Telefone) VALUES ('3371-8804',5,3)
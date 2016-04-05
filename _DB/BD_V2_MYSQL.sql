/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     04/04/2016 07:34:43                          */
/*==============================================================*/


/*==============================================================*/
/* Table: TB_Cliente                                            */
/*==============================================================*/
create table TB_Cliente
(
   Cod_Cliente          int not null auto_increment PRIMARY KEY,
   Nom_Cliente          varchar(100) not null,
   Dta_Nascimento       datetime not null,
   Num_Rg               varchar(15),
   Des_Endereco         varchar(150) not null,
   Ind_Sexo             char(1) not null,
   Num_Filhos           tinyint not null,
   Cod_Cor              tinyint not null,
   Cod_Escolaridade     tinyint not null,
   Cod_Ocupacao         smallint not null,
   Cod_Estado_Civil     tinyint not null,
   Cod_Naturalidade     smallint not null
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
/* Table: TB_Grupo                                              */
/*==============================================================*/
create table TB_Grupo
(
   Cod_Grupo            tinyint not null auto_increment PRIMARY KEY,
   Nom_Grupo            varchar(100) not null,
   Cod_Grupo_Superior   tinyint
);


/*==============================================================*/
/* Table: TB_Lista_Check_Box                                    */
/*==============================================================*/
create table TB_Lista_Check_Box
(
   Cod_Item_Check       smallint not null auto_increment PRIMARY KEY,
   Des_Item_Check       varchar(50) not null,
   Cod_Pergunta         smallint not null
);

/*==============================================================*/
/* Table: TB_Lista_Combo_Box                                    */
/*==============================================================*/
create table TB_Lista_Combo_Box
(
   Cod_Item_Combo       smallint not null auto_increment PRIMARY KEY,
   Des_Item_Combo       varchar(50) not null,
   Cod_Pergunta         smallint not null
);

/*==============================================================*/
/* Table: TB_Lista_Radio                                        */
/*==============================================================*/
create table TB_Lista_Radio
(
   Cod_Item_Radio       smallint not null auto_increment PRIMARY KEY,
   Des_Item_Radio       varchar(50) not null,
   Cod_Pergunta         smallint not null
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
/* Table: TB_Pergunta                                           */
/*==============================================================*/
create table TB_Pergunta
(
   Cod_Pergunta         smallint not null auto_increment PRIMARY KEY,
   Des_Pergunta         varchar(150) not null,
   Cod_Tipo_Pergunta    tinyint not null,
   Cod_Questionario     tinyint not null,
   Cod_Grupo            tinyint not null
);

/*==============================================================*/
/* Table: TB_Prontuario                                         */
/*==============================================================*/
create table TB_Prontuario
(
   Num_Prontuario       int not null auto_increment PRIMARY KEY,
   Dta_Data_Prontuario  datetime,
   Cod_Cliente          int not null
);

/*==============================================================*/
/* Table: TB_Questionario                                       */
/*==============================================================*/
create table TB_Questionario
(
   Cod_Questionario     tinyint not null auto_increment PRIMARY KEY,
   Nom_Questionario     char(100) not null
);

/*==============================================================*/
/* Table: TB_Resposta                                           */
/*==============================================================*/
create table TB_Resposta
(
   Cod_Resposta_Prontuario smallint not null auto_increment PRIMARY KEY,
   Cod_Pergunta         smallint not null,
   Num_Prontuario       int not null,
   Des_Resposta_Aberta  varchar(200),
   Ind_Resposta_SimNao  boolean,
   Des_Resposta_Qual    varchar(100),
   Des_Resposta_Quando  varchar(100),
   Des_Resposta_Outros  varchar(100),
   Des_Resposta_Cite    varchar(100),
   Des_Resposta_Observacao varchar(100),
   Cod_Resposta_ComboBox smallint,
   Cod_Resposta_Radio   smallint
);

/*==============================================================*/
/* Table: TB_Resposta_CheckBox                                  */
/*==============================================================*/
create table TB_Resposta_CheckBox
(
   Cod_Resposta_CheckBox smallint not null auto_increment PRIMARY KEY,
   Cod_Item_Check       smallint not null,
   Cod_Pergunta         smallint not null,
   Num_Prontuario       int not null,
   Ind_CheckBox_Resposta boolean
);

/*==============================================================*/
/* Table: TB_Telefone                                           */
/*==============================================================*/
create table TB_Telefone
(
   Cod_Telefone_Cliente int not null auto_increment PRIMARY KEY,
   Num_Telefone         varchar(20) not null,
   Cod_Cliente          int not null,
   Cod_Tipo_Telefone    int not null
);

/*==============================================================*/
/* Table: TB_Tipo_Pergunta                                      */
/*==============================================================*/
create table TB_Tipo_Pergunta
(
   Cod_Tipo_Pergunta    tinyint not null auto_increment PRIMARY KEY,
   Ind_Pergunta_Aberta  boolean,
   Ind_Pergunta_SimNao  boolean,
   Ind_Pergunta_Qual    boolean,
   Ind_Pergunta_Quando  boolean,
   Ind_Pergunta_Outros  boolean,
   Ind_Pergunta_Cite    boolean,
   Ind_Pergunta_Observacao boolean,
   ind_Pergunta_ComboBox boolean,
   Ind_Pergunta_Radio   boolean,
   Ind_Pergunta_CheckBox boolean
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

alter table TB_Grupo add constraint FK_FK_Sub_Grupo_De_Algum_Grupo foreign key (Cod_Grupo_Superior)
      references TB_Grupo (Cod_Grupo);

alter table TB_Lista_Check_Box add constraint FK_Pergunta_Check_Box foreign key (Cod_Pergunta)
      references TB_Pergunta (Cod_Pergunta);

alter table TB_Lista_Combo_Box add constraint FK_Reference_14 foreign key (Cod_Pergunta)
      references TB_Pergunta (Cod_Pergunta);

alter table TB_Lista_Radio add constraint FK_Pergunta_Radio foreign key (Cod_Pergunta)
      references TB_Pergunta (Cod_Pergunta);

alter table TB_Pergunta add constraint FK_FK_Grupo_Pergunta foreign key (Cod_Grupo)
      references TB_Grupo (Cod_Grupo);

alter table TB_Pergunta add constraint FK_FK_Pergunta_Tipo_Pergunta foreign key (Cod_Tipo_Pergunta)
      references TB_Tipo_Pergunta (Cod_Tipo_Pergunta);

alter table TB_Pergunta add constraint FK_Questionario_Perguntas foreign key (Cod_Questionario)
      references TB_Questionario (Cod_Questionario);

alter table TB_Prontuario add constraint FK_FK_Cliente_Prontuario foreign key (Cod_Cliente)
      references TB_Cliente (Cod_Cliente);

alter table TB_Resposta add constraint FK_Pergunta_Resposta foreign key (Cod_Pergunta)
      references TB_Pergunta (Cod_Pergunta);

alter table TB_Resposta add constraint FK_Prontuario_Resposta foreign key (Num_Prontuario)
      references TB_Prontuario (Num_Prontuario);

alter table TB_Resposta_CheckBox add constraint FK_Pergunta_Resposta_CheckBox foreign key (Cod_Pergunta)
      references TB_Pergunta (Cod_Pergunta);

alter table TB_Resposta_CheckBox add constraint FK_FK_Prontuario_Resposta_CheckBox foreign key (Num_Prontuario)
      references TB_Prontuario (Num_Prontuario);

alter table TB_Resposta_CheckBox add constraint FK_FK_Resposta_CheckBox foreign key (Cod_Item_Check)
      references TB_Lista_Check_Box (Cod_Item_Check);

alter table TB_Telefone add constraint FK_FK_Telefone_Cliente foreign key (Cod_Cliente)
      references TB_Cliente (Cod_Cliente);

alter table TB_Telefone add constraint FK_FK_Tipo_Telefone foreign key (Cod_Tipo_Telefone)
      references TB_Tipo_Telefone (Cod_Tipo_Telefone);

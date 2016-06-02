/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     01/06/2016 01:11:24                          */
/*==============================================================*/


/*==============================================================*/
/* Table: tb_avaliador                                          */
/*==============================================================*/
create table tb_avaliador
(
   Cod_Avaliador        int not null auto_increment PRIMARY KEY,
   Nom_Avaliador        varchar(100) not null,
   Cod_Especialidade    int,
   Cod_Acesso           int,
   Des_Email            varchar(100),
   Des_Login            varchar(100),
   Des_Senha            varchar(200)
);

/*==============================================================*/
/* Table: tb_categoria_combo                                    */
/*==============================================================*/
create table tb_categoria_combo
(
   Cod_Categoria_Combo  int not null auto_increment PRIMARY KEY,
   Des_Categoria        varchar(100) not null
);

/*==============================================================*/
/* Table: tb_cliente                                            */
/*==============================================================*/
create table tb_cliente
(
   Cod_Cliente          int not null auto_increment PRIMARY KEY,
   Nom_Cliente          varchar(200) not null,
   Dta_Nascimento       datetime not null,
   Num_Rg               varchar(20),
   Des_Endereco         varchar(200) not null,
   Ind_Sexo             char(1) not null,
   Num_Filhos           tinyint not null,
   Cod_Cor              tinyint,
   Cod_Escolaridade     tinyint,
   Cod_Ocupacao         smallint,
   Cod_Estado_Civil     tinyint,
   Cod_Naturalidade     smallint
);

/*==============================================================*/
/* Table: tb_cor                                                */
/*==============================================================*/
create table tb_cor
(
   Cod_Cor              tinyint not null auto_increment PRIMARY KEY,
   Nom_Cor              varchar(15)
);

/*==============================================================*/
/* Table: tb_escolaridade                                       */
/*==============================================================*/
create table tb_escolaridade
(
   Cod_Escolaridade     tinyint not null auto_increment PRIMARY KEY,
   Nom_Escolaridade     varchar(100)
);

/*==============================================================*/
/* Table: tb_especialidade                                      */
/*==============================================================*/
create table tb_especialidade
(
   Cod_Especialidade    int not null auto_increment PRIMARY KEY,
   Nom_Especialidade    char(100) not null
);

/*==============================================================*/
/* Table: tb_estado_civil                                       */
/*==============================================================*/
create table tb_estado_civil
(
   Cod_Estado_Civil     tinyint not null auto_increment PRIMARY KEY,
   Nom_Estado_Civil     varchar(15)
);

/*==============================================================*/
/* Table: tb_grupo                                              */
/*==============================================================*/
create table tb_grupo
(
   Cod_Grupo            tinyint not null auto_increment PRIMARY KEY,
   Nom_Grupo            varchar(100) not null,
   Cod_Grupo_Superior   tinyint,
   Cod_Questionario     int,
   Num_Ordem_Grupo      int,
   Ind_Status           bool
);

/*==============================================================*/
/* Table: tb_imagem                                             */
/*==============================================================*/
create table tb_imagem
(
   Cod_Imagem           int not null auto_increment PRIMARY KEY,
   Num_Prontuario       int,
   Nom_Imagem           varchar(100),
   Des_Imagem           varchar(150),
   Dta_Upload           datetime,
   Des_Diretorio        varchar(255)
);

/*==============================================================*/
/* Table: tb_lista_check_box                                    */
/*==============================================================*/
create table tb_lista_check_box
(
   Cod_Item_Check       smallint not null auto_increment PRIMARY KEY,
   Des_Item_Check       varchar(50) not null,
   Cod_Pergunta         smallint
);

/*==============================================================*/
/* Table: tb_lista_combo_box                                    */
/*==============================================================*/
create table tb_lista_combo_box
(
   Cod_Item_Combo       smallint not null auto_increment PRIMARY KEY,
   Des_Item_Combo       varchar(50) not null,
   Cod_Pergunta         smallint
);

/*==============================================================*/
/* Table: tb_lista_multi_combo                                  */
/*==============================================================*/
create table tb_lista_multi_combo
(
   Cod_Item_Multi_Combo int not null auto_increment PRIMARY KEY,
   Des_Item_Multi_Combo varchar(100) not null,
   Cod_Pergunta         smallint,
   Cod_Categoria_Combo  int
);

/*==============================================================*/
/* Table: tb_lista_radio                                        */
/*==============================================================*/
create table tb_lista_radio
(
   Cod_Item_Radio       smallint not null auto_increment PRIMARY KEY,
   Des_Item_Radio       varchar(50) not null,
   Cod_Pergunta         smallint
);

/*==============================================================*/
/* Table: tb_naturalidade                                       */
/*==============================================================*/
create table tb_naturalidade
(
   Cod_Naturalidade     smallint not null auto_increment PRIMARY KEY,
   Nom_Naturalidade     varchar(50)
);

/*==============================================================*/
/* Table: tb_nivel_acesso                                       */
/*==============================================================*/
create table tb_nivel_acesso
(
   Cod_Acesso           int not null auto_increment PRIMARY KEY,
   Des_Acesso           varchar(50)
);

/*==============================================================*/
/* Table: tb_ocupacao                                           */
/*==============================================================*/
create table tb_ocupacao
(
   Cod_Ocupacao         smallint not null auto_increment PRIMARY KEY,
   Nom_Ocupacao         varchar(100)
);

/*==============================================================*/
/* Table: tb_pergunta                                           */
/*==============================================================*/
create table tb_pergunta
(
   Cod_Pergunta         smallint not null auto_increment PRIMARY KEY,
   Cod_Grupo            tinyint,
   Cod_Tipo_Pergunta    tinyint,
   Des_Pergunta         varchar(150) not null,
   Num_Ordem_Pergunta   int
);

/*==============================================================*/
/* Table: tb_prontuario                                         */
/*==============================================================*/
create table tb_prontuario
(
   Num_Prontuario       int not null auto_increment PRIMARY KEY,
   Dta_Data_Prontuario  datetime,
   Cod_Cliente          int,
   Cod_Avaliador        int,
   Val_Pontuacao        decimal(10,2),
   Val_Tempo_Gasto      decimal(10,2)
);

/*==============================================================*/
/* Table: tb_questionario                                       */
/*==============================================================*/
create table tb_questionario
(
   Cod_Questionario     int not null auto_increment PRIMARY KEY,
   Des_Questionario     varchar(100) not null
);

/*==============================================================*/
/* Table: tb_resposta                                           */
/*==============================================================*/
create table tb_resposta
(
   Cod_Resposta_Prontuario smallint not null auto_increment PRIMARY KEY,
   Num_Prontuario       int not null,
   Cod_Pergunta         smallint not null,
   Des_Resposta_Aberta  varchar(255),
   Ind_Resposta_SimNao  bool,
   Des_Resposta_Qual    varchar(255),
   Des_Resposta_Quando  varchar(255),
   Des_Resposta_Outros  varchar(255),
   Des_Resposta_Cite    varchar(255),
   Des_Resposta_Observacao varchar(255),
   Cod_Resposta_ComboBox smallint,
   Cod_Resposta_Radio   smallint
);

/*==============================================================*/
/* Table: tb_resposta_checkbox                                  */
/*==============================================================*/
create table tb_resposta_checkbox
(
   Cod_Resposta_CheckBox smallint not null auto_increment PRIMARY KEY,
   Num_Prontuario       int,
   Cod_Pergunta         smallint,
   Cod_Item_Check       smallint,
   Ind_CheckBox         bool
);

/*==============================================================*/
/* Table: tb_resposta_multi_combo                               */
/*==============================================================*/
create table tb_resposta_multi_combo
(
   Cod_Resposta_Multi_Combo smallint not null auto_increment PRIMARY KEY,
   Num_Prontuario       int,
   Cod_Pergunta         smallint,
   Cod_Item_Multi_Combo int
);

/*==============================================================*/
/* Table: tb_telefone                                           */
/*==============================================================*/
create table tb_telefone
(
   Cod_Telefone_Cliente int not null auto_increment PRIMARY KEY,
   Num_Telefone         varchar(20) not null,
   Cod_Cliente          int,
   Cod_Tipo_Telefone    int
);

/*==============================================================*/
/* Table: tb_tipo_pergunta                                      */
/*==============================================================*/
create table tb_tipo_pergunta
(
   Cod_Tipo_Pergunta    tinyint not null auto_increment PRIMARY KEY,
   Ind_Pergunta_Aberta  bool,
   Ind_Pergunta_SimNao  bool,
   Ind_Pergunta_Qual    bool,
   Ind_Pergunta_Quando  bool,
   Ind_Pergunta_Outros  bool,
   Ind_Pergunta_Cite    bool,
   Ind_Pergunta_Observacao bool,
   Ind_Pergunta_ComboBox bool,
   Ind_Pergunta_Radio   bool,
   Ind_Pergunta_CheckBox bool,
   Ind_Pergunta_Multi_Combo bool,
   Des_Tipo_Perguntas   varchar(100)
);

/*==============================================================*/
/* Table: tb_tipo_telefone                                      */
/*==============================================================*/
create table tb_tipo_telefone
(
   Cod_Tipo_Telefone    int not null auto_increment PRIMARY KEY,
   Des_Tipo_Telefone    varchar(20)
);

alter table tb_avaliador add constraint FK_FK_Acesso_Avaliador foreign key (Cod_Acesso)
      references tb_nivel_acesso (Cod_Acesso);

alter table tb_avaliador add constraint FK_FK_Especialidade_Avaliador foreign key (Cod_Especialidade)
      references tb_especialidade (Cod_Especialidade);

alter table tb_cliente add constraint FK_Cor_Cliente foreign key (Cod_Cor)
      references tb_cor (Cod_Cor);

alter table tb_cliente add constraint FK_Escolaridade_Cliente foreign key (Cod_Escolaridade)
      references tb_escolaridade (Cod_Escolaridade);

alter table tb_cliente add constraint FK_Estado_Civil_Cliente foreign key (Cod_Estado_Civil)
      references tb_estado_civil (Cod_Estado_Civil);

alter table tb_cliente add constraint FK_Naturalidade_Cliente foreign key (Cod_Naturalidade)
      references tb_naturalidade (Cod_Naturalidade);

alter table tb_cliente add constraint FK_Ocupacao_Cliente foreign key (Cod_Ocupacao)
      references tb_ocupacao (Cod_Ocupacao);

alter table tb_grupo add constraint FK_Questionario_Grupo foreign key (Cod_Questionario)
      references tb_questionario (Cod_Questionario);

alter table tb_grupo add constraint FK_Sub_Grupo_De_Algum_Grupo foreign key (Cod_Grupo_Superior)
      references tb_grupo (Cod_Grupo);

alter table tb_imagem add constraint FK_FK_Prontuario_Imagem foreign key (Num_Prontuario)
      references tb_prontuario (Num_Prontuario);

alter table tb_lista_check_box add constraint FK_Pergunta_Check_Box foreign key (Cod_Pergunta)
      references tb_pergunta (Cod_Pergunta);

alter table tb_lista_combo_box add constraint FK_Pergunta_ComboBox foreign key (Cod_Pergunta)
      references tb_pergunta (Cod_Pergunta);

alter table tb_lista_multi_combo add constraint FK_FK_Categoria_Multi_Combo foreign key (Cod_Categoria_Combo)
      references tb_categoria_combo (Cod_Categoria_Combo);

alter table tb_lista_multi_combo add constraint FK_FK_Lista_Multi_Combo foreign key (Cod_Pergunta)
      references tb_pergunta (Cod_Pergunta);

alter table tb_lista_radio add constraint FK_Pergunta_Radio foreign key (Cod_Pergunta)
      references tb_pergunta (Cod_Pergunta);

alter table tb_pergunta add constraint FK_Grupo_Pergunta foreign key (Cod_Grupo)
      references tb_grupo (Cod_Grupo);

alter table tb_pergunta add constraint FK_Pergunta_Tipo_Pergunta foreign key (Cod_Tipo_Pergunta)
      references tb_tipo_pergunta (Cod_Tipo_Pergunta);

alter table tb_prontuario add constraint FK_Avaliador_Prontuario foreign key (Cod_Avaliador)
      references tb_avaliador (Cod_Avaliador);

alter table tb_prontuario add constraint FK_Cliente_Prontuario foreign key (Cod_Cliente)
      references tb_cliente (Cod_Cliente);

alter table tb_resposta add constraint FK_Pergunta_Resposta foreign key (Cod_Pergunta)
      references tb_pergunta (Cod_Pergunta);

alter table tb_resposta add constraint FK_Prontuario_Resposta foreign key (Num_Prontuario)
      references tb_prontuario (Num_Prontuario);

alter table tb_resposta_checkbox add constraint FK_Pergunta_Resposta_CheckBox foreign key (Cod_Pergunta)
      references tb_pergunta (Cod_Pergunta);

alter table tb_resposta_checkbox add constraint FK_Prontuario_Resposta_CheckBox foreign key (Num_Prontuario)
      references tb_prontuario (Num_Prontuario);

alter table tb_resposta_checkbox add constraint FK_CheckBox_Lista foreign key (Cod_Item_Check)
      references tb_lista_check_box (Cod_Item_Check);

alter table tb_resposta_multi_combo add constraint FK_FK_Pergunta_Resposta_Multi_Combo foreign key (Cod_Pergunta)
      references tb_pergunta (Cod_Pergunta);

alter table tb_resposta_multi_combo add constraint FK_FK_Prontuario_Resposta_Multi_Combo foreign key (Num_Prontuario)
      references tb_prontuario (Num_Prontuario);

alter table tb_resposta_multi_combo add constraint FK_FK_Resposta_Multi_Combo_Lista foreign key (Cod_Item_Multi_Combo)
      references tb_lista_multi_combo (Cod_Item_Multi_Combo);

alter table tb_telefone add constraint FK_Telefone_Cliente foreign key (Cod_Cliente)
      references tb_cliente (Cod_Cliente);

alter table tb_telefone add constraint FK_Tipo_Telefone foreign key (Cod_Tipo_Telefone)
      references tb_tipo_telefone (Cod_Tipo_Telefone);


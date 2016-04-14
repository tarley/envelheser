/*==============================================================*/ 
/*                  INSERT DOS QUESTIONÁRIOS                    */ 
/*==============================================================*/ 

INSERT INTO tb_questionario (Des_Questionario) VALUES ('Triagem');
INSERT INTO tb_questionario (Des_Questionario) VALUES ('Fisioterapia');

/*==============================================================*/ 
/*           CRIAÇÃO DA PROCEDURE DE REGISTRAR GRUPOS           */ 
/*==============================================================*/ 

DELIMITER $$

    CREATE  PROCEDURE SPInsereGrupo
    (
        IN P_Nome_Grupo 	 VARCHAR(100),
        IN P_Nome_Grupo_Superior VARCHAR(100),
        IN P_Nome_Questionario   VARCHAR(100),
        IN P_Numero_Ordem_Grupo  INT,
	IN P_Ind_Status          boolean		
    )
        BEGIN
        
          DECLARE V_Nome_Grupo		VARCHAR(100);
          DECLARE V_Cod_Grupo_Superior 	INT;
          DECLARE V_Cod_Questionario 	INT;
          DECLARE V_Numero_Ordem_Grupo 	INT;
	  DECLARE V_Ind_Status          boolean;
          
          SET V_Nome_Grupo 		:= P_Nome_Grupo;
          SET V_Cod_Grupo_Superior 	:= (SELECT Cod_Grupo FROM tb_grupo WHERE Nom_Grupo = P_Nome_Grupo_Superior);
          SET V_Cod_Questionario 	:= (SELECT Cod_Questionario FROM tb_questionario WHERE Des_Questionario = P_Nome_Questionario);
          SET V_Numero_Ordem_Grupo 	:= P_Numero_Ordem_Grupo;
          SET V_Ind_Status              := P_Ind_Status;
          
          
	  	 INSERT INTO tb_grupo

		(	Nom_Grupo,
			Cod_Grupo_Superior,
			Cod_Questionario,
			Num_Ordem_Grupo,
			Ind_Status
		)

         	 VALUES 
		(	
			V_Nome_Grupo,
			V_Cod_Grupo_Superior,
			V_Cod_Questionario,
			V_Numero_Ordem_Grupo,
			V_Ind_Status
		);
          
        END  $$
        
DELIMITER ;

/*==============================================================*/ 
/*                     CADASTRO DOS GRUPOS                      */ 
/*==============================================================*/ 

CALL SPInsereGrupo ('Identificação', null, 'Triagem', 1, 0);

CALL SPInsereGrupo ('Anamnese', null, 'Triagem', 1, 1);

			CALL SPInsereGrupo ('História Médica Pregressa', 'Anamnese', 'Triagem', 1, 1);

						CALL SPInsereGrupo ('Sistema Cardiovascular', 'História Médica Pregressa', 'Triagem', 1, 1);
						CALL SPInsereGrupo ('Sistema Respiratório', 'História Médica Pregressa', 'Triagem', 2, 1);
						CALL SPInsereGrupo ('Sistema Digestório', 'História Médica Pregressa', 'Triagem', 3, 1);
						CALL SPInsereGrupo ('Sistema Genitourinário', 'História Médica Pregressa', 'Triagem', 4, 1);
						CALL SPInsereGrupo ('Sistema Endócrino', 'História Médica Pregressa', 'Triagem', 5, 1);
						CALL SPInsereGrupo ('Sistema Nervoso Central', 'História Médica Pregressa', 'Triagem', 6, 1);
						CALL SPInsereGrupo ('Sistema Sensitivo', 'História Médica Pregressa', 'Triagem', 7, 1);
						CALL SPInsereGrupo ('Sistema Hematopoético', 'História Médica Pregressa', 'Triagem', 8, 1);
						CALL SPInsereGrupo ('Sistema Osteomuscular', 'História Médica Pregressa', 'Triagem', 9, 1);

			CALL SPInsereGrupo ('Histórico de Queda', 'Anamnese', 'Triagem', 2, 1);

			CALL SPInsereGrupo ('Histórico Familiar', 'Anamnese', 'Triagem', 3, 0);

			CALL SPInsereGrupo ('Hábitos e Vícios', 'Anamnese', 'Triagem', 4, 0);

CALL SPInsereGrupo ('Necessidades Psicoespirituais', null, 'Triagem', 2, 0);

CALL SPInsereGrupo ('Necessidades Psicosociais', null, 'Triagem', 3, 0);

CALL SPInsereGrupo ('Necessidades Psicobiológicas', null, 'Triagem', 4, 0);

CALL SPInsereGrupo ('Exame Físico', null, 'Triagem', 5, 0);

CALL SPInsereGrupo ('Coong', null, 'Triagem', 6, 0);

CALL SPInsereGrupo ('Exame Físico Objetivo De Coong_2', null, 'Triagem', 7, 0);

			CALL SPInsereGrupo ('Sistema Respiratório_2', 'Exame Físico Objetivo De Coong 2', 'Triagem', 1, 0);
			CALL SPInsereGrupo ('Sistema Cardiovascular_2', 'Exame Físico Objetivo De Coong 2', 'Triagem', 2, 0);
			CALL SPInsereGrupo ('Sistema Gastrointestinal_2', 'Exame Físico Objetivo De Coong 2', 'Triagem', 3, 0);
			CALL SPInsereGrupo ('Membros Superiores MMSS_2', 'Exame Físico Objetivo De Coong 2', 'Triagem', 4, 0);
			CALL SPInsereGrupo ('Membros Inferiores MMII_2', 'Exame Físico Objetivo De Coong 2', 'Triagem', 5, 0);
			CALL SPInsereGrupo ('Sistema Geniturinário_2', 'Exame Físico Objetivo De Coong 2', 'Triagem', 6, 0);


/*==============================================================*/ 
/*     CRIAÇÃO DA PROCEDURE PARA REGISTRAR TIPO DE PERGUNTAS    */ 
/*==============================================================*/ 

DELIMITER $$

    CREATE  PROCEDURE SPInsereTipoPergunta
    (
        IN  P_Pergunta_Aberta  		bool,
        IN  P_Pergunta_SimNao  		bool,
        IN  P_Pergunta_Qual    		bool,
        IN  P_Pergunta_Quando  		bool,
        IN  P_Pergunta_Outros  		bool,
        IN  P_Pergunta_Cite    		bool,
        IN  P_Pergunta_Observacao 	bool,
        IN  P_Pergunta_ComboBox 	bool,
        IN  P_Pergunta_Radio   		bool,
        IN  P_Pergunta_CheckBox 	bool
    )
        BEGIN
        
            DECLARE  V_Pergunta_Aberta  	bool;
            DECLARE  V_Pergunta_SimNao  	bool;
            DECLARE  V_Pergunta_Qual    	bool;
            DECLARE  V_Pergunta_Quando  	bool;
            DECLARE  V_Pergunta_Outros  	bool;
            DECLARE  V_Pergunta_Cite    	bool;
            DECLARE  V_Pergunta_Observacao 	bool;
            DECLARE  V_Pergunta_ComboBox 	bool;
            DECLARE  V_Pergunta_Radio   	bool;
            DECLARE  V_Pergunta_CheckBox 	bool;
          
            SET  V_Pergunta_Aberta     := P_Pergunta_Aberta;
            SET  V_Pergunta_SimNao     := P_Pergunta_SimNao;
            SET  V_Pergunta_Qual       := P_Pergunta_Qual;
            SET  V_Pergunta_Quando     := P_Pergunta_Quando;
            SET  V_Pergunta_Outros     := P_Pergunta_Outros;
            SET  V_Pergunta_Cite       := P_Pergunta_Cite;
            SET  V_Pergunta_Observacao := P_Pergunta_Observacao;
            SET  V_Pergunta_ComboBox   := P_Pergunta_ComboBox;
            SET  V_Pergunta_Radio      := P_Pergunta_Radio;
            SET  V_Pergunta_CheckBox   := P_Pergunta_CheckBox;
          
          
	  	 INSERT INTO tb_tipo_pergunta

		(	Ind_Pergunta_Aberta,
   			Ind_Pergunta_SimNao,
   			Ind_Pergunta_Qual,
   			Ind_Pergunta_Quando,
   			Ind_Pergunta_Outros,
   			Ind_Pergunta_Cite,
   			Ind_Pergunta_Observacao,
   			ind_Pergunta_ComboBox,
  			Ind_Pergunta_Radio,
   			Ind_Pergunta_CheckBox
		)

         	 VALUES 
		(	
			V_Pergunta_Aberta,   
			V_Pergunta_SimNao,
			V_Pergunta_Qual,
			V_Pergunta_Quando,
			V_Pergunta_Outros,
			V_Pergunta_Cite, 
			V_Pergunta_Observacao,
			V_Pergunta_ComboBox,
			V_Pergunta_Radio,
			V_Pergunta_CheckBox
		);
          
        END  $$
        
DELIMITER ;

/*==============================================================*/ 
/*               CADASTRO DOS TIPOS DE PERGUNTAS                */ 
/*==============================================================*/ 
	/*SimNão - 1*/
	CALL SPInsereTipoPergunta(0,1,0,0,0,0,0,0,0,0);
	
	/*Qual - 2*/
	CALL SPInsereTipoPergunta(0,0,1,0,0,0,0,0,0,0);
	
	/*Aberta - 3*/
	CALL SPInsereTipoPergunta(1,0,0,0,0,0,0,0,0,0);
	
	/*Quando - 4*/
	CALL SPInsereTipoPergunta(0,0,0,1,0,0,0,0,0,0);
	
	/*Aberta - SImNão - Qual - 5*/
	CALL SPInsereTipoPergunta(1,1,1,0,0,0,0,0,0,0);
	
	/*SimNão - Qual - Quando - 6*/
	CALL SPInsereTipoPergunta(0,1,1,1,0,0,0,0,0,0);
	
	/*SimNão - Qual - 7*/
	CALL SPInsereTipoPergunta(0,1,1,0,0,0,0,0,0,0);
	
	/*SimNão - Quando - 8*/
	CALL SPInsereTipoPergunta(0,1,0,1,0,0,0,0,0,0);


/*==============================================================*/ 
/*          CRIAÇÃO DA PROCEDURE DE REGISTRAR PERGUNTAS         */ 
/*==============================================================*/ 

DELIMITER $$

    CREATE  PROCEDURE SPInserePergunta
    (
   	IN P_Nome_Grupo 	  	  VARCHAR(100),
   	IN P_Cod_Tipo_Pergunta    TINYINT,
   	IN P_Des_Pergunta         VARCHAR(150),
   	IN P_Num_Ordem_Pergunta   INT

    )
        BEGIN
        
          DECLARE V_Cod_Grupo            INT;
          DECLARE V_Cod_Tipo_Pergunta    TINYINT;
          DECLARE V_Des_Pergunta         VARCHAR(150);
          DECLARE V_Num_Ordem_Pergunta   INT;
          
          SET V_Cod_Grupo 	     	 := (SELECT Cod_Grupo FROM tb_grupo WHERE Nom_Grupo = P_Nome_Grupo );
          SET V_Cod_Tipo_Pergunta    := P_Cod_Tipo_Pergunta;
          SET V_Des_Pergunta         := P_Des_Pergunta;
          SET V_Num_Ordem_Pergunta   := P_Num_Ordem_Pergunta;
          
          
	  	 INSERT INTO tb_pergunta

		(	Cod_Grupo,
   			Cod_Tipo_Pergunta,
   			Des_Pergunta,
   			Num_Ordem_Pergunta
		)

         	 VALUES 
		(	
			V_Cod_Grupo,
			V_Cod_Tipo_Pergunta,
			V_Des_Pergunta,
			V_Num_Ordem_Pergunta
		);
          
        END  $$
        
DELIMITER ;


/*==============================================================*/ 
/*                    CADASTRO DAS PERGUNTAS                    */ 
/*==============================================================*/ 

/*===================================*/ 
/*          Cardiovascular           */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Infarto', 1);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Insuficiência Cardíaca', 2);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Pressão Arterial', 3);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Angina', 4);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Prótese Valvar', 5);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Sopro', 6);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Arritmias', 7);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Cirurgias Cardíacas', 8);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Marca-Passo', 9);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Doença de Chagas', 10);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Prolapso de Válvula Mitral', 11);
CALL SPInserePergunta ('Sistema Cardiovascular', 1, 'Febre Reumática Com Cardiopatia', 12);

/*===================================*/ 
/*          Respiratório             */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Respiratório', 1, 'Pneumonia', 1);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'Asma', 2);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'Bronquite', 3);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'Fibrose Cística', 4);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'Tuberculose', 5);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'Enfisema', 6);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'Dificuldade Para Respirar', 7);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'Sinusite', 8);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'Tosse Crônica', 9);
CALL SPInserePergunta ('Sistema Respiratório', 1, 'DPOC', 10);

/*===================================*/ 
/*          Digestório               */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Digestório', 1, 'Azia', 1);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Gastrite', 2);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Úlcera', 3);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Hepatite', 4);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Cirrose', 5);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Icterícia', 6);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Anorexia Nervosa', 7);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Bulimia', 8);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Diarréia Persistente', 9);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Constipação Intestinal', 10);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Refluxo', 11);
CALL SPInserePergunta ('Sistema Digestório', 1, 'Colite', 12);

/*===================================*/ 
/*          Genitourinário           */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Genitourinário', 1, 'Insuficiência Renal', 1);
CALL SPInserePergunta ('Sistema Genitourinário', 1, 'Cálculos', 2);
CALL SPInserePergunta ('Sistema Genitourinário', 1, 'Doenças Sexualmente Transmissíveis', 3);
CALL SPInserePergunta ('Sistema Genitourinário', 1, 'Incontinência', 4);
CALL SPInserePergunta ('Sistema Genitourinário', 1, 'Infecção De Urina', 5);

/*===================================*/ 
/*          Endócrino                */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Endócrino', 1, 'Diabetes', 1);
CALL SPInserePergunta ('Sistema Endócrino', 1, 'Distúrbios De Tireoide', 2);
CALL SPInserePergunta ('Sistema Endócrino', 1, 'Distúrbio Hipofisário', 3);
CALL SPInserePergunta ('Sistema Endócrino', 1, 'Hipoglicemia', 4);


/*===================================*/ 
/*          Nervoso central          */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Aneurisma', 1);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Demência', 2);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Alzheimer', 3);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Parkinson', 4);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Fobia', 5);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Insônia', 6);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Convulsôes', 7);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Desmaios', 8);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Perda de Conciência', 9);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Paralisia Cerebral', 10);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Trauma Crânio Encefálico', 11);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Distúrbios Sensoriais', 12);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Epilepsia', 13);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Sindrome do Pânico', 14);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Derrame', 15);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Cefaléia Intensa', 16);
CALL SPInserePergunta ('Sistema Nervoso Central', 1, 'Emocional', 17);

/*===================================*/ 
/*          Sensitivo                */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Sensitivo', 1, 'Cegueira', 1);
CALL SPInserePergunta ('Sistema Sensitivo', 1, 'Glaucoma', 2);
CALL SPInserePergunta ('Sistema Sensitivo', 1, 'Conjutivite', 3);
CALL SPInserePergunta ('Sistema Sensitivo', 1, 'Úlcera', 4);
CALL SPInserePergunta ('Sistema Sensitivo', 1, 'Auditivo', 5);
CALL SPInserePergunta ('Sistema Sensitivo', 1, 'Hanseníase', 6);
CALL SPInserePergunta ('Sistema Sensitivo', 1, 'Agnosia', 7);
CALL SPInserePergunta ('Sistema Sensitivo', 1, 'Gustativo', 8);

/*===================================*/ 
/*          Hematopoético            */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Anemia', 1);
CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Tranfusões', 2);
CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Sangramento Nasal', 3);
CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Equimoses', 4);
CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Alterações De Coagulação', 5);
CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Suscetibilidade à Infecções', 6);
CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Linfadenopatia', 7);
CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Hemofilia', 8);
CALL SPInserePergunta ('Sistema Hematopoético', 1, 'Leucemia', 9);

/*===================================*/ 
/*          Osteomuscular             */ 
/*===================================*/ 

CALL SPInserePergunta ('Sistema Osteomuscular', 1, 'Fraturas', 1);
CALL SPInserePergunta ('Sistema Osteomuscular', 1, 'Cirurgias Ortopédicas', 2);
CALL SPInserePergunta ('Sistema Osteomuscular', 1, 'Uso De Prótese Ou Órtese', 3);

/*===================================*/ 
/*          Histórico de queda       */ 
/*===================================*/ 

CALL SPInserePergunta ('Histórico de Queda', 1, 'Quedas Nos Últimos 12 Meses', 1);

/*===================================*/ 
/*              Anamnese             */ 
/*===================================*/ 

CALL SPInserePergunta ('Anamnese', 3, 'Qual a Queixa Principal?', 1);
CALL SPInserePergunta ('Anamnese', 3, 'História Medicamentosa', 2);
CALL SPInserePergunta ('Anamnese', 3, 'História da Moléstia Atual', 3);
CALL SPInserePergunta ('Anamnese', 8, 'Alergias?', 4);
CALL SPInserePergunta ('Anamnese', 7, 'Tem ou teve doença infecto-contagiosa?', 5);
CALL SPInserePergunta ('Anamnese', 6, 'Já esteve internado ou se submeteu a alguma cirurgia, tratamento com radioterapia e quimioterapia?', 6);
CALL SPInserePergunta ('Anamnese', 3, 'Última consulta - Época e motivo', 7);
CALL SPInserePergunta ('Anamnese', 7, 'Medicamentos em uso prescrito atual ou nos últimos 6 meses?', 8);

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

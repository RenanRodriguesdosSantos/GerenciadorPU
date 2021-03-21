#trigger nova disciplina_iteracao
DELIMITER $$
CREATE TRIGGER TRG_Teste AFTER INSERT ON disciplina_iteracao 
FOR EACH ROW
BEGIN
	DECLARE idDisciplina INT;
    DECLARE disciplina varchar(2);
    DECLARE idArtefato INT;
    DECLARE idConteudo INT;
    SET idDisciplina = new.id;
    SET disciplina = new.disciplina;
    CASE
        WHEN disciplina = 'D1' THEN

            INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Avaliação da Organização Alvo',idDisciplina);
                SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Definições, acrônimos, abreviações',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Contexto de Negócios',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Ideias e Estratégias de Negócios no contexto do projeto',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Fatores Externos',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Clientes',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Concorrentes',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Outras Partes Interessadas',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Fatores Internos',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Processos de Negócios',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Ferramenta de Suporte',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Organização Interna',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Competências, Habilidades e Atitudes',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Capacidade de Mudança',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Resultados do Benchmarking',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Desempenho da Organização Alvo',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Conclusão da Avaliação',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Áreas de Problemas',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Novas Tecnologias Aplicáveis',idConteudo);
            
            INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Documento de Arquitetura de Negócios',idDisciplina);
                SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo); 
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Definições, acrônimos e abreviações',idConteudo); 
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo); 
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo); 
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Representação da Arquitetura',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Objetivos e Restrições Arquitetônicas',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Visão do Processo de Negócio',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Visão da Estrutura da Organização',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Realização de Casos de Uso de Negócios',idConteudo); 
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Visão da Cultura',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Visão dos Aspectos de Recursos Humanos',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Visualização do Domínio(Opcional)',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Tamanho e Metas de Desempenho',idArtefato);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Metas de Qualidade',idArtefato);

            INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário de Negócios',idDisciplina);
                SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);  
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);  
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);  
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);  
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('< aTerm>',idConteudo);  
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('< anotherTerm>',idConteudo);  
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('< aGroupOfTerms>',idConteudo);  
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriotipos UML',idArtefato);


        WHEN disciplina = 'D2' THEN
           INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário',idDisciplina);
            SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<anotherTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aGroupofTerms> ',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aSecondGroupofTerms> ',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriótipos UML',idArtefato);

        #REPLICADA PARA TRG_AFTER_INSERT_DISCIPLINA_ITERACAO        
        WHEN disciplina = 'D3' THEN
           INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário',idDisciplina);
            SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<anotherTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aGroupofTerms> ',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aSecondGroupofTerms> ',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriótipos UML',idArtefato);
        #REPLICADA PARA TRG_AFTER_INSERT_DISCIPLINA_ITERACAO        
        WHEN disciplina = 'D4' THEN
           INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário',idDisciplina);
            SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<anotherTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aGroupofTerms> ',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aSecondGroupofTerms> ',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriótipos UML',idArtefato);

                
        WHEN disciplina = 'D5' THEN
           INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário',idDisciplina);
            SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<anotherTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aGroupofTerms> ',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aSecondGroupofTerms> ',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriótipos UML',idArtefato);

        WHEN disciplina = 'D6' THEN
           INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário',idDisciplina);
            SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<anotherTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aGroupofTerms> ',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aSecondGroupofTerms> ',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriótipos UML',idArtefato);

        WHEN disciplina = 'D7' THEN
           INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário',idDisciplina);
            SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<anotherTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aGroupofTerms> ',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aSecondGroupofTerms> ',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriótipos UML',idArtefato);

        WHEN disciplina = 'D8' THEN
           INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário',idDisciplina);
            SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<anotherTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aGroupofTerms> ',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aSecondGroupofTerms> ',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriótipos UML',idArtefato);

        WHEN disciplina = 'D9' THEN
           INSERT INTO artefatos (nome,id_disciplina_iteracao) VALUE ('Glossário',idDisciplina);
            SET idArtefato = (SELECT ID FROM artefatos ORDER BY ID DESC LIMIT 1);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Introdução',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Objetivo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Escopo',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Referências',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('Visão Geral',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Definições',idArtefato);
                    SET idConteudo = (SELECT ID FROM conteudo ORDER BY ID DESC LIMIT 1);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<anotherTerm>',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aGroupofTerms> ',idConteudo);
                    INSERT INTO subconteudo (titulo,id_conteudo) VALUE ('<aSecondGroupofTerms> ',idConteudo);
                INSERT INTO conteudo (titulo,id_artefato) VALUE ('Esteriótipos UML',idArtefato);


	END CASE;   

END $$
DELIMITER ;
/*
conteudos.forEach(e =>{let linha = e.innerText.replace('.',''); let nConteudo = linha[0]; linha = linha.replace(/[0-9]/,'');var subQuery =""; var indexSub = 0;subconteudos.forEach(e2 => {let subLinha = e2.innerText.replace('.',''); let nConteudoSub = subLinha[0]; if(nConteudo == nConteudoSub){ if(indexSub == 0){subQuery += "\tSET idConteudo = (SELECT ID FROM conteudo ORDER BY DESC LIMIT 1);\n";} indexSub++;;subLinha = subLinha.replace(/[0-9]/g,''); subQuery += "\tINSERT INTO subconteudo (titulo,id_conteudo) VALUE ('"+ subLinha.trim()+"',idConteudo);\n"} }); query += "INSERT INTO conteudo (titulo,id_artefato) VALUE ('" + linha.trim() + "',idArtefato);\n"+ subQuery});
*/
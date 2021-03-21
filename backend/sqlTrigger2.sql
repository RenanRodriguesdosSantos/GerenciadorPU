DELIMITER $$
CREATE TRIGGER TRG_AFTER_INSERT_ITERACAO AFTER INSERT ON iteracao 
FOR EACH ROW
BEGIN
	DECLARE idIteracao INT;
    SET idIteracao = new.id;
    insert into disciplina_iteracao (id_iteracao,disciplina)  values 
    (idIteracao,'D1'),
    (idIteracao,'D2'),
    (idIteracao,'D3'),
    (idIteracao,'D4'),
    (idIteracao,'D5'),
    (idIteracao,'D6'),
    (idIteracao,'D7'),
    (idIteracao,'D8'),
    (idIteracao,'D9');

END $$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER TRG_AFTER_INSERT_DISCIPLINA_ITERACAO AFTER INSERT ON disciplina_iteracao 
FOR EACH ROW
BEGIN
	DECLARE idDisciplina INT;
    DECLARE nomeDisciplina varchar(2);
    DECLARE idIteracao INT;
    DECLARE idFase INT;
    SET idDisciplina = new.id;
    SET nomeDisciplina = new.disciplina;
    SET idFase = (SELECT id_fase FROM iteracao i INNER JOIN disciplina_iteracao di ON (i.id = di.id_iteracao) WHERE i.id = new.id_iteracao LIMIT 1);

    IF (SELECT (EXISTS (SELECT * FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1, 1)) = 0) THEN
        SET idFase = idFase - 1;
        WHILE (SELECT (EXISTS (SELECT * FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1)) = 0) DO
            SET idFase = idFase - 1;
        END WHILE;
        SET idIteracao = (SELECT id FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1);
    ELSE
        SET idIteracao = (SELECT id FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1, 1);
    END IF;
    DROP TEMPORARY TABLE IF EXISTS tmpArtefatos;
    CREATE TEMPORARY TABLE tmpArtefatos  SELECT nome, id_disciplina_iteracao, autor FROM artefatos  a INNER JOIN disciplina_iteracao di on (a.id_disciplina_iteracao = di.id) WHERE disciplina = nomeDisciplina AND id_iteracao = idIteracao;
    UPDATE tmpArtefatos SET id_disciplina_iteracao = idDisciplina;
    INSERT INTO artefatos (nome, id_disciplina_iteracao, autor) SELECT * FROM tmpArtefatos;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER TRG_AFTER_INSERT_ARTEFATOS AFTER INSERT ON artefatos 
FOR EACH ROW
BEGIN
    DECLARE idArtefato INT;
    DECLARE idIteracao INT;
    DECLARE idFase INT;
    SET idArtefato = new.id;

    SET idFase = (SELECT i.id_fase FROM iteracao i INNER JOIN disciplina_iteracao di ON (i.id = di.id_iteracao) INNER JOIN artefatos a ON (a.id_disciplina_iteracao = di.id) WHERE a.id = new.id LIMIT 1);

    IF (SELECT (EXISTS (SELECT * FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1, 1)) = 0) THEN
        SET idFase = idFase - 1;
        WHILE (SELECT (EXISTS (SELECT * FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1)) = 0) DO
            SET idFase = idFase - 1;
        END WHILE;
        SET idIteracao = (SELECT id FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1);
    ELSE
        SET idIteracao = (SELECT id FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1, 1);
    END IF;

    DROP TEMPORARY TABLE IF EXISTS tmpConteudos;
    CREATE TEMPORARY TABLE tmpConteudos  SELECT titulo, c.texto , id_artefato FROM conteudo c INNER JOIN artefatos a on(c.id_artefato = a.id) INNER JOIN disciplina_iteracao di on (a.id_disciplina_iteracao = di.id) WHERE a.nome LIKE new.nome AND id_iteracao = idIteracao;
    UPDATE tmpConteudos SET id_artefato = idArtefato;
    INSERT INTO conteudo (titulo, texto ,id_artefato) SELECT * FROM tmpConteudos;

    DROP TEMPORARY TABLE IF EXISTS tmpAnexos;
    CREATE TEMPORARY TABLE tmpAnexos  SELECT an.nome, an.conteudo, an.tipo, an.tamanho, an.id_artefato FROM anexos an INNER JOIN artefatos a on(an.id_artefato = a.id) INNER JOIN disciplina_iteracao di on (a.id_disciplina_iteracao = di.id) WHERE a.nome LIKE new.nome AND id_iteracao = idIteracao;
    UPDATE tmpAnexos SET id_artefato = idArtefato;
    INSERT INTO anexos (nome, conteudo , tipo, tamanho,id_artefato) SELECT * FROM tmpAnexos;
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER TRG_AFTER_INSERT_CONTEUDO AFTER INSERT ON conteudo 
FOR EACH ROW
BEGIN
    DECLARE idArtefato INT;
    DECLARE idIteracao INT;
    DECLARE idFase INT;
    DECLARE idConteudo INT;
    DECLARE nomeArtefato VARCHAR(60);
    SET idConteudo = new.id;

    SET idFase = (SELECT i.id_fase FROM iteracao i INNER JOIN disciplina_iteracao di ON (i.id = di.id_iteracao) INNER JOIN artefatos a ON (a.id_disciplina_iteracao = di.id) INNER JOIN conteudo c ON (c.id_artefato = a.id) WHERE c.id = new.id LIMIT 1);

    IF (SELECT (EXISTS (SELECT * FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1, 1)) = 0) THEN
        SET idFase = idFase - 1;
        WHILE (SELECT (EXISTS (SELECT * FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1)) = 0) DO
            SET idFase = idFase - 1;
        END WHILE;
        SET idIteracao = (SELECT id FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1);
    ELSE
        SET idIteracao = (SELECT id FROM iteracao WHERE id_fase = idFase ORDER BY id DESC LIMIT 1, 1);
    END IF;

    SET nomeArtefato = (SELECT a.nome FROM artefatos a INNER JOIN conteudo c ON (c.id_artefato = a.id) WHERE c.id = idConteudo);
    SET idArtefato = (SELECT a.id FROM artefatos a INNER JOIN disciplina_iteracao di on (a.id_disciplina_iteracao = di.id) WHERE a.nome LIKE nomeArtefato AND id_iteracao = idIteracao);
    
    DROP TEMPORARY TABLE IF EXISTS tmpSubConteudo;
    CREATE TEMPORARY TABLE tmpSubConteudo  SELECT s.titulo, s.texto , id_conteudo FROM subconteudo s INNER JOIN conteudo c ON(s.id_conteudo = c.id) WHERE c.id_artefato = idArtefato AND c.titulo = new.titulo;
    UPDATE tmpSubConteudo SET id_conteudo = idConteudo;
    INSERT INTO subconteudo (titulo, texto ,id_conteudo) SELECT * FROM tmpSubConteudo;

END$$
DELIMITER ;




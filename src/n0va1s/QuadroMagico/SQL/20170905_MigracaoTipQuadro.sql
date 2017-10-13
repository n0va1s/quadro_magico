CREATE TABLE tipo_quadro (seq_tipo_quadro INT AUTO_INCREMENT NOT NULL, val_tipo_quadro VARCHAR(1) NOT NULL, des_tipo_quadro VARCHAR(255) NOT NULL, PRIMARY KEY(seq_tipo_quadro)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

insert into tipo_quadro (val_tipo_quadro, des_tipo_quadro) values ('F', 'FÃ©rias');
insert into tipo_quadro (val_tipo_quadro, des_tipo_quadro) values ('M', 'Mesada');
insert into tipo_quadro (val_tipo_quadro, des_tipo_quadro) values ('T', 'Tarefa');

update quadro set tip_quadro = 
    (SELECT seq_tipo_quadro
        FROM tipo_quadro
        WHERE val_tipo_quadro = quadro.tip_quadro);
        
ALTER TABLE quadro CHANGE tip_quadro tip_quadro INT DEFAULT NULL;
ALTER TABLE quadro ADD CONSTRAINT FK_4CCE845F68295759 FOREIGN KEY (tip_quadro) REFERENCES tipo_quadro (seq_tipo_quadro);
ALTER TABLE quadro RENAME INDEX FK_4CCE845F68295759 TO IDX_4CCE845F68295759;
--CREATE UNIQUE INDEX UNIQ_4CCE845F68295759 ON quadro (tip_quadro);
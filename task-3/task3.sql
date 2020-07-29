CREATE TABLE IF NOT EXISTS tb_users (
  id_user int(11) NOT NULL AUTO_INCREMENT,
  st_username varchar(150) NOT NULL,
  st_password varchar(150) NOT NULL,
  PRIMARY KEY (id_user)
);

CREATE TABLE IF NOT EXISTS tb_employees (
  id_employee int(11) NOT NULL AUTO_INCREMENT,
  st_name varchar(255) NOT NULL,
  dt_birthday date NOT NULL,
  st_ssn varchar(32) NOT NULL,
  bo_current tinyint(1) NOT NULL DEFAULT '1',
  st_email varchar(255) NOT NULL,
  st_phone varchar(255) NOT NULL,
  st_address varchar(255) NOT NULL,
  PRIMARY KEY (id_employee)
);

CREATE TABLE IF NOT EXISTS tb_languages (
  id_language int(11) NOT NULL AUTO_INCREMENT,
  st_title varchar(32) NOT NULL,
  st_code varchar(4) NOT NULL,
  PRIMARY KEY (id_language)
);

CREATE TABLE IF NOT EXISTS tb_info_type (
  id_info_type int(11) NOT NULL AUTO_INCREMENT,
  st_title varchar(32) NOT NULL,
  PRIMARY KEY (id_info_type)
);


CREATE TABLE IF NOT EXISTS tb_employee_info (
  id_employee_info int(11) NOT NULL AUTO_INCREMENT,
  id_employee int(11) NOT NULL,
  id_language int(11) NOT NULL,
  id_info_type int(11) NOT NULL,
  tx_text text NOT NULL,
  PRIMARY KEY (id_employee_info)
);

CREATE TABLE IF NOT EXISTS tb_audit_log (
  id_audit_log int(11) NOT NULL AUTO_INCREMENT,
  st_table varchar(100) NOT NULL,
  created_by int(11) NOT NULL,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_by int(11) NOT NULL,
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_audit_log)
);

INSERT INTO tb_users 
(st_username, st_password) VALUES
('fabioolima@gmail.com', 'mysupersecretpassword');

INSERT INTO tb_employees 
(st_name, dt_birthday, st_ssn, bo_current, st_email, st_phone, st_address) VALUES
('Fabio Lima', '1980-05-17', '123456789-01', 1, 'fabioolima@gmail.com', '+5561981115636', 'Rua 01 - Brasilia, Brazil');

INSERT INTO tb_info_type (st_title) VALUES ('Introduction');
INSERT INTO tb_info_type (st_title) VALUES ('Previous work experience');
INSERT INTO tb_info_type (st_title) VALUES ('Education information');

INSERT INTO tb_languages (st_title, st_code) VALUES ('English', 'en');
INSERT INTO tb_languages (st_title, st_code) VALUES ('Spanish', 'es');
INSERT INTO tb_languages (st_title, st_code) VALUES ('French', 'fr');

INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 1, 1, 'This is an introduction in english');
INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 2, 1, 'Esta es una introducción en español');
INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 3, 1, 'C est une introduction en français');
INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 1, 2, 'This is a report of previous work experience');
INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 2, 2, 'Este es un informe de experiencia de trabajo previa');
INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 3, 2, 'C est un rapport du précédente expérience professionnelle');
INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 1, 3, 'This is my education information');
INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 2, 3, 'Esta es mi información educativa');
INSERT INTO tb_employee_info (id_employee, id_language, id_info_type, tx_text) VALUES (1, 3, 3, 'Ce sont mes informations d éducation');

INSERT INTO tb_users 
(st_username, st_password) VALUES
('fabioolima@gmail.com', 'mysupersecretpassword');

ALTER TABLE tb_employee_info ADD CONSTRAINT fk_employee_info_employee 
FOREIGN KEY (id_employee) REFERENCES tb_employees (id_employee) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE tb_employee_info ADD CONSTRAINT fk_employee_info_languages 
FOREIGN KEY (id_language) REFERENCES tb_languages (id_language) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE tb_employee_info ADD CONSTRAINT fk_employee_info_info_type 
FOREIGN KEY (id_info_type) REFERENCES tb_info_type (id_info_type) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE tb_audit_log ADD CONSTRAINT fk_audit_log_user_created
FOREIGN KEY (created_by) REFERENCES tb_users (id_user) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE tb_audit_log ADD CONSTRAINT fk_audit_log_user_updated 
FOREIGN KEY (updated_by) REFERENCES tb_users (id_user) ON DELETE CASCADE ON UPDATE NO ACTION;
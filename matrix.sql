CREATE TABLE IF NOT EXISTS warsztaty (
  id int(11) NOT NULL AUTO_INCREMENT,
  nazwa_kursu varchar(255) NOT NULL,
  liczba_studentow int(11) NOT NULL,
  procent_ukonczonych float NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY nazwa_kursu_unique (nazwa_kursu)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO warsztaty (nazwa_kursu, liczba_studentow, procent_ukonczonych)
VALUES ('Linux', 514, 87),
       ('Ansible', 218, 82),
       ('Zabbix', 388, 94),
       ('Proxmox', 401, 92),
       ('Sec', 257, 81)
ON DUPLICATE KEY UPDATE
  liczba_studentow = VALUES(liczba_studentow),
  procent_ukonczonych = VALUES(procent_ukonczonych);


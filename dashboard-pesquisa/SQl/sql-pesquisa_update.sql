CREATE DATABASE pesquisa_satisfacao;

CREATE TABLE IF NOT EXISTS pesquisa_satisfacao (
  id SERIAL,
  nivel_gentileza int NOT NULL,
  nivel_satisfacao int NOT NULL,
  chance_indicacao int NOT NULL,
  data_avaliacao timestamp without time zone DEFAULT CURRENT_TIMESTAMP;
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS usuario (
 id SERIAL,
 login varchar(125) NOT NULL,
 senha varchar(100) NOT NULL,
 PRIMARY KEY(id)
);

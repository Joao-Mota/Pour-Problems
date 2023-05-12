/*
==========================================================
|                     -- Drops --                        |
==========================================================

*/

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Role;
DROP TABLE IF EXISTS Status;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Hashtag;
DROP TABLE IF EXISTS Ticket_User;
DROP TABLE IF EXISTS User_Department;
DROP TABLE IF EXISTS FAQ;


/*

==========================================================
|                     -- Tabelas --                      |
==========================================================

*/


-- Tabela de Usuários
CREATE TABLE User 
(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  fullname VARCHAR(255) NOT NULL,
  username VARCHAR(255) UNIQUE NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role_id INTEGER NOT NULL,
  CONSTRAINT user_role_fk FOREIGN KEY (role_id) REFERENCES Role
);


-- Tabela de Tickets
CREATE TABLE Ticket 
(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  subject VARCHAR(255) NOT NULL,
  datetime DATETIME NOT NULL,
  status_id INTEGER NOT NULL,
  CONSTRAINT ticket_status_fk FOREIGN KEY (status_id) REFERENCES Status
);


-- Tabela de Roles, ex: Admin, Client, Agent
CREATE TABLE Role 
(
  id INTEGER,
  sigla VARCHAR(3) NOT NULL,
  CONSTRAINT role_pk PRIMARY KEY (id)
);


-- Tabela de Status, ex: Open, Closed
CREATE TABLE Status 
(
  id INTEGER,
  stat VARCHAR(50) NOT NULL,
  CONSTRAINT status_pk PRIMARY KEY (id)
);


-- Tabela de Mensagens, mensagens trocadas entre o usuário e o agente
CREATE TABLE Message 
(
  id INTEGER,
  text TEXT NOT NULL,
  datetime DATETIME NOT NULL,
  user_id INTEGER NOT NULL,
  ticket_id INTEGER NOT NULL,
  CONSTRAINT message_pk PRIMARY KEY (id),
  CONSTRAINT message_user_fk FOREIGN KEY (user_id) REFERENCES User,
  CONSTRAINT message_ticket_fk FOREIGN KEY (ticket_id) REFERENCES Ticket
);


-- Tabela de Departamentos, relaciona os usuários com os departamentos
CREATE TABLE Department 
(
  id INTEGER,
  name VARCHAR(50) NOT NULL,
  CONSTRAINT department_pk PRIMARY KEY (id)
);


-- Tabela de Hashtag, relaciona as hashtags com os tickets
CREATE TABLE Hashtag 
(
  id INTEGER,
  name VARCHAR(50) NOT NULL,
  ticket_id INTEGER,
  CONSTRAINT hashtag_pk PRIMARY KEY (id),
  CONSTRAINT hashtag_ticket_fk FOREIGN KEY (ticket_id) REFERENCES Ticket
);


-- Tabela Ticket_User, relaciona os usuários com os tickets
CREATE TABLE Ticket_User 
(
  client_id INTEGER NOT NULL,
  agent_id INTEGER,
  ticket_id INTEGER NOT NULL,
  CONSTRAINT ticket_user_pk PRIMARY KEY (client_id, ticket_id),
  CONSTRAINT ticket_user_user_fk FOREIGN KEY (client_id) REFERENCES User,
  CONSTRAINT ticket_user_agent_fk FOREIGN KEY (agent_id) REFERENCES User,
  CONSTRAINT ticket_user_ticket_fk FOREIGN KEY (ticket_id) REFERENCES Ticket
);


-- Tabela de User_Department, relaciona os usuários com os departamentos
CREATE TABLE User_Department 
(
  user_id INTEGER NOT NULL,
  department_id INTEGER NOT NULL,
  CONSTRAINT user_department_pk PRIMARY KEY (user_id, department_id),
  CONSTRAINT user_department_user_fk FOREIGN KEY (user_id) REFERENCES User,
  CONSTRAINT user_department_department_fk FOREIGN KEY (department_id) REFERENCES Department
);


-- Tabela de FAQ, perguntas frequentes feitas pelos clientes e respondidas pelos agentes
CREATE TABLE FAQ 
(
  id INTEGER,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  user_id INTEGER NOT NULL,
  CONSTRAINT faq_pk PRIMARY KEY (id),
  CONSTRAINT faq_user_fk FOREIGN KEY (user_id) REFERENCES User
);



/*

==========================================================
|                     -- Inserts --                      |
==========================================================

*/

-- Insert de Roles
INSERT INTO Role VALUES (1, 'ADM');
INSERT INTO Role VALUES (2, 'AGE');
INSERT INTO Role VALUES (3, 'CLI');

-- Insert de Status
INSERT INTO Status VALUES (1, 'Open');
INSERT INTO Status VALUES (2, 'Waiting for client');
INSERT INTO Status VALUES (3, 'Waiting for agent');
INSERT INTO Status VALUES (4, 'Solved');

-- Insert de Admins
INSERT INTO User VALUES (1, 'Pedro Landolt', 'Landolt_admin', 'admin_pl@pourproblems.com', 'PourProblemsPL', 1);
INSERT INTO User VALUES (2, 'João Mota', 'Mota_admin', 'admin_jm@pourproblems.com', 'PourProblemsJM', 1);
INSERT INTO User VALUES (3, 'João Coelho', 'Coelho_admin', 'admin_jc@pourproblems.com', 'PourProblemsJC', 1);

/*

==========================================================
|                    -- Triggers --                      |
==========================================================

*/

-- Trigger para inserir o usuário que criou o ticket



-- Query para testar o banco de dados
SELECT * FROM User;
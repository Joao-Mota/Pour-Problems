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
DROP TABLE IF EXISTS Profile_Picture;


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
  image VARCHAR(255),
  CONSTRAINT user_role_fk FOREIGN KEY (role_id) REFERENCES Role
    ON UPDATE CASCADE
    ON DELETE CASCADE
);


-- Tabela de Tickets
CREATE TABLE Ticket 
(
  id INTEGER PRIMARY KEY,
  subject VARCHAR(255) NOT NULL,
  description TEXT,
  datetime DATETIME NOT NULL,
  department VARCHAR(255),
  status_id INTEGER NOT NULL,
  CONSTRAINT ticket_status_fk FOREIGN KEY (status_id) REFERENCES Status
    ON UPDATE CASCADE
    ON DELETE CASCADE
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
  datetime DATETIME,
  user_id INTEGER NOT NULL,
  ticket_id INTEGER NOT NULL,
  CONSTRAINT message_pk PRIMARY KEY (id),
  CONSTRAINT message_user_fk FOREIGN KEY (user_id) REFERENCES User
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT message_ticket_fk FOREIGN KEY (ticket_id) REFERENCES Ticket
    ON UPDATE CASCADE
    ON DELETE CASCADE
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
    ON UPDATE CASCADE
    ON DELETE CASCADE
);


-- Tabela Ticket_User, relaciona os usuários com os tickets
CREATE TABLE Ticket_User 
(
  ticket_id INTEGER PRIMARY KEY,
  client_id INTEGER,
  agent_id INTEGER,
  CONSTRAINT ticket_user_pk UNIQUE (client_id, ticket_id),
  CONSTRAINT ticket_user_user_fk FOREIGN KEY (client_id) REFERENCES User
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT ticket_user_agent_fk FOREIGN KEY (agent_id) REFERENCES User
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT ticket_user_ticket_fk FOREIGN KEY (ticket_id) REFERENCES Ticket
    ON UPDATE CASCADE
    ON DELETE CASCADE
);



-- Tabela de User_Department, relaciona os usuários com os departamentos
CREATE TABLE User_Department 
(
  user_id INTEGER NOT NULL,
  department_id INTEGER NOT NULL,
  CONSTRAINT user_department_pk PRIMARY KEY (user_id, department_id),
  CONSTRAINT user_department_user_fk FOREIGN KEY (user_id) REFERENCES User
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  CONSTRAINT user_department_department_fk FOREIGN KEY (department_id) REFERENCES Department
    ON UPDATE CASCADE
    ON DELETE CASCADE
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
    ON UPDATE CASCADE
    ON DELETE CASCADE
);


-- Tabela de Profile Picture, relaciona os usuários com suas imagens de perfil
CREATE TABLE Profile_Picture 
(
  id INTEGER,
  image VARCHAR(255) NOT NULL,
  user_id INTEGER NOT NULL,
  CONSTRAINT profile_picture_pk PRIMARY KEY (id),
  CONSTRAINT profile_picture_user_fk FOREIGN KEY (user_id) REFERENCES User
    ON UPDATE CASCADE
    ON DELETE CASCADE
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
INSERT INTO Status VALUES (1, 'Open (Waiting for agent)');
INSERT INTO Status VALUES (2, 'Assigned to agent');
INSERT INTO Status VALUES (3, 'Closed');

/*

==========================================================
|                    -- Triggers --                      |
==========================================================

*/

-- Trigger para inserir o usuário que criou o ticket



-- Query para testar o banco de dados
SELECT * FROM User;
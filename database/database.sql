/*
==========================================================
|                     -- Drops --                        |
==========================================================

*/

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Role;
DROP TABLE IF EXISTS Status;
DROP TABLE IF EXISTS Chat;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Department;


/*

==========================================================
|                     -- Tabelas --                      |
==========================================================

*/


-- Tabela de Usuários
CREATE TABLE User 
(
  id INTEGER,
  name VARCHAR(50),
  username VARCHAR(50),
  email VARCHAR(50),
  password VARCHAR(20),
  role_id INTEGER,
  department_id INTEGER,
  CONSTRAINT user_pk PRIMARY KEY (id),
  CONSTRAINT user_role_fk FOREIGN KEY (role_id) REFERENCES Role,
  CONSTRAINT user_department_fk FOREIGN KEY (department_id) REFERENCES Department
);


-- Tabela de Tickets
CREATE TABLE Ticket 
(
  id INTEGER,
  subject VARCHAR(100),
  datetime DATETIME,
  chat_id INTEGER,
  status_id INTEGER,
  client_id INTEGER,
  officer_id INTEGER,
  CONSTRAINT ticket_pk PRIMARY KEY (id),
  CONSTRAINT ticket_chat_fk FOREIGN KEY (chat_id) REFERENCES Chat,
  CONSTRAINT ticket_status_fk FOREIGN KEY (status_id) REFERENCES Status,
  CONSTRAINT ticket_client_fk FOREIGN KEY (client_id) REFERENCES User,
  CONSTRAINT ticket_officer_fk FOREIGN KEY (officer_id) REFERENCES User
);


-- Tabela de Roles, ex: Admin, Client, Officer
CREATE TABLE Role 
(
  id INTEGER,
  sigla VARCHAR(3),
  CONSTRAINT role_pk PRIMARY KEY (id)
);


-- Tabela de Status, ex: Open, Closed
CREATE TABLE Status 
(
  id INTEGER,
  stat VARCHAR(50),
  CONSTRAINT status_pk PRIMARY KEY (id)
);


-- Tabela de Chat, relaciona os tickets com os chats
CREATE TABLE Chat 
(
  id INTEGER,
  ticket_id INTEGER,
  CONSTRAINT chat_pk PRIMARY KEY (id),
  CONSTRAINT chat_ticket_fk FOREIGN KEY (ticket_id) REFERENCES Ticket
);


-- Tabela de Mensagens, relaciona os chats com as mensagens
CREATE TABLE Message 
(
  id INTEGER,
  text TEXT,
  datetime DATETIME,
  chat_id INTEGER,
  user_id INTEGER,
  CONSTRAINT message_pk PRIMARY KEY (id),
  CONSTRAINT message_chat_fk FOREIGN KEY (chat_id) REFERENCES Chat,
  CONSTRAINT message_user_fk FOREIGN KEY (user_id) REFERENCES User
);


-- Tabela de Departamentos, relaciona os usuários com os departamentos
CREATE TABLE Department 
(
  id INTEGER,
  name VARCHAR(25),
  user_id INTEGER,
  CONSTRAINT department_pk PRIMARY KEY (id),
  CONSTRAINT department_user_fk FOREIGN KEY (user_id) REFERENCES User
);
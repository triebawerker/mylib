-- scripts/schema.sqlite.sql
--
-- You will need load your database schema with this SQL.

CREATE TABLE guestbook (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    email VARCHAR(32) NOT NULL DEFAULT 'noemail@test.com',
    comment TEXT NULL,
    created DATETIME NOT NULL
);

CREATE INDEX "id" ON "guestbook" ("id");

Create table author (
	id integer not null primary key autoincrement,
	firstname varchar(50) null,
	lastname varchar(50) null
)

create table publisher (
	id integer not null primary key autoincrement,
	name varchar(50) null
)


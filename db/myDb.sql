CREATE TABLE Users ( id SERIAL NOT NULL PRIMARY KEY, username VARCHAR(100) NOT NULL UNIQUE, password VARCHAR(100) NOT NULL, display_name VARCHAR(100) NOT NULL );

CREATE TABLE Skills (id SERIAL NOT NULL PRIMARY KEY,name varchar(100) NOT NULL,dmg int,effect varchar(1000),range int,mp int NOT NULL,flavortext varchar(1000));

CREATE TABLE Abilities (id SERIAL NOT NULL PRIMARY KEY, effect varchar(1000) NOT NULL, type char NOT NULL, flavortext varchar(1000));

CREATE TABLE Equips ( id SERIAL NOT NULL PRIMARY KEY, name varchar(100) NOT NULL, effect varchar(1000) NOT NULL, flavortext varchar(1000));

CREATE TABLE SkillSet ( id SERIAL NOT NULL PRIMARY KEY, name varchar(100) NOT NULL, skill1 int REFERENCES SkillSet(id), skill2 int REFERENCES SkillSet(id), skill3 int REFERENCES SkillSet(id), skill4 int REFERENCES SkillSet(id), skill5 int REFERENCES SkillSet(id), skill6 int REFERENCES SkillSet(id), skill7 int REFERENCES SkillSet(id), skill8 int REFERENCES SkillSet(id), skill9 int REFERENCES SkillSet(id), skill10 int REFERENCES SkillSet(id));

CREATE TABLE Units ( id SERIAL NOT NULL PRIMARY KEY, name varchar(100) NOT NULL, class varchar(100) NOT NULL, A_Abilitiy int NOT NULL REFERENCES SkillSet(id), S_Ability int NOT NULL REFERENCES Abilities(id), R_Ability int REFERENCES Abilities(id), weapon1 int NOT NULL REFERENCES Equips(id), weapon2 int REFERENCES Equips(id), armor int NOT NULL REFERENCES Equips(id), accessory int NOT NULL REFERENCES Equips(id), lvl int NOT NULL, exp int NOT NULL, atk int NOT NULL, def int NOT NULL, int int NOT NULL, spr int NOT NULL, move int NOT NULL, crit int NOT NULL, eva int NOT NULL, flavortext varchar(1000));

CREATE TABLE Cells ( id SERIAL NOT NULL PRIMARY KEY, name varchar(100) NOT NULL, content char NOT NULL, hexColor int NOT NULL, isBlock boolean NOT NULL, effect varchar(1000));

CREATE TABLE CellPositions ( id SERIAL NOT NULL PRIMARY KEY, position varchar(2) NOT NULL, cell_id int NOT NULL REFERENCES Cells(id), grid_name varchar(100) NOT NULL);
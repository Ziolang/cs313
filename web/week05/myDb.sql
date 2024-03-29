CREATE TABLE users ( 
   id SERIAL NOT NULL PRIMARY KEY, 
   username VARCHAR(100) NOT NULL UNIQUE, 
   password VARCHAR(100) NOT NULL, 
   display_name VARCHAR(100) NOT NULL 
);

DROP TABLE units;
DROP TABLE skillset;
DROP TABLE skills;
DROP TABLE equips;
DROP TABLE abilities;

CREATE TABLE skills (
	id SERIAL NOT NULL PRIMARY KEY,
	name varchar(100) NOT NULL,
	dmg int,
	stat char(3),
	effect varchar(1000),
	range int,
	mp int NOT NULL,
	flavortext varchar(1000)
);

CREATE TABLE abilities (
	id SERIAL NOT NULL PRIMARY KEY, 
	name varchar(40) NOT NULL,
	effect varchar(1000) NOT NULL, 
	type char NOT NULL, 
	flavortext varchar(1000)
);

CREATE TABLE equips ( 
	id SERIAL NOT NULL PRIMARY KEY, 
	name varchar(100) NOT NULL, 
	effect varchar(1000) NOT NULL, 
	type varchar(40) NOT NULL,
	flavortext varchar(1000)
);

CREATE TABLE skillset ( 
	id SERIAL NOT NULL PRIMARY KEY, 
	name varchar(100) NOT NULL, 
	skill1 int REFERENCES skills(id), 
	skill2 int REFERENCES skills(id), 
	skill3 int REFERENCES skills(id), 
	skill4 int REFERENCES skills(id), 
	skill5 int REFERENCES skills(id), 
	skill6 int REFERENCES skills(id), 
	skill7 int REFERENCES skills(id), 
	skill8 int REFERENCES skills(id), 
	skill9 int REFERENCES skills(id), 
	skill10 int REFERENCES skills(id)
);

CREATE TABLE units ( 
	id SERIAL NOT NULL PRIMARY KEY, 
	name varchar(100) NOT NULL, 
	class varchar(100) NOT NULL, 
	aability int NOT NULL REFERENCES skillset(id), 
	sability int NOT NULL REFERENCES abilities(id), 
	rability int REFERENCES abilities(id), 
	weapon1 int NOT NULL REFERENCES equips(id), 
	weapon2 int REFERENCES equips(id), 
	armor int NOT NULL REFERENCES equips(id), 
	accessory int NOT NULL REFERENCES equips(id), 
	lvl int NOT NULL, 
	exp int NOT NULL, 
	hp int NOT NULL,
	mp int NOT NULL,
	atk int NOT NULL, 
	def int NOT NULL, 
	int int NOT NULL, 
	spr int NOT NULL, 
	move int NOT NULL, 
	crit int NOT NULL, 
	eva int NOT NULL, 
	flavortext varchar(4000)
);

CREATE TABLE cells ( 
	id SERIAL NOT NULL PRIMARY KEY, 
	name varchar(100) NOT NULL, 
	content char NOT NULL, 
	hexColor int NOT NULL, 
	isBlock boolean NOT NULL, 
	effect varchar(1000)
);

CREATE TABLE cellpositions ( 
	id SERIAL NOT NULL PRIMARY KEY, 
	position varchar(2) NOT NULL, 
	cell_id int NOT NULL REFERENCES cells(id), 
	grid_name varchar(100) NOT NULL
);

INSERT INTO skills 
VALUES 
	(DEFAULT, 'Fireball', 100, 'Int', 'Chance of Burn.', 3, 8, 'Hurls a flaming projectile at the target.'),
	(DEFAULT, 'Ice Shard', 120, 'Int', NULL, 3, 8, 'Hurls a Freezing projectile at the target.'),
	(DEFAULT, 'Flurry', 100, 'Atk', 'Hits three times.', 1, 10, 'Repeatedly strikes an opponent.'),
	(DEFAULT, 'Heavy Stance', 0, NULL, 'Increases Atk and Def by 20% for 3 turns.', 0, 8, 'Readies oneself into a prepared stance to improve combat prowess.'),
	(DEFAULT, 'Snipe', 100, 'Atk', 'Chance of Bleed.', 99, 10, 'Fires a magically imbued arrow capable of flying ridiculous distances.'),
	(DEFAULT, 'First Aid', 100, 'Atk', 'Healing.', 0, 6, 'Quickly dresses minor wounds.');

INSERT INTO abilities 
VALUES 
	(DEFAULT, 'Concentration', 'MP healing effects for the user are increased by 50%', 'S', NULL),
	(DEFAULT, 'Dual Wield', 'Unit may carry an additional weapon.', 'S', NULL),
	(DEFAULT, 'Steady Aim', 'Unit atk is increased by 10% and Basic Attack range is increased by 1.', 'S', NULL),
	(DEFAULT, 'Might', 'Atk and Def increased by 10%.', 'S', NULL),
	(DEFAULT, 'Prowess', 'Int and Spr increased by 10%.', 'S', NULL),
	(DEFAULT, 'Efficient', 'Skills cost 15% less MP.', 'S', NULL),
	(DEFAULT, 'Scorch', 'Basic attacks have Chance of Burn.', 'S', NULL);

INSERT INTO equips (name, effect, type)
VALUES 
	('Shortsword', 'Atk +1', 'Weapon'),
	('Dagger', 'Atk +1', 'Weapon'),
	('Staff', 'Int +1', 'Weapon'),
	('Bow', 'Range: +2.', 'Weapon'),
	('Chestplate', 'Def +1', 'Armor'),
	('Robe', 'Spr +1', 'Armor'),
	('Leather Padding', 'Def +1', 'Armor'),
	('Gauntlet', 'Atk +1', 'Accessory'),
	('Pendant', 'Int +1', 'Accessory'),
	('Bracer', 'Crit +3', 'Accessory'),
	('Silver Chain', 'MP +5', 'Accessory'),
	('Solid Helm', 'HP +5', 'Accessory'),
	('Quick Boots', 'Eva +3', 'Accessory');

INSERT INTO skillset (name, skill1, skill2)
VALUES 
	('Black Magic', 1, 2),
	('Swordsmanship', 3, 4),
	('Archery', 5, 6);

INSERT INTO units
VALUES 
	(DEFAULT, 'Magic Dude', 'Black Mage', 1, 1, NULL, 3, NULL, 6, 9, 1, 0, 15, 25, 2, 2, 4, 3, 2, 2, 2, NULL),
	(DEFAULT, 'Sword Guy', 'Swordsman', 2, 2, NULL, 1, 2, 5, 8, 1, 0, 25, 15, 4, 3, 2, 2, 3, 3, 2, NULL),
	(DEFAULT, 'Arrow Lady', 'Ranger', 3, 3, NULL, 4, NULL, 7, 10, 1, 0, 20, 20, 4, 2, 2, 3, 2, 4, 3, NULL);






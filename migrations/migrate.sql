DROP TABLE IF EXISTS collections;
create table collections( 
    collection_id int NOT NULL AUTO_INCREMENT, 
    collection_label varchar(255) NOT NULL,
    PRIMARY KEY (collection_id)
);

insert into collections (collection_label) values ("Adventure Time Funko Pops");
insert into collections (collection_label) values ("Adventure Time Funko Pops / Minecraft");
insert into collections (collection_label) values ("Adventure Time Funko Pops / Special Items");


DROP TABLE IF EXISTS collectables;
CREATE TABLE collectables (
    collectable_id int NOT NULL AUTO_INCREMENT, 
    collectable_label varchar(255) NOT NULL,
    collectable_collection tinyint,
    PRIMARY KEY (collectable_id)
);

insert into collectables (collectable_label, collectable_collection) values ("30 Lumpy Space Princess", 1);
insert into collectables (collectable_label, collectable_collection) values ("31 Marceline", 1);
insert into collectables (collectable_label, collectable_collection) values ("32 Finn", 1);
insert into collectables (collectable_label, collectable_collection) values ("32 Finn (w/ sword) - Hot Topic", 1);
insert into collectables (collectable_label, collectable_collection) values ("32 Finn (sword GITD) - 2013 SDCC", 1);
insert into collectables (collectable_label, collectable_collection) values ("33 Jake", 1);
insert into collectables (collectable_label, collectable_collection) values ("33 Jake (Flocked) - Toy Wars", 1);
insert into collectables (collectable_label, collectable_collection) values ("34 Ice King", 1);
insert into collectables (collectable_label, collectable_collection) values ("44 Zombie Jake - 2013 SDCC", 1);
insert into collectables (collectable_label, collectable_collection) values ("51 Princess Bubblegum", 1);
insert into collectables (collectable_label, collectable_collection) values ("51 Princess Bubblegum (GITD) - 2014 SDCC", 1);
insert into collectables (collectable_label, collectable_collection) values ("52 BMO", 1);
insert into collectables (collectable_label, collectable_collection) values ("52 BMO (Metallic) - Hot Topic", 1);
insert into collectables (collectable_label, collectable_collection) values ("52 BMO (GITD) - 2014 SDCC", 1);
insert into collectables (collectable_label, collectable_collection) values ("52 BMO Green - 2014 ECCC", 1);
insert into collectables (collectable_label, collectable_collection) values ("53 Lemongrab", 1);
insert into collectables (collectable_label, collectable_collection) values ("54 Fionna", 1);
insert into collectables (collectable_label, collectable_collection) values ("55 Cake", 1);
insert into collectables (collectable_label, collectable_collection) values ("87 Gunter", 1);
insert into collectables (collectable_label, collectable_collection) values ("187 JMO (Jake as BMO) - Target", 1);
insert into collectables (collectable_label, collectable_collection) values ("283 BMO Noire - Hot Topic", 1);
insert into collectables (collectable_label, collectable_collection) values ("301 Marceline (w/ hat, guitar) - Hot Topic", 1);
insert into collectables (collectable_label, collectable_collection) values ("302 Flame Princess", 1);
insert into collectables (collectable_label, collectable_collection) values ("303 The Lich", 1);
insert into collectables (collectable_label, collectable_collection) values ("303 The Lich Green - 2016 ECCC", 1);
insert into collectables (collectable_label, collectable_collection) values ("321 Blushing BMO - Hot Topic", 1);

insert into collectables (collectable_label, collectable_collection) values ("411 Finn / Minecraft", 2);
insert into collectables (collectable_label, collectable_collection) values ("412 Jake / Minecraft", 2);
insert into collectables (collectable_label, collectable_collection) values ("413 Marceline / Minecraft", 2);
insert into collectables (collectable_label, collectable_collection) values ("415 Princess Bubblegum / Minecraft", 2);

insert into collectables (collectable_label, collectable_collection) values ("2-Pack: Fionna & Cake - HMV", 3);
insert into collectables (collectable_label, collectable_collection) values ("Rides: 14 Jake Car with Finn", 3);


DROP TABLE IF EXISTS nerd_status;
create table nerd_status (
    nerd_status_id int NOT NULL AUTO_INCREMENT, 
    nerd_status_label varchar(255) NOT NULL,
    PRIMARY KEY (nerd_status_id)
);

insert into nerd_status (nerd_status_label) values ("Admin");

DROP TABLE IF EXISTS tribes;
create table tribes (
    tribe_id int NOT NULL AUTO_INCREMENT, 
    tribe_label varchar(255) NOT NULL,
    PRIMARY KEY (tribe_id)
);

insert into tribes (tribe_label) values ("Buttocks");

DROP TABLE IF EXISTS nerds;
create table nerds (
    nerd_id int NOT NULL AUTO_INCREMENT, 
    nerd_label varchar(255) NOT NULL,
    nerd_status tinyint not null,  
    PRIMARY KEY (nerd_id)
);

insert into nerds (nerd_label, nerd_status) values ("Dad", 1);
insert into nerds (nerd_label, nerd_status) values ("Dan", 1);
insert into nerds (nerd_label, nerd_status) values ("Alex", 1);


DROP TABLE IF EXISTS nerd_tribe_link;
create table nerd_tribe_link (
    nerd_tribe_link_id int NOT NULL AUTO_INCREMENT, 
    nerd_tribe_link_tribe tinyint not null,
    nerd_tribe_link_nerd tinyint not null,    
    PRIMARY KEY (nerd_tribe_link_id)
);

insert into nerd_tribe_link (nerd_tribe_link_tribe, nerd_tribe_link_nerd) values (1, 1);
insert into nerd_tribe_link (nerd_tribe_link_tribe, nerd_tribe_link_nerd) values (1, 2);
insert into nerd_tribe_link (nerd_tribe_link_tribe, nerd_tribe_link_nerd) values (1, 3);



DROP TABLE IF EXISTS sources;
create table sources (
    source_id int NOT NULL AUTO_INCREMENT, 
    source_label varchar(255) NOT NULL,    
    PRIMARY KEY (source_id)
);

insert into sources (source_label) values ("eBay"),("Forbidden Planet"),("N/A");


DROP TABLE IF EXISTS collected;
create table collected (
    collected_id int NOT NULL AUTO_INCREMENT, 
    collected_collectable tinyint not null,  
    collected_price int(255),
    collected_rating int,
    collected_nerd int,
    collected_source int,
    collected_date DATE,
    PRIMARY KEY (collected_id)
);


insert into collected (
    collected_collectable,
    collected_price,
    collected_rating,
    collected_nerd,
    collected_source,
    collected_date
) values 

-- Marcline / Dan
( 22, 1700, 5, 2, 1, '2021-03-12' ),
-- Lumpy space princess / Alex
( 1, 870, 2, 3, 1, '2021-02-12' ),
-- Finn / Alex
( 3, 1600, 3, 3, 1, '2021-03-13' ),
-- Jake / Alex
( 6, 760, 3, 3, 1, '2021-03-09' ),
-- BMO / Alex
( 12, 1600, 3, 3, 1, '2021-02-02' ),
-- BMO ( blushing ) / Alex
( 26, 1250, 3, 3, 2, '2019-12-2' ),
-- Gunther / Dan
( 19, 1150, 5, 2, 1, '2021-03-12' ),
-- The Lich / Dan
( 24, 1000, 5, 2, 1, '2021-02-24' ),
-- Lemongrab / Dan
( 16, 850, 5, 2, 1, '2021-03-02' ),
-- Ice king / Alex
( 8, 900, 5, 2, 1, '2021-03-21' ),
-- Fionna / Dan
( 17, 700, 5, 2, 1, '2021-03-27' )
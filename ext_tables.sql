CREATE TABLE fe_users (
    room varchar(255) DEFAULT '' NOT NULL,
    department varchar(255) DEFAULT '' NOT NULL,
    position varchar(255) DEFAULT '' NOT NULL,
    teaching_area varchar(255) DEFAULT '' NOT NULL,
    consultation_hours text,
    mobile varchar(50) DEFAULT '' NOT NULL,
    fax varchar(50) DEFAULT '' NOT NULL,
    vita_entries int(11) unsigned DEFAULT '0' NOT NULL,
    publications int(11) unsigned DEFAULT '0' NOT NULL,
    researches int(11) unsigned DEFAULT '0' NOT NULL,
    teachings int(11) unsigned DEFAULT '0' NOT NULL,
    person_links int(11) unsigned DEFAULT '0' NOT NULL,
    slug varchar(2048) DEFAULT '' NOT NULL,
    tx_extbase_type varchar(255) DEFAULT '' NOT NULL,

    KEY slug (slug(191))
);

CREATE TABLE tx_dveducationpersons_domain_model_vitaentry (
    person int(11) unsigned DEFAULT '0' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    description text,
    date_start date DEFAULT NULL,
    date_end date DEFAULT NULL,
    sorting int(11) DEFAULT '0' NOT NULL
);

CREATE TABLE tx_dveducationpersons_domain_model_publication (
    person int(11) unsigned DEFAULT '0' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    description text,
    date date DEFAULT NULL,
    url varchar(2048) DEFAULT '' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL
);

CREATE TABLE tx_dveducationpersons_domain_model_research (
    person int(11) unsigned DEFAULT '0' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    description text,
    date date DEFAULT NULL,
    url varchar(2048) DEFAULT '' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL
);

CREATE TABLE tx_dveducationpersons_domain_model_teaching (
    person int(11) unsigned DEFAULT '0' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    description text,
    date date DEFAULT NULL,
    url varchar(2048) DEFAULT '' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL
);

CREATE TABLE tx_dveducationpersons_domain_model_link (
    person int(11) unsigned DEFAULT '0' NOT NULL,
    title varchar(255) DEFAULT '' NOT NULL,
    url varchar(2048) DEFAULT '' NOT NULL,
    sorting int(11) DEFAULT '0' NOT NULL
);

CREATE TABLE tt_content (
    counter_time int(11) unsigned DEFAULT '0' NOT NULL,
    counter_stop int(11) unsigned DEFAULT '0' NOT NULL,
    counter_stop_text text,
    counter_labels varchar(255) DEFAULT '' NOT NULL,
    counter_format varchar(255) DEFAULT '' NOT NULL,
);

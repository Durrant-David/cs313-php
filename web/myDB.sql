CREATE TABLE catwalk (
    id serial PRIMARY KEY,
    name varchar(255)
);

CREATE TABLE lookup (
    id serial PRIMARY KEY,
    "level" varchar(255),
    cwalk_id INT REFERENCES "catwalk"(id),
    chairs varchar(255),
    light int,
    fixture_id int
);

CREATE TABLE fixtures (
    id serial PRIMARY KEY,
    cwalk_id INT REFERENCES "catwalk"(id),
    number int,
    "status" varchar(255)
);

CREATE TABLE category (
    id serial PRIMARY KEY,
    name varchar(255),
    parent_cat INT REFERENCES "category"(id)
);

CREATE TABLE catalog (
    id serial PRIMARY KEY,
    name varchar(255),
    cat_id INT REFERENCES "category"(id),
    description text,
    image varchar(255),
    location varchar(255),
    "status" varchar(255)
);

CREATE TABLE access_level (
    id serial PRIMARY KEY,
    name varchar(255)
);

CREATE TABLE "user" (
    id serial PRIMARY KEY,
    username varchar(255),
    first_name varchar(255),
    last_name varchar(255),
    access_id INT REFERENCES "access_level"(id),
    last_login date,
    expiration date
);
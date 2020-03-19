create table if not exists Administrator (
    id integer primary key,
    firstname text not null,
    lastname text not null,
    email text not null,
    pass text not null,
    is_active boolean default false not null,
);

create table if not exists Manager (
    id integer primary key,
    firstname text not null,
    lastname text not null,
    email text not null,
    pass text not null,
    work_address text,
    phone text,
    picture mediumblob,
    is_active boolean default false not null,
);

create table if not exists User (
    NSS integer primary key,
    firstname text not null,
    lastname text not null,
    email text not null,
    pass text not null,
    doctor integer references Manager(id), 
    phone text,
    picture mediumblob,
);

create table if not exists Banned (
    NSS integer references User(NSS)
);

create table if not exists Exam (
    id integer primary key,
    doctor integer references Manager(id),
    patient integer references User(NSS),
);

create table if not exists Contain (
    idTest text not null,
    type text not null,
    exam integer references Exam(id),
);

create table if not exists Testuser (
    id integer primary key,
    firstname text not null,
    lastname text not null,
    NSS integer primary key,
    Date text not null
);

create table if not exists console (
    id integer primary key
);




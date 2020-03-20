create table if not exists Administrator (
    id integer primary key,
    firstname text not null,
    lastname text not null,
    email text not null,
    pass text not null,
    is_active boolean default false not null
);

create table if not exists Manager (
    id integer primary key,
    firstname text not null,
    lastname text not null,
    email text not null,
    pass text not null,
    work_address text not null,
    phone text,
    picture mediumblob,
    is_active boolean default false not null
);

create table if not exists User (
    NSS integer primary key,
    firstname text not null,
    lastname text not null,
    email text not null,
    pass text not null,
    doctor integer not null references Manager(id),
    phone text,
    picture mediumblob
);

create table if not exists Banned (
    NSS integer unique references User(NSS)
);

create table if not exists Exam (
    id integer primary key,
    doctor integer not null references Manager(id),
    patient integer not null references User(NSS),
    console integer references Console(id)
);

create table if not exists Test (
    id integer primary key,
    nameType text not null,
    result float,
    start_time timestamp,
    exam integer references Exam(id)
);

create table if not exists Console (
    id integer primary key,
    manager integer not null references Manager(id)
);

create table if not exists FAQ (
    num integer primary key,
    administrator integer not null references Administrator(id),
    question text not null,
    answer text not null
);
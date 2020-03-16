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
    work_address text,
    phone text,
    picture mediumblob,
    is_active boolean default false not null
);
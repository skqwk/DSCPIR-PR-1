create table location
(
    id        bigserial
        primary key,
    latitude  double precision,
    longitude double precision,
    name      varchar(255)
);

alter table location
    owner to root;

create table user_account
(
    id       bigserial
        primary key,
    password varchar(255),
    username varchar(255)
);

alter table user_account
    owner to root;

create table weather_report
(
    id          bigserial
        primary key,
    pressure    double precision,
    temperature double precision,
    timestamp   varchar(255),
    wind_speed  double precision
);

alter table weather_report
    owner to root;

insert into public.location (id, latitude, longitude, name)
values  (1, 42.3, 57.8, 'Alekseevka, Belgorodskaya oblast'),
        (2, 44.3, 58.8, 'Chernyanka, Belgorodskaya oblast');

insert into public.user_account (id, password, username)
values  (1, '$2a$10$qQ/kUKaku6hLp1G60s7q9uBY3coYog3IvRzsMjh0vwrvckt2K9jaa', 'user'),
        (2, '$2a$10$B7MVUVLCh96QeBUZh2eoV.3bENr0RWGvlx7K1QEAS2SRPyPH6RSni', 'admin');

insert into public.weather_report (id, pressure, temperature, timestamp, wind_speed)
values  (1, 760.1, 23.2, '2022/10/11', 5.4),
        (2, 760.1, 25.1, '2022/11/11', 10.5);

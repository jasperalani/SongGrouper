# Song table
create table sg_db.sg_song_table
(
    id          int auto_increment
        constraint `PRIMARY`
        primary key,
    artist_name varchar(255)                         null,
    album_name  varchar(255)                         null,
    song_name   varchar(255)                         null,
    link        varchar(255)                         null,
    created     datetime default current_timestamp() null,
    deleted     datetime                             null
);

# Meta table
create table sg_db.sg_ext_meta_table
(
    id int auto_increment
        constraint `PRIMARY`
        primary key
);
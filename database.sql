CREATE DATABASE IF NOT EXISTS videoslaravel;
USE videoslaravel;

CREATE TABLE users(
  id int(255) auto_increment not null,
  role varchar(20),
  name varchar(255),
  surname varchar(255),
  email varchar(255),
  password varchar(255),
  image varchar(255),
  create_at datetime,
  update_at datetime,
  remember_token varchar(255),
  CONSTRAINT pk_user PRIMARY KEY(id)
)engine =InnoDb;

CREATE TABLE videos(
  id int(255) auto_increment not null,
  user_id int(255) not null,
  title varchar(255),
  description text,
  status varchar(20),
  image varchar(255),
  video_path varchar(255),
  create_at datetime,
  update_at datetime,
  CONSTRAINT pk_videos PRIMARY KEY(id),
  CONSTRAINT fk_videos_user FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE = InnoDb;

CREATE TABLE comments(
  id int(255) auto_increment not null,
  user_id int(255) not null,
  video_id int(255) not null,
  body text,
  create_at datetime,
  update_at datetime,
  CONSTRAINT pk_commnet PRIMARY KEY (id),
  CONSTRAINT fk_comment_videos FOREIGN KEY (video_id) REFERENCES videos(id),
  CONSTRAINT fk_comment_user FOREIGN KEY (user_id) REFERENCES users(id)

)ENGINE = InnoDb;
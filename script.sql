-- @block

create database GameVault;
use gamevault;
-- @block

create table users(
	User_ID int primary key auto_increment,
    Nick_Name varchar (50) not null,
    Email varchar (100) unique not null,
    Password varchar (100) not null,
    Role enum ("User","Admin") ,
    Banned boolean default (false),
    Profile_Pic varchar (300) 
    
);
-- @block

create table Games(
	Game_ID int primary key auto_increment,
    Game_Name varchar(50) not null ,
    Poster varchar (300) not null,
    Game_Category varchar(100),
    Relese_Date Date 
);
-- @block
create table Screen_Shots(
	Screen_ID int primary key auto_increment,
    Game_ID int ,
    Screen_Url varchar (300) not null ,
    constraint FK_Game_Screens foreign key (Game_ID) references Games(Game_ID)
);

-- @block

create table Scores(
	Score_ID int primary key auto_increment,
    Game_ID int not null, 
    User_ID int not null,
    Score int default 0,
    constraint FK_Game_Score foreign key (Game_ID) references Games (Game_ID),
    constraint FK_Player_Score foreign key (User_ID) references Users (User_ID)
);

-- @block
create table Chat_Rooms(
	Chat_Room_ID int primary key auto_increment,
    Game_ID int not null,
    constraint FK_Game_Chat foreign key (Game_ID) references Games (Game_ID)
);

-- @block
create table Libraries(
	Library_ID int primary key auto_increment,
    User_ID int not null ,
     constraint FK_UserLibrary foreign key (User_ID) references users (User_ID)
);

-- @block
create table Library_Join(
	Library_Join_ID int primary key auto_increment,
    Library_ID int not null ,
    Game_ID int not null ,
    constraint FK_Library_Game foreign key (Game_ID) references Games (Game_ID),
    constraint FK_User_Library foreign key (Library_ID) references Libraries (Library_ID)
);

-- @block
create table Feedbacks(
	Feedback_ID int primary key auto_increment,
    Game_ID int not null,
    Rating int default 0,
    feedback varchar(200) not null,
    constraint FK_Game_Feedback foreign key (Game_ID) references Games (Game_ID)
);

-- @block
create table Chat_Room_Join(
	Message_ID int primary key auto_increment,
    User_ID int not null ,
    Chat_Room_ID int not null,
    Message_Content varchar (200) not null,
	foreign key (User_ID) references users (User_ID),
    foreign key (Chat_Room_ID) references Chat_Rooms (Chat_Room_ID)
    
);

-- @block
create table Wish_Lists(
	Wish_List_ID int primary key auto_increment,
    User_ID int not null ,
	foreign key (User_ID) references users (User_ID)

);

-- @block

create table Wish_Lists_Join(
	Wish_Join_ID int primary key auto_increment,
    Game_ID int not null ,
    Wish_List_ID int not null,
    foreign key (Game_ID) references Games (Game_ID),
    foreign key (Wish_List_ID) references Wish_Lists (Wish_List_ID)
);

-- @block
create table Histories(
	Historic_ID int primary key auto_increment,
    User_ID int not null,
    foreign key (User_ID) references users (User_ID)
);

-- @block
create table Histories_Join(
	Historic_Join_ID int primary key auto_increment,
    Game_ID int not null,
    Historic_ID int not null,
    foreign key (Game_ID) references Games (Game_ID),
    foreign key (Historic_ID) references Histories (Historic_ID)
);
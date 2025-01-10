
DESCRIBE chat_messages;

 -- @block
 SELECT * FROM games;

 -- @block
 INSERT INTO games(Game_Name,Poster,Game_Category,Relese_Date) VALUES ('Lost Ark','https://kgo.googleusercontent.com/profile_vrt_raw_bytes_1587514212_1078.jpg','MMO RPG','2014-11-12')
 -- @block
 INSERT INTO games(Game_Name,Poster,Game_Category,Relese_Date) VALUES('Guild wars','https://cdn2.steamgriddb.com/thumb/74981861c59aa5c1b551b36b741976cf.jpg','MMO RPG','2012-08-28');


  -- @block
 INSERT INTO games(Game_Name,Poster,Game_Category,Relese_Date) VALUES ('Counter strike 2','https://upload.wikimedia.org/wikipedia/en/f/f2/CS2_Cover_Art.jpg','FPS','2023-09-27')
 -- @block
 INSERT INTO games(Game_Name,Poster,Game_Category,Relese_Date) VALUES('Valorant','https://m.media-amazon.com/images/M/MV5BZmQwMjQ2ZTUtZmM5MC00MTdkLWIxYzgtODU1NzQ4Zjg4NmMxXkEyXkFqcGc@._V1_.jpg','FPS','2020-05-28');


-- @block
  INSERT INTO games(Game_Name,Poster,Game_Category,Relese_Date) VALUES ('PUBG Battlegrounds','https://cdn1.epicgames.com/spt-assets/53ec4985296b4facbe3a8d8d019afba9/pubg-battlegrounds-17zb2.png','Battleground','2017-03-23')
 -- @block
 INSERT INTO games(Game_Name,Poster,Game_Category,Relese_Date) VALUES('Fortnite','https://m.media-amazon.com/images/M/MV5BMTZlMmIxM2EtN2Y4Zi00M2ZhLTk3NzgtNjJmZTU0MTQ3YjcwXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg','Battleground','2018-07-21');

-- @block
SHOW TABLES;

-- @block

SELECT * FROM wish_lists

--@block
INSERT INTO Wish_Lists_Join(Game_ID,Wish_List_ID) VALUES(3,2)

CREATE TABLE comics(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(100) NOT NULL,
    publisher VARCHAR(20) NOT NULL,
    price NUMERIC(10,2) NOT NULL,
    createdAt VARCHAR(19) NOT NULL,
    updatedAt VARCHAR(19) NOT NULL
);

INSERT INTO comics VALUES (null, 'The Dark Knight Returns', 'DC Comics', 13.80, '2017-04-27 13:32:00', '2017-04-27 13:32:00');
INSERT INTO comics VALUES (null, 'Watchmen', 'DC Comics', 17.96, '2017-04-27 16:22:15', '2017-04-27 16:22:15');
INSERT INTO comics VALUES (null, 'V for Vendetta', 'DC Comics', 11.97, '2017-04-28 13:32:00', '2017-04-28 13:32:00');
INSERT INTO comics VALUES (null, 'Arkham Asylum', 'DC Comics', 13.59, '2017-04-27 08:05:00', '2017-04-27 08:05:00');
INSERT INTO comics VALUES (null, 'Spider-Man: Kravens Last Hunt', 'Marvel Comics', 29.45, '2017-04-27 11:31:00', '2017-04-27 11:31:00');
INSERT INTO comics VALUES (null, 'Asterios Polyp', 'Pantheon', 22.79, '2017-04-27 17:59:00', '2017-04-27 17:59:00');
INSERT INTO comics VALUES (null, 'Infinity Gauntlet', 'Marvel Comics', 15.24, '2017-04-28 16:00:03', '2017-04-28 16:00:03');

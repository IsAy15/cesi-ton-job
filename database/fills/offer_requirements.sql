DELETE FROM offer_requirements;

INSERT INTO offer_requirements (of_id, ab_id) VALUES
(1, 1), (1, 2), (1, 3),
(2, 4), (2, 5), (2, 6), (2, 9), (2, 14), (2, 15), (2, 16),
(3, 1), (3, 2), (3, 3), (3, 14), (3, 15), (3, 16),
(4, 1), (4, 2), (4, 3), (4, 5), (4, 9), (4, 14), (4, 15), (4, 16),
(5, 4), (5, 5), (5, 6), (5, 9), (5, 13), (5, 14), (5, 15), (5, 16),
(6, 4), (6, 5), (6, 6), (6, 9), (6, 13), (6, 14), (6, 15), (6, 16),
(7, 1), (7, 2), (7, 3), (7, 13), (7, 14), (7, 15), (7, 16),
(8, 4), (8, 5), (8, 6), (8, 13), (8, 14), (8, 15), (8, 16);

--Ca ne fonctionne pas
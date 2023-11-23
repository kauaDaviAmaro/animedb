CREATE DATABASE IF NOT EXISTS `animedb`;

use `animedb`;

CREATE TABLE IF NOT EXISTS `usuario` (
	`id_usuario` INT NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(100) NOT NULL,
	`senha` VARCHAR(255) NOT NULL,
	`apelido` VARCHAR(100) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`numero_seguidores` INT DEFAULT 0,
	`data_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id_usuario`)
);

INSERT INTO usuario (nome, senha, apelido, email) VALUES ("dd@dd.com", "dd@dd.com", "dd@dd.com", "dd@dd.com");

CREATE TABLE IF NOT EXISTS `anime` (
	`id_anime` INT NOT NULL AUTO_INCREMENT,
    `titulo` VARCHAR(50) NOT NULL,
    `produtora` VARCHAR(50) NOT NULL,
    `diretor` VARCHAR(50) NOT NULL,
    `ano_lancamento` DATE NOT NULL,
    `classificacao` CHAR(2) NOT NULL,
    `categoria` VARCHAR(100) NOT NULL,
    `local_imagem` TEXT NOT NULL,
    `logo_imagem` TEXT NOT NULL,
    `descricao` TEXT NOT NULL,
    `total_comentario` INT DEFAULT 0,
    `nota` INT DEFAULT 1,
    `criado` INT NOT NULL,
	PRIMARY KEY (`id_anime`),
    FOREIGN KEY (`criado`) REFERENCES `usuario`(`id_usuario`)
);

CREATE TABLE IF NOT EXISTS `avaliacao` (
    `id_avaliacao` INT  NOT NULL AUTO_INCREMENT,
    `id_anime` INT,
    `id_usuario` INT,
    `nota` INT NOT NULL,
    `resenha` TEXT NOT NULL,
	`data_registro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_avaliacao`),
    FOREIGN KEY (`id_anime`) REFERENCES `anime`(`id_anime`),
    FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id_usuario`)
);

CREATE TABLE IF NOT EXISTS `seguidores` (
    `id_seguidor` INT NOT NULL AUTO_INCREMENT,
    `id_usuario_seguido` INT NOT NULL,
    `id_usuario_seguidor` INT NOT NULL,
    PRIMARY KEY (`id_seguidor`),
    FOREIGN KEY (`id_usuario_seguido`) REFERENCES `usuario`(`id_usuario`),
    FOREIGN KEY (`id_usuario_seguidor`) REFERENCES `usuario`(`id_usuario`)
);

-- Trigger para atualizar total_comentario quando uma nova avaliação é inserida
DELIMITER //
CREATE TRIGGER after_avaliacao_insert
AFTER INSERT ON avaliacao
FOR EACH ROW
BEGIN
    UPDATE anime
    SET total_comentario = total_comentario + 1
    WHERE id_anime = NEW.id_anime;
END;
//
DELIMITER ;

-- Trigger para atualizar total_comentario quando uma avaliação é deletada
DELIMITER //
CREATE TRIGGER after_avaliacao_delete
AFTER DELETE ON avaliacao
FOR EACH ROW
BEGIN
    UPDATE anime
    SET total_comentario = total_comentario - 1
    WHERE id_anime = OLD.id_anime;
END;
//
DELIMITER ;



INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (1, 'One Piece', 'Toei Animation', 'Kounosuke Uda', '1999-10-20', '14', 'Aventura', 'https://www.crunchyroll.com/imgsrv/display/thumbnail/1200x675/catalog/crunchyroll/1ecde018e863e2aaee31f00a23378c35.jpe', 'https://1000logos.net/wp-content/uploads/2022/08/One-Piece-Logo.png', 'There once lived a pirate named Gol D. Roger. He obtained wealth, fame, and power to earn the title of Pirate King. When he was captured and about to be executed, he revealed that his treasure called One Piece was hidden somewhere at the Grand Line. This made all people set out to search and uncover the One Piece treasure, but no one ever found the location of Gol D. Roger&#38;#39;s treasure, and the Grand Line was too dangerous a place to overcome. Twenty-two years after Gol D. Roger&#38;#39;s death, a boy named Monkey D. Luffy decided to become a pirate and search for Gol D. Roger&#38;#39;s treasure to become the next Pirate King.', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (3, 'Demon Slayer', 'Ufotable', 'Haruo Sotozaki', '2019-04-06', '16', 'Acao', 'https://a.storyblok.com/f/178900/1280x720/15642d94c0/f5d0f04e85a224493fe9caa2e59740811630901421_main.png/m/filters:quality(95)format(webp)', 'https://upload.wikimedia.org/wikipedia/commons/a/a8/Kimetsu_no_Yaiba_logo_%28red%29.png', 'A family is attacked by demons and only two members survive - Tanjiro and his sister Nezuko, who is turning into a demon slowly. Tanjiro sets out to become a demon slayer to avenge his family and cure his sister.', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (4, 'One Punch Man', 'Madhouse', 'Shingo Natsume', '2015-10-05', '16', 'Comedia', 'https://occ-0-2794-2219.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABYM9KvP-bpz9dnTQP1O7OhpXl-Vs21ImIUtsfrrwF34WX36c4S7ceysPRTiFe4MamL8AKhiCvsPsS_ON75eGeuJfhSEmUp4l6bM0.jpg?r=0e5', 'https://i.pinimg.com/originals/15/f7/51/15f751c21abe543475e770664ddea8fe.png', 'In a world of superhuman beings, Saitama is a unique hero, he can defeat enemies with a single punch. But being just one hero in a world filled with them, his life is empty and hollow: he gets no respect from anyone, he displays a laidback attitude to everything and for the most part, he finds his overall hero life pointless... and worst of all, he lost his hair due to intense training. These are the adventures of an ordinary yet extraordinary hero.', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (5, 'Death Note', 'Madhouse', 'Tetsurō Araki', '2006-10-04', 'LI', 'Misterio', 'https://cinepop.com.br/wp-content/uploads/2022/07/death-note-netflix.jpg', 'https://upload.wikimedia.org/wikipedia/commons/4/4a/Death_Note_logo_%28black_background%29.png', 'After an intelligent yet cynical high school student begins to cleanse the world from evil with the help of a magical notebook that can kill anyone whose name is written on it, international authorities call upon a mysterious detective known as &#38;#34;L&#38;#34; to thwart his efforts.', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (6, 'Fullmetal Alchemist', 'Bones', 'Seiji Mizushima', '2009-04-05', '16', 'Aventura', 'https://miro.medium.com/v2/resize:fit:1400/1*9IqR88lb9NRRVLNid4OBJw.jpeg', 'https://occ-0-2794-2219.1.nflxso.net/dnm/api/v6/LmEnxtiAuzezXBjYXPuDgfZ4zZQ/AAAABZrHx_Ys2cQXJ4cP0_WI2RkqqEeV-p5duHjyS5Fh5cm2vfszwvCZHECoVCoKrTat4bz1SzaF2-cp9SDNXxr4M0a_mp9zl2UJhHrGpN3pBvOx.png?r=06b', 'Two brothers lose their mother to an incurable disease. With the power of &#38;#34;alchemy&#38;#34;, they use taboo knowledge to resurrect her. The process fails, and as a toll for using this type of alchemy, the older brother, Edward Elric loses his left leg while the younger brother, Alphonse Elric loses his entire body. To save his brother, Edward sacrifices his right arm and is able to affix his brother&#38;#39;s soul to a suit of armor. With the help of a family friend, Edward receives metal limbs - &#38;#34;automail&#38;#34; - to replace his lost ones. With that, Edward vows to search for the Philosopher&#38;#39;s Stone to return the brothers to their original bodies, even if it means becoming a &#38;#34;State Alchemist&#38;#34;, one who uses his/her alchemy for the military.', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (7, 'Hunter x Hunter', 'Madhouse', 'Hiroshi Kōjina', '2011-10-02', '16', 'Ficcao_Cientifica', 'https://www.cnet.com/a/img/resize/ab9fc7f5f1a1e52e08cd315879b9f112e7a13d0c/hub/2022/05/25/36e6a368-1b94-44b1-9fb8-5aaa7977bf05/hunterxhunter.jpg?auto=webp&fit=crop&height=675&width=1200', 'https://upload.wikimedia.org/wikipedia/commons/c/c8/Hunter_x_hunter.png', 'Gon Freecss is a young boy living on Whale Island. He learns from &#38;#34;Hunter&#38;#34; Kite, that his father, who he was told was dead, is still alive somewhere as a top &#38;#34;Hunter,&#38;#34; risking his life to seek unknown items, such as hidden treasures, curiosa, exotic living creatures, etc. Gon decides to become a professional Hunter and leaves the island. To become a Hunter, he must pass the Hunter Examination, where he meets and befriends three other applicants: Kurapika, Leorio and Killua. Can Gon pass this formidable hurdle, the Hunter Examination, to become &#38;#34;the Best Hunter in the World&#38;#34; and eventually meet his father?', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (8, 'Chainsaw Man', 'MAPPA', 'Ryū Nakayama', '2022-02-12', '14', 'Comedia', 'https://criticalhits.com.br/wp-content/uploads/2021/04/chainsaw.jpg', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Chainsaw_Man_logo.png/1200px-Chainsaw_Man_logo.png', 'When his father died, Denji was stuck with a huge debt and no way to pay it back. Thanks to a Devil dog he saved named Pochita, he&#38;#39;s able to survive through odd jobs and killing Devils for the Yakuza. Pochita&#38;#39;s chainsaw powers come in handy against these powerful demons. When the Yakuza betrays him and he&#38;#39;s killed by the Zombie Devil, Pochita sacrifices himself to save his former master. Now Denji has been reborn as some kind of weird Devil-Human hybrid. He is now a Chainsaw Man!', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (9, 'My Hero Academia', 'Bones', 'Kenji Nagasaki', '2016-04-03', '14', 'Acao', 'https://static.bandainamcoent.eu/high/my-hero-academia/my-hero-ultra-rumble/00-page-setup/MHUR-new-header-mobile.jpg', 'https://1000logos.net/wp-content/uploads/2021/11/My-Hero-Academia-Logo.png', 'In a world where people with superpowers (known as "quirks") are the norm, a boy without them must enroll in a prestigious hero academy and uncover its dark secrets.', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (10, 'Attack on Titan', 'Wit Studio', 'Tetsurō Araki', '2013-04-06', '18', 'Acao', 'https://www.cafemaisgeek.com/wp-content/uploads/2023/04/AttackOnTitan_Anime_ColossusTitan_Eren_fixed.jpg', 'https://logosmarcas.net/wp-content/uploads/2022/02/Attack-on-Titan-Logo.png', 'In a world where giant humanoid creatures known as Titans threaten the existence of humanity, a young boy named Eren Yeager vows to reclaim his homeland by joining the scout regiment and taking down the Titans.', 0, 1, 1);
INSERT INTO `anime` (`id_anime`, `titulo`, `produtora`, `diretor`, `ano_lancamento`, `classificacao`, `categoria`, `local_imagem`, `logo_imagem`, `descricao`, `total_comentario`, `nota`, `criado`) VALUES (11, 'Naruto', 'Pierrot', 'Hayato Date', '2002-10-03', '14', 'Acao', 'https://www.alucare.fr/wp-content/uploads/2023/08/Naruto-scaled.jpg', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Naruto_logo.svg/1280px-Naruto_logo.svg.png', 'It is about a boy named Naruto Uzumaki, with a demon fox sealed within him. He is shunned and hated by both villagers and other ninja, and is labeled a freak and a danger to all around him. He overcomes these challenges through hard work and perseverance, and slowly earns the respect and appreciation of others. He finds friendship and love in those who believed in him when others would not, and together they work as a team to overcome the challenges they face and become true ninjas. It is a story of hope and love, of overcoming impossible odds, and of finding the value and beauty in even the darkest of times', 0, 1, 1);

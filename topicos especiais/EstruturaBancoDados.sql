CREATE TABLE tb_livros(
    id INT unsigned not null PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    pagina INT NOT NULL DEFAULT 0,
    genero VARCHAR(50) NOT NULL
)

create table tb_generos(
    id int unsigned not null primary key auto_increment,
    cod char(3) not null,
    nome tinytext
)

INSERT INTO tb_generos(cod, nome) VALUES
('ROM', 'Romance'),
('TER', 'Terror'),
('COM', 'Comédia'),
('FAN', 'Fantasia'),
('DIS', 'Distopia'),
('FAB', 'Fábula');

ALTER TABLE tb_livros ADD genero_id int unsigned default null AFTER id,
ADD CONSTRAINT fk_livro_genero FOREIGN KEY (genero_id) REFENCES tb_generos(id);

INSERT INTO tb_livros(titulo, autor, pagina, genero) VALUES
('O Senhor dos Anéis', 'J.R.R. Tolkien', 1216, 'Fantasia'),
('1984', 'George Orwell', 328, 'Distopia'),
('O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 96, 'Fábula'),
('Dom Quixote', 'Miguel de Cervantes', 992, 'Romance');



SELECT * FROM tb_livros ORDER BY genero ASC;


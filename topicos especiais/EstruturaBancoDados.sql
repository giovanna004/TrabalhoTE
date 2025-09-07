CREATE database biblioteca;

CREATE TABLE tb_livros(
    id INT unsigned not null PRIMARY KEY AUTO_INCREMENT,
    capa VARCHAR(255),
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
ADD CONSTRAINT fk_livro_genero FOREIGN KEY (genero_id) REFERENCES tb_generos(id);



SELECT * FROM tb_livros ORDER BY genero ASC;


CREATE DATABASE IF NOT EXISTS tedsi;
USE tedsi;

CREATE TABLE tb_generos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    descricao TEXT
);

CREATE TABLE tb_livros(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    genero_id INT UNSIGNED,
    capa VARCHAR(255),
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    paginas INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_livro_genero 
        FOREIGN KEY (genero_id) REFERENCES tb_generos(id)
        ON UPDATE CASCADE ON DELETE SET NULL
);



INSERT INTO tb_generos(nome, descricao) VALUES
('Romance', 'Narrativas centradas em relações amorosas e emocionais.'),
('Terror', 'Histórias com elementos assustadores e sobrenaturais.'),
('Fantasia', 'Mundos ficcionais com magia ou seres fantásticos.'),
('Aventura', 'Histórias de exploração, desafios e jornadas épicas.'),
('Ficção Científica', 'Enredos baseados em ciência, tecnologia e futuros imaginários.'),
('Biografia', 'Relatos sobre a vida de uma pessoa real.'),
('História', 'Obras que exploram fatos e contextos históricos.'),
('Poesia', 'Coloções de poemas líricos, épicos ou narrativas.'),
('Drama', 'Narrativas intensas que exploram conflitos humanos.'),
('Humor', 'Livros focados em situações cômicas e sátiras.'),
('Autoajuda', 'Obras que visam orientar sobre desenvolvimento pessoal.'),
('Infantil', 'Livros destinados ao público infantil com temas apropriados.'),
('Jovem Adulto', 'Narrativas voltadas para adolescentes e jovens adultos.'),
('Clássicos', 'Obras literárias reconhecidas por sua importância histórica e cultural.'),
('Suspense', 'Histórias que mantêm o leitor em tensão e expectativa.'),
('Mistério', 'Enredos centrados em enigmas ou crimes a serem resolvidos.'),
('Religião', 'Livros que exploram temas espirituais e religiosos.'),
('Filosofia', 'Obras que discutem questões fundamentais sobre existência, conhecimento e ética.'),
('Ciência', 'Livros que explicam conceitos científicos e descobertas.'),
('Tecnologia', 'Obras que abordam avanços tecnológicos e seu impacto na sociedade.'),
('HQs e Mangás','Histórias em quadrinhos e mangás de diversos gêneros.');




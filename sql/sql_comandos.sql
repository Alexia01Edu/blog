delete from blog.usuario where id=2;
delete from blog.post where id=4;
INSERT INTO blog.usuario(nome, email, senha, ativo,adm)values('Alexia', 'a@gmail.com', '123',1,1);
INSERT INTO blog.post(titulo, texto, usuario_id, data_postagem) VALUES('Como fazer pão de mel?', 'compre pão de mel, pois os ingredientes estão caros', 1, '2020-02-23 11:12:36');
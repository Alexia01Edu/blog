-- Drop banco de dados
--drop database DoIn;

-- Criação do banco de dados
create database DoIn;

-- selecionar banco de dados
use DoIn;

-- Criação da tabela usuario
create table usuario (
	usuarioID			int 		    not null auto_increment,
    nome 		        varchar(100)	not null,
    email	            varchar(30)		not null,
    senha 		        varchar(100)	not null,
    cpf 		        varchar(100)	not null,
    dataNasc 		    date	        not null,
    telefone	        int		        not null,
    quantDoar           int             not null,
    quantTrocar         int             not null,
    fk_ranking          int             not null,
    primary key (usuarioID)
    );
    
    create table categoria (
	categoriaID			int 		    not null auto_increment,
    nome 		        varchar(100)	not null,
    primary key (categoriaID)
    );

    create table Produto (
	produtoID			int 		    not null auto_increment,
    descricao 		    varchar(100)	not null,
    nome_prod	        varchar(30)		not null,
    quant 		        int         	not null,
    modoOperacao        varchar(10)     not null,
    dataValidade        date            not null,
    estado 		        varchar(100)	not null,
    cidade              varchar(100)    not null,
    fk_categoria        int             not null,
    fk_usuario          int             not null,
    primary key (produtoID),
    foreign key (fk_usuario) references usuario (usuarioID) on delete cascade on update cascade,
    foreign key (fk_categoria) references categoria (categoriaID) on delete cascade on update cascade
    );


    create table Imagem (
	imagemID			int 		    not null auto_increment,
    Imagem_arq          varchar(255)    not null,
    dataImg 		    datetime not null default current_timestamp,
    descricaoImg	    varchar(30)		null,
    imagem_name         varchar(100)    not null,
    primary key (imagemID)
    );
    


    create table lista_desejos (
	fk_usuario			int 		    not null,
    fk_produto 		    int         	not null,
    data                date            not null,
    descricao           text            null,
    publicar            varchar(10)     not null,
    primary key (fk_usuario, fk_produto),
    foreign key (fk_usuario) references usuario (usuarioID) on delete cascade on update cascade,
    foreign key (fk_produto) references Produto (produtoID) on delete cascade on update cascade
    );
 

    create table conversa (
	fk_usuario			int 		    not null,
    fk_usuario2 		int         	not null,
    dataChat 		    date         	not null,
    texto               text            not null,
    primary key (fk_usuario, fk_usuario2),
    foreign key (fk_usuario) references usuario (usuarioID) on delete cascade on update cascade,
    foreign key (fk_usuario2) references usuario (usuarioID) on delete cascade on update cascade
    );
    
    create table possui (
	fk_imagem			int 		    not null,
    fk_produto 		    int         	not null,
    primary key (fk_imagem, fk_produto),
    foreign key (fk_imagem) references Imagem (imagemID) on delete cascade on update cascade,
    foreign key (fk_produto) references Produto (produtoID) on delete cascade on update cascade
    );


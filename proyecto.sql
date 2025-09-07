create database proyecto;
use proyecto;
create table usuario (
ID tinyint unsigned auto_increment,
Nombre_Usuario bigint unsigned primary key,
Nombre varchar (255) not null,
contrasena varchar (255) not null,
direccion varchar (255) not null,
Tipo_Usuario enum ("Administrador","Cajero","Almacenista") not null,
Estado_Usuario enum ("A","NA") default "A",
Telefono bigint unsigned not null,
Fecha_Nacimiento Date not null,
Genero enum ("Femenino","Masculino","Otro") Not null,
Correo_Electronico varchar (255) not null,
Tipo_Sangre enum ("O+","O-","A-","A+","B-","B+","AB-","AB+") not null,
EPS varchar (255) not null,
Estado_Civil enum ("Soltero","Casado","Divorciado","Viudo","Separado","Union Libre","Union civil") null,
index (ID)
);
create table Titulo (
ID tinyint unsigned primary key auto_increment,
Nombre_Entidad varchar (255) not null,
Nombre_Titulo varchar (255) not null,
Descripcion varchar (255) not null,
Ano year not null, 
Titulo_De bigint unsigned not null,
foreign key (Titulo_De) references Usuario (Nombre_Usuario)
);
create table PerfilProfesional (
ID tinyint unsigned primary key auto_increment,
Empresa varchar (255) not null,
Cargo varchar (255) null,
Descripcion varchar(255) not null,
Telefono bigint unsigned not null,
Perfil_De bigint unsigned not null,
foreign key (Perfil_De) references Usuario (Nombre_Usuario)
);
create table Proveedor (
ID tinyint unsigned primary key auto_increment,
Nombre varchar (255) not null,
Direccion varchar (255) not null,
Telefono bigint unsigned not null,
Dia_Entrega date not null,
Estado enum ("A","NA") default "A",
Registrado_Por bigint unsigned not null,

foreign key (Registrado_Por) references Usuario (Nombre_Usuario)
);
create table Producto (
ID tinyint unsigned primary key auto_increment,
Nombre varchar (255) not null,
Valor_Compra mediumint unsigned not null,
Tipo_Producto Enum ("Alcoholica","No Alcoholica","Snacks","Platos Elaborados") not null,
cantidad smallint unsigned not null,
Descripcion varchar (255) null,
Valor_Venta mediumint unsigned not null,
Estado enum ("A","NA") default "A",
Registrado_Por bigint unsigned not null,
id_proveedor tinyint unsigned not null,
foreign key (Registrado_Por) references Usuario (Nombre_Usuario),
foreign key (id_proveedor) references Proveedor (ID)
);
create table Venta (
ID smallint unsigned primary key auto_increment,
Metodo_Pago enum ("Efectivo","Tarjeta","Transferencia") not null,
IVA int unsigned not null,
Fecha_Venta date not null,
Descripcion varchar (255) not null,
sub_total int unsigned not null,
valor_total int unsigned not null,
Estado enum ("A","NA") default "A",
Registrado_Por bigint unsigned not null,
foreign key (Registrado_Por) references Usuario (Nombre_Usuario)
);
create table Detalles_Producto_Venta (
ID_Producto tinyint unsigned not null,
ID_Venta smallint unsigned not null,
Valor_Producto mediumint not null,
Cantidad smallint not null,
foreign key (ID_Producto) references Producto (ID),
foreign key (ID_Venta) references Venta (ID)
);

create procedure LOGIN (
in a bigint unsigned,
in b varchar (255)
)
select Nombre_Usuario, contrasena, Tipo_Usuario from usuario where Nombre_Usuario = a and contrasena = b and Estado_Usuario = 'A';

/* VISTAS */

/* VISTA DE LLAVE FORANEA */

create view CProveedorProducto as
select ID, Nombre from proveedor where Estado = 'A';

/* CONSULTAR USUARIO */

CREATE VIEW generalUsuarios AS
SELECT ID, Nombre_Usuario, Nombre, Tipo_Usuario, Telefono, Fecha_Nacimiento, Genero, Correo_Electronico FROM Usuario WHERE Estado_Usuario = 'A' ORDER BY ID ASC;

/* CONSULTAR ELIMINADOS */

CREATE VIEW usuariosEliminados AS
SELECT ID, Nombre_Usuario, Nombre, Tipo_Usuario, Telefono, Fecha_Nacimiento, Genero, Correo_Electronico FROM Usuario WHERE Estado_Usuario = 'NA' ORDER BY ID ASC;

/* CONSULTAR PROVEEDOR */

CREATE VIEW generalProveedores AS 
SELECT ID, Nombre, Direccion, Telefono, Dia_Entrega, Registrado_Por FROM Proveedor WHERE Estado = 'A' ORDER BY ID ASC;

/* CONSULTAR ELIMINADOS */

CREATE VIEW proveedoresEliminados AS
SELECT ID, Nombre, Direccion, Telefono, Dia_Entrega, Registrado_Por FROM Proveedor WHERE Estado = 'NA' ORDER BY ID ASC;

/* CONSULTAR PRODUCTOS */

CREATE VIEW generalProductos AS 
SELECT p.ID, p.Nombre, p.Tipo_Producto, p.Cantidad, p.Descripcion, p.Valor_Venta, cp.Nombre AS Nombre_Proveedor FROM Producto AS p
LEFT JOIN CProveedorProducto AS cp ON p.id_proveedor = cp.ID 
WHERE p.Estado = 'A' ORDER BY p.ID ASC;

/* CONSULTAR ELIMINADOS */

CREATE VIEW productosEliminados AS
SELECT p.ID, p.Nombre, p.Tipo_Producto, p.Cantidad, p.Descripcion, p.Valor_Venta, cp.Nombre AS Nombre_Proveedor FROM Producto AS p
LEFT JOIN CProveedorProducto AS cp ON p.id_proveedor = cp.ID 
WHERE p.Estado = 'NA' ORDER BY p.ID ASC;

/* CONSULTAR VENTAS */
CREATE VIEW generalVentas AS
SELECT ID, Metodo_Pago, Fecha_Venta, Descripcion, sub_total, valor_total FROM Venta WHERE Estado = 'A' ORDER BY ID ASC;

/* SELECCIONAR LA ULTIMA VENTA CREADA */
CREATE VIEW ultimaVenta AS
SELECT MAX(ID) FROM Venta;

/* PROCEDIMIENTOS */

/* CRUD USUARIO */

create procedure RUsuarios (
in a bigint unsigned,
in b varchar (255),
in c varchar (255),
in d varchar (255),
in e enum ("Administrador","Cajero","Almacenista"),
in f bigint unsigned,
in g Date,
in h enum ("Femenino","Masculino","Otro"),
in i varchar (255),
in j enum ("O+","O-","A-","A+","B-","B+","AB-","AB+"),
in k varchar (255),
in l enum ("Soltero","Casado","Divorciado","Viudo","Separado","Union Libre","Union civil")
)
insert into usuario (Nombre_Usuario, Nombre, contrasena, direccion, Tipo_Usuario, Telefono, Fecha_Nacimiento, Genero, Correo_Electronico, Tipo_Sangre, EPS, Estado_Civil)
values (a, b, c, d, e, f, g, h, i, j, k, l);

CALL RUsuarios ("1147484267", "Santiago Guayana", "GSGG_ADMIN", "CRA 111 #135 B-57", "Administrador", "3223483884", "2007-07-14", "Masculino", "santiagoguayana2@gmail.com", "O+", "Compensar", "Casado");
CALL RUsuarios ("1147484261", "Leidy Paola", "LPGG_ADMIN", "CRA 111 #135 B-51", "Almacenista", "3223483881", "2007-07-15", "Femenino", "LPGG@gmail.com", "O+", "Sanitas", "Soltero");
CALL RUsuarios ("1147484262", "Zharick Yojana", "ZYPR_ADMIN", "CRA 111 #135 B-52", "Administrador", "3223483882", "2007-07-16", "Femenino", "ZYPR@gmail.com", "A+", "Compensar", "Soltero");
CALL RUsuarios ("1147484263", "Juan Perez", "JP_ADMIN", "CRA 111 #135 B-53", "Administrador", "3223483883","2007-07-16", "Otro", "juanperez@gmail.com", "A-", "Sanitas", "Viudo");
CALL RUsuarios ("1147484264", "María Gómez", "MG_ADMIN", "CRA 111 #135 B-54", "Cajero", "3223483885", "2007-07-18", "Otro", "mariagomez@gmail.com", "O-", "Compensar", "Casado");

create procedure RTitulo (
in a varchar (255),
in b varchar (255),
in c varchar (255),
in d year, 
in e bigint unsigned
)
insert into Titulo (Nombre_Entidad, Nombre_Titulo, Descripcion, Ano, Titulo_De)
values (a, b, c, d, e);

-- primer usuario
CALL RTitulo("Universidad Nacional", "Ingeniero de Sistemas", "Graduado con honores", 2024, 1147484267);

-- segundo usuario
CALL RTitulo("Universidad de Los Andes", "Contadora Pública", "Mención honorífica en auditoría", 2023, 1147484261);

-- tercer usuario
CALL RTitulo("SENA", "Técnico en Logística", "Especialización en almacenamiento y distribución", 2022, 1147484262);

-- cuarto usuario
CALL RTitulo("Universidad del Cielo", "Teología", "Estudios avanzados en espiritualidad", 2020, 1147484263);

-- quinto usuario
CALL RTitulo("Universidad Nacional", "Ciencias Culinarias", "Especialización en postres", 2023, 1147484264);

create procedure RPerfilProfesional (
in a varchar (255),
in b varchar (255),
in c varchar(255),
in d bigint unsigned,
in e bigint unsigned
)
insert into PerfilProfesional (Empresa, Cargo, Descripcion, Telefono, Perfil_De)
values (a, b, c, d, e);

-- primer usuario
CALL RPerfilProfesional("Google", "Ingeniero de Software", "Desarrollador backend", 3223483880, 1147484267);

-- segundo usuario
CALL RPerfilProfesional("KPMG", "Auditora Senior", "Responsable de auditorías financieras", 3223483881, 1147484261);

-- tercer usuario
CALL RPerfilProfesional("Amazon", "Coordinadora de Logística", "Supervisión de operaciones en almacenes", 3223483882, 1147484262);

-- cuarto usuario
CALL RPerfilProfesional("CieloCorp", "Líder espiritual", "Guía espiritual global", 3223483883, 1147484263);

-- quinto usuario
CALL RPerfilProfesional("LecheCorp", "Chef de Repostería", "Creador de postres únicos", 3223483885, 1147484264);

CREATE PROCEDURE CUsuarios (
    IN a bigint unsigned
)
    SELECT 
        u.*, 
        t.Nombre_Entidad, 
        t.Nombre_Titulo, 
        t.Descripcion AS Titulo_Descripcion, 
        t.Ano AS Titulo_Ano, 
        p.Empresa, 
        p.Cargo, 
        p.Descripcion AS Perfil_Descripcion, 
        p.Telefono AS Perfil_Telefono
    FROM 
        Usuario u
    LEFT JOIN 
        Titulo t ON u.Nombre_Usuario = t.Titulo_De
    LEFT JOIN 
        PerfilProfesional p ON u.Nombre_Usuario = p.Perfil_De
    WHERE 
        u.Estado_Usuario = 'A'
        AND u.Nombre_Usuario = a;

create procedure MUsuarios (
in b bigint unsigned,
in c varchar (255),
in d varchar (255),
in e enum ("Administrador","Cajero","Almacenista"),
in f bigint unsigned,
in g Date,
in h enum ("Femenino","Masculino","Otro"),
in i varchar (255),
in j enum ("O+","O-","A-","A+","B-","B+","AB-","AB+"),
in k varchar (255),
in l enum ("Soltero","Casado","Divorciado","Viudo","Separado","Union Libre","Union civil")
)
update usuario set Nombre = c, direccion = d, Tipo_Usuario = e, Telefono = f,
Fecha_Nacimiento = g, Genero = h, Correo_Electronico = i, Tipo_Sangre = j, EPS = k, Estado_Civil = l
where Nombre_Usuario = b;

create procedure EUsuarios (
IN a bigint unsigned
)
update usuario set Estado_Usuario = "NA" where Nombre_Usuario = a;

update usuario set Estado_Usuario = "A" where Nombre_Usuario = "1147484267";

create procedure reactivarUsuarios (
in a bigint unsigned
)
update usuario set Estado_Usuario = 'A' where Nombre_Usuario = a and Estado_Usuario = 'NA';

/* CRUD PROVEEDOR */

create procedure RProveedores (
in a varchar (255),
in b varchar (255),
in c bigint unsigned,
in d date,
in e bigint unsigned
)
insert into Proveedor (Nombre, Direccion, Telefono, Dia_Entrega, Registrado_Por) values
(a, b, c, d, e);

CALL RProveedores('Distribuidora de Bebidas XYZ', 'Calle 123 #45-67', 3001234567, '2024-10-20', 1147484267);
CALL RProveedores('Snacks & Delicias', 'Avenida Principal #89-12', 3109876543, '2024-10-21', 1147484267);
CALL RProveedores('Licores del Valle', 'Carrera 15 #10-20', 3123456789, '2024-10-22', 1147484261);
CALL RProveedores('Carnes Frescas Ltda.', 'Calle 56 #78-90', 3056789123, '2024-10-23', 1147484261);
CALL RProveedores('Frutas y Verduras S.A.', 'Diagonal 25 #67-89', 3156789123, '2024-10-24', 1147484262);
CALL RProveedores('Lácteos de la Montaña', 'Calle 90 #12-34', 3004567891, '2024-10-25', 1147484262);
CALL RProveedores('Fábrica de Gaseosas Nacional', 'Avenida Siempre Viva #100', 3201234567, '2024-10-26', 1147484263);
CALL RProveedores('Frituras y Snacks', 'Calle 45 #56-78', 3041234567, '2024-10-27', 1147484263);
CALL RProveedores('Comida Gourmet S.A.', 'Carrera 10 #50-60', 3112345678, '2024-10-28', 1147484264);
CALL RProveedores('Vinos & Licores Internacionales', 'Avenida del Parque #45-12', 3176543210, '2024-10-29', 1147484264);

create procedure CProveedores (
in a varchar (255)
)
select * from proveedor where Estado = 'A' and Nombre = a;

create procedure CIDProveedores (
in a tinyint unsigned
)
select * from proveedor where Estado = 'A' and ID = a;

create procedure MProveedores (
in a tinyint unsigned,
in b varchar (255),
in c varchar (255),
in d bigint unsigned,
in e date
)
update Proveedor set Nombre = b, Direccion = c, Telefono = d, Dia_Entrega = e
where ID = a;

create procedure EProveedores (
in a tinyint unsigned
)
update Proveedor set Estado = "NA" where ID = a;

create procedure reactivarProveedores (
in a tinyint unsigned
)
update Proveedor set Estado = 'A' where ID = a and Estado = 'NA';

/* CRUD PRODUCTO */

create procedure RProductos (
in a varchar (255),
in b mediumint unsigned,
in c Enum ("Alcoholica","No Alcoholica","Snacks","Platos Elaborados"),
in d smallint unsigned,
in e varchar (255),
in f mediumint unsigned,
in g bigint unsigned,
in h tinyint unsigned
)
insert into Producto (Nombre, Valor_Compra, Tipo_Producto, cantidad, Descripcion, Valor_Venta, Registrado_Por, id_proveedor) values
(a, b, c, d, e, f, g, h);

CALL RProductos('Cerveza Corona', 5000, 'Alcoholica', 400, 'Bebida refrescante con alcohol', 8000, 1147484267, 1);
CALL RProductos('Pepsi', 3000, 'No Alcoholica', 400, 'Bebida gaseosa sin alcohol', 5000, 1147484267, 1);
CALL RProductos('Papas Fritas Lays', 2000, 'Snacks', 400, 'Snacks crujientes sabor original', 3500, 1147484261, 2);
CALL RProductos('Hamburguesa Doble', 7000, 'Platos Elaborados', 400, 'Hamburguesa con doble carne y queso', 12000, 1147484261, 2);
CALL RProductos('Whisky Jack Daniels', 15000, 'Alcoholica', 400, 'Bebida alcohólica destilada', 25000, 1147484262, 3);
CALL RProductos('Agua Mineral', 1500, 'No Alcoholica', 400, 'Agua mineral sin gas', 3000, 1147484262, 3);
CALL RProductos('Nachos con Queso', 4000, 'Snacks', 400, 'Nachos con queso derretido', 7000, 1147484263, 4);
CALL RProductos('Pizza Familiar', 12000, 'Platos Elaborados', 400, 'Pizza grande con ingredientes mixtos', 20000, 1147484263, 4);
CALL RProductos('Vodka Smirnoff', 13000, 'Alcoholica', 400, 'Bebida alcohólica destilada', 22000, 1147484264, 5);
CALL RProductos('Jugo de Naranja', 2500, 'No Alcoholica', 400, 'Jugo natural de naranja', 4000, 1147484264, 5);

create procedure CProductos (
in a varchar (255)
)
select p.ID, p.Nombre, p.Tipo_Producto, p.Cantidad, p.Descripcion, p.Valor_Venta, cp.Nombre as Nombre_Proveedor FROM Producto as p
left join CProveedorProducto as cp on p.id_proveedor = cp.ID 
where p.Estado = 'A' and p.Nombre = a;

create procedure CIDProductos (
in a tinyint unsigned
)
select p.ID, p.Nombre, p.Valor_Compra, p.Tipo_Producto, p.cantidad, p.Descripcion, p.Valor_Venta, cp.Nombre as Nombre_Proveedor from Producto as p 
left join CProveedorProducto as cp on p.id_proveedor = cp.ID
where p.Estado = 'A' and p.ID = a;

create procedure MProductos (
in a tinyint unsigned,
in b varchar (255),
in c mediumint unsigned,
in d Enum ("Alcoholica","No Alcoholica","Snacks","Platos Elaborados"),
in e smallint unsigned,
in f varchar (255),
in g mediumint unsigned,
in h tinyint unsigned
)
update Producto set Nombre = b, Valor_Compra = c, Tipo_Producto = d, cantidad = e, Descripcion = f, Valor_Venta = g, id_proveedor = h
where ID = a;

create procedure EProductos (
in a tinyint unsigned
)
update Producto set Estado = "NA" where ID = a;

create procedure reactivarProductos (
in a tinyint unsigned
)
update Producto set Estado = 'A' where ID = a and Estado = 'NA';

/* CRUD VENTA */

DELIMITER $$
create procedure RDetalles (
a tinyint unsigned,
b smallint unsigned,
c mediumint,
d smallint
)
BEGIN
insert into Detalles_Producto_Venta (ID_Producto, ID_Venta, Valor_Producto, Cantidad) values
(a, b, c, d);
update Producto set Cantidad = Cantidad - d where ID = a;
END$$

create procedure RVentas (
in a enum ("Efectivo","Tarjeta","Transferencia"),
in b int unsigned,
in c varchar (255),
in d int unsigned,
in e int unsigned,
in f bigint unsigned
)
insert into Venta (Metodo_Pago, IVA, Fecha_Venta, Descripcion, sub_total, valor_total, Registrado_Por) values
(a, b, now(), c, d, e, f);

create procedure CFechaVenta (
in a date
)
select ID, Metodo_Pago, Fecha_Venta, Descripcion, sub_total, valor_total from Venta where Fecha_Venta = a;

create procedure CIDVentas (
in a smallint unsigned
)
select * from Venta where Estado = 'A' and ID = a;

create procedure MVentas (
in a smallint unsigned,
in b enum ("Efectivo","Tarjeta","Transferencia"),
in c date,
in d varchar(255),
in e int unsigned,
in f int unsigned
)
update Venta set Metodo_Pago = b, Fecha_Venta = c, Descripcion = d, sub_total = e, valor_total = f
where ID = a;

/* VISTAS DINAMICAS */

-- Productos mas vendidos

CREATE VIEW ProductosMasVendidos AS
SELECT 
    p.ID AS ProductoID,
    p.Nombre AS NombreProducto,
    COUNT(dp.ID_Venta) AS TotalVentas, -- Cuenta la cantidad de ventas relacionadas
    SUM(dp.Cantidad) AS CantidadVendida  -- Suma de la cantidad de productos vendidos
FROM 
    Producto p
JOIN 
    Detalles_Producto_Venta dp ON p.ID = dp.ID_Producto
JOIN 
    Venta v ON dp.ID_Venta = v.ID
WHERE 
    p.Estado = 'A' -- filtrar por productos activos
GROUP BY 
    p.ID, p.Nombre
ORDER BY 
    CantidadVendida DESC;

-- Usuarios con mas ventas

CREATE VIEW UsuariosMasVentas AS
SELECT 
    u.Nombre_Usuario AS UsuarioDoc,
    u.Nombre AS NombreUsuario,
    COUNT(DISTINCT v.ID) AS TotalVentas,  -- Contar solo las ventas únicas realizadas por el usuario
    SUM(dp.Cantidad) AS CantidadProductosVendidos  -- Sumar la cantidad de productos vendidos en todas las ventas del usuario
FROM 
    usuario u
JOIN 
    venta v ON u.Nombre_Usuario = v.Registrado_Por
JOIN 
    detalles_producto_venta dp ON v.ID = dp.ID_Venta
WHERE 
    u.Estado_Usuario = 'A' -- filtrar por usuarios activos
GROUP BY 
    u.Nombre_Usuario, u.Nombre
ORDER BY 
    TotalVentas DESC;

select * from UsuariosMasVentas;
select * from ProductosMasVendidos;

select * from usuario;
select * from proveedor;
select * from producto;
select * from venta;
select * from titulo;
select * from PerfilProfesional;
select * from Detalles_Producto_Venta;

drop database proyecto;
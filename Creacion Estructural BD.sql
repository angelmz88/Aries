CREATE SCHEMA Tintoreria_Aries;

DROP SCHEMA Tintoreria_Aries;
USE Tintoreria_Aries;

-- Relacion de clientes
CREATE TABLE Clientes 
(
	Numero_Telefono_PK VARCHAR(10) NOT NULL,
    Primer_Nombre VARCHAR(30) NOT NULL,
    Segundo_Nombre VARCHAR(30) NULL,
    Primer_Apellido VARCHAR(30) NOT NULL,
    Segundo_Apellido VARCHAR(30) NOT NULL, 
    Calle VARCHAR(50) NULL,
    Numero_Exterior VARCHAR(6) NULL,
	CONSTRAINT Clientes PRIMARY KEY(Numero_Telefono_PK)
);

-- Relacion de empleados
CREATE TABLE Empleados
(
	Numero_Telefono_PK VARCHAR(10) NOT NULL,
    Primer_Nombre VARCHAR(30) NOT NULL,
    Segundo_Nombre VARCHAR(30) NULL,
    Primer_Apellido VARCHAR(30) NOT NULL,
    Segundo_Apellido VARCHAR(30) NOT NULL, 
    Correo_Electronico VARCHAR(100) NULL,
    Numero_Seguridad_Social VARCHAR(9) NOT NULL,
    Salario FLOAT NOT NULL,
    Tipo_Nomina VARCHAR(30) NOT NULL,
    Vigente BOOLEAN NOT NULL, 
    CONSTRAINT Empleados PRIMARY KEY(Numero_Telefono_PK)
);

-- Relacion de notas
CREATE TABLE Notas
(
	Folio_Nota_PK INT NOT NULL AUTO_INCREMENT,
    Numero_Telefono_Cliente_FK VARCHAR(10) NOT NULL,
    Numero_Telefono_Empleado_FK VARCHAR(10) NOT NULL,
    Tipo_Servicio VARCHAR(30) NOT NULL,
    Fecha_Entrega_Estimada DATE NOT NULL,
    Hora_Entrega_Estimada TIME NOT NULL,
    CONSTRAINT Notas PRIMARY KEY(Folio_Nota_PK),
    CONSTRAINT Telefono_Clientes_Notas FOREIGN KEY(Numero_Telefono_Cliente_FK) REFERENCES Clientes(Numero_Telefono_PK),
    CONSTRAINT Telefono_Empleados_Notas FOREIGN KEY(Numero_Telefono_Empleado_FK) REFERENCES Empleados(Numero_Telefono_PK)
);

-- Relacion de Precio de las prendas
CREATE TABLE Precio_Prendas
(
	Tipo_Prenda_PK VARCHAR(50) NOT NULL,
    Precio_Unitario FLOAT NOT NULL,
    CONSTRAINT Precio_Prendas PRIMARY KEY(Tipo_Prenda_PK)
);

-- Relacion de Prendas
CREATE TABLE Prendas
(
	Folio_Nota_PK_FK INT NOT NULL,
    Tipo_Prenda_PK_FK VARCHAR(50) NOT NULL,
    Color VARCHAR(40) NOT NULL,
    Cantidad INT NOT NULL,
    Precio_Total FLOAT NOT NULL,
    Observaciones VARCHAR(200) NULL,
    Fecha_Entrada DATE NOT NULL,
    Hora_Entrada TIME NOT NULL,
    Fecha_Salida DATE NULL,
    Hora_Salida TIME NULL,
    CONSTRAINT Prendas PRIMARY KEY(Folio_Nota_PK_FK, Tipo_Prenda_PK_FK),
    CONSTRAINT Folio_Nota_Prendas FOREIGN KEY(Folio_Nota_PK_FK) REFERENCES Notas(Folio_Nota_PK),
    CONSTRAINT Tipo_Prenda_Prendas FOREIGN KEY(Tipo_Prenda_PK_FK) REFERENCES Precio_Prendas(Tipo_Prenda_PK)
);

-- Relacion de Areas
CREATE TABLE Areas
(
	Identificador_Area_PK CHAR(3) NOT NULL,
    Numero_Area INT NOT NULL,
    Nombre_Area VARCHAR(30) NOT NULL,
    Cantidad_Empleados INT NOT NULL,
    CONSTRAINT Areas PRIMARY KEY(Identificador_Area_PK)
);

-- Relacion de Mostrador
CREATE TABLE Mostrador
(
	Folio_Nota_PK_FK INT NOT NULL,
    Fecha_Entrada_PK DATE NOT NULL,
    Hora_Entrada TIME NOT NULL,
    Fecha_Salida DATE NOT NULL,
    Hora_Salida TIME,
    Identificador_Area_FK CHAR(3) NOT NULL,
    Area_Siguiente CHAR(3) NOT NULL,
    Estatus Boolean NOT NULL,
    CONSTRAINT PRIMARY KEY (Folio_Nota_PK_FK, Fecha_Entrada_PK),
    CONSTRAINT Folio_Nota_Mostrador FOREIGN KEY(Folio_Nota_PK_FK) REFERENCES Notas(Folio_Nota_PK),
    CONSTRAINT Identificador_Areas_Mostrador FOREIGN KEY(Identificador_Area_FK) REFERENCES Areas(Identificador_Area_PK)
);

-- Relacion de Planta
CREATE TABLE Planta
(
	Folio_Nota_PK_FK INT NOT NULL,
    Fecha_Entrada_PK DATE NOT NULL,
    Hora_Entrada TIME NOT NULL,
    Fecha_Salida DATE NOT NULL,
    Hora_Salida TIME NOT NULL,
    Identificador_Area_FK Char(3) NOT NULL,
    Area_Siguiente Char(3) NOT NULL,
    Estatus Boolean NOT NULL,
    CONSTRAINT Planta PRIMARY KEY (Folio_Nota_PK_FK, Fecha_Entrada_PK),
    CONSTRAINT Folio_Nota_Planta FOREIGN KEY(Folio_Nota_PK_FK) REFERENCES Notas(Folio_Nota_PK),
    CONSTRAINT Identificador_Area_Planta FOREIGN KEY(Identificador_Area_FK) REFERENCES Areas(Identificador_Area_PK)
);

-- Relacion de Lavado
CREATE TABLE Lavado
(
	Folio_Nota_PK_FK INT NOT NULL,
    Fecha_Entrada_PK DATE NOT NULL,
    Hora_Entrada TIME NOT NULL,
    Fecha_Salida DATE NOT NULL,
    Hora_Salida TIME NOT NULL,
    Identificador_Area_FK Char(3) NOT NULL,
    Area_Siguiente Char(3) NOT NULL,
    Estatus Boolean NOT NULL,
    CONSTRAINT Lavado PRIMARY KEY (Folio_Nota_PK_FK, Fecha_Entrada_PK),
    CONSTRAINT Folio_Nota_Lavado FOREIGN KEY(Folio_Nota_PK_FK) REFERENCES Notas(Folio_Nota_PK),
    CONSTRAINT Identificador_Area_Lavado FOREIGN KEY(Identificador_Area_FK) REFERENCES Areas(Identificador_Area_PK)
);

-- Relacion de Planchado
CREATE TABLE Planchado
(
	Folio_Nota_PK_FK INT NOT NULL,
    Fecha_Entrada_PK DATE NOT NULL,
    Hora_Entrada TIME NOT NULL,
    Fecha_Salida DATE NOT NULL,
    Hora_Salida TIME NOT NULL,
    Identificador_Area_FK Char(3) NOT NULL,
    Area_Siguiente Char(3) NOT NULL,
    Estatus Boolean NOT NULL,
    CONSTRAINT Planchado PRIMARY KEY (Folio_Nota_PK_FK, Fecha_Entrada_PK),
    CONSTRAINT Folio_Nota_Planchado FOREIGN KEY(Folio_Nota_PK_FK) REFERENCES Notas(Folio_Nota_PK),
    CONSTRAINT Identificador_Area_Planchado FOREIGN KEY(Identificador_Area_FK) REFERENCES Areas(Identificador_Area_PK)
);

-- Relacion de Colaboradores
CREATE TABLE Colaboradores
(
	Numero_Telefono_PK VARCHAR(10) NOT NULL,
    Primer_Nombre VARCHAR(50) NOT NULL,
    Segundo_Nombre VARCHAR(50) NULL,
    Primer_Apellido VARCHAR(50) NOT NULL,
    Segundo_Apellido VARCHAR(50) NOT NULL,
    CONSTRAINT Colaboradores PRIMARY KEY(Numero_Telefono_PK)
);

-- Relacion Teniño y Reparacion
CREATE TABLE Tenido_Reparacion
(
	Folio_Nota_PK_FK INT NOT NULL,
    Cantidad_Prendas_PK INT NOT NULL,
    Tipo_Servicio VARCHAR(50) NOT NULL,
    Telefono_Colaborador_fk VARCHAR(10) NOT NULL, 
    Estatus Boolean NOT NULL,
    CONSTRAINT Tenido_Reparacion PRIMARY KEY (Folio_Nota_PK_FK, Cantidad_Prendas_PK),
    CONSTRAINT Folio_Nota_Tenido_Reparacion FOREIGN KEY(Folio_Nota_PK_FK) REFERENCES Notas(Folio_Nota_PK),
    CONSTRAINT Telefono_Colaborador_Tenido_Reparacion FOREIGN KEY(Telefono_Colaborador_FK) REFERENCES Colaboradores(Numero_Telefono_PK)
);

-- Relacion de Productos
CREATE TABLE Productos
(
	Clave_Producto_PK VARCHAR(20) NOT NULL,
    Nombre_Producto VARCHAR(100) NOT NULL,
    Piezas INT NOT NULL,
    UM VARCHAR(20) NOT NULL,
    Descripcion_Producto VARCHAR(100) NOT NULL, 
    Precio_Unitario FLOAT NOT NULL,
    CONSTRAINT Productos PRIMARY KEY(Clave_Producto_PK)
);

-- Relacion de Almacen
CREATE TABLE Almacen
(
	Clave_Producto_PK_FK VARCHAR(20) NOT NULL,
    Identificador_Area_PK_FK CHAR(3) NOT NULL,
    Existencias INT NOT NULL,
    CONSTRAINT Almacen PRIMARY KEY(Clave_Producto_PK_FK, Identificador_Area_PK_FK),
    CONSTRAINT Clave_Producto_Almacen FOREIGN KEY(Clave_Producto_PK_FK) REFERENCES Productos(Clave_Producto_PK),
    CONSTRAINT Identificador_Area_Almacen FOREIGN KEY(Identificador_Area_PK_FK) REFERENCES Areas(Identificador_Area_PK)
);

-- Relacion de Proveedores
CREATE TABLE Proveedores
(
	Nombre_Distribuidora_PK VARCHAR(80) NOT NULL,
    Telefono_Principal VARCHAR(10) NOT NULL,
    Telefono_Alterno VARCHAR(10) NULL,
    Correo_Electronico VARCHAR(100) NULL,
    Metodo_Pago VARCHAR(40) NOT NULL,
    Catalogo_Producto VARCHAR(50) NOT NULL,
    Calle VARCHAR(50) NOT NULL,
    Numero_Exterior INT NOT NULL,
    Colonia VARCHAR(40) NOT NULL,
    Codigo_Postal INT NOT NULL,
    Municipio VARCHAR(50) NOT NULL,
    Estado VARCHAR(50) NOT NULL,
    CONSTRAINT Proveedores priMARY KEY(Nombre_Distribuidora_PK)
);

-- Relacion de Pedidos
CREATE TABLE Pedidos
(
	Numero_Pedido_PK INT NOT NULL AUTO_INCREMENT,
    Nombre_Distribuidora_PK_FK VARCHAR(80) NOT NULL,
    Fecha_Pedido DATE NOT NULL,
    Total_Pagar FLOAT NOT NULL,
    CONSTRAINT Pedidos PRIMARY KEY(Numero_Pedido_PK),
    CONSTRAINT Nombre_Distribuidora_Pedidos FOREIGN KEY(Nombre_Distribuidora_PK_FK) REFERENCES Proveedores(Nombre_Distribuidora_PK)
);

-- Relacion de Detalles del pedido
CREATE TABLE Detalles_Pedidos
(
	Numero_Pedido_PK_FK INT NOT NULL,
    Identificador_Producto_PK_FK VARCHAR(20) NOT NULL,
    Cantidad_Producto INT NOT NULL,
    CONSTRAINT Detalles_Pedidos PRIMARY KEY(Numero_Pedido_PK_FK, Identificador_Producto_PK_FK),
    CONSTRAINT Numero_Pedido_Detalles FOREIGN KEY(Numero_Pedido_PK_FK) REFERENCES Pedidos(Numero_Pedido_PK),
    CONSTRAINT Identificador_Producto_Detalles FOREIGN KEY(Identificador_Producto_PK_FK) REFERENCES Productos(Clave_Producto_PK)
);
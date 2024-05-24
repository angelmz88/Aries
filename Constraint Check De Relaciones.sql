USE Tintoreria_Aries;

-- Relacion de clientes

-- Relacion de empleados
ALTER TABLE Empleados
ADD CONSTRAINT Tipo_Nomina CHECK (Tipo_Nomina IN ('Quincenal', 'Mensual'));

ALTER TABLE Empleados
ADD CONSTRAINT Tipo_Empleado CHECK (Tipo_Empleado IN ('Empleado', 'Jefe'));

-- Relacion de notas
SELECT * FROM Notas;
SELECT DISTINCT(Tipo_Servicio) FROM Notas;
ALTER TABLE Notas 
ADD CONSTRAINT Tipo_Servicio CHECK (Tipo_Servicio IN ('Lavado', 'Teñido', 'Reparación', 'Lavado en seco', 'Planchado'));


-- Relacion de precio prendas
ALTER TABLE Precio_Prendas
Add CONSTRAINT Precio_Unitario_Prendas CHECK (Precio_Unitario > 0);

-- Relacion de prendas

-- Relacion de Areas
SELECT DISTINCT(Identificador_Area_PK) FROM Areas;
ALTER TABLE Areas
ADD CONSTRAINT Identificador_Area_PK CHECK (Identificador_Area_PK IN ('A', 'L', 'M', 'P', 'PL', 'REP'));

-- Relacion de mostrador
ALTER TABLE Mostrador
ADD CONSTRAINT Identificador_Area_Mostrador CHECK (Identificador_Area_FK = 'M');

SELECT DISTINCT(Area_Siguiente) FROM Mostrador;
ALTER TABLE Mostrador
ADD CONSTRAINT Area_Siguiente_Mostrador_FK CHECK (Area_Siguiente IN ('L', 'REP', 'P', 'PL', 'N/A'));

-- Relacion de planta
ALTER TABLE Planta
ADD CONSTRAINT Identificador_Area_Planta CHECK (Identificador_Area_FK = 'P');

SELECT DISTINCT(Area_Siguiente) FROM Planta; 
ALTER TABLE Planta
ADD CONSTRAINT Area_Siguiente_Planta CHECK (Area_Siguiente IN ('REP', 'PL', 'M'));

-- Relacion de lavado
ALTER TABLE Lavado
ADD CONSTRAINT Identificador_Area_Lavado CHECK (Identificador_Area_FK = 'L');

SELECT DISTINCT(Area_Siguiente) FROM Lavado;
ALTER TABLE Lavado
ADD CONSTRAINT Area_Siguiente_Lavado CHECK (Area_Siguiente IN ('PL', 'REP', 'M'));

-- Relacion de Planchado
ALTER TABLE Planchado
ADD CONSTRAINT Identificador_Area_Planchado CHECK (Identificador_Area_FK = 'PL');

SELECT DISTINCT(Area_Siguiente) FROM Planchado;
ALTER TABLE Planchado
ADD CONSTRAINT Area_Siguiente_Planchado CHECK (Area_Siguiente IN ('M'));

-- Relacion de colaboradores

-- Relacion de teñido y reparacion

-- Relacion de productos
ALTER TABLE Productos
ADD CONSTRAINT Piezas_Productos CHECK (Piezas >= 0);

ALTER TABLE Productos
ADD CONSTRAINT Precio_Unitario_Productos CHECK (Precio_Unitario >= 0);

ALTER TABLE Productos
ADD CONSTRAINT Stock_Minimo_Productos CHECK (Stock_Minimo >= 0);

-- Relacion de almacen
ALTER TABLE Almacen
ADD CONSTRAINT Identificador_Almacen_Area CHECK (Identificador_Area_PK_FK = 'A');

ALTER TABLE Almacen
ADD CONSTRAINT Existencias_Almacen CHECK (Existencias >= 0);

-- Relacion Proveedores
ALTER TABLE Proveedores
ADD CONSTRAINT Metodo_Pago_Proveedores CHECK (Metodo_Pago IN ('Efectivo', 'Tarjeta', 'Transferencia'));

-- Relacion de pedidos
ALTER TABLE Pedidos
ADD CONSTRAINT Total_Pagar_Pedidos CHECK (Total_Pagar > 0);

-- Relacion detalles de pedidos
ALTER TABLE Detalles_Pedidos
ADD CONSTRAINT Cantidad_Producto_Detalles CHECK (Cantidad_Producto > 0);
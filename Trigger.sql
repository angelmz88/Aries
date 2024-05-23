USE Tintoreria_Aries;

-- Crear tabla de alertas
DROP TABLE Alertas_Stock;
DROP TRIGGER Trigger_Stock_Minimo;
DROP TRIGGER Trigger_Rebastecimiento_Stock;

-- Crear tabla Alertas
CREATE TABLE Alertas_Stock (
    ID_Alerta_PK INT AUTO_INCREMENT PRIMARY KEY,
    Clave_Producto_PK_FK VARCHAR(20),
    Descripcion VARCHAR(255),
    Alerta BOOLEAN DEFAULT TRUE,
    Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear Trigger de aviso para stock minimo
DELIMITER //
CREATE TRIGGER Trigger_Stock_Minimo
AFTER UPDATE ON Productos
FOR EACH ROW
BEGIN
	DECLARE Descripcion_Alerta VARCHAR(255);
    
    IF NEW.Piezas <= NEW.Stock_Minimo THEN
		SET Descripcion_Alerta = CONCAT(
			"El Producto ", OLD.Nombre_Producto,
            " (", OLD.Clave_Producto_PK, " ) ha alcanzado el stock minimo configurado. "
            " Piezas actuales: ", NEW.Piezas
		);
    
		INSERT INTO Alertas_Stock (Clave_Producto_PK_FK, Descripcion)
		VALUES (OLD.Clave_Producto_PK, Descripcion_Alerta);
	END IF;
END;
//
DELIMITER ;

-- Crear Trigger de alertas reabastecimiento de stcok
DELIMITER //
CREATE TRIGGER Trigger_Actualizacion_Stock
AFTER UPDATE ON Productos
FOR EACH ROW
BEGIN
	DECLARE Alerta_ID INT;
    IF NEW.Piezas > NEW.Stock_Minimo THEN
		SELECT ID_Alerta_PK INTO Alerta_ID FROM Alertas_Stock WHERE Clave_Producto_PK_FK = NEW.Clave_Producto_PK;
		IF Alerta_ID IS NOT NULL THEN
			UPDATE Alertas_Stock SET Alerta = FALSE WHERE ID_ALerta_PK = Alerta_ID;
		END IF;
	END IF;
END;
// 
DELIMITER ;

-- Limpieza en tabla de alertas cuando haya rebastecimiento
DELIMITER //
CREATE TRIGGER Trigger_Rebastecimiento_Stock
AFTER UPDATE ON Productos
FOR EACH ROW
BEGIN
	DECLARE Alerta_ID INT;
	IF NEW.Piezas > NEW.Stock_Minimo THEN
		SELECT ID_Alerta_PK INTO Alerta_ID FROM Alertas_Stock WHERE Clave_Producto_PK_FK = NEW.Clave_Producto_PK;
		IF Alerta_Id IS NOT NULL THEN
			DELETE FROM Alertas_Stock WHERE ID_Alerta_PK = Alerta_ID;
		END IF;
    END IF;
END;
//
DELIMITER ;

SELECT * FROM Productos;
SELECT CLave_Producto_PK_FK, Descripcion, Alerta FROM Alertas_Stock;

UPDATE Productos
SET Piezas = 3
WHERE Clave_Producto_PK = 'KC-30';

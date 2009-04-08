;<?php exit(); ?>

; Configuration file for the RPInventory application

; database server hostname
database_hostname = localhost

; username for RPInventory database
; This database user will be created with  SELECT, INSERT, UPDATE,
; and DELETE permissions on the RPInventory database specified
; below.
database_username = sullic5

; password for database user specified above
; CHANGE THIS FROM THE DEFAULT!
database_password = ibanez

; database name of RPInventory database
; If this database exists on the specified server, its contents will
; be erased and the default RPInventory schema will be created.
; 
; If this database does not exit on the server, it will be created
; with the RPInventory schema.
database_name = rpinventory

; club name for this RPInventory installation
club_name = RPI TV
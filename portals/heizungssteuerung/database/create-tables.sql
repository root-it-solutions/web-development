-- Erstellen der Datenbank
CREATE DATABASE Heizungssteuerung;
USE Heizungssteuerung;

-- Erstellen der Wohnung-Tabelle
CREATE TABLE Wohnungen (
                           WohnungID INT AUTO_INCREMENT PRIMARY KEY,
                           Wohnungsname VARCHAR(100) NOT NULL
);

-- Erstellen der Benutzer-Tabelle
CREATE TABLE Benutzer (
                          BenutzerID INT AUTO_INCREMENT PRIMARY KEY,
                          Vorname VARCHAR(50) NOT NULL,
                          Nachname VARCHAR(50) NOT NULL,
                          Benutzername VARCHAR(50) NOT NULL UNIQUE,
                          Passwort VARCHAR(255) NOT NULL,
                          WohnungID INT,
                          FOREIGN KEY (WohnungID) REFERENCES Wohnungen(WohnungID)
);

-- Erstellen der Räume-Tabelle
CREATE TABLE Raeume (
                        RaumID INT AUTO_INCREMENT PRIMARY KEY,
                        Raumname VARCHAR(50) NOT NULL,
                        Etage VARCHAR(20) NOT NULL,  -- NEU: Angabe der Etage (z. B. EG, 1. OG, Keller)
                        WohnungID INT,
                        FOREIGN KEY (WohnungID) REFERENCES Wohnungen(WohnungID)
);

-- Erstellen der Thermostate-Tabelle
CREATE TABLE Thermostate (
                             ThermostatID INT AUTO_INCREMENT PRIMARY KEY,
                             RaumID INT,
                             Seriennummer VARCHAR(100) NOT NULL UNIQUE,
                             FOREIGN KEY (RaumID) REFERENCES Raeume(RaumID)
);

-- Erstellen der Heizungszeitplaene-Tabelle
-- Heizungszeitplaene-Tabelle mit Start- und Endzeit
CREATE TABLE Heizungszeitplaene (
                                    ZeitplanID INT AUTO_INCREMENT PRIMARY KEY,
                                    ThermostatID INT,
                                    Wochentag ENUM('Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag') NOT NULL,
                                    Uhrzeit TIME NOT NULL,
                                    Tagtemperatur DECIMAL(5,2) NOT NULL,
                                    Nachtabsenkungstemperatur DECIMAL(5,2) NOT NULL,
                                    Nachtabsenkung_start TIME NOT NULL,   -- Startzeit der Absenkung
                                    Nachtabsenkung_ende TIME NOT NULL,    -- Endzeit der Absenkung
                                    FOREIGN KEY (ThermostatID) REFERENCES Thermostate(ThermostatID)
);

-- Affichage Atao
    ---- Login Principale
    ---- Service Tsotra
        ---- Page mampiditra besoin
    ---- Service d'achat
        ---- Page Besoin Service
        ---- Page Besoin Entreprise
    ---- 

CREATE DATABASE gestion_commerciale;

\c gestion_commerciale;

CREATE SEQUENCE seq_personnelle;
CREATE SEQUENCE seq_service;
CREATE SEQUENCE seq_departement;
CREATE SEQUENCE seq_fournisseur;
CREATE SEQUENCE seq_produit;
CREATE SEQUENCE seq_stock;
CREATE SEQUENCE seq_besoin;
CREATE SEQUENCE seq_boncommande;
CREATE SEQUENCE seq_detailboncommande;

CREATE TABLE personnelle (
    idpersonnelle VARCHAR(15) DEFAULT 'PRS'||nextval('seq_personnelle') PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(50),
    mdp VARCHAR(50)
);

INSERT INTO personnelle(nom,prenom,email,mdp) VALUES('Dupont', 'Laura', 'laura@gmail.com', 'laura');
INSERT INTO personnelle(nom,prenom,email,mdp) VALUES('Martin', 'Thomas', 'thomas@gmail.com', 'thomas');
INSERT INTO personnelle(nom,prenom,email,mdp) VALUES('Dubois', 'Sophie', 'sophie@gmail.com', 'sophie');

CREATE TABLE DirecteurGeneral (
    idDG VARCHAR(15) PRIMARY KEY,
    nomDG VARCHAR(50)
);

INSERT INTO DirecteurGeneral(idDG, nomDG) VALUEs('DG001', 'Alexandre Leroy');

CREATE TABLE departementAchat (
    idDA VARCHAR(15) PRIMARY KEY,
    nomchef VARCHAR(50),
    mdp VARCHAR(30),
    idDG VARCHAR(15),
    FOREIGN KEY (idDG) REFERENCES DirecteurGeneral(idDG)
);
INSERT INTO departementAchat(idDA, nomchef, mdp, idDG) VALUEs('DPA001','Cristiano Frederic', 'achat','DG001');

CREATE TABLE Finance (
    idFinance VARCHAR(15) PRIMARY KEY,
    nomchef VARCHAR(50),
    mdp VARCHAR(30),
    idDG VARCHAR(15),
    FOREIGN KEY (idDG) REFERENCES DirecteurGeneral(idDG)
);
INSERT INTO Finance(idFinance, nomchef, mdp, idDG) VALUEs('FIN001','Loic Rakoto', 'finance','DG001');

CREATE TABLE departement (
    iddepartement VARCHAR(15) DEFAULT 'DEP'||nextval('seq_departement') PRIMARY KEY,
    nomdepartement VARCHAR(50),
    idchef VARCHAR(15),
    idDG VARCHAR(15),
    FOREIGN KEY (idchef) REFERENCES personnelle(idpersonnelle),
    FOREIGN KEY (idDG) REFERENCES DirecteurGeneral(idDG)
);

INSERT INTO departement(nomdepartement,idchef,idDG) VALUES('Departement des Ventes et du Marketing', 'PRS2', 'DG001');
INSERT INTO departement(nomdepartement,idchef,idDG) VALUES('Departement des Ressources Humaines', 'PRS3', 'DG001');
INSERT INTO departement(nomdepartement,idchef,idDG) VALUES('Departement de l Agriculture', 'PRS1', 'DG001');

--- Vue detailDepartement
CREATE VIEW DetailDepartement AS
SELECT dep.*, per.nom, per.prenom, per.email, per.mdp FROM departement dep
JOIN personnelle as per ON dep.idchef = per.idpersonnelle;

CREATE TABLE service (
    idservice VARCHAR(15) DEFAULT 'SER'||nextval('seq_service') PRIMARY KEY,
    nomservice VARCHAR(50),
    nomchefservice VARCHAR(50),
    mdp VARCHAR(30),
    iddepartement VARCHAR(15),
    FOREIGN KEY (iddepartement) REFERENCES departement(iddepartement)
);

INSERT INTO service(nomservice, nomchefservice, mdp, iddepartement) VALUES('Ventes', 'Roman Scott', 'vente', 'DEP1');
INSERT INTO service(nomservice, nomchefservice, mdp, iddepartement) VALUES('Marketing', 'Andrew Bogut', 'marketing', 'DEP1');
INSERT INTO service(nomservice, nomchefservice, mdp, iddepartement) VALUES('Recrument et Selection', 'Camille Roussel', 'recru', 'DEP2');
INSERT INTO service(nomservice, nomchefservice, mdp, iddepartement) VALUES('Administration du Personnel', 'Donald Trump', 'perso', 'DEP2');
INSERT INTO service(nomservice, nomchefservice, mdp, iddepartement) VALUES('Administration de Culture', 'Rakoto Jean', 'culture', 'DEP3');


CREATE TABLE fournisseur (
    idfournisseur VARCHAR(15) DEFAULT 'FRS'||nextval('seq_fournisseur') PRIMARY KEY,
    nom VARCHAR(50),
    adresse VARCHAR(50),
    contact VARCHAR(30),
    email VARCHAR(100)
);

INSERT INTO fournisseur(nom,adresse, contact, email) VALUES('Jumbo Score', 'Tanjombato', '034 52 125 96', 'jumboscore@gmail.com');
INSERT INTO fournisseur(nom,adresse, contact, email) VALUES('Super U', 'Analakely', '034 51 202 98', 'superu@gmail.com');
INSERT INTO fournisseur(nom,adresse, contact, email) VALUES('Leader Price', 'Tanjombato', '034 78 951 23', 'leaderprice@gmail.com');

CREATE TABLE produit (
    idproduit VARCHAR(15) DEFAULT 'PRO'||nextval('seq_produit') PRIMARY KEY,
    nomproduit VARCHAR(50),
    unite VARCHAR(15),
    TVA INT
);

INSERT INTO produit(nomproduit,unite,TVA) VALUES('Cahier', 'piece', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Stylo', 'piece', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Ordinateur', 'piece', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Table Bureau', 'piece', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Riz', 'Kg', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Cache Bouche', 'piece', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Gel', 'litre', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Imprimante', 'piece', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Encre', 'litre', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Ecran', 'piece', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Prise Multiple', 'piece', 1);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Engrais', 'Kg', 0);
INSERT INTO produit(nomproduit,unite,TVA) VALUES('Grain', 'Kg', 0);

CREATE TABLE stock (
    idstock VARCHAR(15) DEFAULT 'STK'||nextval('seq_stock') PRIMARY KEY,
    idfournisseur VARCHAR(15),
    idproduit VARCHAR(15),
    prixunitaire FLOAT,
    quantite FLOAT,
    FOREIGN KEY (idfournisseur) REFERENCES fournisseur(idfournisseur),
    FOREIGN KEY (idproduit) REFERENCES produit(idproduit)
);

INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO1', 4800, 450);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO2', 600, 200);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO3', 1000000, 55);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO4', 600000, 25);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO5', 3000, 2000);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO6', 250, 600);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO7', 2000, 600);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO10', 600000, 56);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS2', 'PRO1', 4799, 600);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS2', 'PRO2', 599, 400);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS2', 'PRO11', 11000, 200);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS3', 'PRO1', 4500, 120);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS3', 'PRO2', 650, 100);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS3', 'PRO9', 5000, 100);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS3', 'PRO8', 150000, 40);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS3', 'PRO7', 1900, 100);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS3', 'PRO6', 240, 100);

INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO12', 2000, 600);
INSERT INTO stock(idfournisseur, idproduit, prixunitaire, quantite) VALUES('FRS1', 'PRO13', 1500, 1200);

-- Vue getValeur Produit minimun par produit 
-- CREATE OR REPLACE VIEW prixminim AS
-- SELECT idproduit, MIN(prixunitaire) as minprix FROM stock
-- GROUP BY idproduit;

-- CREATE OR REPLACE VIEW stockPrixMinim AS
-- SELECT stock.*, pd.nomproduit, pd.unite, pd.TVA FROM stock
-- JOIN prixminim pr ON stock.idproduit=pr.idproduit AND stock.prixunitaire=pr.minprix
-- JOIN produit pd ON stock.idproduit = pd.idproduit;

CREATE TABLE besoin (
    idbesoin VARCHAR(15) DEFAULT 'BES'||nextval('seq_besoin') PRIMARY KEY,
    idproduit VARCHAR(15),
    idservice VARCHAR(15),
    quantite FLOAT,
    datedemande DATE,
    dateexpiration DATE,
    etat INT DEFAULT 0,
    FOREIGN KEY (idproduit) REFERENCES produit(idproduit),
    FOREIGN KEY (idservice) REFERENCES service(idservice)
);

INSERT INTO besoin(idproduit,idservice,quantite,datedemande,dateexpiration,etat) VALUES('PRO1','SER3',25,'2023-11-16','2023-11-30',1);
INSERT INTO besoin(idproduit,idservice,quantite,datedemande,dateexpiration,etat) VALUES('PRO1','SER3',35,'2023-11-16','2023-11-30',1);
INSERT INTO besoin(idproduit,idservice,quantite,datedemande,dateexpiration,etat) VALUES('PRO1','SER3',55,'2023-11-16','2023-11-30',1);
INSERT INTO besoin(idproduit,idservice,quantite,datedemande,dateexpiration,etat) VALUES('PRO3','SER3',10,'2023-11-16','2023-11-30',1);
INSERT INTO besoin(idproduit,idservice,quantite,datedemande,dateexpiration,etat) VALUES('PRO3','SER4',12,'2023-11-16','2023-11-30',1);

-- Vue besoin Grouper
-- CREATE OR REPLACE VIEW besoinGrouper AS
-- SELECT idproduit, SUM(quantite) as quantitebesoin FROM besoin 
-- WHERE etat = 1
-- GROUP BY idproduit;

-- -- Vue get Facture Proforma en fonction du besoin
-- CREATE OR REPLACE VIEW FactProforma AS
-- SELECT bes.*, spm.idfournisseur, spm.prixunitaire, spm.nomproduit, spm.TVA FROM besoingrouper bes
-- JOIN stockPrixMinim as spm ON bes.idproduit=spm.idproduit;


CREATE TABLE boncommande (
    idboncommande VARCHAR(15) DEFAULT 'BDC'||nextval('seq_boncommande') PRIMARY KEY,
    idfournisseur VARCHAR(15),
    livraisonpartielle INT,
    typepayement VARCHAR,
    dateboncommande DATE,
    etat INT,
    FOREIGN KEY (idfournisseur) REFERENCES fournisseur(idfournisseur)
);

create or replace view boncommandedetaille as
select bc.*,f.nom,f.adresse,f.contact,f.email from boncommande bc
join fournisseur f on bc.idfournisseur=f.idfournisseur;

CREATE TABLE detailboncommande (
    iddetailboncommande VARCHAR(15) DEFAULT 'DTB'||nextval('seq_detailboncommande') PRIMARY KEY, 
    idboncommande VARCHAR(15),
    idproduit VARCHAR(15),
    quantite FLOAT,
    FOREIGN KEY (idboncommande) REFERENCES boncommande(idboncommande)
);

create or replace view detailbdc as
select dt.*,p.nomproduit,p.unite,p.tva,st.prixunitaire,bc.idfournisseur from detailboncommande dt
join produit p on dt.idproduit=p.idproduit
join boncommande bc on dt.idboncommande = bc.idboncommande
join fournisseur fr on bc.idfournisseur = fr.idfournisseur
join stock st on fr.idfournisseur = st.idfournisseur and dt.idproduit = st.idproduit;


create or replace view proformat as select f.idfournisseur,p.idproduit,ss.idservice ,
 b.quantite quantiteBesoin, b.etat etatBesoin, s.quantite quantiteStock,p.nomproduit,p.unite,ss.nomservice,f.nom nomFournisseur,s.prixunitaire,b.etat
 from besoin as b
	join stock as s on s.idproduit=b.idproduit
	join fournisseur as f on f.idfournisseur=s.idfournisseur
	join produit as p on p.idproduit=b.idproduit
	join service as ss on ss.idservice=b.idservice;


create or replace view proformats as select sum(quantitebesoin),idfournisseur,prixunitaire,quantitestock,idproduit,nomproduit,nomFournisseur,unite,etat
 from proformat where etat=1 group by idfournisseur,prixunitaire,quantitestock,idproduit,nomproduit,nomFournisseur,unite,etat ;

 CREATE OR REPLACE VIEW detailBesoin as select   
    b.idbesoin,
    b.idproduit,
    b.idservice,
    b.quantite,
    b.datedemande,
    b.dateexpiration,
    b.etat,
    s.nomservice,
    s.nomchefservice,
    s.mdp,
    s.iddepartement,
    p.nomproduit,
    p.unite,
    p.tva from besoin b 
        join service s on b.idservice=s.idservice 
        join produit p on p.idproduit=b.idproduit;
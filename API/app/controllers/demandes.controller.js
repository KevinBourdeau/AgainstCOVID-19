const db = require("../models");
const Demande = db.demandes;

// Création et sauvegarde d'une nouvelle demande
exports.create = (req, res) => {
  // Vérifie que la requête n'est pas vide
  if (!req.body.nom) {
    res.status(400).send({
      error: "La requête est vide !"
    });
    return;
  }

  var nowDate = new Date();

  // Création de la demande
  const demande = {
      nom: req.body.nom,
      prenom: req.body.prenom,
      nom_etablissement: req.body.nom_etablissement,
      tel: req.body.tel,
      email: req.body.email,
      quantite: req.body.quantite,
      date: nowDate.getDate()+'/'+(nowDate.getMonth()+1)+'/'+nowDate.getFullYear(),
      statut: 0
  };

  console.log(demande);

  // Sauvegarde dans la BDD
  Demande.create(demande)
    .then(data => {
      res.send({
        message: "L'entrée a été correctement ajoutée."
      });
    })
    .catch(err => {
      res.status(500).send({
        error:
          err.message || "Il y a eu une erreur lors de la tentative de création de la demande."
      });
    });
};

// Mise à jour d'une entrée de la table
exports.update = (req, res) => {
  const id = req.params.id;

  Demande.update(req.body, {
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "L'entrée a été correctement modifiée."
        });
      } else {
        res.send({
          error: "Impossible de mofifier l'entrée avec l'id " + id
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        error:
          err.message ||  "Il y a eu une erreur lors de la tentative de modification de l'entrée avec l'id " + id
      });
    });
};

// Suppression d'une entrée de la table
exports.delete = (req, res) => {
  const id = req.params.id;

  Demande.destroy({
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "L'entrée a été correctement supprimée"
        });
      } else {
        res.send({
          error: "Impossible de supprimer l'entrée avec l'id" + id
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        error:
          err.message ||  "Il y a eu une erreur lors de la tentative de suppression de l'entrée avec l'id " + id
      });
    });
};

// Retourne toutes les entrées de la table
exports.findAll = (req, res) => {
  Demande.findAll()
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        error:
          err.message || "Une erreur est advenue lors de la récupération des entrées."
      });
    });
};
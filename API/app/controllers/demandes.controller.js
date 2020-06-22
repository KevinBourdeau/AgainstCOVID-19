const db = require("../models");
const Demande = db.demandes;
const Op = db.Sequelize.Op;

// Create and Save a new Demande
exports.create = (req, res) => {
  // Validate request
  if (!req.body.nom) {
    res.status(400).send({
      message: "Content can not be empty!"
    });
    return;
  }

  var nowDate = new Date();

  // Create a Demande
  const demande = {
      nom: req.body.nom,
      prenom: req.body.prenom,
      nom_etablissement: req.body.etablissement,
      tel: req.body.tel,
      email: req.body.email,
      quantite: req.body.quantite,
      date: nowDate.getDate()+'/'+(nowDate.getMonth()+1)+'/'+nowDate.getFullYear(),
      statut: 0
  };

  console.log(demande);

  // Save Demande in the database
  Demande.create(demande)
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while creating the Demande."
      });
    });
};

exports.update = (req, res) => {
  const id = req.params.id;

  Demande.update(req.body, {
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "Demande was updated successfully."
        });
      } else {
        res.send({
          message: `Cannot update Demande with id=${id}. Maybe Demande was not found or req.body is empty!`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Error updating Demande with id=" + id
      });
    });
};

exports.delete = (req, res) => {
  const id = req.params.id;

  Demande.destroy({
    where: { id: id }
  })
    .then(num => {
      if (num == 1) {
        res.send({
          message: "Demande was deleted successfully!"
        });
      } else {
        res.send({
          message: `Cannot delete Demande with id=${id}. Maybe Demande was not found!`
        });
      }
    })
    .catch(err => {
      res.status(500).send({
        message: "Could not delete Demande with id=" + id
      });
    });
};

exports.findAll = (req, res) => {
  Demande.findAll()
    .then(data => {
      res.send(data);
    })
    .catch(err => {
      res.status(500).send({
        message:
          err.message || "Some error occurred while retrieving Demandes."
      });
    });
};
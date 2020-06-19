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

    // Create a Demande
    const demande = {
        nom: req.body.nom,
        prenom: req.body.prenom,
        nom_etablissement: req.body.etablissement,
        tel: req.body.tel,
        email: req.body.email,
        quantite: req.body.quantite,
        date: req.body.date
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
module.exports = app => {
    const demandes = require("../controllers/demandes.controller.js");
  
    var router = require("express").Router();
  
    // Création d'une nouvelle entrée
    router.post("/", demandes.create);
    
    // Modification d'une entrée via id
    router.put("/:id", demandes.update);

    // Suppression d'une entrée via id
    router.delete("/:id", demandes.delete);

    // Récupération de toutes les entrées
    router.get("/", demandes.findAll);
  
    // Route de base
    app.use('/api/demandes', router);
  };
module.exports = app => {
    const demandes = require("../controllers/demandes.controller.js");
  
    var router = require("express").Router();
  
    // Create a new Demande
    router.post("/", demandes.create);
    
    // Update a Demande with id
    router.put("/:id", demandes.update);

    // Delete a Demande with id
    router.delete("/:id", demandes.delete);

    // Retrieve all Demandes
    router.get("/", demandes.findAll);
  
    app.use('/api/demandes', router);
  };
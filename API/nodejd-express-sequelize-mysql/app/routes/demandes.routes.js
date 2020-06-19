module.exports = app => {
    const demandes = require("../controllers/demandes.controller.js");
  
    var router = require("express").Router();
  
    // Create a new Demande
    router.post("/", demandes.create);
  
    app.use('/api/demandes', router);
  };
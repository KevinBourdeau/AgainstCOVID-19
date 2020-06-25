module.exports = (sequelize, Sequelize) => {
    return sequelize.define("demandes", {
      nom: {
        type: Sequelize.STRING(50)
      },
      prenom: {
        type: Sequelize.STRING(50)
      },
      nom_etablissement: {
        type: Sequelize.STRING(255)
      },
      tel: {
        type: Sequelize.STRING(10)
      },
      email: {
        type: Sequelize.STRING(50)
      },
      quantite: {
        type: Sequelize.INTEGER(11)
      },
      date: {
        type: Sequelize.STRING(20)
      },
      statut: {
        type: Sequelize.INTEGER(1)
      }
    },
    {
      timestamps: false
    },
    {
      tablename: 'demandes'
    });
  };
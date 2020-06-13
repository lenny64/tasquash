tasquash.controller('homeController', ['$scope', '$cookies', '$routeParams', 'apiService', 'sessionService', function($scope, $cookies, $routeParams, $apiService, $sessionService) {

    $scope.logged_in = $sessionService.getUserLoggedIn();

    $scope.taches_liste = [
        {
            titre: "Poser du parquet",
            descriptionCourte: "Pour poser du parquet",
            contenu: "Je cherche quelqu'un qui soit capable d'installer du parquet chez moi !",
            rating: 4,
            pseudo: "Didier_3"
        },
        {
            titre: "Installer une douche",
            descriptionCourte: "Pose de douche",
            contenu: "Et si quelqu'un pouvait m'aider à installer ma douche dans la salle de bains ? J'y arrive pas moi !",
            rating: 3,
            pseudo: "Didier_3"
        },
        {
            titre: "Faire un site web",
            descriptionCourte: "Je voudrais faire un site web",
            contenu: "Si quelqu'un sait faire un site web je suis preneur :)",
            rating: 1,
            pseudo: "Didier_3"
        }
    ];

    $scope.montrerTache = function(tache) {
        $scope.tache_to_show = tache;
    }
    $scope.tache_to_show = false;
}]);

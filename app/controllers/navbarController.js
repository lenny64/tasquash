tasquash.controller('navbarController', ['$scope', '$cookies', 'apiService', 'sessionService', function($scope, $cookies, $apiService, $sessionService) {

    $scope.logged_in = $sessionService.logged_in;

    $scope.navbar = [
        { lien: '#/accueil', texte: 'Home' },
        { lien: '#/login', texte: 'Login' }
    ];

}]);

tasquash.controller('navbarController', ['$scope', '$cookies', 'apiService', 'sessionService', function($scope, $cookies, $apiService, $sessionService) {

    $scope.logged_in = $sessionService.getUserLoggedIn();

    $scope.navbar = [
        { lien: '#/accueil', texte: 'Home' },
        { lien: '#/login', texte: 'Login' }
    ];

    $scope.logout = function() {
        $scope.logged_in = false;
        $sessionService.logOut();
    }
    $scope.checkLogin = function() {
        $scope.logged_in = $cookies.get('logged_in');
        return $scope.logged_in;
    }

}]);

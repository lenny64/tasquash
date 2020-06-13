tasquash.controller('loginController', ['$scope', '$cookies', '$routeParams', '$location', 'apiService', 'sessionService', function($scope, $cookies, $routeParams, $location, $apiService, $sessionService) {

    $scope.logged_in = $sessionService.getUserLoggedIn();

    $scope.login = function() {
        $scope.logged_in = $apiService.login($scope.user_login, $scope.user_password).then(function(reponse) {
            if (reponse.data.logged_in == true) {
                $scope.logged_in = true;
                $location.path('#/home');
            }
        });
        $sessionService.setUserLoggedIn();
    }

}]);

tasquash.controller('loginController', ['$scope', '$cookies', '$routeParams', 'apiService', 'sessionService', function($scope, $cookies, $routeParams, $apiService, $sessionService) {

    $scope.logged_in = $sessionService.logged_in;

    $scope.login = function() {
        $scope.logged_in = $apiService.login($scope.user_login, $scope.user_password);
        $sessionService.setUserLoggedIn();
    }
    
}]);

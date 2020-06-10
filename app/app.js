var tasquash = angular.module('tasquash', ['ngRoute', 'ngCookies']);


tasquash.config(function($routeProvider) {
    $routeProvider
        .when('/accueil', {
            templateUrl: 'views/home.html',
            controller: 'homeController'
        })
        .when('/login', {
            templateUrl: 'views/login.html',
            controller: 'loginController'
        })
        .otherwise({
            templateUrl: 'views/home.html',
            controller: 'homeController'
        });
});

tasquash.config(['$locationProvider', function($locationProvider) {
    $locationProvider.hashPrefix('');
}]);

tasquash.service('sessionService', ['$cookies', function($cookies) {
    this.username = $cookies.get('username');
    this.logged_in = ($cookies.get('logged_in') === "true") ? true : false;

    this.setUserLoggedIn = function() {
        this.logged_in = true;
        $cookies.logged_in = true;
    }

}]);

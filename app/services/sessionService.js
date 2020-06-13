tasquash.service('sessionService', ['$cookies', function($cookies) {
    this.username = $cookies.get('username');
    this.logged_in = ($cookies.get('logged_in') === "true") ? true : false;

    this.setUserLoggedIn = function() {
        this.logged_in = true;
        $cookies.put('logged_in', true);
    }
    this.getUserLoggedIn = function() {
        if ($cookies.get('logged_in') === "true" || this.logged_in === true) {
            return true;
        }else {
            return false;
        }
    }
    this.logOut = function() {
        $cookies.put('logged_in', false);
        this.logged_in = false;
    }

}]);

tasquash.service('apiService', ['$http', '$cookies', function($http, $cookies) {
    api = {url: '../api/'};
    this.login = function(username, password) {
        var data = {'username': username, 'password': password};
        return $http.post(api.url + 'login.php', data);
    }
}]);

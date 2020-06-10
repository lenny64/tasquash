tasquash.service('apiService', ['$http', '$cookies', function($http, $cookies) {
    this.login = function(username, password) {
        var logged_in = false;
        var liste_utilisateurs = [{username: 'boubacar', password: 'boubacar'}, {username: 'test', password: 'test'}];
        $.each(liste_utilisateurs, function(i, utilisateur) {
            if (utilisateur.username == username && utilisateur.password == password) {
                logged_in = true;
            }
        });
        return logged_in;
    }
}]);

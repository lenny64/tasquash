tasquash.service('apiService', ['$http', '$cookies', function($http, $cookies) {
    api = {url: '../api/'};


    // USER
    this.login = function(username, password) {
        var data = {'username': username, 'password': password};
        return $http.post(api.url + 'login.php', data);
    }
    this.getAllUsers = function() {
        return $http.get(api.url + 'users/getAllUsers.php');
    }
    this.getUserSkills = function(user_id) {
        return $http.get(api.url + 'users/getUserSkills.php?user_id=' + user_id);
    }
    this.getUserTasks = function(user_id) {
        return $http.get(api.url + 'users/getUserTasks.php?user_id=' + user_id);
    }
    this.addUserSkill = function(data) {
        return $http.put(api.url + 'users/addUserSkill.php', data);
    }
    this.getPossibleSquashs = function(user_id) {
        return $http.get(api.url + 'users/getPossibleSquashs.php?user_id=' + user_id);
    }

    // SKILLS
    this.getAllSkills = function() {
        return $http.get(api.url + 'skills/getAllSkills.php');
    }

    // TASKS
    this.addUserTask = function(data) {
        return $http.put(api.url + 'tasks/addUserTask.php', data);
    }

}]);

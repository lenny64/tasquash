tasquash.controller('homeController', ['$scope', '$cookies', '$routeParams', 'apiService', 'sessionService', function($scope, $cookies, $routeParams, $apiService, $sessionService) {

    $scope.logged_in = $sessionService.getUserLoggedIn();

    // *******************
    // USERS ************
    // *******************
    $scope.getAllUsers = function() {
        $apiService.getAllUsers().then(function(reponse) {
            $scope.users_list = reponse.data;
        });
    }
    $scope.selectUser = function() {
        $scope.getUserSkills();
        $scope.getUserTasks();
        $scope.getPossibleSquashs();
    }

    // ****************
    // SKILLS *********
    // ****************
    $scope.getAllSkills = function() {
        $apiService.getAllSkills().then(function(reponse) {
            $scope.all_skills_list = reponse.data;
        });
    }
    $scope.getUserSkills = function() {
        $apiService.getUserSkills($scope.selected_user.id).then(function(reponse) {
            $scope.selected_user.skills_list = reponse.data;
        });
    }
    $scope.addUserSkill = function() {
        var data = {
            user_id: $scope.selected_user.id,
            category_id: $scope.selected_skill.id,
            text: $scope.text
        };
        $apiService.addUserSkill(data).then(function(reponse) {
            $scope.getUserSkills();
        });
    }

    // *****************
    // TASKS ***********
    // *****************
    $scope.getUserTasks = function() {
        $apiService.getUserTasks($scope.selected_user.id).then(function(reponse) {
            $scope.selected_user.tasks_list = reponse.data;
        });
    }
    $scope.getPossibleSquashs = function() {
        $apiService.getPossibleSquashs($scope.selected_user.id).then(function(reponse) {
            $scope.selected_user.possible_squashs_list = reponse.data;
        });
    }

    $scope.getAllUsers();
    $scope.getAllSkills();
}]);

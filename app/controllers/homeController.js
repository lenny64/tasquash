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
        $scope.getPossibleQuashs();
    }
    $scope.addUser = function() {
        var data = {
            pseudo: $scope.new_user_pseudo,
            email: $scope.new_user_email,
            firstname: $scope.new_user_firstname,
            lastname: $scope.new_user_lastname,
            password: $scope.new_user_password
        };
        $apiService.addUser(data).then(function(reponse) {
            $scope.users_list.push(reponse.data);
            $scope.selected_user = reponse.data;
        });
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
    $scope.addSkill = function() {
        var data = {
            skill_name: $scope.skill_name
        };
        $apiService.addSkill(data).then(function(reponse) {
            $scope.show_new_skill_form = false;
            $scope.all_skills_list.push(reponse.data);
            $scope.selected_skill = reponse.data;
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
            $scope.show_user_skill_form = false;
            $scope.text = '';
        });
    }
    $scope.removeUserSkill = function(skill) {
        var data = {
            category_id: skill.id,
            user_id: $scope.selected_user.id
        };
        $apiService.removeUserSkill(data).then(function(reponse) {
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
    $scope.addUserTask = function() {
        var data = {
            taskmaster: $scope.selected_user.id,
            description: $scope.description,
            category_id: $scope.selected_skill.id,
            title: $scope.title,
            distance: $scope.distance,
            deadline: $scope.deadline
        };
        $apiService.addUserTask(data).then(function(reponse) {
            $scope.getUserTasks();
            $scope.show_user_task_form = false;
            $scope.description = '';
            $scope.title = '';
        });
    }
    $scope.removeUserTask = function(task) {
        $apiService.removeUserTask(task.id).then(function(reponse) {
            $scope.getUserTasks();
        });
    }

    // *******************
    // QUASHS
    // *******************
    $scope.getPossibleQuashs = function() {
        $apiService.getPossibleQuashs($scope.selected_user.id).then(function(reponse) {
            $scope.selected_user.possible_quashs_list = reponse.data;
            $scope.selected_user.interesting_quashs_list = [];
            $.each($scope.selected_user.possible_quashs_list, function(i, task) {
                if (task.status == 'created') {
                    $scope.selected_user.interesting_quashs_list.push(task);
                }
                if (task.offers) {
                    $.each(task.offers, function(j, offer) {
                        if (offer.user_id && offer.user_id == $scope.selected_user.id) {
                            $scope.selected_user.possible_quashs_list[i]['already_applied'] = true;
                        }
                    });
                }
            });
        });
    }
    $scope.makeQuashApplication = function(quash) {
        var data = {
            quasher: $scope.selected_user.id,
            task_id: quash.id
        };
        $apiService.makeQuashApplication(data).then(function(reponse) {
            $scope.getPossibleQuashs();
        });
    }
    $scope.acceptOffer = function(offer) {
        $apiService.acceptOffer(offer).then(function(reponse) {
            $scope.getUserTasks();
        });
    }

    $scope.view = 'tasks';
    $scope.getAllUsers();
    $scope.getAllSkills();
}]);

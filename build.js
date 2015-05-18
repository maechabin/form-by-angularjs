var angular = angular || {};
var formApp = angular.module("formApp", []);

formApp.controller("FormController", ["$scope", "$http", function ($scope, $http) {

  "use strict";

  $scope.master = {};

  $scope.send = function (user) {

    this.master = angular.copy(user);

    $http({
      method: "POST",
        url: "./index.php",
        params: this.master
      })
      .success(function (data, status, headers, config) {
        $scope.message = "success";
      })
      .error(function (data, status, headers, config) {
        $scope.message = "failed";
      });

  };

}]);

var angular = angular || {};
var formApp = angular.module("formApp", []);

formApp.controller("FormController", ["$scope", "$http", function ($scope, $http) {

  "use strict";

  $scope.master = {};

  $scope.send = function (user) {

    this.master = angular.copy(user);

    $http({
      method: "POST",
        url: "http://example.com/wp-admin/admin-ajax.php",
        params: this.master
      })
      .success(function (data, status, headers, config) {
        $scope.message = data.title; // 適宜変更する
      })
      .error(function (data, status, headers, config) {
        $scope.message = "failed";
      });

   };

 }]);

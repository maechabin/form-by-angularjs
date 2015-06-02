var angular = angular || {};
var formApp = angular.module("formApp", []);

formApp.controller("FormController", ["$scope", "$http", function ($scope, $http) {

  "use strict";

  $scope.master = {};

  $scope.submit = function (user) {

    this.master = angular.copy(user);
    //console.log(this.master);

    $http({
      method: "GET",
        url: "./index.php",
        params: this.master
      })
      .success(function (data, status, headers, config) {
        this.message = "success";
        location.hash = "#" + this.message;
        //console.log($scope.message);
        //console.dir(arguments);
        angular.element(".form__list").html("お問い合わせを受け付けました。<br>ありがとうございます。");
      })
      .error(function (data, status, headers, config) {
        this.message = "failed";
        location.hash = "#" + this.message;
        //console.log($scope.message);
        //console.dir(arguments);
        angular.element(".form__list").html("お問い合わせの送信に失敗しました。<br>時間をおいてから再度お試しください。");
      });

  };

}]);

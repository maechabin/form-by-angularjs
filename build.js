var angular = angular || {};
var formApp = angular.module("formApp", []);

formApp.config(function ($locationProvider) {
  "use strict";
  $locationProvider.html5Mode(true);
});

formApp.controller("FormController", ["$scope", "$http", "$location", function ($scope, $http, $location) {

  "use strict";

  //console.dir($location.search());

  $scope.user = {
    name: $location.search().name
  };

  $scope.master = {};

  $scope.submit = function (user) {

    var that = this;
    that.master = angular.copy(user);
    //console.log(that.master);

    $http({
      method: "GET",
        url: "./index.php",
        params: that.master
      })
      .success(function (data, status, headers, config) {
        that.message = "success";
        $location.hash(that.message);
        //location.hash = "#" + that.message;
        //console.log(that.message);
        //console.dir(arguments);
        angular.element(".form__list").html("お問い合わせを受け付けました。<br>ありがとうございます。");
      })
      .error(function (data, status, headers, config) {
        that.message = "failed";
        $location.hash(that.message);
        //location.hash = "#" + that.message;
        //console.log(that.message);
        //console.dir(arguments);
        angular.element(".form__list").html("お問い合わせの送信に失敗しました。<br>時間をおいてから再度お試しください。");
      });

  };

}]);

var angular = angular || {};
var formApp = angular.module("formApp", []);

formApp.config(function ($locationProvider) {
  "use strict";
  $locationProvider.html5Mode(true);
});

formApp.controller("FormController", ["$scope", "$http", "$location", function ($scope, $http, $location) {

  "use strict";

  //console.dir($location.search());

  this.user = {
    name: $location.search().name
  };

  this.master = {};

  $scope.submit = function (user) {

    var self = this;
    self.master = angular.copy(user);
    //console.log(self.master);

    $http({
      method: "GET",
        url: "./index.php",
        params: self.master
      })
      .success(function (data, status, headers, config) {
        self.message = "success";
        $location.hash(self.message);
        //location.hash = "#" + that.message;
        //console.log(self.message);
        //console.dir(arguments);
        angular.element(".form__list").html("お問い合わせを受け付けました。<br>ありがとうございます。");
      })
      .error(function (data, status, headers, config) {
        self.message = "failed";
        $location.hash(self.message);
        //location.hash = "#" + that.message;
        //console.log(self.message);
        //console.dir(arguments);
        angular.element(".form__list").html("お問い合わせの送信に失敗しました。<br>時間をおいてから再度お試しください。");
      });

  };

}]);

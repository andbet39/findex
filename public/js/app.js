/**
 * Created by andrea.terzani on 22/04/2015.
 */
var app = angular.module('fileApp', ['angularFileUpload'], function() {

});


    app.controller('fileController', ['$scope', '$upload','$http', function ($scope, $upload,$http) {

        $scope.uploaded = [];

        $scope.$watch('files', function () {
            $scope.upload($scope.files);
        });

        $scope.upload = function (files) {
            if (files && files.length) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    $upload.upload({
                        url: '/files',
                        fields: {'username': $scope.username},
                        file: file
                    }).progress(function (evt) {
                        var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                        console.log('progress: ' + progressPercentage + '% ' + evt.config.file.name);
                    }).success(function (data, status, headers, config) {
                        console.log('file ' + config.file.name + 'uploaded. Response: ' + data);
                        $scope.getfile();
                    });
                }
            }


        };

        $scope.getfile = function(){
            $http.get('/listfile').
                success(function(data, status, headers, config) {
                    $scope.uploaded = data;
                });
        };

        $scope.getfile();

    }]);



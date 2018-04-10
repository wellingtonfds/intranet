app.controller('patternController', ['$scope', '$http','Upload', function ($scope, $http,Upload) {
    $scope.documents = [];
    $scope.disciplines = [];
    $scope.subDisciplines = [];
    $scope.categories = [];
    function getDocuments(){
        $http.get('/documents').then(function (response) {
            $scope.documents = response.data;
        })
    }
    function getDiscipline(){
        $http.get('/discipline').then(function (response) {
            $scope.disciplines = response.data;
        })
    }
    function getSubDisciplne(discipline) {
        $http.get('/discipline/sub/'+discipline).then(function (response) {
            $scope.subDisciplines = response.data;
        })
    }
    function getCategory(discipline,subDiscipline){
        $http.get('/discipline/cat/'+discipline+'/'+subDiscipline).then(function (response) {
            $scope.categories = response.data;
        });
    }
    function traitResponse(response) {
        switch (response.status) {
            case 500:
                swal(
                    'Fail! ' + response.status,
                    response.statusText,
                    'error'
                )
                break;
            case 422:
                var messagem = "";
                $.each(response.data, function (index, item) {
                    messagem += item[0] + "<br>";
                });
                swal(
                    'Oops...',
                    messagem,
                    'error'
                )
                break;
            case 405:
                swal(
                    'Fail! ' + response.status,
                    response.statusText,
                    'error'
                )
                break;
            default:
        }
    }

    function storeDocument(documentStore) {
        Upload.upload({
            url: '/document',
            data: documentStore,
        }).then(function (resp) {
            getDocuments();
            swal(
                'Good job!',
                'Documento salvo!',
                'success'
            )
            delete $scope.document;
            $('#newCategory').modal('hide')
        },function (response) {
            traitResponse(response);
        });
    }
    function deleteDocument(documentDelete){
        $http({
            url:'/document/'+documentDelete.id,
            method:'delete'
        }).then(function (response) {
            getDocuments();
            swal(
                'Good job!',
                'Documento deletado!',
                'success'
            )
        },function (response) {
            traitResponse(response);
        })
    }
    function udpdateDocument(documentStore) {
        console.log(documentStore);
        Upload.upload({
            url: '/documents/'+documentStore.id,
            data: documentStore,
        }).then(function (resp) {
            getDocuments();
            swal(
                'Good job!',
                'Documento salvo!',
                'success'
            )
            delete $scope.document;
            $('#editCategory').modal('hide')
        },function (response) {
            traitResponse(response);
        });
    }
    getDiscipline();
    getDocuments();

    $scope.getSubDiscipline = function (discipline) {
        getSubDisciplne(discipline);
    }

    $scope.getCategory = function (discipline,subDiscipline) {
        getCategory(discipline,subDiscipline)
    }

    $scope.save = function (documentForm) {
        storeDocument(documentForm);
    }
    $scope.edit = function (document) {
        $scope.document = angular.copy(document);
        $('#editCategory').modal('show');

    }
    $scope.update = function (documentUpdate) {
        udpdateDocument(documentUpdate);
    }
    $scope.delete = function (documentDelete) {
        swal({
            title: 'Deseja apagar o arquivo?',
            text: "Não será possível reverter a ação!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, pode apagar!'
        }).then(function(result){
            deleteDocument(documentDelete);
        });
    }
}]).directive("filesInput", function() {
    return {
        require: "ngModel",
        link: function postLink(scope,elem,attrs,ngModel) {
            elem.on("change", function(e) {
                var files = elem[0].files;
                ngModel.$setViewValue(files);
            })
        }
    }
});;